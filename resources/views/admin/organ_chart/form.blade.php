<!-- resources/views/admin/organ_chart/form.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1>{{ isset($organization) ? 'Edit Organization' : 'Add Organization' }}</h1>
    <form action="{{ isset($organization) ? route('admin.organ_chart.update', $organization->id) : route('admin.organ_chart.store') }}" method="POST">
        @csrf
        @if(isset($organization))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $organization->name ?? '') }}" required>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $organization->position ?? '') }}" required>
            @if ($errors->has('position'))
                <span class="text-danger">{{ $errors->first('position') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                @foreach(array_keys($positions) as $category)
                    <option value="{{ $category }}" {{ $organization->category == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="parent_id">Parent Organization</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">None</option>
                @foreach($organizations as $org)
                    <option value="{{ $org->id }}" {{ isset($organization) && $organization->parent_id == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('parent_id'))
                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-success">{{ isset($organization) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection
