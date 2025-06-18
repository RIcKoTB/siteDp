// Enhanced interactions and animations for News Page
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            
            // Create new URL with filter
            const url = new URL(window.location.origin + window.location.pathname);
            if (filter !== 'all') {
                url.searchParams.set('category', filter);
            }
            // Reset pagination when filtering
            url.searchParams.delete('page');
            
            // Navigate to filtered page
            // Додаємо індикатор завантаження
            document.querySelector('.news-grid').classList.add('loading');
            
            // Показуємо що фільтр активний
            this.style.opacity = '0.8';
            
            window.location.href = url.toString();
        });
    });
        });
    });
            });
        });
    });
    
    // Like button functionality
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('.stat-icon');
            const count = this.querySelector('.stat-count');
            
            if (icon.textContent === '❤️') {
                icon.textContent = '💖';
                count.textContent = parseInt(count.textContent) + 1;
                this.style.color = '#dc2626';
                
                // Add pulse animation
                this.style.animation = 'pulse 0.3s ease';
                setTimeout(() => {
                    this.style.animation = '';
                }, 300);
            } else {
                icon.textContent = '❤️';
                count.textContent = parseInt(count.textContent) - 1;
                this.style.color = '';
            }
        });
    });
    
    // Bookmark functionality
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('.icon');
            
            if (icon.textContent === '🔖') {
                icon.textContent = '📌';
                this.style.background = 'rgba(102, 126, 234, 0.2)';
                this.style.transform = 'scale(1.1)';
            } else {
                icon.textContent = '🔖';
                this.style.background = 'rgba(255,255,255,0.9)';
                this.style.transform = 'scale(1)';
            }
        });
    });
    
    // Share functionality
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Новина з коледжу',
                    url: window.location.href
                });
            } else {
                navigator.clipboard.writeText(window.location.href);
                
                // Show feedback
                const originalIcon = this.querySelector('.icon').textContent;
                this.querySelector('.icon').textContent = '✅';
                this.style.background = 'rgba(34, 197, 94, 0.2)';
                
                setTimeout(() => {
                    this.querySelector('.icon').textContent = originalIcon;
                    this.style.background = 'rgba(255,255,255,0.9)';
                }, 1500);
            }
        });
    });
    
    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('.form-submit');
            const originalText = submitBtn.querySelector('.submit-text').textContent;
            
            submitBtn.querySelector('.submit-text').textContent = 'Підписуємо...';
            submitBtn.style.opacity = '0.7';
            
            setTimeout(() => {
                submitBtn.querySelector('.submit-text').textContent = 'Підписано!';
                submitBtn.querySelector('.submit-icon').textContent = '✅';
                
                setTimeout(() => {
                    submitBtn.querySelector('.submit-text').textContent = originalText;
                    submitBtn.querySelector('.submit-icon').textContent = '✉️';
                    submitBtn.style.opacity = '1';
                    this.reset();
                }, 2000);
            }, 1000);
        });
    }
    
    // Smooth scroll for scroll indicator
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            document.querySelector('.news-section').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }
    
    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.news-card').forEach(card => {
        observer.observe(card);
    });
    
    // Parallax effect for hero
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroParticles = document.querySelector('.hero-particles');
        
        if (heroParticles) {
            heroParticles.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
    
    // Dynamic number animation for stats
    const animateNumbers = () => {
        document.querySelectorAll('.stat-number').forEach(el => {
            const target = parseInt(el.textContent);
            let current = 0;
            const increment = target / 50;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(current);
            }, 30);
        });
    };
    
    // Trigger number animation when hero is visible
    const heroObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
                heroObserver.unobserve(entry.target);
            }
        });
    });
    
    const heroStats = document.querySelector('.hero-stats');
    if (heroStats) {
        heroObserver.observe(heroStats);
    }
});

// Додаткова логіка для фільтрації
document.addEventListener('DOMContentLoaded', function() {
    // Встановлюємо активну вкладку на основі URL параметрів
    const urlParams = new URLSearchParams(window.location.search);
    const currentCategory = urlParams.get('category') || 'all';
    
    // Знаходимо і активуємо правильну вкладку
    const filterTabs = document.querySelectorAll('.filter-tab');
    filterTabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.dataset.filter === currentCategory) {
            tab.classList.add('active');
        }
    });
    
    // Якщо немає активної вкладки, активуємо "Всі новини"
    if (!document.querySelector('.filter-tab.active')) {
        const allTab = document.querySelector('.filter-tab[data-filter="all"]');
        if (allTab) {
            allTab.classList.add('active');
        }
    }
});
