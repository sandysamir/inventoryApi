<?php
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\StockTransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/inventory', [InventoryItemController::class, 'index']);
    Route::get('/warehouses/{warehouse}/inventory', [WarehouseController::class, 'show']);
    Route::post('/stock-transfers', [StockTransferController::class, 'store']); 
});
