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

    public function getProductCollection(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if($request->filled('q')) {
            $keyword = $request->query('q');
            $query->whereHas('category', function($q) use ($keyword) {
                $q->where('slug', 'LIKE', '%'.$keyword.'%');
            });
        }

        $cats = [];
        if($request->filled('cat')) {
            $cat = $request->query('cat');
            $tempArr = explode(',', $cat);
            if(count($tempArr) > 0) {
                foreach($tempArr as $temp) {
                    if(isset($temp) && $temp != "") {
                        $cats[] = $temp;
                    }
                }
            }

            $query->whereIn('category_id', $cats);
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->with(['category','images','reviews'])->active()->paginate(9);

        // categories for side filter
        $categories = $this->category->getAllActiveCategoriesWithProductCount();

        return view('pages.collection.index', compact('products', 'categories', 'cats'));
    }

    public function getBestSellingCollection()
    {
        $cats = [];

        $products = $this->product->getBestSellingProductsWithPagination();

        // categories for side filter
        $categories = $this->category->getAllActiveCategoriesWithProductCount();

        return view('pages.collection.index', compact('products', 'categories', 'cats'));
    }
}
