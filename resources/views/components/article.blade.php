<div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
    <!-- News block -->
    <div class="hover-overlay shadow-2-strong p-2">
        <!-- Article data -->
        <div class="row mb-3">
            <div class="col-6">
                <a href="{{ route('category', ['slug' => $article->category->slug, 'id' => $article->category->id]) }}"
                   class="text-info">
                    <i class="fas fa-plane"></i>
                    {{ $article->category->name }}
                </a>
            </div>

            <div class="col-6 text-end">
                <u>{{ $article->updated_at->format('Y-m-d') }}</u>
            </div>
        </div>

        <!-- Article title and description -->
        <a href="{{ route('article', ['slug' => Str::slug($article->title), 'id' => $article->id]) }}"
           class="text-dark">
            <h5>{{ $article->title }}</h5>
            <p>
                {!! $article->preview !!}
            </p>
        </a>

        <div class="col-12 text-end">
            <span>{{ $article->user->name }}</span>
        </div>
    </div>
    <!-- News block -->
</div>
