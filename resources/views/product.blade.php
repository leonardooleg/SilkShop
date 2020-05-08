@extends('layouts.app')


@section('title', $product->name)

@section('content')
    <div class="container container-my product-p">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <a class="btn btn-primary" style="margin: 0 20px 0 0; padding: 5px 15px" href="{{ url()->previous() }}" role="button">Назад</a>
                <li class="breadcrumb-item" style="margin: 10px 0"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                @foreach($categories as $i => $category)
                    <li class="breadcrumb-item" style="margin: 10px 0">{{ $category->ancestors->count() ? implode('  ', $category->ancestors->pluck('tile')->toArray()):''  }}
                    <a href="/catalog/{{ $category->path }}" class="link breadcrumbs__link">{{ $category->title }}</a></li>
                @endforeach



            </ol>
        </nav>



        <div  itemscope="" itemtype="http://schema.org/Product" class="row product content__product">
            <div class="col-md-5 product__photo">
                <img id="poster" src="@foreach(explode(';', $product->media) as $media){{$media}}@break @endforeach" class="fotorama__img loading" data-was-processed="true" style="">

                <div class="wrap_product__details">
                    <div class="product__details">
                        <div class="title">Поделиться:</div>
                        <div class="likely">


                            <div class="ya-share2 ya-share2_inited" data-services="vkontakte,facebook,odnoklassniki"><div class="ya-share2__container ya-share2__container_size_m"><ul class="ya-share2__list ya-share2__list_direction_horizontal"><li class="ya-share2__item ya-share2__item_service_vkontakte"><a class="ya-share2__link" href="https://vk.com/share.php?url=https%3A%2F%2Fsilkandlace.ru%2Fcatalog%2Fzhenskoe-bele%2Fchulochno-nosochnye-izdeliya%2Fnoski%2Fdtnszh16s1407249.html&amp;title=%D0%96%D0%B5%D0%BD%D1%81%D0%BA%D0%B8%D0%B5%20%D0%BD%D0%BE%D1%81%D0%BE%D1%87%D0%BA%D0%B8%20Conte%20DT%D0%9D%D1%81%D0%B616%D0%A11407249%20%E2%80%94%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%20%D0%BF%D0%BE%20%D0%BF%D1%80%D0%B8%D0%B2%D0%BB%D0%B5%D0%BA%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%B9%20%D1%86%D0%B5%D0%BD%D0%B5%20%D1%81%20%D0%B2%D1%8B%D0%B3%D0%BE%D0%B4%D0%BD%D0%BE%D0%B9%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%BE%D0%B9%20%D0%BF%D0%BE%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B5%20%D0%B8%20%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8%20%D0%B2%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D0%B5%20Silk%26Lace&amp;utm_source=share2" rel="nofollow noopener" target="_blank" title="ВКонтакте"><span class="ya-share2__badge"><span class="ya-share2__icon"></span><span class="ya-share2__counter"></span></span><span class="ya-share2__title">ВКонтакте</span></a></li><li class="ya-share2__item ya-share2__item_service_facebook"><a class="ya-share2__link" href="https://www.facebook.com/sharer.php?src=sp&amp;u=https%3A%2F%2Fsilkandlace.ru%2Fcatalog%2Fzhenskoe-bele%2Fchulochno-nosochnye-izdeliya%2Fnoski%2Fdtnszh16s1407249.html&amp;title=%D0%96%D0%B5%D0%BD%D1%81%D0%BA%D0%B8%D0%B5%20%D0%BD%D0%BE%D1%81%D0%BE%D1%87%D0%BA%D0%B8%20Conte%20DT%D0%9D%D1%81%D0%B616%D0%A11407249%20%E2%80%94%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%20%D0%BF%D0%BE%20%D0%BF%D1%80%D0%B8%D0%B2%D0%BB%D0%B5%D0%BA%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%B9%20%D1%86%D0%B5%D0%BD%D0%B5%20%D1%81%20%D0%B2%D1%8B%D0%B3%D0%BE%D0%B4%D0%BD%D0%BE%D0%B9%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%BE%D0%B9%20%D0%BF%D0%BE%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B5%20%D0%B8%20%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8%20%D0%B2%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D0%B5%20Silk%26Lace&amp;utm_source=share2" rel="nofollow noopener" target="_blank" title="Facebook"><span class="ya-share2__badge"><span class="ya-share2__icon"></span><span class="ya-share2__counter"></span></span><span class="ya-share2__title">Facebook</span></a></li><li class="ya-share2__item ya-share2__item_service_odnoklassniki"><a class="ya-share2__link" href="https://connect.ok.ru/offer?url=https%3A%2F%2Fsilkandlace.ru%2Fcatalog%2Fzhenskoe-bele%2Fchulochno-nosochnye-izdeliya%2Fnoski%2Fdtnszh16s1407249.html&amp;title=%D0%96%D0%B5%D0%BD%D1%81%D0%BA%D0%B8%D0%B5%20%D0%BD%D0%BE%D1%81%D0%BE%D1%87%D0%BA%D0%B8%20Conte%20DT%D0%9D%D1%81%D0%B616%D0%A11407249%20%E2%80%94%20%D0%BA%D1%83%D0%BF%D0%B8%D1%82%D1%8C%20%D0%BF%D0%BE%20%D0%BF%D1%80%D0%B8%D0%B2%D0%BB%D0%B5%D0%BA%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%B9%20%D1%86%D0%B5%D0%BD%D0%B5%20%D1%81%20%D0%B2%D1%8B%D0%B3%D0%BE%D0%B4%D0%BD%D0%BE%D0%B9%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%BE%D0%B9%20%D0%BF%D0%BE%20%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B5%20%D0%B8%20%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D0%B8%20%D0%B2%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D0%B5%20Silk%26Lace&amp;utm_source=share2" rel="nofollow noopener" target="_blank" title="Одноклассники"><span class="ya-share2__badge"><span class="ya-share2__icon"></span><span class="ya-share2__counter"></span></span><span class="ya-share2__title">Одноклассники</span></a></li></ul></div></div>
                        </div>
                        <div class="product__tel product__gap">
                            <p class="paragraph">Мы всегда рады вам помочь по телефону:</p>
                            <a class="link" href="tel:+74951338608">8 (495)133-86-08</a>
                        </div>
                        <hr class="sep product__sep">
                        <!-- Nav pills -->
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#home">Доставка</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#menu1">Оплата</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                                <ul>
                                    <li>Курьерская доставка по Москве, Санкт-Петербургу и еще 1500 населенных пунктов России;</li>

                                    <li>Пункты выдачи заказов по Москве, Санкт-Петербургу и более 95 городов России;</li>

                                    <li>Доставка по Москве, Московской области и России через постаматы PickPoint;</li>

                                    <li>Доставка почтой по России.</li>
                                </ul>
                            </div>
                            <div class="tab-pane container fade" id="menu1">

                                <div class="row product__items text-center">
                                    <div class="col-md-4 product__item">
                                        <div class="product__circle">
                                            <img class="img loading" src="/img/cash.svg" alt="Наличными курьеру" data-was-processed="true">
                                        </div>
                                        <div class="title">Счёт на e-mail</div>
                                        <div class="product__note">Вам на почту придёт ссылка на оплату. Оплатить можно любым способом.</div>
                                    </div>
                                    <div class="col-md-4 product__item">
                                        <div class="product__circle">
                                            <img class="img loading" src="/img/card.svg" alt="Банковская карта" data-was-processed="true">
                                        </div>
                                        <div class="title">Банковская карта, электронные деньги</div>
                                    </div>
                                    <div class="col-md-4 product__item">
                                        <div class="product__circle">
                                            <img class="img loading" src="/img/list.svg" alt="Предоплата заказа через банк" data-was-processed="true">
                                        </div>
                                        <div class="title">Оплата по реквизитам компании</div>
                                        <div class="product__note ">
                                            (<a class="link link--inherit" target="_blank" href="/local/include/Реквизиты_ИП.pdf">Cкачать
                                                реквизиты для оплаты</a>)
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>
                </div><!-- wrap_product__details -->



            </div>

            <div  class="col-md-7 product__description">

                <h1 class="title title--size-s title--light" itemprop="name">{{$product->name}}</h1>
                <meta itemprop="category" content="{{$product->name}}">
                <meta itemprop="brand" content="{{$product->name_brand}}">


                <div class="product__price text-bold" itemprop="price" content="{{$product->price}}">
                    {{$product->price}} руб.        </div>

                <link itemprop="availability" href="http://schema.org/InStock">
                <!--обертка нового блока-->
                <div class="row flex-wr-pr">
                    <div class="col-md-6 product__fields" idel="2324387">
                        <div class="product__field wrap_color_select">
                            <div class="color j-color-name-container">
                                Цвет:
                                <span id="attr-name" class="color"></span>
                            </div>
                            <div class="product__field wrap_color_select">

                                <div class="btn-group btn-group-toggle btn-color" data-toggle="buttons">
                                    @foreach ($attr_colors as $img_color)
                                        <label class="btn btn-secondary" style="background-image: url({{$img_color->img_color}})" >
                                            <input type="radio"   title="{{$img_color->name_color}}" value="{{$img_color->color_id}}" v-model="item.attributes.color" name="color" id="color{{$img_color->color_id}}" autocomplete="off" >
                                        </label>
                                    @endforeach

                                </div>

                                <div class="product__size">
                                    <i class="icon icon--size"></i>
                                    <a class="link  callbackOrder" data-toggle="modal" href="javascript:void(0)">Нет моего
                                        размера/цвета</a>
                                </div>
                            </div>

                        </div>
                        <div class="product__field wrap_size_select">
                            <div class="i-sizes-block-v1">
                                <div class="j-table-of-sizes table-of-sizes">
                                    <p class="j-sizes-table-show sizes-table-show" data-toggle="modal" data-target="#sizeModal">Таблица размеров</p>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade modal-table-of-size" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="sizeModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Таблица размеров</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="text-center" width="100%" class="text-center">
                                                    <thead>
                                                    <tr class="tr_head">
                                                        <td style="width:16%;">
                                                            <div>Российский размер</div>
                                                        </td>
                                                        <td style="width:16%;">
                                                            <div>Размер производителя</div>
                                                        </td>
                                                        <td style="width:16%;">
                                                            <div>Обхват груди, в см</div>
                                                        </td>
                                                        <td style="width:16%;">
                                                            <div>Обхват талии, в см</div>
                                                        </td>
                                                        <td style="width:16%;">
                                                            <div>Обхват бедер, в см</div>
                                                        </td>
                                                        <td style="width:16%;">
                                                            <div>Рост, см</div>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                <table class="text-center" width="100%">
                                                            <tbody>
                                                            <tr class="data-size j-table-row">
                                                                <td style="width:16%;">
                                                                    <div>42</div>
                                                                </td>
                                                                <td class="j-tech-size" style="width:16%;">
                                                                    <div>XS</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>84</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>62</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>88</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>168</div>
                                                                </td>
                                                            </tr>
                                                            <tr class="data-size j-table-row">
                                                                <td style="width:16%;">
                                                                    <div>44</div>
                                                                </td>
                                                                <td class="j-tech-size" style="width:16%;">
                                                                    <div>S</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>88</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>66</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>92</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>170</div>
                                                                </td>
                                                            </tr>
                                                            <tr class="data-size j-table-row selected">
                                                                <td style="width:16%;">
                                                                    <div>46</div>
                                                                </td>
                                                                <td class="j-tech-size" style="width:16%;">
                                                                    <div>M</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>92</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>70</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>96</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>172</div>
                                                                </td>
                                                            </tr>
                                                            <tr class="data-size j-table-row">
                                                                <td style="width:16%;">
                                                                    <div>48</div>
                                                                </td>
                                                                <td class="j-tech-size" style="width:16%;">
                                                                    <div>L</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>96</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>74</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>100</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>174</div>
                                                                </td>
                                                            </tr>
                                                            <tr class="data-size j-table-row">
                                                                <td style="width:16%;">
                                                                    <div>50</div>
                                                                </td>
                                                                <td class="j-tech-size" style="width:16%;">
                                                                    <div>XL</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>100</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>78</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>104</div>
                                                                </td>
                                                                <td style="width:16%;">
                                                                    <div>176</div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="modal-footer" style="display: none">
                                                <button type="button" class="btn btn-primary">Выбрать размер</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="j-size-list size-list j-smart-overflow-instance">
                                    <div class="size-table sizetable">
                                        @foreach ($attr_sizes as $sizes)
                                            <li class="form-check"><input type="radio" value="{{$sizes->size_id}}"   v-model="item.attributes.size" name="size" id="size{{$sizes->size_id}}" ><label class="form-check-label" id ="lSize{{$sizes->size_id}}" for="size{{$sizes->size_id}}">{{$sizes->brand_name_size}} ({{$sizes->rus_name_size}})</label></li>
                                       @endforeach



                                    </div>
                                </div>


                            </div>
                            <div class="product__size">
                                <i class="icon icon--size"></i>
                                <a class="link link--inherit" target="_blank" href="/sizes/conte.html">Как определить размер?</a>
                            </div>
                        </div>



                        <input type="hidden" id="checked_attr" value=""   v-model="item.checked_attr" name="checked_attr" >




                        <div class="product__field">
                            <button type="button" v-on:click="addItem()" class="btn btn-danger button--pink">Добавить в корзину</button>
                            <br>
                            <a href="/cart/" class="btngotobasket dn">
                                Перейти в корзину
                            </a>


                            <br>
                            <a class="btn btn-primary" href="#" role="button">
                                Быстрый заказ
                                <div style="font-size:  8px;">(Мы вам перезвоним)</div>
                            </a>


                            <br>
                        </div>
                    </div>
                    <div class="col-md-4 new-mes-block-wr">
                        <div class="new-mes-block">
                            <a class="new-mes-block-link" href="/actions/besplatnaya-dostavka-po-vsey-rossii.html" target="_blank"></a>
                            <div class="new-mes-block-img">
                                <img src="/img/shipping-and-delivery.svg" alt="" class="loading" data-was-processed="true">
                            </div>
                            <div class="new-mes-block-text">
                                При заказе от 3500 руб бесплатная доставка
                            </div>
                        </div>
                        <div class="new-mes-block">
                            <a class="new-mes-block-link" href="/return" target="_blank"></a>
                            <div class="new-mes-block-img">
                                <img src="/img/clock.svg" alt="" class="loading" data-was-processed="true">
                            </div>
                            <div class="new-mes-block-text">
                                14 дней на возврат
                            </div>
                        </div>
                        <div class="new-mes-block">
                            <a class="new-mes-block-link" href="/delivery" target="_blank"></a>
                            <div class="new-mes-block-img">
                                <img src="/img/wallet.svg" alt="" class="loading" data-was-processed="true">
                            </div>
                            <div class="new-mes-block-text">
                                Любые способы оплаты
                            </div>
                        </div>
                    </div>
                </div>



                <!--обертка нового блока-->
                <div class="product__gap">
                    <div class="list product__features">
                        <div class="list__item"><i>Бренд:</i>
                            <a href="/brands/conte.html" class="link link--inherit">{{$product->name_brand}}</a>
                        </div>
                        <div class="list__item"><i>Страна:</i>
                            <span class="link link--inherit">{{$product->name_country}}</span>
                        </div>
                        <div class="list__item"><i>Артикул:</i> {{$product->vendor_code}}</div>

                        <div class="list__item"><i>Материал:</i> {{$product->material}} </div>
                    </div>
                </div>
                <div class="product__gap">
                    <div class="text text--light" itemprop="description">
                        <p class="paragraph"></p>
                        {{$product->description}}
                        <br><br><p>Вам может быть полезно:</p>
                        <ul>
                            <li><a href="/catalog/zhenskoe-bele/chulochno-nosochnye-izdeliya/noski/conte/" style="text-decoration: none;">Женские носочки Conte</a>
                            </li>
                            <li><a href="/catalog/zhenskoe-bele/chulochno-nosochnye-izdeliya/noski/" style="text-decoration: none;">Женские носочки</a>
                            </li>
                            <li><a href="/catalog/zhenskoe-bele/chulochno-nosochnye-izdeliya/" style="text-decoration: none;">Все чулочно-носочные изделия</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <!-- Latest -->
        @if(isset($similar_p[0]))
        <div class="section">
            <div class="title title--size-m title--light title--underline content__title">Похожие товары:</div>
            <div class="page__layout">
                <div class="slider slider-p ">
                    <div class="">
                        <div class="row proda">
                            @foreach ($similar_p as $p)
                            <div class="col-lg-9 col-sm-4">
                                <div class="strat">
                                    <a href="/catalog/{{$p->path}}/{{$p->slug}}.html">
                                        <div class="image">
                                            <img class="img latest__img loading" src="@foreach(explode(';', $p->media) as $media){{$media}}@break @endforeach" alt=""  data-was-processed="true">
                                        </div>
                                    </a>
                                    <div class="text text-center">
                                        <div class="card__description">
                                            <div class="card__name">@if(iconv_strlen($p->name)>51){{mb_strimwidth($p->name, 0, 50, "...")}} @else {{$p->name}}@endif</div>
                                            <div class="card__type">{{$p->title}}</div>
                                            <div class="card__price"><b>{{$p->price}} руб.</b></div>
                                            <div class="card__action">
                                                <a href="/catalog/{{$p->path}}/{{$p->slug}}.html" class="btn btn-outline-dark" data-id="2291907" tabindex="0"> Подробнее </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                       {{-- <a class="carousel-control-prev slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
        @endif


        @if(isset($last_p[0]))
            <div class="section">
                <div class="title title--size-m title--light title--underline content__title">Недавно просмотренные товары:</div>
                <div class="page__layout">
                    <div class="slider slider-p ">
                        <div class="">
                            <div class="row proda">
                                @foreach ($last_p as $p)
                                    <div class="col-lg-9 col-sm-4">
                                        <div class="strat">
                                            <a href="/catalog/{{$p->path}}/{{$p->slug}}.html">
                                                <div class="image">
                                                    <img class="img latest__img loading" src="@foreach(explode(';', $p->media) as $media){{$media}}@break @endforeach" alt=""  data-was-processed="true">
                                                </div>
                                            </a>
                                            <div class="text text-center">
                                                <div class="card__description">
                                                    <div class="card__name">@if(iconv_strlen($p->name)>51){{mb_strimwidth($p->name, 0, 50, "...")}} @else {{$p->name}}@endif</div>
                                                    <div class="card__type">{{$p->title}}</div>
                                                    <div class="card__price"><b>{{$p->price}} руб.</b></div>
                                                    <div class="card__action">
                                                        <a href="/catalog/{{$p->path}}/{{$p->slug}}.html" class="btn btn-outline-dark" data-id="2291907" tabindex="0"> Подробнее </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            {{--<a class="carousel-control-prev slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next slick__arrow  slick-arrow" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <script type="application/javascript">
        var attr_all =@php
            echo json_encode($attr_all);
        @endphp;
    </script>

@endsection
