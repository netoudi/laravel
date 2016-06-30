<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;

class StoreController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $pFeatured = Product::featured()->get()->random(6);
        $pRecommend = Product::recommend()->get()->random(3);

        return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category = Category::find($id);

        return view('store.category', compact('categories', 'category'));
    }
}
