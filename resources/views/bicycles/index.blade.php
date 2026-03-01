@extends('layouts.app')

@section('title', 'Bicycles')
@section('page-title', 'Bicycles')

@section('topbar-actions')
    <a href="{{ route('bicycles.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Register Bicycle
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Bicycles ({{ $bicycles->total() }})</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bicycle No.</th>
                    <th>Serial No.</th>
                    <th>Owner</th>
                    <th>Brand / Model</th>
                    <th>Color</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bicycles as $b)
                <tr>
                    <td>{{ $loop->iteration + ($bicycles->currentPage()-1) * $bicycles->perPage() }}</td>
                    <td><strong>{{ $b->bicycle_number }}</strong></td>
                    <td><code style="font-size:0.8rem;background:#f5f5f5;padding:2px 6px;border-radius:4px;">{{ $b->serial_number }}</code></td>
                    <td>
                        <a href="{{ route('customers.show', $b->customer) }}" style="color:var(--pink);text-decoration:none;font-weight:600;">{{ $b->customer->name }}</a>
                        <br><small style="color:#999">{{ $b->customer->phone }}</small>
                    </td>
                    <td>{{ trim($b->brand . ' ' . $b->model) ?: '—' }}</td>
                    <td>{{ $b->color ?? '—' }}</td>
                    <td>{{ $b->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('bicycles.show', $b) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('bicycles.edit', $b) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('bicycles.destroy', $b) }}" onsubmit="return confirm('Delete this bicycle?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#999;padding:32px">No bicycles registered yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($bicycles->hasPages())
        <div style="padding:16px 24px;">{{ $bicycles->links('pagination::simple-bootstrap-4') }}</div>
    @endif
</div>
@endsection
