@extends('layouts.layout')

<title> Organzation Chart | Scribe Entertainment</title>
<link rel="stylesheet" href="css/chart.css">

@section('content')
<div class="container-fluid">

    <!-- University of Scribe Section -->
    <div class="university-scribe-section mt-5">
        <hr class="section-line">
        <center><h2 class="section-title">University of Scribe</h2></center>

        <ul class="org-chart">
            @foreach ($organizations['UNIVERSITY OF SCRIBE'] as $organization)
                <li class="top-level">
                    <div class="org-node">
                        @if ($organization->image)
                            <img src="{{ asset('storage/' . $organization->image) }}" alt="Organization Image" class="org-image">
                        @endif
                        <div class="org-info">
                            <strong class="org-name">{{ $organization->name }}</strong>
                            <span class="org-position">{{ $organization->position }}</span>
                        </div>
                    </div>
                    @if ($organization->children->isNotEmpty())
                        <ul>
                            @include('organation.tree', ['organizations' => $organization->children])
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Staff Section -->
    <div class="staff-section mt-5">
        <hr class="section-line">
        <center><h2 class="section-title">Staff</h2></center>

        <ul class="org-chart">
            @foreach ($organizations['STAFF'] as $organization)
                <li class="top-level">
                    <div class="org-node">
                        @if ($organization->image)
                            <img src="{{ asset('storage/' . $organization->image) }}" alt="Organization Image" class="org-image">
                        @endif
                        <div class="org-info">
                            <strong class="org-name">{{ $organization->name }}</strong>
                            <span class="org-position">{{ $organization->position }}</span>
                        </div>
                    </div>
                    @if ($organization->children->isNotEmpty())
                        <ul>
                            @include('organation.tree', ['organizations' => $organization->children])
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <hr class="section-line">
    <br>
</div>

@endsection
