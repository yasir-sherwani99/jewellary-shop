<?php

namespace App\Repositories;

use App\Models\TaxRate;
use App\Repositories\Interfaces\TaxRateRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TaxRateRepository implements TaxRateRepositoryInterface
{
    protected $tax;

    /**
     * Create a new class instance.
     */
    public function __construct(TaxRate $tax)
    {
        $this->tax = $tax;
    }

    public function find($id): ?\App\Models\TaxRate
    {
        return $this->tax->find($id);
    }

    public function getTaxRateById($rateId): ?\App\Models\TaxRate
    {
        return $this->tax->find($rateId);
    }

    public function getActiveTaxRates(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->tax->active()->get();
    }

    public function getAllTaxRates(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->tax->get();
    }

    public function create($data): \App\Models\TaxRate
    {
        return $this->tax->create($data);
    }

    public function update($data, $taxId): bool
    {
        $taxRate = $this->find($taxId);

        return $taxRate ? $taxRate->update($data) : false;
    }

    public function setActiveTaxRate($id): void
    {
        // Start transaction to avoid race conditions
        DB::transaction(function () use ($id) {
            TaxRate::where('active', 1)->update(['active' => 0]);

            TaxRate::where('id', $id)->update(['active' => 1]);
        });
    }

    public function getActiveTaxRate(): ?\App\Models\TaxRate
    {
        return $this->tax->active()->first();
    }
}
