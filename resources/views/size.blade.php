@extends('layouts.app')

@section('title', 'Таблица размеров '.$size->name_brand)

@section('content')
    <div class="container container-my">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="/" class="link breadcrumbs__link">Главная</a> </li>
                    <li class="breadcrumb-item"><a href="/sizes" class="link breadcrumbs__link">Таблица размеров</a></li>
                    <li class="breadcrumb-item"><a  class="link breadcrumbs__link">{{$size->name_brand}}</a></li>
            </ol>
        </nav>


            <br>
            <h2 class=" text-center content__title">Таблица размеров "{{$size->name_brand}}"</h2>
        <div class="text-center ">Как узнать размер нижнего белья?</div>
            <hr class="sep page__sep">

            <div class="container-fluid sizes">
                <div class="row proportions">
                    <div class="col-md-2">
                        <div class="title title--light">Выберите бренд:</div>
                        <div class=" proportions__nav">
                            @foreach ($brands as $brand)
                                <div class="list__item">
                                    <a class="link link--inherit" href="/sizes/{{$brand['url']}}.html">{{$brand['name_brand']}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-10">

                        {!! $size->sizes_brand !!}

                    </div>
                </div>





            </div>


    </div>



@endsection
