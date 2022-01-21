@extends('tampilan.layout.apps')

@section('title','Halaman Home')

@section('meta')
    @include('tampilan.include.meta')
@endsection

@section('header')
    @include('tampilan.include.header')
@endsection

@section('content')
 <!-- End site branding area -->
    
  
    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
					<li>
						<img src="{{ asset(' /h4-slide.png') }}" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								iPhone <span class="primary">6 <strong>Plus</strong></span>
							</h2>
							<h4 class="caption subtitle">Dual SIM</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="{{ asset('img/h4-slide2.png') }}" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								by one, get one <span class="primary">50% <strong>off</strong></span>
							</h2>
							<h4 class="caption subtitle">school supplies & backpacks.*</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="{{ asset('img/h4-slide3.png') }}" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">
								Apple <span class="primary">Store <strong>Ipod</strong></span>
							</h2>
							<h4 class="caption subtitle">Select Item</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="{{ asset('img/h4-slide4.png') }}" alt="Slide">
						<div class="caption-group">
						  <h2 class="caption title">
								Apple <span class="primary">Store <strong>Ipod</strong></span>
							</h2>
							<h4 class="caption subtitle">& Phone</h4>
							<a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
						</div>
					</li>
				</ul>
			</div>
			<!-- ./Slider -->
    </div> <!-- End slider area -->
    
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
  
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                        @foreach($product as $p)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="{{ $p->qty == 0 ? asset('images/habis.png') : asset($p->img_url)}}"  alt="">
                                    <div class="product-hover">
                                        <a onclick="addtochart('{{$p->id}}','{{$p->price}}','{{$p->qty}}','{{asset($p->img_url)}}','{{$p->name}}')" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="{{ route('home.singleproduct', $p->id) }}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>
                                <h2><a href="{{ route('home.singleproduct', $p->id) }}">{{ $p->name }}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>Rp {{ number_format($p->price,0,"",".")}}</ins> <del></del>
                                </div> 
                            </div>
                            @endforeach

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="{{ asset('img/brand1.png') }}" alt="">
                            <img src="{{ asset('img/brand2.png') }}" alt="">
                            <img src="{{ asset('img/brand3.png') }}" alt="">
                            <img src="{{ asset('img/brand4.png') }}" alt="">
                            <img src="{{ asset('img/brand5.png') }}" alt="">
                            <img src="{{ asset('img/brand6.png') }}" alt="">
                            <img src="{{ asset('img/brand1.png') }}" alt="">
                            <img src="{{ asset('img/brand2.png') }}" alt="">                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Minuman</h2>
                        <a href="{{route('home.shoppage',['cari'=> 'Minuman'])}}" class="wid-view-more">View All</a>
                     @foreach($productminuman as $pm)
                            <div class="single-wid-product">
                                <a href=""><img src="{{asset($pm->img_url)}}" alt="" class="product-thumb"></a>
                                <h2><a href="single-product.html">{{$pm->name}}</a></h2>
                                    <div class="product-wid-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                <div class="product-wid-price">
                                    <ins>Rp {{number_format($pm ->price,0,"",".")}}</ins> <del></del>
                                </div>                            
                            </div>
                     @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Makanan</h2>
                        <a href="{{route('home.shoppage',['cari'=> 'Makanan'])}}" class="wid-view-more">View All</a>
                      
                             @foreach($productmakanan as $pm)
                        <div class="single-wid-product">
                            <a href=""><img src="{{asset($pm->img_url)}}" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">{{$pm->name}}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>Rp {{number_format($pm->price,0,"",".")}}</ins> <del></del>
                            </div>                            
                        </div>
                        @endforeach     
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Buah</h2>
                        <a href="{{route('home.shoppage',['cari'=> 'Buah'])}}" class="wid-view-more">View All</a>
                     @foreach($productbuah as $pb)                    
                        <div class="single-wid-product">
                            <a href=""><img src="{{asset($pb->img_url)}}" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">{{$pb->name}}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>Rp {{number_format($pb->price,0,"",".")}}</ins> <del></del>
                            </div>                            
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->
    
@endsection

@section('footer')
    @include('tampilan.include.footer')
@endsection

@section('custom_script')
    @include('tampilan.include.custom_script')
    <script>
        $("#price").keyup(function() {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
            $(this).val(convertNumberToPrice($(this).val()))
        });
      
    </script>
@endsection
