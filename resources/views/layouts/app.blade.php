<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Купить женское нижнее белье в магазине SilkandLace в Москве — Каталог с выгодными ценами на женское белье от магазина "Шелк и Кружево"')</title>
    <!-- Scripts -->


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" rel="stylesheet" >
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="page">
    <div  id="app">
        <div class="container-fluid info" onclick="window.location='/actions/besplatnaya-dostavka-po-vsey-rossii.html/';">
            <div class="container container-my">
                <i class="icon icon--delivery info__icon"></i>
                <span class="info__text"><b>Бесплатная доставка</b> по всей России</span>
                <a class="link link--inherit info__link" href="/actions/besplatnaya-dostavka-po-vsey-rossii.html/">Подробнее</a>
            </div>
        </div>
        <div class="container container-my">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto h_menu">
                        @foreach(Menu::getByName('Шапка') as $menu_h)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menu_h['link'] }}" title="">{{ $menu_h['label'] }}</a>
                            </li>
                        @endforeach


                    </ul>
                    <form class="form-inline my-2 my-lg-0 ">
                        <input class="form-control mr-sm-2 bg-dark" type="search" placeholder="Найти" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0 bg-dark" type="submit">Поиск</button>
                    </form>
                </div>
            </nav>
            <div class="row ">
                <div class="col-lg-4 col-md-6 order-xs-2 order-sm-2 order-md-2 order-lg-1 order-2">
                    <div class="header__contacts">
                        <div class="tel">
                            ﻿<a class="link link--text" href="tel:+78001008766">+7 (800) 100-87-66</a><div class="number__desc">Бесплатно по всей России</div><br>
                            <a class="link link--text" href="tel:+74951338608">+7 (495) 133-86-08</a><div class="number__desc">Для Москвы</div>
                            <a class="tg_link" href="tg://resolve?domain=silkandlacebot" target="_blank"><span class="tg_span"><img src="/img/telegram.png" class="loading" data-was-processed="true">@<span>silkandlacebot</span></span></a>
                        </div>
                        <div class="header__working">
                            Работаем круглосуточно, заявки обрабатываем пн-пт
                        </div>
                    </div>
                </div>

                <div class="order-1 order-sm-1 order-md-1 order-lg-2 order-xl-2 col-lg-4 col-md-12 col-sm-12 justify-content-md-center text-center">
                    <a class="logo header__logo " href="/">
                        <img class="img logo__img loading" src="/img/logo.png" alt="SilkandLace" srcset="/img/logo@2x.png 2x" data-was-processed="true">                        <div class="logo__slogan">Нижнее белье и одежда для дома</div>
                    </a>
                </div>

                <div class="order-3 col-lg-4 col-md-6 order-sm-3 order-md-3">
                    <div class="header__sign text-right">
                        <i class="icon icon--profile link__icon"></i>
                        <ul class="header__sign__items">
                            <li class="header__sign__item">
                                <a class="link link--text" data-toggle="modal" data-target="#sign">Войти</a>
                            </li>
                            <li class="header__sign__item">
                                <a class="link link--text" data-toggle="modal" data-target="#registration">Зарегистрироваться</a>
                            </li>
                        </ul>
                    </div>
                    <noindex>
                        <div  class="header__cart float-right">
                            <a class="link link--text" href="/cart/">
                                <i class="icon icon--cart link__icon"></i><span>Корзина @{{itemCount}}</span>
                            </a>
                            <ul class="list header__cart-info dn">
                                <li class="list__item"><b class="ajb_count">0</b><span>@{{itemCount}} товар(ов)</span></li>
                                <li class="list__item"><b class="ajb_sum">0</b><span> руб.</span></li>
                            </ul>
                        </div>
                    </noindex>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark">
            <nav  class="navbar navbar-expand-lg navbar-dark bg-dark ">
                <div class="container container-my">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu1" aria-controls="menu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="menu1" class="collapse navbar-collapse" >
                        <ul class="navbar-nav mr-auto menu__items">
                            @foreach(Menu::getByName('Главное') as $menu)
                                <li class="nav-item menu__item @if( $menu['child'] ) dropdown @endif">
                                    <a href="{{ $menu['link'] }}" class="nav-link @if( $menu['child'] )dropdown-toggle @endif"  @if( $menu['child'] )data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>{{ $menu['label'] }}</a>
                                    @if( $menu['child'] )
                                        <ul class="dropdown-menu menu__content" aria-labelledby="navbarDropdownMenuLink">
                                                    @foreach( $menu['child'] as $child )
                                                        <li class="menu__sub-item">
                                                            <a href="{{ $child['link'] }}" class="text-left dropdown-item menu__sub-link">{{ $child['label'] }}</a>
                                                        </li>
                                                    @endforeach

                                        </ul><!-- /.sub-menu -->
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </nav>
        </div>







        @yield('content')


        <!-- Footer -->
        <footer class="footer">
            <div class="container container-footer">
                <div class="row">

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6 list__item">
                                <div class="list__head">
                                    <p><a class="link link--text" href="/pokupka/">Покупателям</a></p>
                                </div>
                                <p><a class="link link--text" href="/delivery/">Доставка и оплата</a></p>
                                <p><a class="link link--text" href="/kakzakazat/">Как сделать заказ</a></p>
                                <p><a class="link link--text" href="/kak-poluchit-promokod/">Как получить промокод</a></p>
                                <p><a class="link link--text" href="/programma-loyalnosti/">Программа лояльности</a></p>
                                <p><a class="link link--text" href="/primerka/">Примерка</a></p>
                                <p><a class="link link--text" href="/return">Возврат и обмен товара</a></p>
                            </div>
                            <div class="col-md-6 ">
                                <div class="list__head">
                                    <p><a class="link link--text" href="/catalog/">Каталог</a></p>
                                </div>
                                <p><a class="link link--text" href="/brands/">Бренды</a></p>
                                <p><a class="link link--text" href="/sizes/">Таблица размеров</a></p>
                                <p><a class="link link--text" href="/catalog/zhenskoe-bele/byustgaltery/">Бюстгальтеры</a></p>
                                <p><a class="link link--text" href="/catalog/zhenskoe-bele/trusiki/">Трусы</a></p>
                                <p><a class="link link--text" href="/catalog/zhenskoe-bele/kupalniki/">Купальники</a></p>
                                <p><a class="link link--text" href="/catalog/zhenskoe-bele/komplekty-belya/">Комплекты</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="logo footer__logo">
                            <img class="img logo__img loading" src="/img/logo_footer.png" alt="SilkandLace" srcset="/local/templates/silkandlace_new/static/logo/logo_footer@2x.png 2x" data-was-processed="true">                    <div class="logo__slogan">Нижнее белье и одежда для дома</div>
                        </div>
                        <div class="footer__copyright">
                            <b>SilkandLace.ru</b>  ИНН: 665204863619<br> ОГРН: 319665800239370                </div>
                    </div>


                    <div class="col-md-4 text-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list__head">
                                    <p><a class="link link--text" href="/about/">О Компании</a></p>
                                </div>
                                <p><a class="link link--text" href="/about/">О нас</a></p>
                                <p><a class="link link--text" href="/contacts/">Контакты</a></p>
                                <p><a class="link link--text" href="/news/">Новости</a></p>
                                <p><a class="link link--text" href="/search/map/">Карта сайта</a></p>
                                <p><a class="link link--text" href="https://yandex.ru/maps/-/CBqhqRu93D" target="_blank">Отзывы о нас</a></p>
                                <p><a class="link link--text" href="/wholesale/">Оптовым покупателям</a></p>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <p><a class="link  list__head link--text" href="/contacts/">Контакты</a></p>

                                    <p><a class="link link--text" href="tel:+78001008766">+7 (800) 100-87-66</a></p><p><a class="link link--text" href="tel:+74951338608">+7 (495) 133-86-08</a></p>
                                    <p><a class="link link--text" href="mailto:info@silkandlace.ru">info@silkandlace.ru</a></p>
                                    <div class="social social--light">
                                        <noindex>
                                            <a class="link social__link" href="https://vk.com/" target="_blank">
                                                <svg class="icon social__icon" viewBox="0 0 16 16"><path d="M15.8 12c.2.3.2 1-.3 1H13c-.7 0-1.3-.7-1.3-.7l-1.3-1.5c-.2-.2-.6-.2-.8.2-.2.3-.2 1.3-.2 1.3 0 .7-.4.7-.8.7-1 0-2.5 0-3.4-.7-.7-.6-2-2.5-3.8-5.7C.4 5 0 4 0 3.6c0 0 0-.2.4-.2h2.4c.3 0 .5.2.7.6L5 7l.5.7c.2.2.5.3.6 0 0 0 .4-1.7.2-3.2 0-.5-.2-.8-.7-.8-.3 0 0-.7.5-.7h2.8c.3 0 .5.2.5.8V7c0 .2 0 .6.4.8.3.3.5.2.7 0l1.8-4c.2-.4.3-.4.6-.4h2.8c.4 0 .4.3.4.6s-.3 1-1 2l-1.3 2c-.4.6-.4.8 0 1.3l2 2.7z"></path>
                                                </svg>
                                            </a>
                                            <a class="link social__link" href="https://ok.ru/" target="_blank">
                                                <svg class="icon social__icon" viewBox="0 0 16 16"><g fill-rule="evenodd"><path d="M3.7 10s-.2 0-.3-.2c-.5-.5-.5-1-.2-1.4C3.5 8 4 8 4.5 8c0 .2.2.2.3.3 2 1.2 4.4 1.3 6.3 0 .3 0 .5-.2.7-.3.5 0 1 0 1 .5.4.4.4.8 0 1-.5.7-1 1-1.8 1.3L9 11l3 3.3c.3.3.3.7.2 1-.2.5-.7.7-1 .7-.4 0-.6-.2-.8-.3L8 13l-2.5 2.7c-.3.3-.7.4-1 .2-.5-.3-.7-.7-.7-1 0-.4 0-.6.3-.8L7 11c-1.5 0-2.6-.5-3.3-1z"></path><path d="M8 8c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zm0-2c1 0 2-1 2-2S9 2 8 2 6 3 6 4s1 2 2 2z"></path></g>
                                                </svg>
                                            </a>
                                            <a class="link social__link" href="https://www.facebook.com/" target="_blank">
                                                <svg class="icon social__icon" viewBox="0 0 16 16"><path d="M12 0h-2C7.5 0 6 1.5 6 4v2H4v3h2v7h3V9h3V6H9V4c0-.5 0-1 1-1h2V0z"></path>
                                                </svg>
                                            </a>
                                            <a class="link social__link" href="https://plus.google.com/" target="_blank">
                                                <svg class="icon social__icon" viewBox="0 0 16 16"><path d="M10 0H6c-1.7 0-2.8.4-4 1.2C1.6 2 1 3 1 4c0 1.6 1.2 3.3 3.4 3.3H5v.8c0 .7 0 1 .4 1.5-1 0-2.6.2-3.8 1C0 11.5 0 12.5 0 13c0 1.5 1.4 3 4.4 3 3.5 0 5.4-2 5.4-4 0-1.4-1-2-1.8-3l-.7-.5c-.2-.2-.5-.4-.5-.8 0-.5.3-.8.5-1C8 6 9 5.2 9 3.6S8 1.2 7.7 1H9V.7l1-.6V0zM5.3 15c-2.2 0-3.6-1-3.6-2.4 0-1 .6-1.7 1.7-2.2 1-.3 2.2-.3 2.2-.3h.5c1.5 1.2 2.2 1.8 2.2 3 0 1.3-1.2 2-3 2zm0-8.3C3.6 6.7 2.8 4.3 2.8 3c0-.6.2-1 .5-1.5.3-.4 1-.7 1.4-.7C6.3.8 7.3 3 7.3 4.6c0 .3 0 1-.5 1.6-.4.3-1 .5-1.4.5zM16 7h-2V5h-1v2h-2v1h2v2h1V8h2"></path>
                                                </svg>
                                            </a>
                                            <a class="link social__link" href="https://www.instagram.com/silkandlace.ru/" target="_blank">
                                                <svg class="icon social__icon" viewBox="0 0 16 16"><g transform="matrix(0.0893157 0 0 0.0893157 1.43835 1.30759)"><g>
                                                            <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752   c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407   c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752   c17.455,0,31.656,14.201,31.656,31.655V122.407z" data-original="#000000" class="active-path" style="fill:#FFFFFF" data-old_color="#FCFCFC"></path>
                                                            <path d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561   C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561   c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z" data-original="#000000" class="active-path" style="fill:#FFFFFF" data-old_color="#FCFCFC"></path>
                                                            <path d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78   c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78   C135.661,29.421,132.821,28.251,129.921,28.251z" data-original="#000000" class="active-path" style="fill:#FFFFFF" data-old_color="#FCFCFC"></path>
                                                        </g></g></svg>
                                            </a>
                                        </noindex>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>



    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

        <script src="/js/jquery-3.4.1.slim.min.js"  type="text/javascript" ></script>
        <script src="/js/bootstrap.bundle.min.js"  type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js" type="text/javascript"></script>

        <script  type="text/javascript">
                $(document).ready(function(){
                    $('.customer-logos').slick({
                        slidesToShow: 6,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 15000,
                        arrows: false,
                        dots: false,
                        pauseOnHover: false,
                        responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4
                            }
                        }, {
                            breakpoint: 520,
                            settings: {
                                slidesToShow: 3
                            }
                        }]
                    });
                });
            $(document).ready(function() {
                $('.as').slick({
                    dots: true,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 20000,
                    pauseOnFocus: false,
                    pauseOnHover: false,
                    pauseOnDotsHover: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 700,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
                $('.asa').slick({
                    dots: true,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 30000,
                    pauseOnFocus: false,
                    pauseOnHover: false,
                    pauseOnDotsHover: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    cssEase: 'linear'
                });
                $('.proda').slick({
                    dots: true,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 20000,
                    pauseOnFocus: false,
                    pauseOnHover: false,
                    pauseOnDotsHover: false,
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    responsive: [
                        {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 700,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        /*Стрелка вверх*/
        // ===== Scroll to Top ====
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200);    // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200);   // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });
        /*Стрелка вверх*/

        @if(preg_match('!html!', $_SERVER['REQUEST_URI']))
            window.onload = function(){
            var elem = document.querySelectorAll('[name="color"]'), i = elem.length;
            var color;
            while(i--){
                elem[i].onclick = function(i){
                    return function(){
                        //  let someTextiles = attr_all.filter(item => item.attr_all_color == this.value);
                        color= this.value;
                        // console.log(color+"-color");                 //цвет
                        document.getElementById('attr-name').innerHTML = this.title;
                        var x = document.getElementsByName("size");
                        var a;
                        for (a = 0; a < x.length; a++) {
                            var tablesize= x[a].value;
                            //  console.log(tablesize+"-size");         //розмер
                            var tempLsize = document.getElementById('lSize'+tablesize);
                            var tempsize = document.getElementById('size'+tablesize);
                            tempLsize.classList.add("disabled_size");
                            tempsize.disabled = true;
                            tempsize.checked = false;
                            var b;
                            for (b = 0; b < attr_all.length; b++) {
                                if (attr_all[b].size_id == tablesize && attr_all[b].color_id == color) {
                                    tempLsize.classList.remove("disabled_size");
                                    tempsize.disabled = false;
                                }
                            }
                        }
                    };

                }(i);
            }
            var elemSize = document.querySelectorAll('[name="size"]'), c = elemSize.length;
            while(c--){
                elemSize[c].onclick = function(c){
                    return function(){
                        var sizes= this.value;
                        var d;
                        for (d = 0; d < attr_all.length; d++) {
                            if (attr_all[d].size_id == sizes && attr_all[d].color_id == color) {
                                console.log(attr_all[d].id);
                                document.getElementById('checked_attr').value=attr_all[d].id;
                                Vue.set(app.item, 'checked_attr', attr_all[d].id);
                                console.log(attr_all[d].id);
                            }
                        }
                    };
                }(c);
            }
        };
        @endif

        $('.dropdown-toggle').click(function(e) {
            if ($(document).width() > 768) {
                e.preventDefault();
                var url = $(this).attr('href');
                if (url !== '#') {
                    window.location.href = url;
                }
            }
        });


    </script>

    @include('layouts.footerCart')
    </div>
</body>



</html>
