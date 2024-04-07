<?php

namespace App\Interfaces;

use App\Models\MedicationInventory;
use Illuminate\Database\Eloquent\Collection;

interface MedicationInventoryRepositoryInterface
{
    public function all(): Collection;
    public function findById($id): ? MedicationInventory;
    public function create(array $data): MedicationInventory;
    public function update($id, array $data): MedicationInventory;
    public function delete($id): bool;
    public function softDelete($id): bool;
    public function restore($id): bool;
}
