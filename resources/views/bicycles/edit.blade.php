@extends('layouts.app')

@section('title', 'Edit Bicycle')
@section('page-title', 'Edit Bicycle')

@section('topbar-actions')
    <a href="{{ route('bicycles.show', $bicycle) }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header"><h2>{{ $bicycle->bicycle_number }}</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ route('bicycles.update', $bicycle) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="serial_number">Serial Number *</label>
                    <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number', $bicycle->serial_number) }}" required>
                    @error('serial_number')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="bicycle_number">Bicycle Number *</label>
                    <input type="text" id="bicycle_number" name="bicycle_number" value="{{ old('bicycle_number', $bicycle->bicycle_number) }}" required>
                    @error('bicycle_number')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group full">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}" {{ old('customer_id', $bicycle->customer_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->name }} ({{ $c->phone }})
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $bicycle->brand) }}">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" id="model" name="model" value="{{ old('model', $bicycle->model) }}">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color', $bicycle->color) }}">
                </div>
                <div class="form-group full">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes">{{ old('notes', $bicycle->notes) }}</textarea>
                </div>
            </div>
            <div style="margin-top:24px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Bicycle</button>
                <a href="{{ route('bicycles.show', $bicycle) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
