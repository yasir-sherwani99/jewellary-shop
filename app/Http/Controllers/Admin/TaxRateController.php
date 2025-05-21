<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaxRateStoreRequest;
use App\Repositories\Interfaces\TaxRateRepositoryInterface;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    protected $tax;

    public function __construct(
        TaxRateRepositoryInterface $taxRateRepository
    ) {
        $this->tax = $taxRateRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxRates = $this->tax->getAllTaxRates();

        return view('pages.admin.tax.index', [
            'taxRates' => $taxRates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.tax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxRateStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'rate' => $request->rate,
            'country' => $request->country,
            'active' => 0
        ];

        $this->tax->create($data);

        return redirect()->route('admin.tax-rates.index')
                         ->with('success', 'New tax rate created successfully');
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
        // get tax rate
        $tax = $this->tax->getTaxRateById($id);
        if(!isset($tax) || empty($tax)) {
    		abort(404);
    	}

        return view('pages.admin.tax.edit', [
            'tax' => $tax
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxRateStoreRequest $request, string $id)
    {
        // get tax rate
        $tax = $this->tax->getTaxRateById($id);
        if(!isset($tax) || empty($tax)) {
    		abort(404);
    	}

        $data = [
            'name' => $request->name,
            'rate' => $request->rate,
            'country' => $request->country
        ];

        $this->tax->update($data, $tax->id);

        return redirect()->route('admin.tax-rates.index')
                         ->with('success', 'Tax rate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get tax rate
        $tax = $this->tax->getTaxRateById($id);
        if(!isset($tax) || empty($tax)) {
    		abort(404);
    	}

        $tax->delete();               

        return redirect()->route('admin.tax-rates.index')
                         ->with('success', 'A tax rate deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function toggle(Request $request, $id)
    {
        $tax = $this->tax->getTaxRateById($id);
        if(!isset($tax) || empty($tax)) {
    		abort(404);
    	}

        $this->tax->setActiveTaxRate($tax->id);
        
        return back()->with('success', 'Tax rate updated successfully.');
    }
}
