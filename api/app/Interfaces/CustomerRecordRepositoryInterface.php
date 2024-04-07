<?php

namespace App\Interfaces;

use App\Models\CustomerRecord;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRecordRepositoryInterface
{
    public function all(): Collection;
    public function findById($id): ?CustomerRecord;
    public function create(array $data): CustomerRecord;
    public function update($id, array $data): CustomerRecord;
    public function delete($id): bool;
    public function softDelete($id): bool;
    public function restore($id): bool;
}
