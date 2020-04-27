<label for=""><strong>Статус</strong></label>
<select class="form-control" name="published">
    @if (isset($product->id))
        <option value="0" @if ($product->published == 0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($product->published == 1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<div class="form-group ">
    <label for="inputZip"><strong>Название</strong></label>
    <input type="text" name="name" class="form-control" value="{{$product->name ?? ''}}" required>
</div>
<div class="row">
    <div class="col-md-6">
        <label for=""><strong>Категория</strong></label>
        <select id="category" class="form-control" onclick="check()"  name="categories" required>
            <option   value="">-- выбрать --</option>
            @include('admin.sizes.partials.categories', ['categories' => $categories, 'delimiter'  => ''])
        </select>

        <label for=""><strong>Бренд</strong></label>
        <select id="brand" class="form-control" onclick="check()"  onclick="check_color()" name="brand_id" required>
            <option   value="">-- выбрать --</option>
            @foreach($brands as $brand)
                <option value="{{$brand->id}}"  @if(isset($product)) @if($brand->id==$product->brand_id)) selected @endif @endif>{{$brand->name_brand}}</option>
            @endforeach
        </select>

        <div class="form-group ">
            <label for="inputZip"><strong>Символьный код</strong></label>
            <input type="text" name="code" class="form-control" value="{{$product->code ?? ''}}">
        </div>

        <div class="form-group ">
            <label for="inputZip"><strong>Артикул</strong></label>
            <input type="text" name="vendor_code" class="form-control" value="{{$product->vendor_code ?? ''}}" >
        </div>
        <br>
        <label for="">Новинка?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="new" id="exampleRadios1" value="1" @if(isset($product)) @if($product->new===1)checked @endif @endif>
            <label class="form-check-label" for="exampleRadios1">
                Новинка
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="new" id="exampleRadios2" value="0" @if(isset($product)) @if($product->new===0)checked @endif @endif>
            <label class="form-check-label" for="exampleRadios2">
                Нет
            </label>
        </div>
        <hr>



        <div class="form-group ">
            <label for="inputZip"><strong>Цена</strong></label>
            <div class="input-group mb-3">
                <input type="text" name="price" class="form-control" value="{{$product->price ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">руб.</span>
                </div>
            </div>

        </div>

    </div>
    <div class="col-md-6">

        <label for=""><strong>Производитель</strong></label>
        <select class="form-control" name="provider_id" required>
            <option   value="">-- выбрать --</option>
            @foreach($providers as $provider)
                <option value="{{$provider->id}}" @if(isset($product)) @if($provider->id==$product->provider_id)) selected @endif @endif>{{$provider->provider_name}}</option>
            @endforeach
        </select>

        <label for=""><strong>Страна</strong></label>
        <select class="form-control" name="country_id" required>
            <option   value="">-- выбрать --</option>
            @foreach($countries as $country)
                <option value="{{$country->id}}" @if(isset($product)) @if($country->id==$product->country_id) selected @endif @endif>{{$country->name_country}}</option>
            @endforeach
        </select>

        <div class="form-group ">
            <label for="inputZip"><strong>Состав</strong></label>
            <input type="text" name="material" class="form-control" value="{{$product->material ?? ''}}">
        </div>
        <div class="form-group ">
            <label for="inputZip"><strong>Количество</strong></label>
            <input type="text" name="count" class="form-control" value="{{$product->count ?? '0'}}">
        </div>

        <br>
        <label for="">Скидка?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sale" id="exampleRadios1" value="1" @if(isset($product)) @if($product->sale===1)checked @endif @endif>
            <label class="form-check-label" for="exampleRadios1">
                SALE
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sale" id="exampleRadios2" value="0" @if(isset($product)) @if($product->sale===0)checked @endif @endif>
            <label class="form-check-label" for="exampleRadios2">
                Нет
            </label>
        </div>
        <br>
        <div class="form-group ">
            <label for="inputZip"><strong>Ссылка</strong></label>
            <div class="input-group mb-3">
                <input type="text" name="slug" class="form-control" placeholder="Автоматическая генерация или введите свою" value="{{$product->slug ?? ''}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">.html</span>
                </div>
            </div>
        </div>
    </div>
</div>


<hr>
<label for=""><strong>Размеры</strong></label>

