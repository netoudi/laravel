<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    /**
     * AdminProductsController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');
        $categories->prepend('Select a category');

        return view('admin.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();

        $product = $this->product->fill($input);

        $product->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        $product = $this->product->find($id);

        $categories = $category->lists('name', 'id');
        $categories->prepend('Select a category');

        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->product->find($id)->update($request->all());

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->find($id)->delete();

        return redirect()->route('admin.products.index');
    }
}
