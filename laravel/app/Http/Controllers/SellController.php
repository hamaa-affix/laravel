<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SellRequest;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use App\Models\Item;

class SellController extends Controller
{
    public function showSellForm()
    {
        // orderBy()はasc(昇順) か desc(降順)を指定するが、指定しない場合はascとなる
        $conditions = ItemCondition::orderBy('sort_no')->get();
        $cotegories = PrimaryCategory::with('secondaryCategories')
                    ->orderBy('sort_no')
                    ->get();

        return view('sell')
                ->with('conditions', $conditions)
                ->with('categories', $cotegories);
    }

    public function sellItem(SellRequest $request)
    {

        $user = Auth::user();

        $item                        = new Item();
        $item->seller_id             = $user->id;
        $item->name                  = $request->input('name');
        $item->description           = $request->input('description');
        $item->secondary_category_id = $request->input('category');
        $item->item_condition_id     = $request->input('condition');
        $item->price                 = $request->input('price');
        //$item->state                 = Item::STATE_SELLING;
        $item->save();

        return redirect()->back()->with('status', '商品を出品しました。');
    }


}
