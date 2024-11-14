@extends('layouts.app')

<title>Album | Scribe Entertainment</title>


@section('title', 'Album')

@section('content')

            <!-- Sample Post -->
             
        <div class="album-container">
        <h1 class="album-title">Album</h1>
        <div class="month-container">
            <div class="month" onclick="showImages('January', 2024)">
                <img src="pic.jpg" alt="January Latest">
                <div class="month-name">January</div>
            </div>
            <div class="month" onclick="showImages('February', 2024)">
                <img src="gallery.png" alt="February Latest">
                <div class="month-name">February</div>
            </div>
            <div class="month" onclick="showImages('March', 2024)">
                <img src="gallery.png" alt="March Latest">
                <div class="month-name">March</div>
            </div>
            <div class="month" onclick="showImages('April',2024)">
                <img src="gallery.png" alt="April Latest">
                <div class="month-name">April</div>
            </div>
            <div class="month" onclick="showImages('May', 2024)">
                <img src="gallery.png" alt="May Latest">
                <div class="month-name">May</div>
            </div>
            <div class="month" onclick="showImages('June', 2024)">
                <img src="gallery.png" alt="June Latest">
                <div class="month-name">June</div>
            </div>
            <div class="month" onclick="showImages('July', 2024)">
                <img src="gallery.png" alt="July Latest">
                <div class="month-name">July</div>
            </div>
            <div class="month" onclick="showImages('August', 2024)">
                <img src="gallery.png" alt="August Latest">
                <div class="month-name">August</div>
            </div>
            <div class="month" onclick="showImages('September', 2024) ">
                <img src="gallery.png" alt="September Latest">
                <div class="month-name">September</div>
            </div>
            <div class="month" onclick="showImages('October', 2024)">
                <img src="gallery.png" alt="October Latest">
                <div class="month-name">October</div>
            </div>
            <div class="month" onclick="showImages('November', 2024, )">
                <img src="gallery.png" alt="November Latest">
                <div class="month-name">November</div>
            </div>
            <div class="month" onclick="showImages('December', 2024)">
                <img src="gallery.png" alt="December Latest">
                <div class="month-name">December</div>
            </div>
        </div>
    </div>

    <div id="Modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content" id="modalContent">
            <!-- Images will be dynamically loaded here -->
        </div>
    </div>
    <script src="scripts.js"></script>
</body>

@endsection