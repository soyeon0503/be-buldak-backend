<?php

namespace App\Repositories;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReceiptRepository
{

    public function all(): array
    {
        return Receipt::all()->toArray();
    }
    
    public function create(array $data): Receipt
    {
        return Receipt::create($data);
    }

    public function update(int $id, array $data): Receipt
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->update($data);
        return $receipt;
    }

    public function find(int $id): Receipt
    {
        return Receipt::findOrFail($id);
    }

    public function delete(int $id): void
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
    }
}