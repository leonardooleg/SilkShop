@extends('layouts\app')

@section('content')
<!--Слайдер-->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/image/9771185888e167bdd3f64aa73e5700ad.png" class="d-block w-100" alt="...">
        </div>

    </div>
</div>
<!--*Слайдер-->

<div class="container container-my">
    <div class="intro">
        <div class="row intro__buttons  text-center">
            <a class="col-md-4 btn  intro__button" href="/catalog/zhenskoe-bele/byustgaltery" role="button"> <i class="icon icon--bra button__icon"></i>
                <span class="button__text">Бюстгальтеры</span>
            </a>
            <a class="col-md-4 btn  intro__button" href="/catalog/zhenskoe-bele/trusiki" role="button"> <i class="icon icon--panties  button__icon"></i>
                <span class="button__text">Трусики</span>
            </a>
            <a class="col-md-4 btn  intro__button" href="/catalog/zhenskoe-bele/komplekty-belya" role="button"> <i class="icon icon--swimsuits button__icon"></i>
                <span class="button__text">Комплекты</span>
            </a>

        </div>
    </div>


    <!-- Brands -->
    <section class="section slider-brands">
        <div class="page__layout">
            <h1 class="title title--up title--center title--lemon title--size-xl section__title text-center">Бренды</h1>
            <div class="customer-logos slider">
                @if (isset($brands))
                    @foreach ($brands as $brand)
                        <div class="slide"><a href="#"> <img src="/storage/{{$brand->logo_brand}}"></a></div>
                    @endforeach
                @endif

            </div>

            <div class="section__action text-center">
                <a class="link link--inherit" href="/brands/">Посмотреть все бренды</a>
            </div>
        </div>
    </section>


    <!-- Promotions -->
    <div class="section">
        <div class="page__layout">
            <h1 class="title title--up title--center title--lemon title--size-xl section__title  text-center">Действующие акции</h1>

            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://silkandlace.ru/upload/iblock/d98/d98759726c459ecaebbe3097644cde41.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <a class="btn btn-dark promotion__more" href="/actions/free_order_for_blogers.html" role="button"><span class="">Подробнее</span></a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://silkandlace.ru/upload/iblock/c87/c878268b2cce63d575875c95cd3c881e.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <a class="btn btn-dark promotion__more" href="/actions/free_order_for_blogers.html" role="button"><span class="">Подробнее</span></a>
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>

    <!-- Latest -->

    <div class="section">
        <div class="page__layout">
            <h1 class="title title&#45;&#45;up title&#45;&#45;center title&#45;&#45;lemon title&#45;&#45;size-xl section__title  text-center"><a style="text-decoration: none; color: #000;" href="/novelty/">Новинки</a></h1>
            <div class="slider slider-1 ">

                <div class="container">
                    <div class="row as">
                        @if (isset($products))
                            @foreach ($products as $product)
                                <div class="col-lg-9 col-sm-6">
                                    <div class="strat">
                                        <a href="/catalog/{{$product->path}}/{{$product->slug}}.html">
                                            <div class="image">
                                                <img class="img latest__img loading" src="@foreach(explode(';', $product->media) as $media){{$media}}@break @endforeach" alt=""  data-was-processed="true">
                                            </div>
                                        </a>
                                        <div class="text text-center">
                                            <div class="latest__cost">{{$product->price}} руб</div>
                                            <div class="latest__cost latest__cost2">
                                                <div class="card__type" style="margin-top: 0">{{$product->category_name}}</div>
                                                <a href="/catalog/{{$product->path}}/{{$product->slug}}.html" style="text-decoration: none; color: #000;" tabindex="0">
                                                {{$product->name_brand}}<!--                                <br>-->
                                                    <!--                                <span style="font-size: 1.5rem">--><!--</span>-->
                                                </a>
                                            </div>
                                            <a href="/catalog/{{$product->path}}/{{$product->slug}}.html" class="btn  btn__slider3"  role="button"><span class="btn__slider3_text">Подробнее</span></a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>
    </div>

    <!-- Latest 2-->
    <div class="section">
        <div class="page__layout">
            <h1 class="title title&#45;&#45;up title&#45;&#45;center title&#45;&#45;lemon title&#45;&#45;size-xl section__title  text-center">
                <a style="text-decoration: none; color: #000;" href="/blog">Блог</a>
            </h1>
            <div class="slider slider-1 slider_4">

                <div class="container">
                    <div class="row as">
                        @if (isset($blogs))
                            @foreach ($blogs as $blog)
                                <div class="col-lg-9 col-sm-6">
                                    <div class="strat ">
                                        <div class="image ">
                                            <img class="img  latest__img loading" src="/storage/{{$blog->img}}" alt=""  data-was-processed="true">
                                        </div>
                                        <div class="text text-center">
                                            <div class="latest__cost latest__cost2">

                                                <a href="/catalog/zhenskoe-bele/byustgaltery/dtbv86238.html" style="text-decoration: none; color: #000;" tabindex="0">
                                                    {{$blog->title}}
                                                </a>
                                                <div class="card__type" style="margin-top: 0">{{ Illuminate\Support\Str::limit(strip_tags($blog->text), 100) }}</div>
                                            </div>
                                            <a href="/actions/free_order_for_blogers.html" class="btn  btn__slider3"  role="button"><span class="btn__slider3_text">Подробнее</span></a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <a class="carousel-control-prev slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>
    </div>



    <div class="section">
        <div class="page__layout grid">
            <div class="row">
                <div class="col-md-6 grid__col--xs-12">
                    <div class="text text--light">
                        <p>
                            Женское белье будоражит умы не только женщин, но и мужчин. И если раньше это были ночные сорочки, нижние рубашки и юбки, то сегодня это – трусики и бюстгальтеры.
                        </p> <br>
                        <h2>Лучшее нижнее белье в магазине «Шелк и кружево»</h2>
                        <p>
                            Интернет магазин недорогого нижнего белья «Шелк и кружево» пестрит широким разнообразием моделей на любой вкус. В наличии белье от лучших российских, белорусских, итальянских производителей. У нас можно заказать:
                        </p>
                        <p>
                        </p>
                        <ul>
                            <li>лаконичные модели для повседневной носки;</li>
                            <li>кружевные комплекты для особых случаев;</li>
                            <li>эротическое белье;</li>
                            <li>боди, купальники, корректирующее белье и т. д.</li>
                        </ul>
                        <p>
                        </p>
                        <p>
                            Вся продукция изготовлена из качественного материала, приятно прилегающего к телу и не вызывающего дискомфорта.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 grid__col--xs-12">
                    <div class="text text--light">
                        <h3>Преимущества покупки белья в магазине «Шелк и кружево»</h3>
                        <p>
                            Ознакомившись с представленной продукцией, вы непременно захотите совершить покупку в нашем магазине. Преимущества сотрудничества с нами:
                        </p>
                        <ul>
                            <li>постоянное обновление ассортимента;</li>
                            <li>доступные цены без накруток;</li>
                            <li>хорошие скидки, подарки за заказ, акции.</li>
                        </ul>
                        <p>
                        </p>
                        <p>
                            Мы на рынке 4 года, но за это время успели завоевать любовь представительниц прекрасного пола.
                        </p>
                        <h3>Что мы предлагаем</h3>
                        <p>
                            На сайте вы найдете отличные <a href="https://silkandlace.ru/catalog/zhenskoe-bele/odezhda-dlya-doma/">пижамы</a>, <a href="https://silkandlace.ru/catalog/zhenskoe-bele/trusiki/">трусики</a>, <a href="https://silkandlace.ru/catalog/zhenskoe-bele/byustgaltery/">бюстгальтеры</a>, <a href="https://silkandlace.ru/catalog/zhenskoe-bele/kupalniki/">купальники</a>, <a href="https://silkandlace.ru/catalog/zhenskoe-bele/komplekty-belya/">комплекты</a> и т. д. Кроме того, здесь отличный выбор корректирующего и термобелья, боди, одежды для дома.
                        </p>
                        <p>
                            Нижнее белье на сайте интернет магазин Шелк и кружево в Москве представлено в нескольких размерах и цветовой гамме. Если не нашли модель по своим параметрам, сообщите об этом, и мы обязательно найдем для вас подходящий вариант.
                        </p>
                        <h3>Доставка товара и оплата</h3>
                        <p>
                            Купить нижнее белье на сайте довольно легко: позвоните по телефону, оформите заказ онлайн или закажите обратный звонок. Менеджеры проконсультируют вас по ассортименту и помогут подобрать нужный размер.
                        </p>
                        <p>
                            Доставка по регионам России осуществляется курьерскими службами. Также забрать товар можно в специальных постаматах, пунктах самовывоза. Заплатить за продукцию можно двумя способами – банковской картой, наличными средствами.
                        </p>
                        <p>
                            Официальный сайт интернет магазина нижнего белья Шелк и кружево – доверьте нам свою красоту!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
