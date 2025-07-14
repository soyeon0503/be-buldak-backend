<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Receipt;

class UserSavedReceiptSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $receipts = Receipt::all();

        foreach ($users as $user) {
            $receiptIds = $receipts->pluck('id')->shuffle()->take(rand(3, 7))->toArray();

            // 중복 방지 위해 attach 전에 detach (없으면 영향 없음)
            $user->savedReceipt()->detach($receiptIds);
            $user->savedReceipt()->attach($receiptIds);
        }
    }
}
