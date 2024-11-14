@extends('layouts.admin')
<title>Edit Member</title>
@section('content')
<div class="container-fluid">
    <h1>Edit Organization</h1>
    <form action="{{ route('admin.organ_chart.update', $organization->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="position">Position</label>
            <select name="position" id="position" class="form-control" required>
                <option value="">Select Position</option>
                @foreach($positions as $category => $posList)
                    <optgroup label="{{ $category }}">
                        @foreach($posList as $position)
                            <option value="{{ $position }}" {{ $organization->position == $position ? 'selected' : '' }}>
                                {{ $position }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Name (optional)</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $organization->name) }}">
        </div>

        <div class="form-group">
            <label for="parent_id">Parent Organization</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">None</option>
                @foreach($organizations as $org)
                    <option value="{{ $org->id }}" {{ $organization->parent_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control" required>
            <option value="">Select Category</option>
            <option value="BOARDS OF REGENT">BOARDS OF REGENT</option>
            <option value="UNIVERSITY OF SCRIBE">UNIVERSITY OF SCRIBE</option>
            <option value="STAFF">STAFF</option>
        </select>
    </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($organization->image)
                <img src="{{ asset('storage/' . $organization->image) }}" alt="{{ $organization->name }}" class="mt-2" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
