@extends('tampilan.layout.apps')

@section('title','Halaman Home')

@section('meta')
    @include('tampilan.include.meta')
@endsection

@section('header')
    @include('tampilan.include.header')
@endsection

@section('content')
<div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="#">
                            <input type="text" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        @if (count($product)>=4)
                                    @for($i=0; $i<=4; $i++)
                        <div class="thubmnail-recent">
                            <img src="{{asset($product[$i]->img_url)}}" class="recent-thumb" alt="">
                            <h2><a href="single-product.html">{{$product[$i]->name}}</a></h2>
                            <div class="product-sidebar-price">
                                <ins>Rp {{ number_format($product[$i]->price,0,"",".")}}</ins> <del></del>
                            </div>                             
                        </div>
                        @endfor
                    @endif
                        
                       
                    </div>
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                            <li><a href="#">Sony Smart TV - 2015</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart_item" >

                                        <tr>
                                            <td class="actions" colspan="6">
                                                <div class="coupon">
                                                    <label for="coupon_code">Coupon:</label>
                                                    <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                                                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                                </div>
                                                <input type="submit" value="Update Cart" name="update_cart" class="button">
                                                <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                            <div class="cart-collaterals">


                            <div class="cross-sells">
                                <h2>You may be interested in...</h2>
                                @if (count($product)>=2)
                                    @for($i=0; $i<=1; $i++)
                                        <ul class="products">
                                            <li class="product">
                                                <a href="single-product.html">
                                                    <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="{{asset($product[$i]->img_url)}}">
                                                    <h3>Ship Your Idea</h3>
                                                    <span class="price"><span class="amount">Rp {{ number_format($product[$i]->price,0,"",".")}}</span></span>
                                                </a>
                                                <a class="add_to_cart_button" href="{{route('home.singleproduct',$product[$i]->id)}}">Product Detail</a>
                                            </li>
                                        </ul>
                                    @endfor
                                @endif
                            </div>


                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount" id="price_totalchart"> </span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">£15.00</span></strong> </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary"  onclick="checkout()">Checkout</button>
                            </div>


                            <form method="post" action="#" class="shipping_calculator">
                                <h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Calculate Shipping</a></h2>

                                <section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse">

                                <p class="form-row form-row-wide"><input type="text" id="calc_shipping_state" name="calc_shipping_state" placeholder="State / county" value="" class="input-text"> </p>

                                <p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>


                                <p><button class="button" value="1" name="calc_shipping" type="submit">Update Totals</button></p>

                                </section>
                            </form>
                            </div>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('tampilan.include.footer')
@endsection

@section('custom_script')
    @include('tampilan.include.custom_script')
    <script  type="text/javascript">

        $("#price").keyup(function() {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
            $(this).val(convertNumberToPrice($(this).val()))
        });

        function increaseCart(id,total){
            index = -1;
            for (var i=0;i<arraychart.length;i++){
                if (arraychart[i].id==id){
                    index = i;
                }
            }

            if (index!=-1 && arraychart[index].total >arraychart[index].jumlah ){
                item = arraychart[index];
                
                hargaSatuan = parseInt(item.price/item.jumlah);
                item.price = item.price + hargaSatuan
                item.jumlah = item.jumlah + 1

                //push to UI
                updateHeaderCart();

                $("#jumlah_"+id).val(item.jumlah);
                $("#price_"+id).html("Rp "+convertNumberToPrice(item.price));
                localStorage.setItem('cart', JSON.stringify(arraychart));
                error_log(localStorage.setItem('cart', JSON.stringify(arraychart)));
            } else{
                alert('Stock tidak mencukupi');
            } 
         
        }

        function deltedChart(id){
            index = -1;   
            arraychart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(arraychart));
            initCart();
            updateHeaderCart();
        }

        function decreaseChart(id){
            index = -1;
            for (var i=0;i<arraychart.length;i++){
                if (arraychart[i].id==id){
                    index = i;
                }
            }
            if (arraychart[index].jumlah==1){
                arraychart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(arraychart));
                initCart();
            } else if (index!=-1 && arraychart[index].jumlah>=2){
                item = arraychart[index];

                hargaSatuan = parseInt(item.price/item.jumlah);
                item.price = item.price - hargaSatuan
                item.jumlah = item.jumlah - 1

                //push to UI
                updateHeaderCart();
                $("#jumlah_"+id).val(item.jumlah);
                $("#price_"+id).html("Rp "+convertNumberToPrice(item.price));
                localStorage.setItem('cart', JSON.stringify(arraychart));
            }   
        }

        function initCart(){
            updateHeaderCart();
            $("#cart_item").html(``);
            for (var i=0;i<arraychart.length;i++){
                $("#cart_item").prepend(`<tr class="cart_item">
                    <td class="product-remove">
                        <a title="Remove this item" class="remove"onClick="deltedChart(`+arraychart[i].id+`)">×</a> 
                    </td>

                    <td class="product-thumbnail">
                        <a id="select_img"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="`+arraychart[i].img_url+`"></a>
                    </td>

                    <td class="product-name">
                        <a >`+arraychart[i].name+`</a> 
                    </td>

                    <td class="product-price">
                        <span class="amount" id="price_total">Rp `+convertNumberToPrice(parseInt(arraychart[i].price/arraychart[i].jumlah))+`</span> 
                    </td>

                    <td class="product-quantity">
                        <div class="quantity buttons_added">
                            <input type="button" class="minus" value="-" onClick="decreaseChart(`+arraychart[i].id+`)">
                            <input id="jumlah_`+arraychart[i].id+`" type="number" size="4" class="input-text qty text" title="Qty" readonly value=`+arraychart[i].jumlah+` min="0" step="1">
                            <input type="button" class="plus" value="+" onClick="increaseCart(`+arraychart[i].id+`)">
                        </div>
                    </td>

                    <td class="product-subtotal">
                        <span id="price_`+arraychart[i].id+`" "class="amount">Rp `+convertNumberToPrice(arraychart[i].price)+`</span> 
                    </td>
                </tr>
                `)
            }
        }

        initCart();

        function checkout(){
            Swal.fire({
                title: 'Apakah yakin membeli product ini?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: `Tidak`,
                }).then((result) => {
                if (result.isConfirmed) {
                    //delete data from BE
                    $.ajax({
                        url: "{{route('home.checkout','')}}",
                        type: "POST",
                        data: {
                            "_token": "{{csrf_token()}}",
                            "arraychart":arraychart
                        },
                        success: function (response) {
                            if (response==1){
                                Swal.fire(
                                    'Berhasil',
                                    'Berhasil checkout product',
                                    'success'
                                ).then((result) => {
                                    localStorage.setItem('cart', JSON.stringify([]));
                                    window.location.reload(); 
                                });
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    'Gagal checkout product',
                                    'error'
                                ).then((result) => { window.location.reload(); });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else if (result.isDenied) {
                }
            })
        }

    </script>
@endsection