
<script  type="application/javascript">
    var _token = '<?php echo csrf_token() ?>';

    $(document).ready(function() {
            @if(!preg_match("/login/", $_SERVER['REQUEST_URI']))
        var app = new Vue({
                el: '#app',
                data: {
                    details: {
                        sub_total: 0,
                        total: 0,
                        total_quantity: 0,
                        checked_attr: '0'
                    },
                    counts: [
                        {
                            id: 1,},{id: 2,},{id: 3,},{id: 4,},{id: 5,},{id: 6,},{id: 7,},{id: 8,},{id: 9,},{id: 10,}
                    ],
                    itemCount: 0,
                    items: [],
                    item: {
                        b: 1,
                        id: '{{$product->id ?? ''}}',
                        name: '{{$product->name ?? ''}}',
                        price:  '{{$product->price ?? ''}}',
                        qty: 1,  //тільки для додавання далі quantity
                        checked_attr: '',
                        attributes: {
                            size: '',
                            color: '',
                            brand_name_size: '',
                            rus_name_size: '',
                            img_color: '',
                            name_color: '',
                            vendor_code: '{{$product->vendor_code ?? ''}}',
                            img: ''
                        }

                    },
                    cartShipping: {type: 0},
                    cartCondition: {
                        name: '',
                        type: '',
                        target: '',
                        value: '',
                        attributes: {
                            description: 'Value Added Tax'
                        }
                    }
                },
                mounted:function(){
                    this.loadItems();
                },
                methods: {
                    addItem: function() {


                        var _this = this;

                        this.$http.post('/cart',{
                            _token:_token,
                            id:_this.item.id,
                            name:_this.item.name,
                            price:_this.item.price,
                            qty:_this.item.qty,
                            checked_attr:_this.item.checked_attr,
                            size:_this.item.attributes.size,
                            color:_this.item.attributes.color,
                            vendor_code:_this.item.attributes.vendor_code,
                            /*brand_name_size:_this.item.attributes.brand_name_size,
                            rus_name_size:_this.item.attributes.rus_name_size,*/
                            /*color_code:_this.item.attributes.color_code,
                            color_name:_this.item.attributes.color_name,*/
                            img:_this.item.attributes.img
                        }).then(function(success) {
                            console.log('add');
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);

                        });
                        console.log('ok 2');
                    },
                    addCartShipping: function() {
                        console.log('shipping');
                        var _this = this;

                        this.$http.post('/cart/shipping',{
                            _token:_token,
                            type:_this.cartShipping.type,
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    addCartCondition: function() {
                        console.log(3);
                        var _this = this;

                        this.$http.post('/cart/conditions',{
                            _token:_token,
                            name:_this.cartCondition.name,
                            type:_this.cartCondition.type,
                            target:_this.cartCondition.target,
                            value:_this.cartCondition.value,
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    clearCartCondition: function() {

                        var _this = this;

                        this.$http.delete('/cart/conditions?_token=' + _token).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    removeItem: function(id) {

                        var _this = this;

                        this.$http.delete('/cart/'+id,{
                            params: {
                                _token:_token
                            }
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    loadItems: function() {

                        var _this = this;

                        this.$http.get('/cart',{
                            params: {
                                limit:10
                            }
                        }).then(function(success) {
                            _this.items = success.body.data;
                            _this.itemCount = success.body.data.length;
                            _this.loadCartDetails();
                            _this.loadCartShipping();
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    loadCartDetails: function() {

                        var _this = this;

                        this.$http.get('/cart/details').then(function(success) {
                            _this.details = success.body.data;
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    loadCartShipping: function() {

                        var _this = this;

                        this.$http.get('/cart/shipping').then(function(success) {
                            _this.cartShipping.type = success.body.data;
                        }, function(error) {
                            console.log(error);
                        });
                    },
                    updateItem: function (cart_id, event) {
                        var _this = this;
                        this.$http.get('/cart/update/'+cart_id +'&'+event.target.value,{
                        }).then(function(success) {
                            _this.loadItems();
                        }, function(error) {
                            console.log(error);
                        });
                    }
                },
                /* computed: {
                     sum() {
                         // Воспользуемся методом `reduce`.
                         // https://developer.mozilla.org/ru/docs/Web/JavaScript/Reference/Global_Objects/Array/reduc
                         //console.log(item);

                         return 5
                         //return this.qty.reduce((price, qty) => this.price * Number(qty))
                     }
                 }*/

            });

        /*   var wishlist = new Vue({
               el: '#wishlist',
               data: {
                   details: {
                       sub_total: 0,
                       total: 0,
                       total_quantity: 0
                   },
                   itemCount: 0,
                   items: [],
                   item: {
                       id: '',
                       name: '',
                       price: 0.00,
                       qty: 1
                   }
               },
               mounted:function(){
                   this.loadItems();
               },
               methods: {
                   addItem: function() {

                       var _this = this;

                       this.$http.post('/wishlist',{
                           _token:_token,
                           id:_this.item.id,
                           name:_this.item.name,
                           price:_this.item.price,
                           qty:_this.item.qty
                       }).then(function(success) {
                           _this.loadItems();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   removeItem: function(id) {

                       var _this = this;

                       this.$http.delete('/wishlist/'+id,{
                           params: {
                               _token:_token
                           }
                       }).then(function(success) {
                           _this.loadItems();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   loadItems: function() {

                       var _this = this;

                       this.$http.get('/wishlist',{
                           params: {
                               limit:10
                           }
                       }).then(function(success) {
                           _this.items = success.body.data;
                           _this.itemCount = success.body.data.length;
                           _this.loadCartDetails();
                       }, function(error) {
                           console.log(error);
                       });
                   },
                   loadCartDetails: function() {

                       var _this = this;

                       this.$http.get('/wishlist/details').then(function(success) {
                           _this.details = success.body.data;
                       }, function(error) {
                           console.log(error);
                       });
                   }
               }
           });*/
        @endif
            @if(preg_match('!html!', $_SERVER['REQUEST_URI']))
            window.onload = function(){
            var elem = document.querySelectorAll('[name="color"]'), i = elem.length;
            var color;
            var img = document.getElementById('poster').src;
            Vue.set(app.item.attributes, 'img', img);
            while(i--){
                elem[i].onclick = function(i){
                    return function(){
                        //  let someTextiles = attr_all.filter(item => item.attr_all_color == this.value);
                        color= this.value;
                        //console.log('col'+color);
                        document.getElementById('color'+color).setAttribute('checked', 'checked');
                        //console.log(color+"-color");                 //цвет
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
                                document.getElementById('checked_attr').value=attr_all[d].id;
                                Vue.set(app.item, 'checked_attr', attr_all[d].id);
                                //console.log(attr_all[d].id);
                            }
                        }
                    };
                }(c);
            }
        };
        @endif

    });

</script>


