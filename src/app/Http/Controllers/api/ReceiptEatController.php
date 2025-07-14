<?php
namespace App\Http\Controllers\api;

use App\Models\Receipt;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptEatController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user->eatenReceipt()->get());
    }

    public function toggleEat(Request $request, Receipt $receipt)
    {
        $user = $request->user();

        if ($user->eatenReceipt()->where('receipt_id', $receipt->id)->exists()) {
            $user->eatenReceipt()->detach($receipt->id);
            return response()->json(['message' => '먹음 기록 취소']);
        }

        $user->eatenReceipt()->attach($receipt->id);
        return response()->json(['message' => '먹음 기록 완료']);
    }

}
