<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, Store $store)
    {
        $products = Product::where('store_id', $store->id)
            ->paginate($request->page_size ?? 10);


        return view('client.products.index', [
            'store' => $store,
            'products' => $products
        ]);
    }

    public function create(Store $store)
    {
        $categories = Category::select(['id', 'title'])
            ->with('children:id,parent_id,title')
            ->parent()
            ->where('store_id', $store->id)
            ->get()
            ->map(function ($category) {
                $category->text = $category->title;
                $category->makeHidden(['id', 'title']);
                $category->children = $category->children->map(function ($children) {
                    $children->text = $children->title;
                    return $children;
                });
                return $category;
            })
            ->toArray();

        return view('client.products.create', [
            'store' => $store,
            'categories' => $categories
        ]);
    }

    public function store(CreateRequest $request, Store $store)
    {
        $product = Product::create($request->validated());

        $product->categories()->sync($request->categories);

        $images = collect($request->images)->map(function ($link){
            return ['url' => $link];
        })->toArray();

        $product->images()->createMany($images);

        return redirect("$store->baseUri/admin/products")
            ->with('status', 'Product Created');
    }
}
