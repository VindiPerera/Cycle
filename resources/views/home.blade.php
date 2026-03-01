@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('topbar-actions')
    <a href="{{ route('search.index') }}" class="btn btn-primary btn-sm">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        Search
    </a>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <span class="label">Customers</span>
        <span class="value">{{ $stats['customers'] }}</span>
        <span class="sub"><a href="{{ route('customers.index') }}" style="color:var(--pink);text-decoration:none;">View all →</a></span>
    </div>
    <div class="stat-card" style="border-color:#0288d1">
        <span class="label">Bicycles</span>
        <span class="value" style="color:#0277bd">{{ $stats['bicycles'] }}</span>
        <span class="sub"><a href="{{ route('bicycles.index') }}" style="color:#0288d1;text-decoration:none;">View all →</a></span>
    </div>
    <div class="stat-card" style="border-color:#e65100">
        <span class="label">Pending</span>
        <span class="value" style="color:#bf360c">{{ $stats['pending'] }}</span>
        <span class="sub">awaiting service</span>
    </div>
    <div class="stat-card" style="border-color:#1565c0">
        <span class="label">In Progress</span>
        <span class="value" style="color:#0d47a1">{{ $stats['in_progress'] }}</span>
        <span class="sub">currently servicing</span>
    </div>
    <div class="stat-card" style="border-color:#2e7d32">
        <span class="label">Completed</span>
        <span class="value" style="color:#1b5e20">{{ $stats['completed'] }}</span>
        <span class="sub">services done</span>
    </div>
    <div class="stat-card" style="border-color:#777">
        <span class="label">Total Services</span>
        <span class="value" style="color:#444">{{ $stats['total_services'] }}</span>
        <span class="sub"><a href="{{ route('service-history.index') }}" style="color:#777;text-decoration:none;">View all →</a></span>
    </div>
</div>

<!-- Quick Actions -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-bottom:28px;">
    <a href="{{ route('customers.create') }}" class="btn btn-primary" style="justify-content:center;padding:14px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Add Customer
    </a>
    <a href="{{ route('bicycles.create') }}" class="btn btn-outline" style="justify-content:center;padding:14px;border-color:#0288d1;color:#0288d1">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Register Bicycle
    </a>
    <a href="{{ route('service-history.create') }}" class="btn btn-outline" style="justify-content:center;padding:14px;border-color:#00838f;color:#00838f">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        New Service
    </a>
    <a href="{{ route('search.index') }}" class="btn btn-outline" style="justify-content:center;padding:14px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        Search
    </a>
</div>

<!-- Recent Services -->
<div class="card">
    <div class="card-header">
        <h2>Recent Service Records</h2>
        <a href="{{ route('service-history.index') }}" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Bicycle</th>
                    <th>Customer</th>
                    <th>Service Type</th>
                    <th>Mechanic</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentServices as $s)
                <tr>
                    <td>{{ $s->service_date->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('bicycles.show', $s->bicycle) }}" style="color:var(--pink);font-weight:600;text-decoration:none;">
                            {{ $s->bicycle->bicycle_number }}
                        </a>
                    </td>
                    <td>{{ $s->bicycle->customer->name }}</td>
                    <td>{{ $s->service_type }}</td>
                    <td>{{ $s->mechanic_name ?? 'mdash;' }}</td>
                    <td>Rs. {{ number_format($s->cost, 2) }}</td>
                    <td><span class="badge {{ $s->status_badge }}">{{ ucfirst(str_replace('_',' ',$s->status)) }}</span></td>
                    <td><a href="{{ route('service-history.show', $s) }}" class="btn btn-outline btn-sm">View</a></td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#999;padding:32px">No service records yet. <a href="{{ route('service-history.create') }}" style="color:var(--pink)">Add one</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
