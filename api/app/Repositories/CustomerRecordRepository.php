<?php

namespace App\Repositories;

use App\Interfaces\CustomerRecordRepositoryInterface;
use App\Models\CustomerRecord;
use Illuminate\Database\Eloquent\Collection;

class CustomerRecordRepository implements CustomerRecordRepositoryInterface
{
    public function all(): Collection
    {
        return CustomerRecord::all();
    }

    public function findById($id): ?CustomerRecord
    {
        return CustomerRecord::find($id);
    }

    public function create(array $data): CustomerRecord
    {
        return CustomerRecord::create($data);
    }

    public function update($id, array $data): CustomerRecord
    {
        $customer = CustomerRecord::findOrFail($id);
        $customer->update($data);
        return $customer;
    }

    public function delete($id): bool
    {
        return CustomerRecord::where('id', $id)->forceDelete();
    }

    public function softDelete($id): bool
    {
        $customer = CustomerRecord::find($id);
        if ($customer) {
            return $customer->delete();
        }

        return false;
    }

    public function restore($id) : bool
    {
        return CustomerRecord::withTrashed()->where('id', $id)->restore();
    }
}
