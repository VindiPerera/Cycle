<?php

namespace App\Http\Controllers;

use App\Models\ServiceHistory;
use App\Models\Bicycle;
use Illuminate\Http\Request;

class ServiceHistoryController extends Controller
{
    public function index()
    {
        $services = ServiceHistory::with('bicycle.customer')
            ->latest('service_date')
            ->paginate(15);
        return view('service-history.index', compact('services'));
    }

    public function create(Request $request)
    {
        $bicycles = Bicycle::with('customer')->get();
        $selectedBicycle = $request->bicycle_id
            ? Bicycle::with('customer')->find($request->bicycle_id)
            : null;
        return view('service-history.create', compact('bicycles', 'selectedBicycle'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bicycle_id'      => 'required|exists:bicycles,id',
            'service_date'    => 'required|date',
            'service_type'    => 'required|string|max:100',
            'description'     => 'nullable|string',
            'parts_replaced'  => 'nullable|string',
            'cost'            => 'nullable|numeric|min:0',
            'mechanic_name'   => 'nullable|string|max:100',
            'status'          => 'required|in:pending,in_progress,completed',
            'remarks'         => 'nullable|string',
        ]);

        ServiceHistory::create($data);

        return redirect()->route('service-history.index')
            ->with('success', 'Service record added successfully.');
    }

    public function show(ServiceHistory $serviceHistory)
    {
        $serviceHistory->load('bicycle.customer');
        return view('service-history.show', compact('serviceHistory'));
    }

    public function edit(ServiceHistory $serviceHistory)
    {
        $bicycles = Bicycle::with('customer')->get();
        return view('service-history.edit', compact('serviceHistory', 'bicycles'));
    }

    public function update(Request $request, ServiceHistory $serviceHistory)
    {
        $data = $request->validate([
            'bicycle_id'      => 'required|exists:bicycles,id',
            'service_date'    => 'required|date',
            'service_type'    => 'required|string|max:100',
            'description'     => 'nullable|string',
            'parts_replaced'  => 'nullable|string',
            'cost'            => 'nullable|numeric|min:0',
            'mechanic_name'   => 'nullable|string|max:100',
            'status'          => 'required|in:pending,in_progress,completed',
            'remarks'         => 'nullable|string',
        ]);

        $serviceHistory->update($data);

        return redirect()->route('service-history.index')
            ->with('success', 'Service record updated.');
    }

    public function destroy(ServiceHistory $serviceHistory)
    {
        $serviceHistory->delete();
        return redirect()->route('service-history.index')
            ->with('success', 'Service record deleted.');
    }
}
