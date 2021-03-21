<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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

                dd($categoryType);

            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($w) {
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
}
