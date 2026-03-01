@extends('layouts.app')

@section('title', $bicycle->bicycle_number)
@section('page-title', 'Bicycle Details')

@section('topbar-actions')
    <a href="{{ route('service-history.create') }}?bicycle_id={{ $bicycle->id }}" class="btn btn-primary btn-sm">+ Add Service</a>
    <a href="{{ route('bicycles.edit', $bicycle) }}" class="btn btn-outline btn-sm">Edit</a>
    <a href="{{ route('bicycles.index') }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;align-items:start;">
    <!-- Info -->
    <div class="card">
        <div class="card-header"><h2>{{ $bicycle->bicycle_number }}</h2></div>
        <div class="card-body">
            <div style="display:flex;flex-direction:column;gap:14px;">
                <div class="detail-item">
                    <span class="dl">Serial Number</span>
                    <span class="dv"><code style="font-size:0.85rem;background:#f5f5f5;padding:3px 8px;border-radius:4px;">{{ $bicycle->serial_number }}</code></span>
                </div>
                <div class="detail-item">
                    <span class="dl">Owner</span>
                    <span class="dv">
                        <a href="{{ route('customers.show', $bicycle->customer) }}" style="color:var(--pink);font-weight:600;text-decoration:none;">{{ $bicycle->customer->name }}</a>
                        <br><small>{{ $bicycle->customer->phone }}</small>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="dl">Brand / Model</span>
                    <span class="dv">{{ trim($bicycle->brand . ' ' . $bicycle->model) ?: '—' }}</span>
                </div>
                <div class="detail-item">
                    <span class="dl">Color</span>
                    <span class="dv">{{ $bicycle->color ?? '—' }}</span>
                </div>
                @if($bicycle->notes)
                <div class="detail-item">
                    <span class="dl">Notes</span>
                    <span class="dv">{{ $bicycle->notes }}</span>
                </div>
                @endif
                <div class="detail-item">
                    <span class="dl">Registered</span>
                    <span class="dv">{{ $bicycle->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Service History -->
    <div class="card">
        <div class="card-header">
            <h2>Service History ({{ $serviceHistories->total() }})</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Mechanic</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($serviceHistories as $s)
                    <tr>
                        <td>{{ $s->service_date->format('d M Y') }}</td>
                        <td>{{ $s->service_type }}</td>
                        <td>{{ $s->mechanic_name ?? '—' }}</td>
                        <td>Rs. {{ number_format($s->cost, 2) }}</td>
                        <td>
                            <span class="badge {{ $s->status_badge }}">{{ ucfirst(str_replace('_',' ',$s->status)) }}</span>
                        </td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('service-history.show', $s) }}" class="btn btn-outline btn-sm">View</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center;color:#999;padding:24px">No service records yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($serviceHistories->hasPages())
            <div style="padding:16px 24px;">{{ $serviceHistories->links('pagination::simple-bootstrap-4') }}</div>
        @endif
    </div>
</div>
@endsection
