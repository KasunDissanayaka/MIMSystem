<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRecordRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerRecordController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRecordRepositoryInterface $customerRepository) 
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->customerRepository->all());
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
            'address' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'nic_number' => 'nullable|string|regex:/^\d{9}V$/',
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
        ]);
    
        return response()->json($this->customerRepository->create($validatedData), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = $this->customerRepository->findById($id);
        return $customer ? response()->json($customer) : response()->json(['message' => 'Customer not found'], 404);
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
            'address' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'nic_number' => 'nullable|string|regex:/^\d{9}V$/',
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
        ]);
    
        return response()->json($this->customerRepository->update($id, $validatedData));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->customerRepository->softDelete($id)) {
            return response()->json(['message' => 'Customer soft deleted']);
        }
        return response()->json(['message' => 'Customer not found'], 404);
    }

    public function permanentlyDelete($id)
    {
        if ($this->customerRepository->delete($id)) {
            return response()->json(['message' => 'Customer permanently deleted']);
        }
        return response()->json(['message' => 'Customer not found'], 404);
    }

    public function restore($id)
    {
        if ($this->customerRepository->restore($id)) {
            return response()->json(['message' => 'Customer restored']);
        }
        return response()->json(['message' => 'Customer not found'], 404);
    }
}
