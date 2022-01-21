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
                <h2>Product Detail</h2>
            </div>
        </div>
    </div>
</div>
</div>

<div class="single-product-area">
<div class="zigzag-bottom"></div>
<div class="container">
    <div class="row">        
        <div class="col-md-12">
            <div class="product-content-right">
                <div class="product-breadcroumb">
                    <a href="">Home</a>
                    <a href="">Category Name</a>
                    <a href="">Sony Smart TV - 2015</a>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="product-images">
                            <div class="product-main-img">
                                <img src="" alt="">
                            </div>
                            <div class="product-gallery">
                                <img id="main-image" src="{{asset($product->img_url)}}" alt="" style="width:200px;margin-left: auto;margin-right: auto;display: block;">
                            </div>
                            <div class="brands-area">
                <div class="zigzag-bottom"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="brand-wrapper">
                                    <div class="brand-list">       
                                    <img class="image-view" src="{{asset($product->img_url)}}" alt="">
                                    <img class="image-view" src="{{asset($product->productimg[0]->img_url)}}" alt="" >
                                    <img class="image-view" src="{{asset($product->productimg[1]->img_url)}}" alt="" >
                                    <img class="image-view" src="{{asset($product->productimg[2]->img_url)}}" alt="" >
                          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="product-inner">
                            <h2 class="product-name">{{$product->name}}</h2>
                            <div class="product-inner-price">
                                <ins>Rp {{ number_format($product->price,0,"",".")}}</ins> <del></del>
                            </div>    
                            
                            <form action="" class="cart">
                                <a class="add_to_cart_button" type="submit" onclick="addtochart('{{$product->id}}','{{$product->price}}','{{$product->qty}}','{{asset($product->img_url)}}','{{$product->name}}')">Add to cart</a>
                            </form>   
                            
                            <div class="product-inner-category">
                                <p>Category: <a href="">Summer</a>. Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                            </div> 
                            
                            <div role="tabpanel">
                                <ul class="product-tab" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <h2>Product Description</h2>  
                                        <p>{{$product->desc}}</p>
                                        <p></p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                        <h2>Reviews</h2>
                                        <div class="submit-review">
                                            <p><label for="name">Name</label> <input name="name" type="text"></p>
                                            <p><label for="email">Email</label> <input name="email" type="email"></p>
                                            <div class="rating-chooser">
                                                <p>Your rating</p>

                                                <div class="rating-wrap-post">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                            <p><input type="submit" value="Submit"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
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
<script>
    $( ".image-view" ).click(function() {
        $("#main-image").attr("src",$(this).attr("src"));
    });
</script>
@endsection
