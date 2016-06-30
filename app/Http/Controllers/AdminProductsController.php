<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests\ProductImageRequest;
use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminProductsController extends Controller
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Tag
     */
    private $tag;

    /**
     * AdminProductsController constructor.
     * @param Product $product
     * @param Tag $tag
     */
    public function __construct(Product $product, Tag $tag)
    {
        $this->product = $product;
        $this->tag = $tag;
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

        $this->syncTags($request->get('tag_list'), $product->id);

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

        $this->syncTags($request->get('tag_list'), $id);

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

    public function images($id, Product $product)
    {
        $product = $product->find($id);

        return view('admin.products.images.index', compact('product'));
    }

    public function createImage($id, Product $product)
    {
        $product = $product->find($id);

        return view('admin.products.images.form', compact('product'));
    }

    public function storeImage(ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id' => $id, 'extension' => $extension]);

        Storage::disk('public_local')->put($image->id . '.' . $extension, File::get($file));

        return redirect()->route('admin.products.images.index', ['id' => $id]);
    }

    public function destroyImage($id, $idImage, ProductImage $productImage)
    {
        $image = $productImage->find($idImage);

        if (file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension)) {
            Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
        }

        $image->delete();

        return redirect()->route('admin.products.images.index', ['id' => $id]);
    }

    private function syncTags($tagList, $id)
    {
        $syncTag = [];
        $tags = explode(',', str_replace(';', ',', $tagList));
        $tags = array_filter($tags);
        $tags = array_map('trim', $tags);
        $tags = array_map('strip_tags', $tags);
        $tags = array_map('strtolower', $tags);

        foreach ($tags as $tag) {
            $syncTag[] = $this->tag->firstOrCreate(['name' => $tag])->id;
        }

        $product = $this->product->find($id);
        $product->tags()->sync($syncTag);
    }
}
