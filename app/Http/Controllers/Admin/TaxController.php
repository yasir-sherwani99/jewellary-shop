<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TaxRateRepositoryInterface;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    protected $tax;

    public function __construct(TaxRateRepositoryInterface $taxRateRepository)
    {
        $this->tax = $taxRateRepository;
    }

    public function index()
    {
        $taxRates = $this->tax->getAllTaxRates();

        return view('pages.admin.tax.index', [
            'taxRates' => $taxRates
        ]);
    }
}
