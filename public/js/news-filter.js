// Покращена фільтрація новин
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const newsGrid = document.querySelector('.news-grid');
    
    // Встановлюємо активну вкладку на основі URL
    const urlParams = new URLSearchParams(window.location.search);
    const currentCategory = urlParams.get('category') || 'all';
    
    // Активуємо правильну вкладку
    filterTabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.filter === currentCategory) {
            tab.classList.add('active');
        }
    });
    
    // Обробка кліків по фільтрах
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Якщо вкладка вже активна, не робимо нічого
            if (this.classList.contains('active')) {
                return;
            }
            
            // Візуальний фідбек
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Додаємо ефект завантаження
            if (newsGrid) {
                newsGrid.style.opacity = '0.6';
                newsGrid.style.pointerEvents = 'none';
            }
            
            const filter = this.dataset.filter;
            
            // Створюємо URL
            const url = new URL(window.location.origin + window.location.pathname);
            if (filter !== 'all') {
                url.searchParams.set('category', filter);
            }
            
            // Переходимо на нову сторінку
            setTimeout(() => {
                window.location.href = url.toString();
            }, 200);
        });
    });
    
    // Додаємо hover ефекти
    filterTabs.forEach(tab => {
        tab.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            }
        });
        
        tab.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = '';
                this.style.boxShadow = '';
            }
        });
    });
});
