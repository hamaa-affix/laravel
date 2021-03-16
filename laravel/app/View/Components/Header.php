<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\PrimaryCategory;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $user = Auth::user();

    //これは教材のコード下記は実施で作成したコード、結果は同じ出力。何が違うのやら。
        // $categories = PrimaryCategory::query()->with(['secondaryCategories' => function($query) {
        //     $query->orderBy('sort_no');
        // }])->orderBy('sort_no')->get();

        $categories = PrimaryCategory::with(['secondaryCategories'])->orderBy('sort_no')->get();
        // dd($categories);

        return view('components.header', compact('user', 'categories'));
    }
}
