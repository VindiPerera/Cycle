@extends('layouts.app')

@section('title', 'Service History')
@section('page-title', 'Service History')

@section('topbar-actions')
    <a href="{{ route('service-history.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Add Service Record
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Service Records ({{ $services->total() }})</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Bicycle No.</th>
                    <th>Customer</th>
                    <th>Service Type</th>
                    <th>Mechanic</th>
                    <th>Cost (Rs.)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $s)
                <tr>
                    <td>{{ $loop->iteration + ($services->currentPage()-1) * $services->perPage() }}</td>
                    <td>{{ $s->service_date->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('bicycles.show', $s->bicycle) }}" style="color:var(--pink);font-weight:600;text-decoration:none;">
                            {{ $s->bicycle->bicycle_number }}
                        </a>
                    </td>
                    <td>{{ $s->bicycle->customer->name }}</td>
                    <td>{{ $s->service_type }}</td>
                    <td>{{ $s->mechanic_name ?? '—' }}</td>
                    <td>{{ number_format($s->cost, 2) }}</td>
                    <td><span class="badge {{ $s->status_badge }}">{{ ucfirst(str_replace('_',' ',$s->status)) }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('service-history.show', $s) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('service-history.edit', $s) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('service-history.destroy', $s) }}" onsubmit="return confirm('Delete this record?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:#999;padding:32px">No service records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($services->hasPages())
        <div style="padding:16px 24px;">{{ $services->links('pagination::simple-bootstrap-4') }}</div>
    @endif
</div>
@endsection
