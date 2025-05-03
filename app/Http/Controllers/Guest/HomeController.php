<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $product;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->product = $productRepository;
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];

        $data['new_arrivals'] = $this->product->getNewArrivalProducts();
       // dd($data['new_arrivals']);

        return view('pages.home.index', compact('data'));
    }
}
