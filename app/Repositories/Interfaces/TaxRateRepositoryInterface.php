<?php

namespace App\Repositories\Interfaces;

interface TaxRateRepositoryInterface
{
    public function find($id): ?\App\Models\TaxRate;
    public function getTaxRateById($rateId): ?\App\Models\TaxRate;
    public function getActiveTaxRates(): \Illuminate\Database\Eloquent\Collection;
    public function getAllTaxRates(): \Illuminate\Database\Eloquent\Collection;
    public function create($data): \App\Models\TaxRate;
    public function update($data, $taxId): bool;
    public function setActiveTaxRate($id): void;
    public function getActiveTaxRate(): ?\App\Models\TaxRate;
}
