@extends('layouts.app')

@section('title', $customer->name)
@section('page-title', 'Customer Profile')

@section('topbar-actions')
    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary btn-sm">Edit</a>
    <a href="{{ route('customers.index') }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start;">
    <!-- Info card -->
    <div class="card">
        <div class="card-header"><h2>{{ $customer->name }}</h2></div>
        <div class="card-body">
            <div style="display:flex;flex-direction:column;gap:14px;">
                <div class="detail-item">
                    <span class="dl">Phone</span>
                    <span class="dv">{{ $customer->phone }}</span>
                </div>
                <div class="detail-item">
                    <span class="dl">Email</span>
                    <span class="dv">{{ $customer->email ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <span class="dl">Address</span>
                    <span class="dv">{{ $customer->address ?? '—' }}</span>
                </div>
                <div class="detail-item">
                    <span class="dl">Member Since</span>
                    <span class="dv">{{ $customer->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bicycles -->
    <div class="card">
        <div class="card-header">
            <h2>Bicycles ({{ $customer->bicycles->count() }})</h2>
            <a href="{{ route('bicycles.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary btn-sm">+ Add Bicycle</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Bicycle No.</th>
                        <th>Serial No.</th>
                        <th>Brand / Model</th>
                        <th>Last Service</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->bicycles as $b)
                    <tr>
                        <td><strong>{{ $b->bicycle_number }}</strong></td>
                        <td>{{ $b->serial_number }}</td>
                        <td>{{ $b->brand }} {{ $b->model }}</td>
                        <td>
                            @if($b->latestService)
                                {{ $b->latestService->service_date->format('d M Y') }}
                            @else
                                <span style="color:#999">No service</span>
                            @endif
                        </td>
                        <td><a href="{{ route('bicycles.show', $b) }}" class="btn btn-outline btn-sm">View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:#999;padding:24px">No bicycles registered.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
