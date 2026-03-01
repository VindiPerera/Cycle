@extends('layouts.app')

@section('title', 'Edit Customer')
@section('page-title', 'Edit Customer')

@section('topbar-actions')
    <a href="{{ route('customers.index') }}" class="btn btn-outline btn-sm">← Back</a>
@endsection

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header"><h2>Edit: {{ $customer->name }}</h2></div>
    <div class="card-body">
        <form method="POST" action="{{ route('customers.update', $customer) }}">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                    @error('name')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                    @error('phone')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}">
                    @error('email')<p class="error-text">{{ $message }}</p>@enderror
                </div>
                <div class="form-group full">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ old('address', $customer->address) }}</textarea>
                    @error('address')<p class="error-text">{{ $message }}</p>@enderror
                </div>
            </div>
            <div style="margin-top:24px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Customer</button>
                <a href="{{ route('customers.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
