<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    public function index()
    {
        $tiers = Tier::all();

        $transformed = $tiers->map(function ($tier) {
            return [
                'name' => $tier->name,
                'description' => $tier->description,
                'image_path' => asset('storage/' . $tier->image_path),
            ];
        });

        return response()->json([
            'tier' => $transformed,
        ]);
    }
}
