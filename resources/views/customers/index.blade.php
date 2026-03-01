@extends('layouts.app')

@section('title', 'Customers')
@section('page-title', 'Customers')

@section('topbar-actions')
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Add Customer
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2>All Customers ({{ $customers->total() }})</h2>
        <form method="GET" action="{{ route('customers.index') }}" style="display:flex;gap:8px;">
            <input type="text" name="search" placeholder="Search name or phone…" value="{{ request('search') }}" style="width:220px;">
            <button type="submit" class="btn btn-outline btn-sm">Search</button>
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Bicycles</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $c)
                <tr>
                    <td>{{ $loop->iteration + ($customers->currentPage()-1) * $customers->perPage() }}</td>
                    <td><strong>{{ $c->name }}</strong></td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->email ?? '—' }}</td>
                    <td>
                        <span class="badge badge-progress">{{ $c->bicycles_count }}</span>
                    </td>
                    <td>{{ $c->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('customers.show', $c) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('customers.edit', $c) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('customers.destroy', $c) }}" onsubmit="return confirm('Delete this customer?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#999;padding:32px">No customers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($customers->hasPages())
        <div style="padding:16px 24px;">
            {{ $customers->links('pagination::simple-bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
