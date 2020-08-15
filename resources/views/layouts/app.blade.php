<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Купить женское нижнее белье в магазине SilkandLace в Москве — Каталог с выгодными ценами на женское белье от магазина "Шелк и Кружево"')</title>
    <!-- Scripts -->


    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <!-- Scripts -->

    <!-- Custom styles for this template -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet" >
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" >


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @if(preg_match('!cart!', $_SERVER['REQUEST_URI']))  <link href="{{ asset('css/delivery.css') }}" rel="stylesheet">  @endif

    @if(preg_match('!profile!', $_SERVER['REQUEST_URI']))  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">    @endif
</head>
<body class="page">
    <div class="mt-2">
        @if(isset($nenujno))
            <!--пока не нужно-->
       {{-- <div class="container-fluid info" onclick="window.location='/actions/besplatnaya-dostavka-po-vsey-rossii.html/';">
            <div class="container container-my">
                <i class="icon icon--delivery info__icon"></i>
                <span class="info__text"><b>Бесплатная доставка</b> по всей России</span>
                <a class="link link--inherit info__link" href="/actions/besplatnaya-dostavka-po-vsey-rossii.html/">Подробнее</a>
            </div>
        </div>--}}
        @endif
        <div class="container container-my">
            <nav class="navbar navbar-expand-lg navbar-light d-none d-md-block">
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
                <div class="col-lg-4 col-md-6 order-xs-2 order-sm-2 order-md-2 order-lg-1 order-2 d-none d-md-block">
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
                        <ul class="header__sign__items">
                            @if (Route::has('login'))
                                @auth
                                    <a href="/profile"><i class="fa fa-user"></i> Профиль {{Auth::user()->name ?? 'пользователя'}} </a>
                                    <a   href="{{ route('logout') }}"  aria-haspopup="true" aria-expanded="false" v-pre onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('   ( Выход )') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else

                                    <li class="header__sign__item">
                                        <a href="/login" class="link link--text" >Войти</a>
                                    </li>
                                    <li class="header__sign__item">
                                        <a href="/register" class="link link--text" >Зарегистрироваться</a>
                                    </li>

                                @endauth
                            @endif
                                <div id="search_mob" class="ml-4" onclick="search_line()">
                                    <svg   width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-search ml-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                    </svg> <p class="ml-1">Поиск</p>
                                </div>
                        </ul>

                        <form class="form-inline my-2 my-lg-0  search-line" style="display: none">
                            <input class="form-control mr-sm-2 bg-dark" type="search" placeholder="Найти" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 bg-dark" type="submit">Поиск</button>
                        </form>
                    </div>
                        <div id="cart" class="header__cart float-right d-none d-md-block">
                            <a class="link link--text" href="/cart/">
                                <i class="icon icon--cart link__icon"></i><span>Корзина @{{itemCount}}</span>
                            </a>
                            <ul class="list header__cart-info dn">
                                <li class="list__item"><b class="ajb_count">0</b><span>@{{itemCount}} товар(ов)</span></li>
                                <li class="list__item"><b class="ajb_sum">0</b><span> руб.</span></li>
                            </ul>
                        </div>

                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark">
            <!--Меню для моб-->
            <ul class="nav mob-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/new">Новинки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catalog">Каталог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cart">Корзина</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts">Позвонить </a>
                </li>

            </ul>
            <!--Меню для моб-->
            <nav  class="navbar navbar-expand-sm navbar-dark bg-dark d-none d-md-flex">
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
                <div class="row ">

                    <div class="col-md-4 order-1 order-sm-1 order-md-1 text-center text-md-left">
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
                                <p><a class="link link--text" href="/blog">Блог</a></p>
                                <p><a class="link link--text" href="/brands">Бренды</a></p>
                                <p><a class="link link--text" href="/sales">Распродажа </a></p>
                            </div>
                            <div class="col-md-6 ">




                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 order-3  order-sm-3 order-md-2  text-center">
                        <div class="logo footer__logo">
                            <img class="img logo__img loading" src="/img/logo_footer.png" alt="SilkandLace"  data-was-processed="true">                    <div class="logo__slogan">Нижнее белье и одежда для дома</div>
                        </div>
                        <div class="footer__copyright">
                            <b>SilkandLace.ru</b>  ИНН: 665204863619<br> ОГРН: 319665800239370                </div>
                    </div>


                    <div class="col-md-4 order-2  order-sm-2 order-md-3  text-center text-md-right">
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

                                    <p><a class="link link--text" href="tel:+78001008766">+7 (800) 100-87-66</a></p>
                                    <p><a class="link link--text" href="mailto:info@silkandlace.ru">info@silkandlace.ru</a></p>
                                    <div class="social social--light">







                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
        <script src="https://unpkg.com/vue"></script>
        <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
   {{-- <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="/js/site.js" type="text/javascript"></script>
    <script src="/js/jquery.zoom.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" type="text/javascript"></script>
    <script src="/js/carousel.js" type="text/javascript"></script>





        <script  type="text/javascript">

            @if(preg_match('!html!', $_SERVER['REQUEST_URI']))
                $("body").on("click","#modal-size .data-size", function( event ) {
                        var id = $(this).attr('attr');
                        $("#modal-size .data-size").removeClass("selected");
                         $(this).addClass("selected");
                    $('#size'+id).checked = true;
                    var tempsize = document.getElementById('size'+id);
                    if(tempsize.disabled==false) {
                        tempsize.checked = true;
                    }
                });

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
                                //  console.log(tablesize+"-size");         //размер
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
            function search_line(line) {
                var sea = $( line);
                var li = $( '#search_mob');
                sea.show();
                li.hide();
                $( ".search-line" ).show();
            }
    </script>

    @include('layouts.footerCart')

</body>



</html>
