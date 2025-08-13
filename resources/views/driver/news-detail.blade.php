@extends('driver.layouts.main')

@section('title', $post->title . ' - Dịch vụ tài xế thuê lái')

@section('meta')
<meta name="description" content="{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
<meta name="keywords" content="{{ $post->meta_keywords ?? 'tin tức tài xế, dịch vụ thuê lái, ' . $post->title }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 160) }}">
<meta property="og:image" content="{{ $post->image_url }}">
<meta property="og:url" content="{{ request()->url() }}">
@endsection

@push('styles')
<style>
.news-detail-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
    text-align: center;
}

.news-detail-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.news-detail-hero .meta {
    opacity: 0.9;
    font-size: 1.1rem;
}

.news-detail-content {
    padding: 60px 0;
}

.article-container {
    max-width: 800px;
    margin: 0 auto;
}

.article-image {
    width: 100%;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    flex-wrap: wrap;
    gap: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    color: #6c757d;
    font-size: 0.95rem;
}

.meta-item i {
    margin-right: 8px;
    color: #007bff;
}

.article-content {
    line-height: 1.8;
    color: #2c3e50;
    font-size: 1.1rem;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    color: #2c3e50;
    margin: 2rem 0 1rem;
    font-weight: 600;
}

.article-content h2 {
    font-size: 1.8rem;
}

.article-content h3 {
    font-size: 1.5rem;
}

.article-content h4 {
    font-size: 1.3rem;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content ul,
.article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 20px;
    margin: 2rem 0;
    font-style: italic;
    color: #6c757d;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 0 10px 10px 0;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 2rem 0;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.article-tags {
    margin: 40px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.article-tags h5 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-weight: 600;
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-item {
    background: #007bff;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.tag-item:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.share-section {
    margin: 40px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    text-align: center;
}

.share-section h5 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-weight: 600;
}

.share-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.share-btn {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.share-btn:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.share-btn.facebook {
    background: #1877f2;
}

.share-btn.twitter {
    background: #1da1f2;
}

.share-btn.linkedin {
    background: #0077b5;
}

.share-btn.zalo {
    background: #0068ff;
}

.share-btn i {
    margin-right: 8px;
}

.related-posts {
    margin-top: 80px;
    padding-top: 60px;
    border-top: 2px solid #e9ecef;
}

.related-posts h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 2rem;
    text-align: center;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.related-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.related-image {
    height: 200px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-card:hover .related-image img {
    transform: scale(1.1);
}

.related-content {
    padding: 25px;
}

.related-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
    line-height: 1.4;
}

.related-title a {
    color: #2c3e50;
    text-decoration: none;
}

.related-title a:hover {
    color: #007bff;
}

.related-excerpt {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 20px;
}

.related-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9rem;
    color: #6c757d;
}

.back-to-news {
    text-align: center;
    margin: 40px 0;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.back-btn i {
    margin-right: 8px;
}

@media (max-width: 768px) {
    .news-detail-hero h1 {
        font-size: 2rem;
    }
    
    .article-meta {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .share-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="news-detail-hero">
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <div class="meta">
            <span><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('d/m/Y') }}</span>
            @if($post->category)
            <span class="ms-3"><i class="fas fa-folder"></i> {{ $post->category->name }}</span>
            @endif
            <span class="ms-3"><i class="fas fa-eye"></i> {{ $post->views ?? rand(100, 500) }} lượt xem</span>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="news-detail-content">
    <div class="container">
        <div class="article-container">
            @if($post->image)
            <div class="article-image">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
            </div>
            @endif

            <div class="article-meta">
                <div class="meta-item">
                    <i class="fas fa-user"></i>
                    <span>{{ $post->author->name ?? 'Admin' }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $post->created_at->format('H:i') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $post->created_at->format('d/m/Y') }}</span>
                </div>
                @if($post->reading_time)
                <div class="meta-item">
                    <i class="fas fa-book-open"></i>
                    <span>{{ $post->reading_time }} phút đọc</span>
                </div>
                @endif
            </div>

            <div class="article-content">
                {!! $post->content !!}
            </div>

            @if($post->tags && count($post->tags) > 0)
            <div class="article-tags">
                <h5>Tags:</h5>
                <div class="tag-list">
                    @foreach($post->tags as $tag)
                    <a href="{{ route('driver.news') }}?tag={{ $tag->slug }}" class="tag-item">
                        {{ $tag->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="share-section">
                <h5>Chia sẻ bài viết:</h5>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" class="share-btn facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                       target="_blank" class="share-btn twitter">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       target="_blank" class="share-btn linkedin">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                    <a href="https://zalo.me/share?u={{ urlencode(request()->url()) }}" 
                       target="_blank" class="share-btn zalo">
                        <i class="fas fa-share"></i> Zalo
                    </a>
                </div>
            </div>

            <div class="back-to-news">
                <a href="{{ route('driver.news') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách tin tức
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
@if($relatedPosts && count($relatedPosts) > 0)
<section class="related-posts">
    <div class="container">
        <h3>Bài viết liên quan</h3>
        <div class="related-grid">
            @foreach($relatedPosts as $relatedPost)
            <article class="related-card">
                <div class="related-image">
                    <img src="{{ $relatedPost->image_url }}" alt="{{ $relatedPost->title }}">
                </div>
                <div class="related-content">
                    <h4 class="related-title">
                        <a href="{{ route('driver.news.detail', $relatedPost->slug) }}">
                            {{ $relatedPost->title }}
                        </a>
                    </h4>
                    <p class="related-excerpt">
                        {{ Str::limit($relatedPost->excerpt ?? strip_tags($relatedPost->content), 120) }}
                    </p>
                    <div class="related-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $relatedPost->created_at->format('d/m/Y') }}</span>
                        <span><i class="fas fa-eye"></i> {{ $relatedPost->views ?? rand(50, 200) }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add reading time calculation if not provided
    const articleContent = document.querySelector('.article-content');
    if (articleContent) {
        const text = articleContent.textContent || articleContent.innerText;
        const wordCount = text.trim().split(/\s+/).length;
        const readingTime = Math.ceil(wordCount / 200); // Average reading speed: 200 words per minute
        
        // Update reading time in meta if it doesn't exist
        const readingTimeMeta = document.querySelector('.meta-item:last-child');
        if (readingTimeMeta && readingTimeMeta.textContent.includes('phút đọc')) {
            readingTimeMeta.innerHTML = `<i class="fas fa-book-open"></i><span>${readingTime} phút đọc</span>`;
        }
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

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
