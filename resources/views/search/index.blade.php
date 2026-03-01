@extends('layouts.app')

@section('title', 'Search')
@section('page-title', 'Search Bicycles')

@section('content')

<!-- Search Box -->
<div class="card" style="margin-bottom:24px">
    <div class="card-body">
        <form method="GET" action="{{ route('search.results') }}">
            <div style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
                <div class="form-group" style="flex:1;min-width:240px;margin-bottom:0">
                    <label for="query">Search</label>
                    <input type="text" id="query" name="query" value="{{ $query ?? '' }}"
                        placeholder="Enter serial number, bicycle no., or phone…"
                        autofocus>
                </div>
                <div class="form-group" style="min-width:200px;margin-bottom:0">
                    <label for="type">Search By</label>
                    <select id="type" name="type">
                        <option value="all"            {{ ($type ?? 'all') === 'all'            ? 'selected' : '' }}>All Fields</option>
                        <option value="serial"         {{ ($type ?? '') === 'serial'            ? 'selected' : '' }}>Serial Number</option>
                        <option value="bicycle_number" {{ ($type ?? '') === 'bicycle_number'    ? 'selected' : '' }}>Bicycle Number</option>
                        <option value="phone"          {{ ($type ?? '') === 'phone'             ? 'selected' : '' }}>Customer Phone</option>
                    </select>
                </div>
                <div style="padding-bottom:1px">
                    <button type="submit" class="btn btn-primary" style="height:42px;padding:0 28px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Results -->
@isset($results)
    @if(strlen($query ?? '') > 0)
        <div class="card">
            <div class="card-header">
                <h2>
                    @if($results->isEmpty())
                        No results for "{{ $query }}"
                    @else
                        {{ $results->count() }} result(s) for "{{ $query }}"
                    @endif
                </h2>
            </div>

            @if($results->isNotEmpty())
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Bicycle No.</th>
                            <th>Serial No.</th>
                            <th>Owner</th>
                            <th>Phone</th>
                            <th>Brand / Model</th>
                            <th>Last Service</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $b)
                        <tr>
                            <td><strong>{{ $b->bicycle_number }}</strong></td>
                            <td><code style="font-size:0.8rem;background:#f5f5f5;padding:2px 6px;border-radius:4px;">{{ $b->serial_number }}</code></td>
                            <td>
                                <a href="{{ route('customers.show', $b->customer) }}" style="color:var(--pink);font-weight:600;text-decoration:none;">
                                    {{ $b->customer->name }}
                                </a>
                            </td>
                            <td>{{ $b->customer->phone }}</td>
                            <td>{{ trim($b->brand . ' ' . $b->model) ?: '—' }}</td>
                            <td>
                                @if($b->latestService)
                                    {{ $b->latestService->service_date->format('d M Y') }}
                                @else
                                    <span style="color:#999">—</span>
                                @endif
                            </td>
                            <td>
                                @if($b->latestService)
                                    <span class="badge {{ $b->latestService->status_badge }}">
                                        {{ ucfirst(str_replace('_',' ',$b->latestService->status)) }}
                                    </span>
                                @else
                                    <span style="color:#999">No service</span>
                                @endif
                            </td>
                            <td>
                                <div class="td-actions">
                                    <a href="{{ route('bicycles.show', $b) }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ route('service-history.create') }}?bicycle_id={{ $b->id }}" class="btn btn-outline btn-sm">+ Service</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="padding:40px;text-align:center;color:#999">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ddd" stroke-width="1.5" style="margin:0 auto 12px;display:block;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                No bicycles found matching your search.
            </div>
            @endif
        </div>
    @endif
@endisset

@if(!isset($results))
<div style="text-align:center;padding:60px 0;color:#bbb;">
    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#f8bbd0" stroke-width="1.2" style="margin:0 auto 16px;display:block;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    <p style="font-size:1rem;color:#aaa">Enter a search term above to find bicycles.</p>
</div>
@endif

@endsection
