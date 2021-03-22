<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * List parent categories
     *
     * @param Request $request
     * @param Store $store
     * @return View
     */
    public function index(Request $request, Store $store): View
    {
        $categories = Category::parent()
            ->select(['id', 'title', 'description', 'is_active'])
            ->where('store_id', $store->id)
            ->paginate($request->page_size ?? 10);


        return view('client.categories.index', [
            'store' => $store,
            'categories' => $categories
        ]);
    }

    /**
     * Create category form.
     *
     * @param Store $store
     * @return View
     */
    public function create(Store $store): View
    {
        $parentCategories = Category::parent()
            ->select(['id', 'title'])
            ->where('store_id', $store->id)
            ->get();

        return view('client.categories.create', [
            'store' => $store,
            'parentCategories' => $parentCategories
        ]);
    }

    /**
     * Store new Category
     *
     * @param CreateRequest $request
     * @param Store $store
     * @return Redirect
     */
    public function store(CreateRequest $request, Store $store)
    {
        Category::create($request->validated());

        return redirect("$store->baseUri/admin/categories")
            ->with('status', 'Category Created');
    }

    /**
     * Show category sub categories.
     *
     * @param Request $request
     * @param Store $store
     * @param Category $category
     * @return View
     */
    public function show(Request $request, Store $store, Category $category): View
    {
        $subCategories = Category::select(['id', 'title', 'description', 'is_active'])
            ->where('store_id', $store->id)
            ->where('parent_id', $category->id)
            ->paginate($request->page_size ?? 10);

        return view('client.categories.show', [
            'store' => $store,
            'category' => $category,
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Edit Category Details
     *
     * @param Store $store
     * @param Category $category
     * @return View
     */
    public function edit(Store $store, Category $category): View
    {
        $parentCategories = Category::parent()
            ->select(['id', 'title'])
            ->where('store_id', $store->id)
            ->where('id', '!=', $category->id)
            ->get();

        return view('client.categories.edit', [
            'store' => $store,
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }

    /**
     * Update category details
     *
     * @param UpdateRequest $request
     * @param Store $store
     * @param Category $category
     * @return Redirect
     */
    public function update(UpdateRequest $request, Store $store, Category $category)
    {
        $category->title = $request->title;
        $category->description = $request->description;
        $category->is_active = $request->is_active ?? 0;
        $category->parent_id = $request->parent_id;

        $category->save();

        return redirect("$store->baseUri/admin/categories")
            ->with('status', 'Category Updated');
    }

    /**
     * Delete category
     *
     * @param Store $store
     * @param Category $category
     * @return Redirect
     */
    public function destroy(Store $store, Category $category)
    {
        $category->delete();

        return redirect("$store->baseUri/admin/categories")
            ->with('status', 'Category Deleted');
    }
}
