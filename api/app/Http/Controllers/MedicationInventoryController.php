<?php

namespace App\Http\Controllers;

use App\Interfaces\MedicationInventoryRepositoryInterface;
use Illuminate\Http\Request;

class MedicationInventoryController extends Controller
{
    protected $medicationInventoryRepo;

    public function __construct(MedicationInventoryRepositoryInterface $medicationInventoryRepo)
    {
        $this->medicationInventoryRepo = $medicationInventoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->medicationInventoryRepo->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'required|date_format:Y-m-d',
            'manufacturer' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        return $this->medicationInventoryRepo->create($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->medicationInventoryRepo->findById($id);
        if ($item) {
            return $item;
        }
        return response()->json(['message' => 'Record not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'expiry_date' => 'required|date_format:Y-m-d',
            'manufacturer' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        return $this->medicationInventoryRepo->update($id, $validatedData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(string $id)
    {
        if ($this->medicationInventoryRepo->softDelete($id)) {
            return response()->json(['message' => 'Record deleted successfully'], 200);
        }
        return response()->json(['message' => 'Record not found'], 404);
    }

    public function restore($id)
    {
        if ($this->medicationInventoryRepo->restore($id)) {
            return response()->json(['message' => 'Record restored successfully'], 200);
        }
        return response()->json(['message' => 'Record not found'], 404);
    }

    public function permanentlyDelete($id)
    {
        if ($this->medicationInventoryRepo->delete($id)) {
            return response()->json(['message' => 'Record permanently deleted successfully'], 200);
        }
        return response()->json(['message' => 'Record not found'], 404);
    }
}