<div class="row">
    <div class="col-md-3">
        <label for="">Фильр размера</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check()" name="filter" id="filterAll" value="1" checked>
            <label class="form-check-label" for="filterAll">
                Отображать все
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check()" name="filter"  id="filterCatBrand" value="2">
            <label class="form-check-label" for="filterCatBrand">
                отфильтровать по категории и бренду
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check()" name="filter"  id="filterCat" value="3">
            <label class="form-check-label" for="filterCat">
                отфильтровать по категории
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check()" name="filter"  id="filterBrand" value="4">
            <label class="form-check-label" for="filterBrand">
                отфильтровать по  бренду
            </label>
        </div>
        <script type="application/javascript">
            function clone() {
                $(document).ready(function() {
                    var lsthmtl = $(".clone").html();
                    $(".increment").after(lsthmtl);

                });
            }
            function remove() {
                $("body").on("click",".btn-danger",function(event){
                    event.preventDefault();
                    $(this).parents('.hdtuto').remove();
                });
            }
            function check() {
                if(document.getElementById('filterAll').checked) {
                    $('#size option').removeClass('show');
                    $('#size option').removeClass('dis');
                    $('#size option').addClass('show');
                    console.log(1)
                }else if(document.getElementById('filterCatBrand').checked) {
                    var c = document.getElementById("category");
                    var strCategory = c.options[c.selectedIndex].value;
                    var b = document.getElementById("brand");
                    var strBrand = b.options[b.selectedIndex].value;
                    $('#size option').removeClass('show');
                    $('#size option').addClass('dis');
                    $('option[data-cat='+strCategory+'][data-brand='+strBrand+']').removeClass('dis');
                    $('option[data-cat='+strCategory+'][data-brand='+strBrand+']').addClass('show');
                    console.log(strCategory);
                    console.log(strBrand);
                    console.log(2)
                }else if(document.getElementById('filterCat').checked) {
                    var c = document.getElementById("category");
                    var strCategory = c.options[c.selectedIndex].value;
                    $('#size option').removeClass('show');
                    $('#size option').addClass('dis');
                    $('option[data-cat = '+strCategory+']').removeClass('dis');
                    $('option[data-cat = '+strCategory+']').addClass('show');
                    console.log(strCategory);
                    console.log(3)
                }else if(document.getElementById('filterBrand').checked) {
                    var b = document.getElementById("brand");
                    var strBrand = b.options[b.selectedIndex].value;
                    $('#size option').removeClass('show');
                    $('#size option').addClass('dis');
                    $('option[data-brand = '+strBrand+']').removeClass('dis');
                    $('option[data-brand = '+strBrand+']').addClass('show');
                    console.log(strBrand);
                    console.log(4)
                }
            }
        </script>
    </div>
    <div class="col-md-6">
        <div class="input-group row mb-3  hdtuto increment">
            @if(isset($attributeables[0]))
                @foreach ($attributeables as $attr)
                    <div  class="col-md-12 js-clone line">
                        <div  class="row">
                            <div class="input-group col-md-6">
                                <select  class="form-control" name="size_id[]"  id="size">
                                    <option   value="">-- выбрать --</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" data-cat="{{$size->category_id}}" data-brand="{{$size->brand_id}}"
                                                @if(isset($product)) @if($size->id== $attr->size_id) selected @endif @endif>
                                            {{$size->brand_name_size}}(бренд) --- {{$size->rus_name_size}}(рус)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group col-md-4">
                                <select  class="form-control" name="color_id[]"  id="color">
                                    <option   value="">-- выбрать --</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}" data-brand-color="{{$color->brand_id}}" @if(isset($product)) @if($color->id== $attr->color_id) selected @endif @endif>
                                            {{$color->name_color}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger media-del" onclick="del()">Удалить</button>
                            </div>
                            <hr style="width: 100%;margin: 10px 0;">
                        </div>
                    </div>
                @endforeach
            @else
                <div  class="col-md-12 js-clone line">
                    <div  class="row">
                        <div class="input-group col-md-6">
                            <select  class="form-control" name="size_id[]"  id="size">
                                <option   value="">-- выбрать --</option>
                                @foreach($sizes as $size)
                                    <option value="{{$size->id}}" data-cat="{{$size->category_id}}" data-brand="{{$size->brand_id}}">
                                        {{$size->brand_name_size}}(бренд) --- {{$size->rus_name_size}}(рус)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group col-md-4">
                            <select  class="form-control" name="color_id[]"  id="color">
                                <option   value="">-- выбрать --</option>
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}" data-brand-color="{{$color->brand_id}}">
                                        {{$color->name_color}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger media-del" onclick="del()">Удалить</button>
                        </div>
                        <hr style="width: 100%;margin: 10px 0;">
                    </div>
                </div>
            @endif
        </div>

        <div class="clone" hidden>
            <div  class="col-md-12 ">
                <div  class="row">
                    <div class="input-group col-md-6">
                        <select  class="form-control" name="size_id[]"  id="size">
                            <option   value="">-- выбрать --</option>
                            @foreach($sizes as $size)
                                <option value="{{$size->id}}" data-cat="{{$size->category_id}}" data-brand="{{$size->brand_id}}"
                                       >
                                    {{$size->brand_name_size}}(бренд) --- {{$size->rus_name_size}}(рус)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group col-md-4">
                        <select  class="form-control" name="color_id[]"  id="color">
                            <option   value="">-- выбрать --</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}" data-brand-color="{{$color->brand_id}}">
                                    {{$color->name_color}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger media-del" onclick="del()">Удалить</button>
                    </div>
                    <hr style="width: 100%;margin: 10px 0;">
                </div>
            </div>
        </div>

        <div class="input-group-prepend col-md-2 mt-3">
            <button class="btn  btn-success" onclick="clone()" type="button" >Добавить</button>
        </div>



    </div>
    <div class="col-md-3">
        <label for="">Фильр цвета</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check_color()" name="filtercolor" id="filterAllColor" value="1" checked>
            <label class="form-check-label" for="filterAllColor">
                Отображать все
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" onclick="check_color()" name="filtercolor"  id="filterBrandColor" value="2">
            <label class="form-check-label" for="filterBrandColor">
                отфильтровать по  бренду
            </label>
        </div>
        <script type="application/javascript">
            function clone() {
                $(document).ready(function() {
                        var lsthmtl = $(".clone").html();
                    $(lsthmtl).insertAfter(".js-clone:last");
                    var last = $( ".increment div.col-md-12" ).last();
                    last.addClass( "js-clone line" );


                });
            }
            function del() {
                $("body").on("click",".line .btn-danger",function(event){
                    event.preventDefault();
                    $(this).parents('.hdtuto .line').remove();
                });
            }

            function check_color() {
                if(document.getElementById('filterAllColor').checked) {
                    $('#color option').removeClass('show');
                    $('#color option').removeClass('dis');
                    $('#color option').addClass('show');
                    console.log(11)
                }else if(document.getElementById('filterBrandColor').checked) {
                    var b = document.getElementById("brand");
                    var strBrandColor = b.options[b.selectedIndex].value;
                    $('#color option').removeClass('show');
                    $('#color option').addClass('dis');
                    $('option[data-brand-color = '+strBrandColor+']').removeClass('dis');
                    $('option[data-brand-color = '+strBrandColor+']').addClass('show');
                    console.log(strBrandColor);
                    console.log(22)
                }
            }
        </script>
    </div>
</div>
<hr>


<label for="basic-url"><strong>Медіа файли</strong></label>
    <div class="card mb-12 hdtuto2 increment2">
        @if (isset($product->media)!='')
            @foreach(explode(';', $product->media) as $media)
                @if (isset($media)  )

                        <div class="row js-clone-media">
                            <div class="col-md-2">
                                <img src="{{$media ?? ''}}" class="media-img" >
                            </div>
                            <div class="col-md-7">
                                <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Ссылка</span>
                                    </div>
                                    <input type="text" class="form-control" name="media[]" value="{{$media ?? ''}}" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger media-del mt-3" onclick="media_del()">Удалить</button>
                            </div>
                            <hr style="width: 90%">
                        </div>

                @endif

            @endforeach
        @else
            <div class="input-group mb-3  row">
                <div class="col-md-9">
                    <div class="input-group ml-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Ссылка</span>
                        </div>
                        <input type="text" class="form-control" name="media[]"  placeholder="url" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger media-del mt-3" onclick="media_del()">Удалить</button>
                </div>
            </div>
        @endif
    </div>


<div class="row">
    <div class="col-12">
        <button class="btn mt-3 mb-3 btn-success float-left" onclick="media_clone()" type="button">Добавить картинку</button>
    </div>

</div>




<div class="clone2" hidden="">
    <div class="input-group mb-3  row">
        <div class="col-md-9">
            <div class="input-group ml-3 mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Ссылка</span>
                </div>
                <input type="text" class="form-control" name="media[]"  placeholder="url" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-danger media-del mt-3" onclick="media_del()">Удалить</button>
        </div>
    </div>
</div>

<script type="application/javascript">


    function media_clone() {
        $(document).ready(function() {
            var lsthmtl2 = $(".clone2").html();
            $(lsthmtl2).insertAfter(".js-clone-media:last");
            var last = $( ".hdtuto2  div.input-group.row" ).last();
            last.addClass( "js-clone-media" );

        });
    }
    function media_del() {
        $("body").on("click",".media-del",function(event2){
            event2.preventDefault();
            $(this).parents('.hdtuto2 .js-clone-media').remove();
        });



    }
</script>


<div class="form-group ">
    <label for="inputZip"><strong>Описание</strong></label>
    <textarea rows="7" name="description" class="form-control" >{{$product->description ?? ''}}</textarea>
</div>
<hr><br>

