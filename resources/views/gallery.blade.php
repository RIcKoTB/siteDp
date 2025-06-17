@extends('layouts.app')

@section('title', 'Галерея - ЦК ПІТ')

@section('content')
<div class="container" style="padding: 40px 20px;">
    <div style="text-align: center; margin-bottom: 50px;">
        <h1 style="font-size: 36px; margin-bottom: 15px; color: #333;">📸 Галерея</h1>
        <p style="font-size: 18px; color: #666; max-width: 600px; margin: 0 auto;">
            Фотографії з життя нашої циклової комісії: навчання, заходи, випуски та багато іншого
        </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
        @foreach($photos as $photo)
            <div class="gallery-item" style="
                position: relative; 
                border-radius: 15px; 
                overflow: hidden; 
                aspect-ratio: 4/3; 
                background: #f5f5f5;
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            " 
            onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'"
            onclick="openModal('{{ $photo->image_url }}', '{{ $photo->title }}')">

                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}"
                     style="width: 100%; height: 100%; object-fit: cover;">

                <div style="
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: linear-gradient(transparent, rgba(0,0,0,0.8));
                    color: white;
                    padding: 30px 20px 20px;
                    font-weight: 500;
                    font-size: 16px;
                ">
                    {{ $photo->title }}
                </div>
            </div>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 50px;">
        <a href="/" style="
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 12px 24px;
            border: 2px solid #007bff;
            border-radius: 8px;
            transition: all 0.3s ease;
        " 
        onmouseover="this.style.background='#007bff'; this.style.color='white'"
        onmouseout="this.style.background='transparent'; this.style.color='#007bff'">
            ← Повернутися на головну
        </a>
    </div>
</div>

<!-- Modal для перегляду фото -->
<div id="photoModal" style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 1000;
    cursor: pointer;
" onclick="closeModal()">
    <div style="
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        max-height: 90%;
        text-align: center;
    ">
        <img id="modalImage" style="
            max-width: 100%;
            max-height: 80vh;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        ">
        <h3 id="modalTitle" style="
            color: white;
            margin-top: 20px;
            font-size: 24px;
            font-weight: 500;
        "></h3>
    </div>
    
    <button onclick="closeModal()" style="
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        font-size: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease;
    " 
    onmouseover="this.style.background='rgba(255,255,255,0.3)'"
    onmouseout="this.style.background='rgba(255,255,255,0.2)'">
        ×
    </button>
</div>

<script>
function openModal(imageSrc, title) {
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    
    modalImage.src = imageSrc;
    modalTitle.textContent = title;
    modal.style.display = 'block';
    
    // Запобігаємо прокрутці сторінки
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('photoModal');
    modal.style.display = 'none';
    
    // Відновлюємо прокрутку сторінки
    document.body.style.overflow = 'auto';
}

// Закриття модального вікна по Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Адаптивність
window.addEventListener('resize', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    if (window.innerWidth <= 768) {
        galleryItems.forEach(item => {
            item.style.aspectRatio = '3/2';
        });
    } else {
        galleryItems.forEach(item => {
            item.style.aspectRatio = '4/3';
        });
    }
});
</script>

<style>
@media (max-width: 768px) {
    .container {
        padding: 20px 15px !important;
    }
    
    h1 {
        font-size: 28px !important;
    }
    
    p {
        font-size: 16px !important;
    }
    
    .gallery-item {
        aspect-ratio: 3/2 !important;
    }
}

@media (max-width: 480px) {
    .gallery-item {
        aspect-ratio: 1/1 !important;
    }
    
    #photoModal div {
        max-width: 95% !important;
    }
    
    #modalTitle {
        font-size: 18px !important;
    }
}
</style>
@endsection
