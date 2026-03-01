@extends('layouts.app')

@section('title', 'Edit Service Record')
@section('page-title', 'Edit Service Record')

@section('topbar-actions')
    <a href="{{ route('service-history.show', $serviceHistory) }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header"><h2>Edit Service Record #{{ $serviceHistory->id }}</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ route('service-history.update', $serviceHistory) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group full">
                    <label for="bicycle_id">Bicycle *</label>
                    <select id="bicycle_id" name="bicycle_id" required>
                        @foreach($bicycles as $b)
                            <option value="{{ $b->id }}" {{ old('bicycle_id', $serviceHistory->bicycle_id) == $b->id ? 'selected' : '' }}>
                                {{ $b->bicycle_number }} — {{ $b->serial_number }} ({{ $b->customer->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_date">Service Date *</label>
                    <input type="date" id="service_date" name="service_date" value="{{ old('service_date', $serviceHistory->service_date->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="service_type">Service Type *</label>
                    <input type="text" id="service_type" name="service_type" value="{{ old('service_type', $serviceHistory->service_type) }}" required>
                </div>
                <div class="form-group">
                    <label for="mechanic_name">Mechanic Name</label>
                    <input type="text" id="mechanic_name" name="mechanic_name" value="{{ old('mechanic_name', $serviceHistory->mechanic_name) }}">
                </div>
                <div class="form-group">
                    <label for="cost">Cost (Rs.)</label>
                    <input type="number" id="cost" name="cost" value="{{ old('cost', $serviceHistory->cost) }}" step="0.01" min="0">
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="pending"     {{ old('status', $serviceHistory->status) === 'pending'     ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $serviceHistory->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ old('status', $serviceHistory->status) === 'completed'   ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description', $serviceHistory->description) }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="parts_replaced">Parts Replaced</label>
                    <textarea id="parts_replaced" name="parts_replaced">{{ old('parts_replaced', $serviceHistory->parts_replaced) }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks">{{ old('remarks', $serviceHistory->remarks) }}</textarea>
                </div>
            </div>
            <div style="margin-top:24px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Record</button>
                <a href="{{ route('service-history.show', $serviceHistory) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
