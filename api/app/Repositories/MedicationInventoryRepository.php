<?php

namespace App\Repositories;

use App\Interfaces\MedicationInventoryRepositoryInterface;
use App\Models\MedicationInventory;
use Illuminate\Database\Eloquent\Collection;

class MedicationInventoryRepository implements MedicationInventoryRepositoryInterface
{
    public function all(): Collection
    {
        return MedicationInventory::all();
    }

    public function findById($id): ?MedicationInventory
    {
        return MedicationInventory::find($id);
    }

    public function create(array $data): MedicationInventory
    {
        return MedicationInventory::create($data);
    }

    public function update($id, array $data): MedicationInventory
    {
        $customer = MedicationInventory::findOrFail($id);
        $customer->update($data);
        return $customer;
    }

    public function delete($id): bool
    {
        return MedicationInventory::where('id', $id)->forceDelete();
    }

    public function softDelete($id): bool
    {
        $customer = MedicationInventory::find($id);
        if ($customer) {
            return $customer->delete();
        }

        return false;
    }

    public function restore($id) : bool
    {
        return MedicationInventory::withTrashed()->where('id', $id)->restore();
    }
}
