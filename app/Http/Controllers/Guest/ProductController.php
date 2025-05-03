<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
    }

    /**
     * Show the application product details page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($slug)
    {
        $product = $this->product->getProductBySlug($slug);
    
        if(!$product) {
            abort(404);
        }

        $relatedProducts = $this->product->getRelatedProducts($product->id);

        return view('pages.product.show', compact('product', 'relatedProducts'));
    }

    public function getProductCollection($keyword)
    {
        $query = Product::query();

        $products = $query->active()->sort('desc')->paginate(9);

        // categories for side filter
        $categories = $this->category->getAllCategoriesWithProductCount();
     //   dd($categories);

        return view('pages.product.index', compact('products', 'categories'));
    }

    public function getShop(Request $request)
    {
        // $query = Product::query();
    }
}
