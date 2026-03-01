<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use App\Models\Customer;
use Illuminate\Http\Request;

class BicycleController extends Controller
{
    public function index()
    {
        $bicycles = Bicycle::with('customer')->latest()->paginate(15);
        return view('bicycles.index', compact('bicycles'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('bicycles.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'serial_number'  => 'required|string|max:100|unique:bicycles,serial_number',
            'bicycle_number' => 'required|string|max:100|unique:bicycles,bicycle_number',
            'customer_id'    => 'required|exists:customers,id',
            'brand'          => 'nullable|string|max:100',
            'model'          => 'nullable|string|max:100',
            'color'          => 'nullable|string|max:50',
            'notes'          => 'nullable|string|max:500',
        ]);

        Bicycle::create($data);

        return redirect()->route('bicycles.index')
            ->with('success', 'Bicycle registered successfully.');
    }

    public function show(Bicycle $bicycle)
    {
        $bicycle->load('customer', 'serviceHistories');
        $serviceHistories = $bicycle->serviceHistories()->latest('service_date')->paginate(10);
        return view('bicycles.show', compact('bicycle', 'serviceHistories'));
    }

    public function edit(Bicycle $bicycle)
    {
        $customers = Customer::orderBy('name')->get();
        return view('bicycles.edit', compact('bicycle', 'customers'));
    }

    public function update(Request $request, Bicycle $bicycle)
    {
        $data = $request->validate([
            'serial_number'  => 'required|string|max:100|unique:bicycles,serial_number,' . $bicycle->id,
            'bicycle_number' => 'required|string|max:100|unique:bicycles,bicycle_number,' . $bicycle->id,
            'customer_id'    => 'required|exists:customers,id',
            'brand'          => 'nullable|string|max:100',
            'model'          => 'nullable|string|max:100',
            'color'          => 'nullable|string|max:50',
            'notes'          => 'nullable|string|max:500',
        ]);

        $bicycle->update($data);

        return redirect()->route('bicycles.index')
            ->with('success', 'Bicycle updated successfully.');
    }

    public function destroy(Bicycle $bicycle)
    {
        $bicycle->delete();
        return redirect()->route('bicycles.index')
            ->with('success', 'Bicycle deleted.');
    }
}
