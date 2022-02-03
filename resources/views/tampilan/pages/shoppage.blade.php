@extends('tampilan.layout.apps')

@section('title','Halaman Home')

@section('meta')
@include('tampilan.include.meta')
@endsection

@section('header')
@include('tampilan.include.header')
@endsection

@section('content')

    <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">
                            <h2>Shop</h2>
                        </div>
                    </div>
                </div>      
            </div>
    </div>
    <form action="{{route('home.shoppage')}}" method="GET">
            <div class="container">
                <div class="col-md-6">
                    <select name="pricefilter" id="category" class="form-control" style="margin-left:170px">
                        <option hidden value="">== Filter By Price ==</option>
                        <option value="hightolow">High to Low Price</option>
                        <option value="lowtohigh">Low to High Price</option>
                    </select>
                </div>
            </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">

        @if(count($product)==0) 
        
        </div>
        <div class="container">
        
            <div class="col-md-12">
            <h1 style="margin-left:300px"> Produk yang anda cari tidak tersedia </h1></br></br>
                    
                        <input type="text" name="cari" value="{{old('cari')}}">
                        <input type="submit" value="CARI">

            </div>
        </div>
        @else
            <div>
                @php
                $i=0;
                @endphp
                @foreach($product as $p)
                    @if ($i%4==0)
                        </div>
                        <div class="row">
                    @endif
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="{{ $p->qty == 0 ? asset('images/habis.jpg') : asset($p->img_url)}}" style="width:130px" alt="">
                            </div>
                            <h2><a href="">{{$p->name}}</a></h2>
                            <div class="product-carousel-price">
                                <ins>Rp {{ number_format($p->price,0,"",".")}}</ins> <del></del>
                            </div>  
                            
                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('home.singleproduct', $p->id) }}">See Details Product</a>
                            </div>                       
                        </div>
                    </div>
                    @php
                    $i++;
                    @endphp
                @endforeach
                </div>
                    <form action="{{route('home.shoppage')}}" method="GET">
                        <input type="text" name="cari" value="{{old('cari')}}">
                            <input type="submit" value="CARI">
                    </form>
                {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                    {!! $product->links() !!}
            </div>

        @endif
            </div>
    </div>
    </form>
@endsection

@section('footer')
@include('tampilan.include.footer')
@endsection

@section('custom_script')
@include('tampilan.include.custom_script')

@endsection
