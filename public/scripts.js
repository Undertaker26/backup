function showImages(month, year) {
    const modal = document.getElementById('Modal');
    const modalContent = document.getElementById('modalContent');

    modalContent.innerHTML = '';

    // Generate dates for the selected month and year
    const datesInMonth = getDatesInMonth(month, year);

    // Dummy data for images grouped by date (replace with actual data)
    const imagesByDate = {
        '2024-01-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-02-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-03-03': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-05-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-07-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-06-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-11-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-10-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-04-03': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-09-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-08-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        '2024-12-01': ['pic.jpg', 'wiw.jpg', 'wow.jpg'],
        
        
    };

    datesInMonth.forEach(date => {
        const formattedDate = date.toISOString().split('T')[0];
        const dateElement = document.createElement('div');
        dateElement.className = 'image-date';
        dateElement.textContent = date.toDateString();

        const imageGrid = document.createElement('div');
        imageGrid.className = 'image-grid';

        if (imagesByDate[formattedDate]) {
            imagesByDate[formattedDate].forEach(imageSrc => {
                const img = document.createElement('img');
                img.src = imageSrc;
                img.onclick = () => viewImage(imageSrc);
                imageGrid.appendChild(img);
            });
        } else {
            imageGrid.textContent = 'No images available';
        }

        modalContent.appendChild(dateElement);
        modalContent.appendChild(imageGrid);
    });

    modal.style.display = 'block';
}

function getDatesInMonth(month, year) {
    const date = new Date(year, getMonthIndex(month), 1);
    const dates = [];

    while (date.getMonth() === getMonthIndex(month)) {
        dates.push(new Date(date));
        date.setDate(date.getDate() + 1);
    }

    return dates;
}

function getMonthIndex(month) {
    return new Date(Date.parse(month + " 1, 2024")).getMonth();
}

function closeModal() {
    const modal = document.getElementById('Modal');
    modal.style.display = 'none';
}

function viewImage(imageSrc) {
    alert(`Viewing image: ${imageSrc}`);
    // Implement your logic to display the image in a larger view
}
function showVideos(month, year) {
    const modal = document.getElementById('Modal');
    const modalContent = document.getElementById('modalContent');

    modalContent.innerHTML = '';

    // Generate dates for the selected month and year
    const datesInMonth = getDatesInMonth(month, year);

    // Dummy data for videos grouped by date (replace with actual data)
    const videosByDate = {
        '2024-01-01': ['example.mp4','example.mp4'],
        '2024-01-02': ['path/to/video4.mp4', 'path/to/video5.mp4', 'path/to/video6.mp4'],
        // Add more dates and videos as necessary
    };

    datesInMonth.forEach(date => {
        const formattedDate = date.toISOString().split('T')[0];
        const dateElement = document.createElement('div');
        dateElement.className = 'video-date';
        dateElement.textContent = date.toDateString();

        const videoGrid = document.createElement('div');
        videoGrid.className = 'video-grid';

        if (videosByDate[formattedDate]) {
            videosByDate[formattedDate].forEach(videoSrc => {
                const video = document.createElement('video');
                video.src = videoSrc;
                video.controls = true;
                video.onclick = () => viewVideo(videoSrc);
                videoGrid.appendChild(video);
            });
        } else {
            videoGrid.textContent = 'No videos available';
        }

        modalContent.appendChild(dateElement);
        modalContent.appendChild(videoGrid);
    });

    modal.style.display = 'block';
}

function getDatesInMonth(month, year) {
    const date = new Date(year, getMonthIndex(month), 1);
    const dates = [];

    while (date.getMonth() === getMonthIndex(month)) {
        dates.push(new Date(date));
        date.setDate(date.getDate() + 1);
    }

    return dates;
}

function getMonthIndex(month) {
    return new Date(Date.parse(month + " 1, 2024")).getMonth();
}

function viewVideo(videoSrc) {
    alert(`Viewing video: ${videoSrc}`);
    // Implement your logic to display the video in a larger view
}
