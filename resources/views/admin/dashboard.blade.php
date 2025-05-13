@include('partials.header', ['NamaPage' => 'Halaman Utama'])
@include('partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/bombaclat.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">



<div class="ContainerJadwal">
    <h1>Hi, {{ $admin->profile->name }}</h1>

                <div class="news-preview-card">
            <div class="preview-image"> gambar
                
            </div>
            <div class="preview-content">
                <h2 class="preview-title">US-China trade deal to temporarily cut tariffs</h2>
                <p class="preview-text">The Trump administration announced it had reached a trade agreement with China following trade negotiations in Switzerland over the weekend...</p>
                <div class="preview-meta">
                    <div class="preview-author">
                        <div class="author-icon"></div>
                        <span>Chloe Taylor • <span class="preview-date">May 12, 2025</span></span>
                    </div>
                    <a href="#article1" class="preview-button">Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>

    <section class="container" id="article1">
        <div class="article-container">
            <div class="article-header">
                <h1 class="article-title">US-China trade deal to temporarily cut tariffs</h1>
                <div class="article-meta">
                    <div class="article-author">
                        <img src="/api/placeholder/40/40" alt="Author">
                        <div>
                            <strong>Chloe Taylor</strong>
                            <div>Senior Markets Reporter</div>
                        </div>
                    </div>
                    <div class="article-date">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0C3.58 0 0 3.58 0 8C0 12.42 3.58 16 8 16C12.42 16 16 12.42 16 8C16 3.58 12.42 0 8 0ZM8 14.5C4.41 14.5 1.5 11.59 1.5 8C1.5 4.41 4.41 1.5 8 1.5C11.59 1.5 14.5 4.41 14.5 8C14.5 11.59 11.59 14.5 8 14.5Z" fill="#888"/>
                            <path d="M8.5 4H7V8.5L10.5 10.5L11 9.5L8.5 8V4Z" fill="#888"/>
                        </svg>
                        <span>May 12, 2025</span>
                    </div>
                </div>
                <button class="close-btn" onclick="closeArticle('article1')">Close</button>
            </div>

            <img src="/api/placeholder/1200/600" alt="US-China trade deal" class="article-image">

            <div class="article-content">
                <div class="key-points">
                    <h3>Key Points</h3>
                    <ul>
                        <li>The Trump administration announced it had reached a trade agreement with China following trade negotiations in Switzerland over the weekend.</li>
                        <li>Under the deal, so-called reciprocal tariffs will drop from over 100% to 10% on both sides for 90 days. The Trump administration will keep 20% fentanyl-related tariffs on China in place.</li>
                        <li>Global stocks rallied after the terms of the deal were announced Monday morning, with market watchers expecting more positive developments for markets on the back of the news.</li>
                    </ul>
                </div>

                <p>Market watchers have labeled the new U.S.-China deal to temporarily cut tariffs "better than expected," "more workable" and even a "dream scenario" — and are expecting more near-term relief for investors.</p>

                <p>Under the deal, so-called reciprocal tariffs will drop from over 100% to 10% on both sides. The Trump administration will keep 20% fentanyl-related tariffs on China in place, meaning America's total duties on Chinese imports will stand at 30% while the 90-day pause is effective.</p>

                <p>U.S. Treasury Secretary Scott Bennett (R) and U.S. Trade Representative Jamison Brett held a news conference in Geneva on May 12, 2025, to give details of "substantial progress" following a two-day closed-door meeting between U.S. and China top officials aimed at easing the tariff war.</p>

            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle preview card clicks
        const previewButtons = document.querySelectorAll('.preview-button');
        
        previewButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get the target article id from the href attribute
                const targetId = this.getAttribute('href').substring(1);
                
                // Hide all articles
                const allArticles = document.querySelectorAll('section[id^="article"]');
                allArticles.forEach(article => {
                    article.style.display = 'none';
                });
                
                // Show the target article
                const targetArticle = document.getElementById(targetId);
                if (targetArticle) {
                    targetArticle.style.display = 'block';
                    
                    // Scroll to the article
                    targetArticle.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
    
    // Function to close article
    function closeArticle(articleId) {
        document.getElementById(articleId).style.display = 'none';
        
        // Scroll back to top
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>