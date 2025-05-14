<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class HomeController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->product = $productRepository;
        $this->category= $categoryRepository;
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        // new arrivals 
        $data['new_arrivals']['all'] = $this->product->getNewArrivalProducts();
        $data['new_arrivals']['rings'] = $this->product->getProductsByCategory('rings');
        $data['new_arrivals']['necklaces'] = $this->product->getProductsByCategory('necklace-sets');
        $data['new_arrivals']['earrings'] = $this->product->getProductsByCategory('earrings');
        // best sellers
        $data['best_sellers'] = $this->product->getBestSellingProducts();
        // collections by categories
        $data['collections'] = $this->category->getAllActiveCategoriesWithProductCount();

        return view('pages.home.index', compact('data'));
    }
}
