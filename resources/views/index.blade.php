@extends('layouts.frontend')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <article class="hentry post post-standard has-post-thumbnail sticky">

                    <div class="post-thumb">
                        <img src="{{ asset($post_one->featured) }}" alt="{{ $post_one->title }}">
                        <div class="overlay"></div>
                        <a href="{{ asset($post_one->featured) }}" class="link-image js-zoom-image">
                            <i class="seoicon-zoom"></i>
                        </a>
                        <a href="#" class="link-post">
                            <i class="seoicon-link-bold"></i>
                        </a>
                    </div>

                    <div class="post__content">

                        <div class="post__content-info">

                                <h2 class="post__title entry-title ">
                                    <a href="{{ route('posts.single' , ['slug' => $post_one->slug]) }}">{{ $post_one->title }}</a>
                                </h2>

                                <div class="post-additional-info">

                                    <span class="post__date">

                                        <i class="seoicon-clock"></i>

                                        <time class="published" datetime="2016-04-17 12:00:00">
                                            {{ $post_one->created_at->toFormattedDateString() }}
                                        </time>

                                    </span>

                                    <span class="category">
                                        <i class="seoicon-tags"></i>
                                        <a href="{{ route('categories.single' , ['id' => $post_one->category->id ]) }}">{{ $post_one->category->name }}</a>
                                    </span>

                                    <span class="post__comments">
                                        <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                        6
                                    </span>

                                </div>
                        </div>
                    </div>

            </article>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <article class="hentry post post-standard has-post-thumbnail sticky">

                    <div class="post-thumb">
                        <img src="{{ asset($post_two->featured) }}" alt="seo">
                        <div class="overlay"></div>
                        <a href="{{ $post_two->featured }}" class="link-image js-zoom-image">
                            <i class="seoicon-zoom"></i>
                        </a>
                        <a href="#" class="link-post">
                            <i class="seoicon-link-bold"></i>
                        </a>
                    </div>

                    <div class="post__content">

                        <div class="post__content-info">

                                <h2 class="post__title entry-title ">
                                    <a href="{{ route('posts.single' , ['slug' => $post_two->slug]) }}">{{ $post_two->title }}</a>
                                </h2>

                                <div class="post-additional-info">

                                    <span class="post__date">

                                        <i class="seoicon-clock"></i>

                                        <time class="published" datetime="2016-04-17 12:00:00">
                                                {{ $post_two->created_at->toFormattedDateString() }}
                                        </time>

                                    </span>

                                    <span class="category">
                                        <i class="seoicon-tags"></i>
                                        <a href="{{ route('categories.single' , ['id' => $post_two->category->id ]) }}">{{ $post_two->category->name }}</a>
                                    </span>

                                    <span class="post__comments">
                                        <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                        6
                                    </span>

                                </div>
                        </div>
                    </div>

            </article>
        </div>
        <div class="col-lg-6">
            <article class="hentry post post-standard has-post-thumbnail sticky">

                    <div class="post-thumb">
                        <img src="{{ asset($post_three->featured) }}" alt="seo">
                        <div class="overlay"></div>
                        <a href="{{ asset($post_three->featured) }}" class="link-image js-zoom-image">
                            <i class="seoicon-zoom"></i>
                        </a>
                        <a href="#" class="link-post">
                            <i class="seoicon-link-bold"></i>
                        </a>
                    </div>

                    <div class="post__content">

                        <div class="post__content-info">

                                <h2 class="post__title entry-title ">
                                    <a href="{{ route('posts.single' , ['slug' => $post_three->slug]) }}">{{ $post_three->title }}</a>
                                </h2>

                                <div class="post-additional-info">

                                    <span class="post__date">

                                        <i class="seoicon-clock"></i>

                                        <time class="published" datetime="2016-04-17 12:00:00">
                                                {{ $post_three->created_at->toFormattedDateString() }}
                                        </time>

                                    </span>

                                    <span class="category">
                                        <i class="seoicon-tags"></i>
                                        <a href="{{ route('categories.single' , ['id' => $post_three->category->id ]) }}">{{ $post_three->category->name }}</a>
                                    </span>

                                    <span class="post__comments">
                                        <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                        6
                                    </span>

                                </div>
                        </div>
                    </div>

            </article>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row medium-padding120 bg-border-color">
        <div class="container">
            <div class="col-lg-12">

            @foreach($categories as $category)
            @if($category->posts()->count() > 0)
            <div class="offers">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                            <div class="heading">
                                <h4 class="h1 heading-title">{{ $category->name }}</h4>
                                <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="case-item-wrap">
                            @foreach($category->posts()->orderBy('created_at' , 'desc')->take(3)->get() as $post)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="case-item">
                                    <div class="case-item__thumb">
                                        <img src="{{ asset($post->featured) }}" alt="our case">
                                    </div>
                                    <h6 class="case-item__title">
                                        <a href="{{ route('posts.single' , ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h6>
                                </div>
                            </div>
    
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="padded-50"></div>
            @endif
            
            @endforeach
        </div>
        </div>
    </div>
</div>

@endsection