<section id="blog" class="section fade-in-section">
    <div class="container">
        <h2 class="section-title">Latest Blog Posts</h2>
        <div class="row">

            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card">
                        <div class="blog-image">
                            @if($post->thumbnail)
                            <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
                            @else
                            <i class="fas fa-database"></i>
                            @endif
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                               <span class="blog-date">
                                    <i class="far fa-calendar"></i>
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                <span class="blog-category"><i class="far fa-folder"></i> {{ $post->category->post_category_name ?? '' }}</span>
                            </div>
                            <h3 class="blog-title">
                                {{ $post->title ?? '' }}
                            </h3>
                            <p class="blog-excerpt">
                                {!! $post->excerpt ?? '' !!}
                            </p>
                            <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="text-center mt-5">
            <a href="blog.html" class="btn btn-custom">
                <i class="fas fa-newspaper"></i> View All Blog Posts
            </a>
        </div>
    </div>
</section>
