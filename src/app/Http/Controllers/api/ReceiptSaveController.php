<?php
namespace App\Http\Controllers\api;

use App\Models\Receipt;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptSaveController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user->savedReceipt()->get());
    }

    public function toggleSave(Request $request, Receipt $receipt)
    {
        $user = $request->user();
    
        if ($user->savedReceipt()->where('receipt_id', $receipt->id)->exists()) {
            $user->savedReceipt()->detach($receipt->id);
            return response()->json(['message' => '저장 취소']);
        }
    
        $user->savedReceipt()->attach($receipt->id);
        return response()->json(['message' => '저장 완료']);
    }
    
}
