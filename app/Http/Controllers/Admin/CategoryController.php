<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'is_active' => isset($request->active) && $request->active == "on" ? 1 : 0
        ];

        $this->category->create($data);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'New category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->category->getCategoryById($id);
        if(!$category) {
            abort(404);
        }

        return view('pages.admin.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, string $id)
    {
        // get product
        $category = $this->category->getCategoryById($id);
        if(!isset($category) || empty($category)) {
    		abort(404);
    	}

        $data = [
            'name' => $request->name,
            'is_active' => isset($request->active) && $request->active == "on" ? 1 : 0
        ];

        $this->category->update($data, $category->id); 

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
    public function getAllCategories()
    {
        $catArr = [];
        $categories = $this->category->getAllCategoriesWithProductCount();
        
        if(count($categories) > 0) {
            foreach($categories as $key => $category) {
                if($category->is_active == 1) {
                    $active = "<div class=\"form-check form-switch\"><input class=\"form-check-input\" onClick=\"changeStatus({$category->id})\" checked type=\"checkbox\" /></div>";
                } else {
                    $active = "<div class=\"form-check form-switch\"><input class=\"form-check-input\" onClick=\"changeStatus({$category->id})\" type=\"checkbox\" /></div>";
                }

                $catArr[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'total_products' => $category->products_count,
                    'active' => $active,
                    'action' => "<a href=\"/admin/categories/{$category->id}/edit\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Edit\"><i class=\"las la-pen text-secondary font-18\"></i></a>",
                ];
            }
        }

        return json_encode($catArr);
    }

    public function changeStatus($catId)
    {
        $category = $this->category->getCategoryById($catId);

        $newStatus = $category->is_active == 1 ? 0 : 1;

        $this->category->update(['is_active' => $newStatus], $category->id);
    
        $status = $newStatus == 1 ? 'activated' : 'inactivated';

        return response()->json([
            'success' => true,
            'message' => "Well done! Category {$status} successfully."
        ], 200);
    }
}
