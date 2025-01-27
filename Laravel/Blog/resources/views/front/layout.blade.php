<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ isset($post) && $post->seo_title ? $post->seo_title :  config('app.name') }}</title>
    <meta name="description" content="{{ isset($post) && $post->meta_description ? $post->meta_description : __(config('app.description')) }}">
    <meta name="author" content="{{ isset($post) ? $post->user->name : __(config('app.author')) }}">
    @if(isset($post) && $post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->

    <link rel="stylesheet" href="{{ asset('storage/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/styles.css') }}">
    @yield('style')

    <!-- script
    ================================================== -->
    <script src="{{ asset('storage/js/modernizr.js') }}"></script>
    <script defer src="{{ asset('storage/js/fontawesome/all.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
    	<div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header @unless(currentRoute('home')) s-header--opaque @endunless">

        <div class="s-header__logo">
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Homepage">
            </a>
        </div>

        <div class="row s-header__navigation">

            <nav class="s-header__nav-wrap">

                <h3 class="s-header__nav-heading h6">@lang('Navigate to')</h3>

                <ul class="s-header__nav">
                    <li {{ currentRoute('home') }}>
                        <a href="{{ route('home') }}" title="">@lang('Home')</a>
                    </li>
                    <li class="has-children">
                        <a href="#" title="">@lang('Categories')</a>
                        <ul class="sub-menu">
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li {{ currentRoute('contacts.create') }}>
                        <a href="{{ route('contacts.create') }}" title="">@lang('Contact')</a>
                    </li>
                    @guest
                        @request('register')
                        <li class="current">
                            <a href="{{ request()->url() }}">@lang('Register')</a>
                        </li>
                        @endrequest
                        <li {{ currentRoute('login') }}>
                            <a href="{{ route('login') }}">@lang('Login')</a>
                        </li>
                        @request('forgot-password')
                        <li class="current">
                            <a href="{{ request()->url() }}">@lang('Password')</a>
                        </li>
                        @endrequest
                        @request('reset-password/*')
                        <li class="current">
                            <a href="{{ request()->url() }}">@lang('Password')</a>
                        </li>
                        @endrequest
                    @else
                        @if(auth()->user()->role != 'user')
                            <li>
                                <a href="{{ url('admin') }}">@lang('Administration')</a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" hidden>
                                @csrf
                            </form>
                            <a
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.previousElementSibling.submit();">
                                @lang('Logout')
                            </a>
                        </li>
                    @endguest
                </ul>

                <a href="#0" title="@lang('Close Menu')" class="s-header__overlay-close close-mobile-menu">@lang('Close')</a>

            </nav>

        </div>

        <a class="s-header__toggle-menu" href="#0" title="@lang('Menu')"><span>@lang('Menu')</span></a>

        <div class="s-header__search">

            <div class="s-header__search-inner">
                <div class="row wide">

                    <form role="search" method="get" class="s-header__search-form" action="{{ Route('posts.search') }}">
                        <label>
                            <span class="h-screen-reader-text">@lang('Search for:')</span>
                            <input id="search" type="search" name="search" class="s-header__search-field" placeholder="@lang('Search for...')" title="@lang('Search for:')" autocomplete="off">
                        </label>
                        <input type="submit" class="s-header__search-submit" value="Search">
                    </form>

                    <a href="#0" title="@lang('Close Search')" class="s-header__overlay-close">@lang('Close')</a>

                </div>
            </div>

        </div>

        <a class="s-header__search-trigger" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.982 17.983"><path fill="#010101" d="M12.622 13.611l-.209.163A7.607 7.607 0 017.7 15.399C3.454 15.399 0 11.945 0 7.7 0 3.454 3.454 0 7.7 0c4.245 0 7.699 3.454 7.699 7.7a7.613 7.613 0 01-1.626 4.714l-.163.209 4.372 4.371-.989.989-4.371-4.372zM7.7 1.399a6.307 6.307 0 00-6.3 6.3A6.307 6.307 0 007.7 14c3.473 0 6.3-2.827 6.3-6.3a6.308 6.308 0 00-6.3-6.301z"/></svg>
        </a>

    </header>

    <!-- hero
    ================================================== -->
    @yield('hero')

    <!-- content
    ================================================== -->
    <section class="s-content @if(currentRoute('home')) s-content--no-top-padding @endif">


        @yield('main')

        <!-- masonry
        ================================================== -->
{{--        <div class="s-bricks">--}}

{{--            <div class="masonry">--}}
{{--                <div class="bricks-wrapper h-group">--}}

{{--                    <div class="grid-sizer"></div>--}}

{{--                    <div class="lines">--}}
{{--                        <span></span>--}}
{{--                        <span></span>--}}
{{--                        <span></span>--}}
{{--                    </div>--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/macbook-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/macbook-600.jpg 1x, images/thumbs/masonry/macbook-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="https://www.dreamhost.com/r.cgi?287326">Need Web Hosting for Your Websites?</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="https://www.dreamhost.com/r.cgi?287326">StyleShout</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="https://www.dreamhost.com/r.cgi?287326">Site Partner</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Need hosting? We would highly recommend DreamHost.--}}
{{--                                Enjoy 100% in-house support, guaranteed performance and uptime, 1-click installs, and a super-intuitive control panel to make managing your websites and projects easy.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="https://www.dreamhost.com/r.cgi?287326">Learn More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/woodcraft-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/woodcraft-600.jpg 1x, images/thumbs/masonry/woodcraft-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">Just a Normal Simple Blog Post.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Naruto Uzumaki</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Design</a>--}}
{{--                                        <a href="#">Photography</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end entry -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/tulips-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/tulips-600.jpg 1x, images/thumbs/masonry/tulips-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div>  <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">10 Interesting Facts About Caffeine.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Shikamaru Nara</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Health</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/grayscale-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/grayscale-600.jpg 1x, images/thumbs/masonry/grayscale-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">5  Grayscale Coloring Techniques.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Susuke Uchiha</a>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Design</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/walk-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/walk-600.jpg 1x, images/thumbs/masonry/walk-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">Using Repetition and Patterns in Photography.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Naruto Uzumaki</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Work</a>--}}
{{--                                        <a href="#">Lifestyle</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/jump-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/jump-600.jpg 1x, images/thumbs/masonry/jump-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">Create Meaningful Family Moments.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Naruto Uzumaki</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Family</a>--}}
{{--                                        <a href="#">Relationship</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/real-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/real-600.jpg 1x, images/thumbs/masonry/real-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">How We Live Is What Makes Us Real.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Naruto Uzumaki</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Travel</a>--}}
{{--                                        <a href="#">Vacation</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/lamp-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/lamp-600.jpg 1x, images/thumbs/masonry/lamp-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">Symmetry In Modern Design.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Kakakshi Hatake</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Design</a>--}}
{{--                                        <a href="#">Photography</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/clock-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/clock-600.jpg 1x, images/thumbs/masonry/clock-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">10 Tips for Managing Time Effectively.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">John Doe</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Lifestyle</a>--}}
{{--                                        <a href="#">Work</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/beetle-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/beetle-600.jpg 1x, images/thumbs/masonry/beetle-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">Throwback To The Good Old Days.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Sakura Haruno</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Lifestyle</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/phone-and-keyboard-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/phone-and-keyboard-600.jpg 1x, images/thumbs/masonry/phone-and-keyboard-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">3 Reasons to Keep Your Workplace Tidy.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Sakura Haruno</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Work</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                    <article class="brick entry" data-aos="fade-up">--}}

{{--                        <div class="entry__thumb">--}}
{{--                            <a href="single-standard.html" class="thumb-link">--}}
{{--                                <img src="images/thumbs/masonry/seashore-600.jpg"--}}
{{--                                     srcset="images/thumbs/masonry/seashore-600.jpg 1x, images/thumbs/masonry/seashore-1200.jpg 2x" alt="">--}}
{{--                            </a>--}}
{{--                        </div> <!-- end entry__thumb -->--}}

{{--                        <div class="entry__text">--}}
{{--                            <div class="entry__header">--}}
{{--                                <h1 class="entry__title"><a href="single-standard.html">What The Beach Does to Your Brain.</a></h1>--}}

{{--                                <div class="entry__meta">--}}
{{--                                    <span class="byline"">By:--}}
{{--                                        <span class='author'>--}}
{{--                                            <a href="#0">Naruto Uzumaki</a>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                                    <span class="cat-links">--}}
{{--                                        <a href="#">Health</a>--}}
{{--                                        <a href="#">Vacation</a>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="entry__excerpt">--}}
{{--                                <p>--}}
{{--                                Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt mollit id et sit proident dolor nulla sed commodo est ad minim elit reprehenderit nisi officia aute incididunt velit sint in aliqua cillum in consequat consequat in culpa in anim.--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <a class="entry__more-link" href="#0">Read More</a>--}}
{{--                        </div> <!-- end entry__text -->--}}

{{--                    </article> <!-- end article -->--}}

{{--                </div> <!-- end brick-wrapper -->--}}

{{--            </div> <!-- end masonry -->--}}

{{--            <div class="row">--}}
{{--                <div class="column large-12">--}}
{{--                    <nav class="pgn">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <span class="pgn__prev" href="#0">--}}
{{--                                    Prev--}}
{{--                                </span>--}}
{{--                            </li>--}}
{{--                            <li><a class="pgn__num" href="#0">1</a></li>--}}
{{--                            <li><span class="pgn__num current">2</span></li>--}}
{{--                            <li><a class="pgn__num" href="#0">3</a></li>--}}
{{--                            <li><a class="pgn__num" href="#0">4</a></li>--}}
{{--                            <li><a class="pgn__num" href="#0">5</a></li>--}}
{{--                            <li><span class="pgn__num dots">…</span></li>--}}
{{--                            <li><a class="pgn__num" href="#0">8</a></li>--}}
{{--                            <li>--}}
{{--                                <span class="pgn__next" href="#0">--}}
{{--                                    Next--}}
{{--                                </span>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </nav> <!-- end pgn -->--}}
{{--                </div> <!-- end column -->--}}
{{--            </div> <!-- end row -->--}}

        </div> <!-- end s-bricks -->

    </section> <!-- end s-content -->


    <!-- footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">

            <div class="row">

                <div class="column large-6 medium-6 tab-12 s-footer__info">

                    <h5>@lang('About Our Site')</h5>

                    <p>
                        Lorem ipsum Ut velit dolor Ut labore id fugiat in ut
                        fugiat nostrud qui in dolore commodo eu magna Duis
                        cillum dolor officia esse mollit proident Excepteur
                        exercitation nulla. Lorem ipsum In reprehenderit
                        commodo aliqua irure.
                    </p>

                </div>

                <div class="column large-3 medium-3 tab-6 s-footer__site-links">

                    <h5>@lang('Site Links')</h5>

                    <ul>
                        @foreach($pages as $page)
                            <li><a href="{{ route('page', $page->slug) }}">@lang($page->title)</a></li>
                        @endforeach
                    </ul>

                </div>

                <div class="column large-2 medium-3 tab-6 s-footer__social-links">

                    <h5>@lang('Follow Us')</h5>

                    <ul>
                        @foreach($follows as $follow)
                            <li><a href="{{ $follow->href }}">{{ $follow->title }}</a></li>
                        @endforeach
                    </ul>

                </div>

            </div>

        </div>

        <div class="s-footer__bottom">
            <div class="row">
                <div class="column">
                    <div class="ss-copyright">
                        <span>© Copyright Calvin 2020</span>
                        <span>Design by <a href="https://www.styleshout.com/">StyleShout</a></span>
                    </div>
                </div>
            </div>

            <div class="ss-go-top">
                <a class="smoothscroll" title="Back to Top" href="#top">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path></svg>
                </a>
            </div>
        </div>

    </footer>



    <!-- JavaScript
================================================== -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('storage/js/plugins.js') }}"></script>
    <script src="{{ asset('storage/js/main.js') }}"></script>
    @yield('scripts')

</body>

</html>
