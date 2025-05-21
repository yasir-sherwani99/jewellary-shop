<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodStoreRequest;
use App\Repositories\Interfaces\ShippingMethodRepositoryInterface;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    protected $shipping;

    public function __construct(
        ShippingMethodRepositoryInterface $shippingMethodRepository
    ) {
        $this->shipping = $shippingMethodRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingMethods = $this->shipping->getAllShippingMethods();

        return view('pages.admin.shipping-methods.index', [
            'shippingMethods' => $shippingMethods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.shipping-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingMethodStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'active' => 0
        ];

        $this->shipping->create($data);

        return redirect()->route('admin.shipping-methods.index')
                         ->with('success', 'New shipping method created successfully');
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
        // get shipping method
        $shipping = $this->shipping->getShippingMethodById($id);
        if(!isset($shipping) || empty($shipping)) {
    		abort(404);
    	}

        return view('pages.admin.shipping-methods.edit', [
            'shipping' => $shipping
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingMethodStoreRequest $request, string $id)
    {
        // get shipping method
        $shipping = $this->shipping->getShippingMethodById($id);
        if(!isset($shipping) || empty($shipping)) {
    		abort(404);
    	}

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'active' => 0
        ];

        $this->shipping->update($data, $shipping->id);

        return redirect()->route('admin.shipping-methods.index')
                         ->with('success', 'Shipping method updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = $this->shipping->getShippingMethodById($id);
        if(!isset($shipping) || empty($shipping)) {
    		abort(404);
    	}

        $shipping->delete();               

        return redirect()->route('admin.shipping-methods.index')
                         ->with('success', 'Shipping method deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function toggle(Request $request, $id)
    {
        $shipping = $this->shipping->getShippingMethodById($id);
        if(!isset($shipping) || empty($shipping)) {
    		abort(404);
    	}

        $this->shipping->setActiveShippingMethod($shipping->id);
        
        return back()->with('success', 'Shipping method updated successfully.');
    }
}
