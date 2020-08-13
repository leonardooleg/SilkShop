@extends('admin.layouts.app_admin')

@section('content')

    <div class="container-fluid">

        @component('admin.components.breadcrumb')
            @slot('title') Импортировать товары @endslot
            @slot('parent') Главная @endslot
            @slot('active') Товары @endslot
        @endcomponent

        <hr/>

        <form class="form-horizontal" action="{{route('admin.products.import')}}" method="post"  enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Загрузить файл</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="file-input" name="import_file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Выбрать файл</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Импортировать</button>

        </form>
    </div>

@endsection
