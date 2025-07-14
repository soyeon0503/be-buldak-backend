<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Receipt;

class UserEatenReceiptSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $receipts = Receipt::all();

        foreach ($users as $user) {
            $receiptIds = $receipts->pluck('id')->shuffle()->take(rand(2, 5))->toArray();

            $user->eatenReceipt()->detach($receiptIds);
            $user->eatenReceipt()->attach($receiptIds);
        }
    }
}
