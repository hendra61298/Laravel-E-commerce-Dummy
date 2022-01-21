<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                    @if(Auth::check())
                        <li><a href="{{route('home.profilview')}}"><i class="fa fa-user"></i> My Account</a></li>
                        <li><a href="{{route('home.chartview')}}"><i class="fa fa-user"></i> My Cart</a></li>
                        <li><a href="{{route('home.transaksi')}}"><i class="fa fa-user"></i> Riwayat Transaksi</a></li>
                        
                        <li><a href="{{route('home.logout')}}"><i class="fa fa-user"></i> logout</a></li>
                     @else
                        <li><a href="{{route('home.loginview')}}"><i class="fa fa-user"></i> Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" ><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="{{asset('img/logo.png')}}"></a></h1>
                </div>
            </div>
            
            <div class="col-sm-6" >
                <div class="shopping-item" >
                    <a href="{{route('home.chartview')}}">Cart - <span class="cart-amunt" id="price_total" ></span> <i class="fa fa-shopping-cart"  ></i> <span id="select_total" class="product-count"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="undefined-sticky-wrapper" class="sticky-wrapper" style="height: 60px;">
    <div class="mainmenu-area" style="">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav  menul">
                        <li class="{{ request()->is('/') ? 'active' : '' }}" ><a href="{{route('home.index')}}">Home</a></li>
                        <li class="{{ request()->is('home/shoppage*') ? 'active' : '' }}"><a href="{{route('home.shoppage')}}">Shop page</a></li>
                        <li class="{{ request()->is('home/chartview*') ? 'active' : '' }}"><a href="{{route('home.chartview')}}">Cart</a></li>
                        <li class="{{ request()->is('home/transaksi*') ? 'active' : '' }}"><a href="{{route('home.transaksi')}}">Riwayat Transaksi</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div>
</div>

