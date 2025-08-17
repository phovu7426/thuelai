@extends('driver.layouts.main')

@section('title', 'Tin tức - Dịch vụ tài xế thuê lái')

@section('meta')
<meta name="description" content="Tin tức mới nhất về dịch vụ tài xế thuê lái, mẹo lái xe an toàn, và các thông tin hữu ích khác.">
<meta name="keywords" content="tin tức tài xế, mẹo lái xe, dịch vụ thuê lái, an toàn giao thông">
@endsection

@push('styles')
<style>
:root {
    --primary-color: #6366f1;
    --secondary-color: #8b5cf6;
    --accent-color: #ec4899;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --dark-color: #1f2937;
    --light-color: #f8fafc;
    --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
    --gradient-secondary: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: var(--gradient-primary);
    overflow: hidden;
    padding-top: 80px;
}

.hero-video-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(99, 102, 241, 0.9) 0%, 
        rgba(139, 92, 246, 0.8) 50%, 
        rgba(236, 72, 153, 0.7) 100%);
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    background-size: 400px 400px, 300px 300px, 200px 200px;
    animation: float-particles 20s ease-in-out infinite;
}

@keyframes float-particles {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 900px;
    margin: 0 auto;
    padding: 0 1rem;
    width: 100%;
}

.hero-badge {
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease-out;
}

.badge-glow {
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
}

.badge-glow::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.badge-glow:hover::before {
    left: 100%;
}

.hero-title {
    font-size: clamp(3rem, 8vw, 5rem);
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.title-line {
    display: block;
    margin-bottom: 0.5rem;
}

.title-highlight {
    background: var(--gradient-secondary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.title-highlight::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--gradient-secondary);
    border-radius: 2px;
}

.hero-description {
    font-size: 1.4rem;
    margin-bottom: 3rem;
    opacity: 0.95;
    line-height: 1.7;
    animation: fadeInUp 1s ease-out 0.4s both;
}

.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.scroll-arrow {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    animation: bounce 2s infinite;
    cursor: pointer;
    transition: all 0.3s ease;
}

.scroll-arrow:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateX(-50%) scale(1.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-15px); }
    60% { transform: translateX(-50%) translateY(-7px); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Ensure news grid displays properly */
.news-grid {
    padding: 50px 0; /* Giảm padding từ 100px xuống 50px */
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    position: relative;
    min-height: 400px; /* Giảm min-height */
}

.news-grid .container {
    position: relative;
    z-index: 2;
}

.news-grid .row {
    margin: 0 -15px;
}

.news-grid .col-md-6 {
    padding: 0 15px;
    margin-bottom: 30px;
}

.news-filters {
    margin-bottom: 30px; /* Giảm margin từ 50px xuống 30px */
    text-align: center;
    position: relative;
}

.filter-btn {
    background: white;
    border: 2px solid #e2e8f0;
    color: #64748b;
    padding: 12px 24px;
    margin: 0 8px;
    border-radius: 30px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    font-weight: 600;
    font-size: 0.95rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.filter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    transition: left 0.4s ease;
    z-index: -1;
}

.filter-btn:hover::before,
.filter-btn.active::before {
    left: 0;
}

.filter-btn:hover,
.filter-btn.active {
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Make sure news cards are visible */
.news-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    position: relative;
    border: 1px solid rgba(226, 232, 240, 0.8);
    display: flex;
    flex-direction: column;
    min-height: 400px; /* Ensure minimum height */
}

.news-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient-primary);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.news-card:hover::before {
    transform: scaleX(1);
}

.news-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-xl);
}

.news-image {
    height: 220px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
    background: #f1f5f9; /* Fallback background */
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.news-card:hover .news-image img {
    transform: scale(1.1);
}

.news-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: var(--gradient-primary);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow-md);
    z-index: 2;
}

