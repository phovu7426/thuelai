@extends('driver.layouts.main')

@section('title', 'Tin tức - Dịch vụ tài xế thuê lái')

@section('meta')
<meta name="description" content="Tin tức mới nhất về dịch vụ tài xế thuê lái, mẹo lái xe an toàn, và các thông tin hữu ích khác.">
<meta name="keywords" content="tin tức tài xế, mẹo lái xe, dịch vụ thuê lái, an toàn giao thông">
@endsection

@push('styles')
<style>
.news-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.news-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.news-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.news-grid {
    padding: 80px 0;
}

.news-filters {
    margin-bottom: 40px;
    text-align: center;
}

.filter-btn {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    color: #6c757d;
    padding: 10px 20px;
    margin: 0 5px;
    border-radius: 25px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-btn.active,
.filter-btn:hover {
    background: #007bff;
    border-color: #007bff;
    color: white;
}

.news-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    margin-bottom: 30px;
    height: 100%;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.news-image {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.1);
}

.news-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #007bff;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.news-content {
    padding: 25px;
}

.news-date {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.news-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.4;
    color: #2c3e50;
}

.news-excerpt {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 20px;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.read-more {
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.read-more:hover {
    color: #0056b3;
}

.news-views {
    color: #6c757d;
    font-size: 0.9rem;
}

.news-sidebar {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    height: fit-content;
}

.sidebar-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #2c3e50;
    border-bottom: 3px solid #007bff;
    padding-bottom: 10px;
}

.popular-news {
    margin-bottom: 30px;
}

.popular-news-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.popular-news-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.popular-news-image {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
}

.popular-news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popular-news-content h5 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.3;
}

.popular-news-content .news-date {
    font-size: 0.8rem;
    margin-bottom: 0;
}

.categories-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.categories-list li {
    margin-bottom: 10px;
}

.categories-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    background: white;
    border-radius: 8px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.3s ease;
}

.categories-list a:hover {
    background: #007bff;
    color: white;
    transform: translateX(5px);
}

.categories-list .count {
    background: #e9ecef;
    color: #6c757d;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.categories-list a:hover .count {
    background: rgba(255,255,255,0.2);
    color: white;
}

.pagination-wrapper {
    text-align: center;
    margin-top: 50px;
}

.pagination .page-link {
    border: none;
    color: #007bff;
    padding: 12px 18px;
    margin: 0 5px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #007bff;
    color: white;
}

.pagination .page-item.active .page-link {
    background: #007bff;
    border-color: #007bff;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .news-hero h1 {
        font-size: 2rem;
    }
    
    .news-hero p {
        font-size: 1rem;
    }
    
    .filter-btn {
        margin: 5px;
        padding: 8px 16px;
        font-size: 0.9rem;
    }
    
    .news-sidebar {
        margin-top: 40px;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="news-hero">
    <div class="container">
        <h1>Tin tức & Blog</h1>
        <p>Cập nhật những tin tức mới nhất về dịch vụ tài xế thuê lái, mẹo lái xe an toàn và các thông tin hữu ích khác</p>
    </div>
</section>

<!-- News Grid Section -->
<section class="news-grid">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Filters -->
                <div class="news-filters">
                    <button class="filter-btn active" data-category="all">Tất cả</button>
                    <button class="filter-btn" data-category="tips">Mẹo lái xe</button>
                    <button class="filter-btn" data-category="news">Tin tức</button>
                    <button class="filter-btn" data-category="safety">An toàn giao thông</button>
                    <button class="filter-btn" data-category="service">Dịch vụ</button>
                </div>

                <!-- News Grid -->
                <div class="row" id="news-grid">
                    @forelse($posts as $post)
                    <div class="col-md-6 news-item" data-category="{{ $post->category->slug ?? 'news' }}">
                        <article class="news-card">
                            <div class="news-image">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                                <div class="news-category">
                                    {{ $post->category->name ?? 'Tin tức' }}
                                </div>
                            </div>
                            <div class="news-content">
                                <div class="news-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $post->created_at->format('d/m/Y') }}
                                </div>
                                <h3 class="news-title">
                                    <a href="{{ route('driver.news.detail', $post->slug) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="news-excerpt">
                                    {{ Str::limit($post->excerpt ?? $post->content, 120) }}
                                </p>
                                <div class="news-meta">
                                    <a href="{{ route('driver.news.detail', $post->slug) }}" class="read-more">
                                        Đọc thêm <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <span class="news-views">
                                        <i class="fas fa-eye"></i> {{ $post->views ?? rand(100, 500) }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Chưa có bài viết nào</h4>
                            <p class="text-muted">Chúng tôi sẽ cập nhật tin tức sớm nhất!</p>
                        </div>
                    </div>
                    @endforelse
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
                        <h4 class="sidebar-title">Bài viết phổ biến</h4>
                        @foreach($popularPosts ?? [] as $popularPost)
                        <div class="popular-news-item">
                            <div class="popular-news-image">
                                <img src="{{ $popularPost->image_url }}" alt="{{ $popularPost->title }}">
                            </div>
                            <div class="popular-news-content">
                                <h5>
                                    <a href="{{ route('driver.news.detail', $popularPost->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($popularPost->title, 50) }}
                                    </a>
                                </h5>
                                <div class="news-date">{{ $popularPost->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Categories -->
                    <div class="news-categories">
                        <h4 class="sidebar-title">Danh mục</h4>
                        <ul class="categories-list">
                            <li>
                                <a href="{{ route('driver.news') }}?category=all">
                                    <span>Tất cả</span>
                                    <span class="count">{{ $totalPosts ?? 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=tips">
                                    <span>Mẹo lái xe</span>
                                    <span class="count">{{ $categoryCounts['tips'] ?? 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=news">
                                    <span>Tin tức</span>
                                    <span class="count">{{ $categoryCounts['news'] ?? 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=safety">
                                    <span>An toàn giao thông</span>
                                    <span class="count">{{ $categoryCounts['safety'] ?? 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('driver.news') }}?category=service">
                                    <span>Dịch vụ</span>
                                    <span class="count">{{ $categoryCounts['service'] ?? 0 }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Contact -->
                    <div class="quick-contact mt-4">
                        <h4 class="sidebar-title">Liên hệ nhanh</h4>
                        <div class="text-center">
                            <a href="tel:{{ $contactInfo->hotline ?? '1900-xxxx' }}" class="btn btn-primary btn-lg w-100 mb-2">
                                <i class="fas fa-phone"></i> {{ $contactInfo->hotline ?? '1900-xxxx' }}
                            </a>
                            <a href="{{ route('driver.contact') }}" class="btn btn-outline-primary w-100">
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
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const newsItems = document.querySelectorAll('.news-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter news items
            newsItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.5s ease-in';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Add fadeIn animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
});
</script>
@endpush
