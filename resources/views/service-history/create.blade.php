@extends('layouts.app')

@section('title', 'Add Service Record')
@section('page-title', 'Add Service Record')

@section('topbar-actions')
    <a href="{{ route('service-history.index') }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header"><h2>Service Details</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ route('service-history.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group full">
                    <label for="bicycle_id">Bicycle *</label>
                    <select id="bicycle_id" name="bicycle_id" required>
                        <option value="">— Select Bicycle —</option>
                        @foreach($bicycles as $b)
                            <option value="{{ $b->id }}" {{ old('bicycle_id', optional($selectedBicycle)->id ?? request('bicycle_id')) == $b->id ? 'selected' : '' }}>
                                {{ $b->bicycle_number }} — {{ $b->serial_number }} ({{ $b->customer->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('bicycle_id')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="service_date">Service Date *</label>
                    <input type="date" id="service_date" name="service_date" value="{{ old('service_date', date('Y-m-d')) }}" required>
                    @error('service_date')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="service_type">Service Type *</label>
                    <input type="text" id="service_type" name="service_type" value="{{ old('service_type') }}" required placeholder="e.g. Full Tune-up, Brake Repair">
                    @error('service_type')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="mechanic_name">Mechanic Name</label>
                    <input type="text" id="mechanic_name" name="mechanic_name" value="{{ old('mechanic_name') }}" placeholder="e.g. Nimal">
                </div>
                <div class="form-group">
                    <label for="cost">Cost (Rs.)</label>
                    <input type="number" id="cost" name="cost" value="{{ old('cost', '0') }}" step="0.01" min="0" placeholder="0.00">
                    @error('cost')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="pending"     {{ old('status') === 'pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ old('status') === 'completed'   ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="What was done?">{{ old('description') }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="parts_replaced">Parts Replaced</label>
                    <textarea id="parts_replaced" name="parts_replaced" placeholder="List replaced parts, if any…">{{ old('parts_replaced') }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks" placeholder="Any additional notes…">{{ old('remarks') }}</textarea>
                </div>
            </div>
            <div style="margin-top:24px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Save Record</button>
                <a href="{{ route('service-history.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
