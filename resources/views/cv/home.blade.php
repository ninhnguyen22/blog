@extends('layouts.cv')

@section('content')
    <div class="container-fluid profile-box" style="width: auto;">
        <div class="row">
            <div class="col-md-12 rt-div">
                <div class="rit-cover">
                    <div class="hotkey">
                        <h1 class="">N Blog </h1>
                    </div>
                    @foreach($_data['_main'] as $category)
                        <h2 class="rit-titl">
                            <a href="{{ $_data['_cat_route'] }}{{ $category->slug }}-{{ $category->id }}.html">{{ $category->name }}</a>
                        </h2>
                        @if($category->articles->count() > 0)
                            <div class="education">
                                <ul class="row no-margin">
                                    @foreach($category->articles as $article)
                                        <li class="col-md-2">
                                            <a href="{{ $_data['_article_route'] }}{{ Str::slug($article->title) }}-{{$article->id}}.html">
                                                {{ $article->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($category->categories->count() > 0)
                            @foreach($category->categories as $child)
                                <h2 class="rit-titl">
                                    <a href="{{ $_data['_cat_route'] }}{{ $child->slug }}-{{ $child->id }}.html">>> {{ $child->name }}</a>
                                </h2>
                                @if($child->articles->count() > 0)
                                    <div class="education">
                                        <ul class="row no-margin">
                                            @foreach($child->articles as $article)
                                                <li class="col-md-2">
                                                    <a href="{{$_data['_article_route']}}{{ Str::slug($article->title) }}-{{$article->id}}.html">
                                                        {{ $article->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
