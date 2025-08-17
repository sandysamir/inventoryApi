<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InventoryRepositoryInterface;

class InventoryItemController extends Controller
{

    public function __construct(private InventoryRepositoryInterface $inventoryRepo) {
                
        $this->inventoryRepo = $inventoryRepo;

    }
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $filters = $request->all();
        $perPage = $request->get('per_page', 10);
        $data = $this->inventoryRepo->search($filters, $perPage);

        return response()->json($data, 200);
    }
}
