@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumb')
            @slot('title') Добавить расцветку @endslot
            @slot('parent') Главная @endslot
            @slot('active') Расцветки @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.colors.store')}}" method="post">
            {{ csrf_field() }}

            {{-- Form include --}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label for="inputZip">Название</label>
                        <input type="text" name="name_color" class="form-control" id="">
                    </div>
                    <div class=" form-row">
                        <label class=" col-md-12" for="basic-url">Цвет</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">ссылка</span>
                            </div>
                            <input type="text" name="img_color" value="{{$color->img_color ?? ''}}"class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                    <div class=" form-row">
                        <label for="">Для бренда</label>
                        <select class="form-control" name="brand_id">
                            <option value="0">-- для всех брендов --</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" >{{$brand->name_brand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr><br>
                    <button type="submit" class="btn btn-primary float-right">Добавить</button>
                </div>
                <div class="col-md-4">
                    <h4>Уже добавленные цвета </h4>
                    <ul class="list-group">
                        @foreach($colors as $color)
                            <li class="list-group-item " ><img src="{{$color->img_color}}" style="height: 35px"> {{$color->name_color}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>



        </form>
    </div>

@endsection
