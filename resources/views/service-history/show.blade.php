@extends('layouts.app')

@section('title', 'Service Record #' . $serviceHistory->id)
@section('page-title', 'Service Record Details')

@section('topbar-actions')
    <a href="{{ route('service-history.edit', $serviceHistory) }}" class="btn btn-primary btn-sm">Edit</a>
    <a href="{{ route('service-history.index') }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">
        <h2>Record #{{ $serviceHistory->id }} — {{ $serviceHistory->service_type }}</h2>
        <span class="badge {{ $serviceHistory->status_badge }}">{{ ucfirst(str_replace('_',' ',$serviceHistory->status)) }}</span>
    </div>
    <div class="card-body">
        <div class="detail-grid" style="margin-bottom:20px">
            <div class="detail-item">
                <span class="dl">Bicycle</span>
                <span class="dv">
                    <a href="{{ route('bicycles.show', $serviceHistory->bicycle) }}" style="color:var(--pink);font-weight:600;text-decoration:none;">
                        {{ $serviceHistory->bicycle->bicycle_number }}
                    </a>
                    <br><small>S/N: {{ $serviceHistory->bicycle->serial_number }}</small>
                </span>
            </div>
            <div class="detail-item">
                <span class="dl">Customer</span>
                <span class="dv">
                    <a href="{{ route('customers.show', $serviceHistory->bicycle->customer) }}" style="color:var(--pink);text-decoration:none;font-weight:600;">
                        {{ $serviceHistory->bicycle->customer->name }}
                    </a>
                    <br><small>{{ $serviceHistory->bicycle->customer->phone }}</small>
                </span>
            </div>
            <div class="detail-item">
                <span class="dl">Service Date</span>
                <span class="dv">{{ $serviceHistory->service_date->format('d M Y') }}</span>
            </div>
            <div class="detail-item">
                <span class="dl">Mechanic</span>
                <span class="dv">{{ $serviceHistory->mechanic_name ?? '—' }}</span>
            </div>
            <div class="detail-item">
                <span class="dl">Cost</span>
                <span class="dv" style="font-size:1.1rem;font-weight:700;color:var(--pink-dark)">Rs. {{ number_format($serviceHistory->cost, 2) }}</span>
            </div>
        </div>

        @if($serviceHistory->description)
        <div style="margin-bottom:16px">
            <div class="dl" style="font-size:0.78rem;color:#777;font-weight:600;text-transform:uppercase;letter-spacing:0.4px;margin-bottom:4px;">Description</div>
            <p style="font-size:0.9rem;line-height:1.6;">{{ $serviceHistory->description }}</p>
        </div>
        @endif

        @if($serviceHistory->parts_replaced)
        <div style="margin-bottom:16px">
            <div class="dl" style="font-size:0.78rem;color:#777;font-weight:600;text-transform:uppercase;letter-spacing:0.4px;margin-bottom:4px;">Parts Replaced</div>
            <p style="font-size:0.9rem;line-height:1.6;">{{ $serviceHistory->parts_replaced }}</p>
        </div>
        @endif

        @if($serviceHistory->remarks)
        <div>
            <div class="dl" style="font-size:0.78rem;color:#777;font-weight:600;text-transform:uppercase;letter-spacing:0.4px;margin-bottom:4px;">Remarks</div>
            <p style="font-size:0.9rem;line-height:1.6;">{{ $serviceHistory->remarks }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