.news-content {
    padding: 30px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-date {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.news-date i {
    color: var(--primary-color);
}

.news-title {
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 15px;
    line-height: 1.4;
    color: var(--dark-color);
    flex: 1;
}

.news-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.news-title a:hover {
    color: var(--primary-color);
}

.news-excerpt {
    color: #64748b;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 0.95rem;
    flex: 1;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
    margin-top: auto;
}

.read-more {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.read-more:hover {
    color: var(--secondary-color);
    transform: translateX(5px);
}

.news-views {
    color: #64748b;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Ensure proper spacing for news grid */
.news-grid .row {
    margin: 0 -15px;
}

.news-grid .col-md-6 {
    padding: 0 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .news-card {
        margin-bottom: 20px;
        min-height: 350px;
    }
    
    .news-content {
        padding: 20px;
    }
    
    .news-title {
        font-size: 1.2rem;
    }
    
    .news-image {
        height: 180px;
    }
}

@media (max-width: 576px) {
    .news-grid .col-md-6 {
        padding: 0 10px;
    }
    
    .news-content {
        padding: 15px;
    }
    
    .news-title {
        font-size: 1.1rem;
    }
    
    .news-card {
        min-height: 320px;
    }
}

.news-sidebar {
    background: white;
    padding: 35px;
    border-radius: 20px;
    height: fit-content;
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(226, 232, 240, 0.8);
    position: sticky;
    top: 100px;
}

.sidebar-title {
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 25px;
    color: var(--dark-color);
    position: relative;
    padding-bottom: 15px;
}

.sidebar-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 4px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.popular-news {
    margin-bottom: 40px;
}

.popular-news-item {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.popular-news-item:hover {
    transform: translateX(5px);
}

.popular-news-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.popular-news-image {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    overflow: hidden;
    margin-right: 18px;
    flex-shrink: 0;
    box-shadow: var(--shadow-md);
}

.popular-news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.popular-news-item:hover .popular-news-image img {
    transform: scale(1.1);
}

.popular-news-content h5 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.4;
}

.popular-news-content h5 a {
    color: var(--dark-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.popular-news-content h5 a:hover {
    color: var(--primary-color);
}

.popular-news-content .news-date {
    font-size: 0.85rem;
    margin-bottom: 0;
    color: #64748b;
}

.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.categories-list li {
    margin-bottom: 12px;
}

.categories-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f8fafc;
    border-radius: 12px;
    color: #64748b;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid transparent;
    font-weight: 600;
}

.categories-list a:hover {
    background: var(--gradient-primary);
    color: white;
    transform: translateX(8px);
    box-shadow: var(--shadow-md);
}

.categories-list .count {
    background: #e2e8f0;
    color: #64748b;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 700;
    transition: all 0.3s ease;
}

.categories-list a:hover .count {
    background: rgba(255,255,255,0.2);
    color: white;
}

.quick-contact {
    background: var(--gradient-primary);
    padding: 25px;
    border-radius: 15px;
    color: white;
    text-align: center;
}

.quick-contact .sidebar-title {
    color: white;
    margin-bottom: 20px;
}

.quick-contact .sidebar-title::after {
    background: rgba(255, 255, 255, 0.3);
}

.quick-contact .btn {
    margin-bottom: 10px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.quick-contact .btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.pagination-wrapper {
    text-align: center;
    margin-top: 60px;
}

.pagination .page-link {
    border: none;
    color: var(--primary-color);
    padding: 15px 20px;
    margin: 0 5px;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 600;
    box-shadow: var(--shadow-sm);
}

.pagination .page-link:hover {
    background: var(--gradient-primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.pagination .page-item.active .page-link {
    background: var(--gradient-primary);
    border-color: transparent;
    box-shadow: var(--shadow-md);
}

.pagination .page-item.disabled .page-link {
    color: #94a3b8;
    background: #f1f5f9;
    box-shadow: none;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    margin: 40px 0;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #64748b;
    margin-bottom: 10px;
    font-weight: 600;
}

.empty-state p {
    color: #94a3b8;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .hero-section {
        padding-top: 100px;
        min-height: 80vh;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-description {
        font-size: 1.1rem;
    }
    
    .filter-btn {
        margin: 5px;
        padding: 10px 18px;
        font-size: 0.9rem;
    }
    
    .news-sidebar {
        margin-top: 40px;
        position: static;
    }
    
    .news-content {
        padding: 20px;
    }
    
    .news-title {
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .news-filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }
    
    .filter-btn {
        margin: 0;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-video-bg">
        <video autoplay muted loop>
            <source src="{{ asset('assets/videos/hero-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="badge-glow">📰 Tin tức & Blog</span>
        </div>
        <h1 class="hero-title">
            <span class="title-line">Tin tức & Blog</span>
            <span class="title-highlight">Dịch vụ tài xế thuê lái</span>
        </h1>
        <p class="hero-description">
            Cập nhật những tin tức mới nhất về dịch vụ tài xế thuê lái, mẹo lái xe an toàn và các thông tin hữu ích khác
        </p>
        <a href="#news-grid" class="scroll-indicator">
            <span class="scroll-arrow">↓</span>
        </a>
    </div>
</section>

<!-- News Grid Section -->
<section class="news-grid" id="news-grid">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Filters -->
                <div class="news-filters">
                    <button class="filter-btn active" data-category="all">🎯 Tất cả</button>
                    <button class="filter-btn" data-category="tips">💡 Mẹo lái xe</button>
                    <button class="filter-btn" data-category="news">📰 Tin tức</button>
                    <button class="filter-btn" data-category="safety">🛡️ An toàn giao thông</button>
                    <button class="filter-btn" data-category="service">🚗 Dịch vụ</button>
                </div>

                <!-- News Grid -->
                <div class="row" id="news-grid">
                    @if($posts && $posts->count() > 0)
                        @foreach($posts as $post)
                        <div class="col-md-6 news-item" data-category="{{ $post->category->slug ?? 'news' }}">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="{{ $post->image_url ?? asset('images/default-post.jpg') }}" alt="{{ $post->title }}">
                                    <div class="news-category">
                                        {{ $post->category->name ?? 'Tin tức' }}
                                    </div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $post->created_at ? $post->created_at->format('d/m/Y') : now()->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="{{ route('driver.news.detail', $post->slug ?? 'sample-post') }}">
                                            {{ $post->title ?? 'Tiêu đề bài viết mẫu' }}
                                        </a>
                                    </h3>
                                    <p class="news-excerpt">
                                        {{ Str::limit($post->excerpt ?? $post->content ?? 'Đây là nội dung mẫu cho bài viết. Bạn có thể thay thế bằng nội dung thực tế từ database.', 120) }}
                                    </p>
                                    <div class="news-meta">
                                        <a href="{{ route('driver.news.detail', $post->slug ?? 'sample-post') }}" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> {{ $post->views ?? rand(100, 500) }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    @else
                        <!-- Sample News Cards for Demo -->
                        <div class="col-md-6 news-item" data-category="tips">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="Mẹo lái xe an toàn">
                                    <div class="news-category">💡 Mẹo lái xe</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">10 Mẹo lái xe an toàn cho tài xế mới</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Những mẹo lái xe cơ bản giúp bạn trở thành tài xế an toàn và tự tin trên mọi cung đường.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 1,245
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6 news-item" data-category="safety">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="An toàn giao thông">
                                    <div class="news-category">🛡️ An toàn giao thông</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->subDays(1)->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">Quy tắc giao thông mới nhất 2024</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Cập nhật những quy tắc giao thông mới nhất và những thay đổi quan trọng trong luật giao thông.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 2,156
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6 news-item" data-category="service">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="Dịch vụ tài xế">
                                    <div class="news-category">🚗 Dịch vụ</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->subDays(2)->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">Dịch vụ tài xế thuê lái - Giải pháp cho mọi nhu cầu</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Khám phá các dịch vụ tài xế thuê lái chất lượng cao, đáp ứng mọi nhu cầu di chuyển của bạn.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 3,421
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6 news-item" data-category="news">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="Tin tức mới">
                                    <div class="news-category">📰 Tin tức</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->subDays(3)->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">Xu hướng dịch vụ tài xế thuê lái năm 2024</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Những xu hướng mới nhất trong ngành dịch vụ tài xế thuê lái và công nghệ đang thay đổi ngành nghề này.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 4,876
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6 news-item" data-category="tips">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="Mẹo bảo dưỡng xe">
                                    <div class="news-category">💡 Mẹo lái xe</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->subDays(4)->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">Hướng dẫn bảo dưỡng xe định kỳ</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Những bước bảo dưỡng xe cơ bản giúp xe của bạn luôn hoạt động tốt và an toàn trên đường.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 2,543
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6 news-item" data-category="safety">
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=400&h=220&fit=crop" alt="Lái xe ban đêm">
                                    <div class="news-category">🛡️ An toàn giao thông</div>
                                </div>
                                <div class="news-content">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ now()->subDays(5)->format('d/m/Y') }}
                                    </div>
                                    <h3 class="news-title">
                                        <a href="#">Kỹ năng lái xe an toàn vào ban đêm</a>
                                    </h3>
                                    <p class="news-excerpt">
                                        Những kỹ năng cần thiết để lái xe an toàn trong điều kiện ánh sáng yếu và tầm nhìn hạn chế.
                                    </p>
                                    <div class="news-meta">
                                        <a href="#" class="read-more">
                                            Đọc thêm <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <span class="news-views">
                                            <i class="fas fa-eye"></i> 1,987
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="news-sidebar">
                    <!-- Popular News -->
                    <div class="popular-news">
                        <h4 class="sidebar-title">🔥 Bài viết phổ biến</h4>
                        @forelse($popularPosts ?? [] as $popularPost)
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="{{ $popularPost->image_url }}" alt="{{ $popularPost->title }}">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="{{ route('driver.news.detail', $popularPost->slug) }}">
                                        {{ Str::limit($popularPost->title, 50) }}
                                    </a>
                                </h5>
                                <div class="news-date">{{ $popularPost->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @empty
                        <!-- Sample Popular Posts -->
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=70&h=70&fit=crop" alt="Mẹo lái xe">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="#">10 Mẹo lái xe an toàn cho tài xế mới</a>
                                </h5>
                                <div class="news-date">{{ now()->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=70&h=70&fit=crop" alt="An toàn giao thông">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="#">Quy tắc giao thông mới nhất 2024</a>
                                </h5>
                                <div class="news-date">{{ now()->subDays(1)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=70&h=70&fit=crop" alt="Dịch vụ tài xế">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="#">Dịch vụ tài xế thuê lái - Giải pháp cho mọi nhu cầu</a>
                                </h5>
                                <div class="news-date">{{ now()->subDays(2)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?w=70&h=70&fit=crop" alt="Bảo dưỡng xe">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="#">Hướng dẫn bảo dưỡng xe định kỳ</a>
                                </h5>
                                <div class="news-date">{{ now()->subDays(4)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Categories -->
                    <div class="news-categories">
                        <h4 class="sidebar-title">📂 Danh mục</h4>
                        <ul class="categories-list">
                            <li>
                                <a href="{{ route('driver.news') }}?category=all">
                                    <span>🎯 Tất cả</span>
                                    <span class="count">{{ $totalPosts ?? 6 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=tips">
                                    <span>💡 Mẹo lái xe</span>
                                    <span class="count">{{ $categoryCounts['tips'] ?? 2 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=news">
                                    <span>📰 Tin tức</span>
                                    <span class="count">{{ $categoryCounts['news'] ?? 1 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=safety">
                                    <span>🛡️ An toàn giao thông</span>
                                    <span class="count">{{ $categoryCounts['safety'] ?? 2 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=service">
                                    <span>🚗 Dịch vụ</span>
                                    <span class="count">{{ $categoryCounts['service'] ?? 1 }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Contact -->
                    <div class="quick-contact">
                        <h4 class="sidebar-title">📞 Liên hệ nhanh</h4>
                        <div class="text-center">
                            <a href="tel:{{ $contactInfo->hotline ?? '1900-xxxx' }}" class="btn btn-light btn-lg w-100 mb-3">
                                <i class="fas fa-phone"></i> {{ $contactInfo->hotline ?? '1900-xxxx' }}
                            </a>
                            <a href="{{ route('driver.contact') }}" class="btn btn-outline-light w-100">
                                <i class="fas fa-envelope"></i> Gửi tin nhắn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality with enhanced animations
    const filterBtns = document.querySelectorAll('.filter-btn');
    const newsItems = document.querySelectorAll('.news-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button with smooth transition
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.transform = 'scale(1)';
            });
            this.classList.add('active');
            this.style.transform = 'scale(1.05)';
            
            // Filter news items with staggered animation
            let delay = 0;
            newsItems.forEach((item, index) => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                    item.style.animation = `slideInUp 0.6s ease-out ${delay}s both`;
                    delay += 0.1;
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Enhanced animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInUp {
            from { 
                opacity: 0; 
                transform: translateY(30px) scale(0.95); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .news-card {
            animation: fadeInUp 0.8s ease-out both;
        }
        
        .news-card:nth-child(1) { animation-delay: 0.1s; }
        .news-card:nth-child(2) { animation-delay: 0.2s; }
        .news-card:nth-child(3) { animation-delay: 0.3s; }
        .news-card:nth-child(4) { animation-delay: 0.4s; }
        .news-card:nth-child(5) { animation-delay: 0.5s; }
        .news-card:nth-child(6) { animation-delay: 0.6s; }
    `;
    document.head.appendChild(style);

    // Smooth scroll for hero section
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector('#news-grid');
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Intersection Observer for lazy loading and animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all news cards
    document.querySelectorAll('.news-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        }
    });
});
</script>
@endpush
