@extends('layouts.layout')

<title>Gallery | Scribe</title>
<link rel="stylesheet" href="css/album.css">

@section('content')
<div class="gallery-container">
    <center><h1 class="text-center">Scribe Gallery</h1>

    <!-- Filter Buttons -->
    <div class="text-center mb-4">
        <button onclick="filterMedia('all')" class="btn btn-primary">All</button>
        <button onclick="filterMedia('video')" class="btn btn-secondary">Videos</button>
        <button onclick="filterMedia('image')" class="btn btn-secondary">Images</button>
    </div></center>

    @php
        $groupedItems = $items->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('F Y');
        });
    @endphp

    @foreach($groupedItems as $monthYear => $items)
        <h4>{{ $monthYear }}</h4>
        <div class="horizontal-scroll-wrapper">
            @foreach($items as $item)
                <div class="thumbnail-box {{ strpos($item->file_path, '.mp4') !== false ? 'video-item' : 'image-item' }}" onclick="showMedia('{{ Storage::url($item->file_path) }}', '{{ strpos($item->file_path, '.mp4') !== false ? 'true' : 'false' }}')">
                    @if(strpos($item->file_path, '.mp4') !== false)
                        <video muted>
                            <source src="{{ Storage::url($item->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img src="{{ Storage::url($item->file_path) }}">
                    @endif
                    <button class="like-button" onclick="event.stopPropagation(); toggleLike(this)">❤️ Like</button>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<!-- Modal -->
<div id="Modal" class="modal" onclick="closeModal()">
    <div class="modal-content" id="modalContent"></div>
    <span class="close" onclick="closeModal()">&times;</span>
</div>

<script>
    function showMedia(filePath, isVideo) {
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = isVideo === 'true'
            ? `<video controls><source src="${filePath}" type="video/mp4">Your browser does not support the video tag.</video>`
            : `<img src="${filePath}" class="img-fluid">`;
        document.getElementById('Modal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('Modal').style.display = 'none';
    }

    function filterMedia(type) {
        const allItems = document.querySelectorAll('.thumbnail-box');
        allItems.forEach(item => item.style.display = type === 'all' ? 'inline-block' : 'none');
        if (type !== 'all') {
            document.querySelectorAll(`.${type}-item`).forEach(item => item.style.display = 'inline-block');
        }
    }

    function toggleLike(button) {
        if (button.classList.contains('liked')) {
            button.classList.remove('liked');
            button.innerHTML = '❤️ Like';
        } else {
            button.classList.add('liked');
            button.innerHTML = '💔 Liked';
        }
    }
</script>
@endsection
