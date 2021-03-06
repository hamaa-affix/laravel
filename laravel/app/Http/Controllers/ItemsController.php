<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {

        $query = Item::query();
        //カテゴリーの絞り込み
          // カテゴリで絞り込み
        if ($request->filled('category')) { // if($request->category){}?
            //list() -> 配列の要素を引数に指定した変数に格納する。jsでいう分割代入している
                list($categoryType, $categoryID) = explode(':', $request->input('category'));

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {
                    $query->where('primary_category_id', $categoryID);
                });
            } else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
        }

         // キーワードで絞り込み
         if ($request->filled('keyword')) {
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', $keyword);
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }

        $items = $query->orderByRaw( "FIELD(state, '" . Item::STATE_SELLING . "', '" . Item::STATE_BOUGHT . "')" )
        ->orderBy('id', 'DESC')
        ->paginate(52);

        return view('items.items')
            ->with('items', $items);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    public function showItemDetail (Item $item)
    {
        return view('items.item_detail', compact('item'));
    }

    public function showBuyItemForm(Item $item)
    {
        //abort(404)のヘルパーをコールすることで簡単に予期しないアクセスを、Not Foundのエラーページの表示ができます HTTP Exception なの404をthorwしているということ。なのでretureは必要ない。
        if(!$item->isStateSelling) {
            abort(404);
        }

        return view('items.item_buy_form',compact('item'));
    }

    public function buyItem(Request $request, Item $item)
    {
        $user = Auth::user();

        if (!$item->isStateSelling) {
            abort(404);
        }

        $token = $request->input('card-token');

        try {
            $this->settlement($item->id, $item->seller->id, $user->id, $token);
        } catch (Exception $e) {
            Log::error($e);
            return redirect()
                    ->back()
                    ->with('type', 'danger')
                    ->with('message', '購入処理に失敗しました');
        }

        return redirect()->route('item', [$item->id])
                        ->with('message', '商品を購入しました。');
    }

    public function settlement($itemID, $sellerID, $buyerID, $token)
    {
        DB::beginTransaction();

        try {
            $seller = User::lockForUpdate()->find($sellerID);
            $item   = Item::LocForUpdate()->find($itemID);

            if($item->isStateBought) {
                throw new \Exception('多重決済');
            }

            $item->state    = Item::STATE_BOUGHT;
            $item->bougt_at = Carbon::now();
            $item->buy_id   = $buyerID;
            $item->save();

            $seller->sales += $item->price;
            $seller->save();

        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
    }
}
