<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

use App\Traits\UploadImageTrait;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    use UploadImageTrait;

    protected $product;
    protected $category;
    protected $image;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ProductImageRepositoryInterface $productImageRepository
    ) {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
        $this->image = $productImageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = $this->product->getProductsStats();

        return view('pages.admin.products.index', [
            'stats' => $stats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->getAllActiveCategories();

        return view('pages.admin.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'additional_info' => $request->additional_info,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'metal_type' => null,
            'weight_grams' => null,
            'is_customizable' => 0,
            'stock_quantity' => $request->stock_qty,
            'is_active' => isset($request->active) && $request->active == "on" ? 1 : 0
        ];

        $prodId = $this->product->create($data);
        // get product
        $product = $this->product->getProductById($prodId);
        
        // store product images
        if(isset($request->images) && count($request->images) > 0) {
            foreach($request->images as $key => $image) {
                // if file is uploaded file object
                if($image instanceof \Illuminate\Http\UploadedFile) {

                    $path = 'upload/products';

                    $imageName = 'products_' . uniqid();

                    $imageUrl = $this->uploadImage($image, $path, $imageName);
                
                    $product->images()->create([
                        'product_id' => $prodId,
                        'image_url' => $imageUrl,
                        'is_primary' => $key == 0 ? 1 : 0,
                        'display_order' => $key + 1
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'New product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get product
        $product = $this->product->getProductById($id);
        if(!isset($product) || empty($product)) {
    		abort(404);
    	}

        return view('pages.admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get product
        $product = $this->product->getProductById($id);
    	if(!isset($product) || empty($product)) {
    		abort(404);
    	}
        
        // all categories
        $categories = $this->category->getAllActiveCategories();
        
        return view('pages.admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        // get product
        $product = $this->product->getProductById($id);
        if(!isset($product) || empty($product)) {
    		abort(404);
    	}

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'additional_info' => $request->additional_info,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'metal_type' => null,
            'weight_grams' => null,
            'is_customizable' => 0,
            'stock_quantity' => $request->stock_qty,
            'is_active' => isset($request->active) && $request->active == "on" ? 1 : 0
        ];

        $this->product->update($data, $product->id); 

        if(isset($request->images) && count($request->images) > 0) {
            foreach($request->images as $key => $image) {
                // if file is uploaded file object
                if($image instanceof \Illuminate\Http\UploadedFile) {

                    $path = 'upload/products';

                    $imageName = 'products_' . uniqid();

                    $imageUrl = $this->uploadImage($image, $path, $imageName);
                
                    $product->images()->create([
                        'product_id' => $product->id,
                        'image_url' => $imageUrl,
                        'is_primary' => $key == 0 ? 1 : 0,
                        'display_order' => $key + 1
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAllProducts()
    {
        $prodArray = [];

        $products = $this->product->getAllProducts();

        if(count($products) > 0) {
            foreach($products as $key => $prod) {
                if(count($prod->images) > 0) {
                    foreach($prod->images as $key => $img) {
                        if($key == 0) {

                            $imageUrl = asset($img->image_url); 

                            $productImage = "<img 
                                src=\"{$imageUrl}\" 
                                alt=\"{$prod->name}\" 
                                class=\"thumb-sm rounded-circle me-2\" 
                            />";
                        } 
                    }
                } else {

                    $imageUrl = asset('assets/images/default/product_default_image.png');

                    $productImage = "<img src=\"{$imageUrl}\" alt=\"{$prod->name}\" class=\"thumb-sm rounded-circle me-2\" />";
                }

                $prodArray[] = [
                    'image' => $productImage,
                    'name' => $prod->name,
                    'price' => $prod->price,
                    'stock' => $prod->stock_quantity,
                    'category' => $prod->category->name,
                    'published' => $prod->is_active,
                    'details' => $prod->id
                ];
            }
        }
        

        return json_encode($prodArray);
    }

    public function deleteProductImage($imgId)
    {
        $prodImage = $this->image->find($imgId);
        if(!isset($prodImage) || empty($prodImage)) {
            return response()->json([
                'success' => false,
                'message' => 'Woops! The requested resource was not found!'
            ], 404);    
        }

        $isDeleted = $this->deleteImage($prodImage->image_url);
        
        if($isDeleted) {
            // delete image from db
            $prodImage->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Well done! Product image deleted successfully.',
            'image_id' => $imgId
        ], 200);
    }
}
