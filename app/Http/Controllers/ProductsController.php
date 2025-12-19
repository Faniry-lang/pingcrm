<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    public function index(): Response
    {
        $sort = Request::input('sort');

        $query = Product::with('category')
            ->filter(Request::only('search', 'category'));

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('name');
        }

        return Inertia::render('Products/Index', [
            'filters' => Request::all('search', 'category', 'sort'),
            'categories' => Category::orderBy('name')->get()->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
            ]),
            'products' => $query
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($product) => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'is_active' => $product->is_active,
                    'category' => $product->category?->name,
                    'deleted_at' => $product->deleted_at,
                ]),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::orderBy('name')->get()->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
            ]),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return Redirect::route('products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Products/Edit', [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'is_active' => $product->is_active,
                'deleted_at' => $product->deleted_at,
            ],
            'categories' => Category::orderBy('name')->get()->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
            ]),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return Redirect::back()->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return Redirect::back()->with('success', 'Product deleted.');
    }

    public function restore(Product $product): RedirectResponse
    {
        $product->restore();

        return Redirect::back()->with('success', 'Product restored.');
    }
}
