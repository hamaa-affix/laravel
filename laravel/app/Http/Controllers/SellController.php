<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;

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


}
