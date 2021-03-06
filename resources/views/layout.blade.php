<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bán hàng thương mại điện tử">
    <meta name="author" content="">
    <meta name="robots" content="INDEX,FOLLOW" /> 
    <meta name="keywords" content="điện thoại di dộng, máy tính bảng, dien thoai chinh hang, may tinh xach tay, laptop chinh hang, phu kien laptop, điện thoại, dien thoai di dong,may tinh bang">
    <meta name="title" content="Mobileshop.com | Điện thoại, Laptop, Tablet, Phụ kiện chính hãng giá tốt nhất">
    <link rel="canonical" href="http://mobileshop.com"/>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">​ --}}
    <title>Công nghệ - Shop</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettify.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="icon" href="{{asset('frontend/images/Logo4-1.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="frontend/images/ico/apple-touch-icon-57-precomposed.png">
    <style>
        #img_hau{width: 20px; height: 25px; border-radius: 50%;}
        .left-sidebar h2, .brands_products h2 {color: #3f0ffe;}
        .shop-menu ul li a {color: #054b02; font-size: 16px; margin-top: 57px;font-weight: bold;}

        .header-middle .container .row {border-bottom: 7px solid #9b0205;}
        .fa-plus {color: #054b02;}
        .category-products .panel-default .panel-heading .panel-title a {color: #9b0205;}
        .panel-body ul li a {color: #0b7094;}
        .brands-name .nav-stacked li a {background-color: #decccc; color: #9b0205;}
        .category-products {background: #decccc;}
        .category-products .panel-default .panel-heading {background-color: #decccc;}
        .item h1 span {color: #074b04;}
        .item h1 {color: #9b0205;}
        .left-sidebar h2, .brands_products h2 {color: #054b02;}
        .companyinfo h2 span {color: #11540e;}
        .companyinfo h2 {color: #9b0205;}
    </style>
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +0972 912 878</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> vanhauqld45@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('home.index') }}"><img id="img_a" src="{{asset('frontend/images/Logo4-1.png')}}" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @if (Session::get('id'))
                                    @if (count(Session::get('role_id')))
                                        <li><a href="{{route('admin.show_dashboard')}}"><i class="fas fa-user-cog"></i>Quản trị viên</a></li>
                                    @else
                                        {{''}}
                                    @endif
                                @endif
                                
                                <li><a href="#"><i class="fa fa-star"></i>Yêu thích</a></li>
                                <li><a href="{{route('users.showLoginForm')}}"><i class="fa fa-crosshairs"></i>Thanh toán</a></li>
                                <li><a href="{{route('cart.giohang')}}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                @if (Session::get('id') != null)
                                    <li class="dropdown">
                                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                            @if (Session::get('image'))
                                                <img alt="" id="img_hau" src="{{ URL::to('upload/users/'.(Session::get('image'))) }}">
                                            @endif
                                            <span class="username">
                                                @if (Session::get('name'))
                                                    {{Session::get('name')}}
                                                @endif
                                            </span>
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu extended logout">
                                            @if (Session::get('id'))
                                            <li><a href="{{route('users.info_profile', Session::get('id'))}}"><i class=" fa fa-suitcase"></i>Thông tin cá nhân</a></li>
                                            @endif
                                            <li><a href="{{route('users.show_profile')}}"><i class="fa fa-cog"></i>Cài đặt</a></li>
                                            
                                            <li><a href="{{ route('users.logout') }}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{route('users.showLoginForm')}}"><i class="fa fa-lock"></i>Đăng nhập</a></li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/') }}" class="active"><i class="fas fa-home"></i>&nbsp;Trang chủ</a></li>
                                {{-- <li class="dropdown"><a href="#">Sản phẩm theo thương hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($listBrand as $brand)
                                            <li><a href="{{ URL::to('category/statusby/'.$brand->id) }}">
                                                @if ($cat->parent_id == 0)
                                                    {{$brand->name}}
                                                @endif
                                            </a></li>
                                        @endforeach 
                                    </ul>
                                </li>  --}}
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    {{-- <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul> --}}
                                </li> 
                                {{-- <li><a href="{{route('cart.index')}}">Giỏ hàng</a></li> --}}
                                <li><a href="{{route('contact.showContactForm')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <form action="{{route('home.search')}}" method="post">
                        {{-- @method('get') --}}
                        @csrf
                        <div class="col-sm-5">
                            <div class="search_box pull-right">
                                @if (isset($value_search))
                                    <input type="text" name="search" value="{{$value_search}}" placeholder="Search..."/>
                                    @else
                                    <input type="text" name="search" value="" placeholder="Search..."/>
                                @endif
                                
                                <button type="submit" class="btn btn btn-danger"><i class="fas fa-search"></i></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <img src="{{asset('frontend/images/tri-tue-nhan-tao2.jpg')}}" class="girl img-responsive" alt="" />
                                    {{-- <img src="{{('frontend/images/bigsale.png')}}"  class="pricing" alt="" /> --}}
                                </div>
                                <div class="col-sm-6">
                                    <h1><span>CÔNG NGHỆ</span>-SHOP</h1>
                                    <h2>Thỏa sức kết nối cùng đam mê</h2>
                                    <h4>Giá cả siêu sẽ, siêu bất ngờ!</h4>
                                    {{-- <button type="button" class="btn btn-default get">Đi thôi!</button> --}}
                                </div>
                                
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <img src="{{asset('frontend/images/tri-tue-nhan-tao.jpg')}}" class="girl img-responsive" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <h1><span>CÔNG NGHỆ</span>-SHOP</h1>
                                    <h2>100% Hàng chính hãng</h2>
                                    <h4>Mua sắm thả ga không lo về giá!</h4>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <img src="{{asset('frontend/images/slide1.jpg')}}" class="girl img-responsive" alt="" />
                                </div>
                                <div class="col-sm-6">
                                    <h1><span>CÔNG NGHỆ</span>-SHOP</h1>
                                    <h2>Mau đi nào!</h2>
                                    <h4>Hãy đến ngay với chúng tôi. Bạn còn chần chờ gì nữa!</h4>
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach ($listCategory as $key=> $categories)
                            
                            <div class="panel panel-default">
                                @if ($categories->parent_id == 0)
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$categories->slug}}"><span class="badge pull-right"><i class="fa fa-plus"></i></span>{{$categories->name}}</a>
                                        </h4>
                                    </div>  
                                    <div id="{{$categories->slug}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($listCategory as $key=> $cat)
                                                    @if ($cat->parent_id == $categories->id)
                                                        <li><a href="{{ URL::to('category/statusby/'.$cat->id) }}">{{$cat->name}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div> 
                                @endif
                            </div>
                            
                                {{-- {{ URL::to('category/statusby/'.$categories->id) }} --}}
                            @endforeach
                            
                            {{-- @php
                                showCategories($listCategory);
                            @endphp --}}

                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                @foreach ($listBrand as $brand)
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ URL::to('brand/statusby/'.$brand->id) }}"> <span class="pull-right"></span>{{$brand->name}}</a></li>
                                </ul>
                                @endforeach
                            </div>
                        </div><!--/brands_products-->
                        
                        {{-- <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{asset('frontend/images/Robot-thông-minh_1.jpg')}}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>Công nghệ</span>-shop</h2>
                            <p>Địa chỉ: 92 Quang Trung, Q. Hải Châu, TP. Đà Nẵng - Điện thoại : 02363 888 279</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('frontend/images/laptopdell.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Brand Dell</p>
                                <h2>24 DEC 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('frontend/images/macbook2.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Brand Apple</p>
                                <h2>24 DEC 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('frontend/images/huawei1.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Brand Huawei</p>
                                <h2>24 DEC 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('frontend/images/galaxy3.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Brand Samsang</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2020 CÔNG NGHỆ-SHOP Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>

    <script src="{{asset('frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('frontend/js/prettify.js')}}"></script>
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="607YfmOT"></script>
    <script src="{{asset('frontend/ckeditor/ckeditor.js')}}"></script>

</body>
</html>

@php
function showCategories($categories, $parent_id = 0, $char = '')
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        echo '<div class="panel panel-default">';
        echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
            // Hiển thị tiêu đề chuyên mục
            echo "<h4 class='panel-title'><li><a href='http://mobileshop.com/category/statusby/"."$item->id'>".$char.$item->name;
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item->id, $char.'- ');
            echo '</a></li></h4>';

        }

        echo '</ul>';
        echo '<br>';
        echo '</div>';
    }
}
@endphp
{{-- ajax mua hàng --}}
<script>
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            // alert('ssdjdj');
            var id = $(this).data('id');
            // alert(id)
            var product_id = $('.product_id').val();
            var name = $('.product_name').val();
            var price = $('.product_price').val();
            var quantity = $('.product_qty').val();
            var image = $('.product_image').val();
            var quantity_kho = $('.quantity_kho').val();
            var _token = $('input[name="_token"]').val();
            // alert(_token)
            if(parseInt(quantity) > parseInt(quantity_kho)){
                swal("Bạn đã đặt quá số lượng hiện có!", "Vui lòng đặt lại cho phù hợp!");
            }else{
                $.ajax({
                    url: '{{url('/cart/add_by_ajax')}}',
                    method: 'post',
                    data: {
                        product_id: product_id,
                        name: name,
                        price: price,
                        quantity: quantity,
                        quantity_kho: quantity_kho,
                        image: image,
                        _token: _token
                    },
                    success:function(data){
                        // alert(product_id)

                        swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/giohang')}}";
                        });
                    }
                });
            }
        });
    });
</script>
{{-- ajax mua hàng --}}

{{-- truyền trình soạn thảo văn bản vào --}}
<script>
    CKEDITOR.replace('ckeditor3');
</script>
{{-- truyền trình soạn thảo văn bản vào --}}

{{-- thông báo khi vượt quá số lượng đặt hàng --}}
<script>
    $(document).ready(function(){
        $('.product_qty').change(function(){
            var quantity = parseInt($(this).val());
            // var product_kho = $(this).attr('data-totalQty');
            // var quantity_daorder = $(this).attr('data-daOrder');
            // var total_order = var quantity_daorder + var quantity;
            // alert(quantity_daorder)
            if(quantity < 0){
                swal("Không được phép nhập số lượng âm!");
                // location.reload();
            }
            if(quantity > 10){
                swal("Số lượng đặt hàng vượt quá giới hạn cho phép là 10!");
                // location.reload();
            }
            if(isNaN(quantity)){
                swal("Số lượng đặt hàng không đúng định dạng số!");
                // location.reload();
            }
            // if(quantity > product_kho){
            //     alert('Số lượng đặt hàng đã lớn hơn số lượng hàng còn trong kho!');
            //     location.reload();
            // }
        });
    });
</script>

{{-- làm gallay-image --}}
<script>
    $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:4,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>

{{-- Sort sản phẩm --}}
<script>
    $(document).ready(function(){
        $('#sort').change(function(){
            var url = $(this).val();
            if(url){
                window.location = url;
            }
            return false;
        });
    });
</script>
{{-- Sort sản phẩm --}}


{{-- TAO COMMENT SP --}}
<script type="text/javascript">
    $(document).ready(function(){
        load_comment();
        function load_comment()
        {
            var product_id = $('.com_product_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(product_id)
            $.ajax({
                url: '{{url("/load_comment")}}',
                method: 'post',
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success:function(data){
                    $('#show_comment').html(data);
                }
            });
        }
        $('.add_comment').click(function(){
            var product_id = $('.com_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/add_comment')}}',
                method: 'post',
                data: {
                    product_id:product_id,
                    comment_name:comment_name,
                    comment_content:comment_content,
                    _token:_token,
                },
                success:function(data){
                    $('.notify').html('<p class="text-danger" style="color:red">Thêm bình luận thành công!</p>');
                    load_comment();
                    $('.notify').fadeOut(4000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                }
            });
        });
        /*$(document).on('click', '.reply', function(){
            var parent_comment_id = $(this).attr('id');
            var product_id = $('.com_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var user_id = $('.userId').val();
            var _token = $('input[name="_token"]').val();
            $('.comment_content').focus();
            $.ajax({
                url: '{{url("/reply_comment")}}',
                method: 'post',
                data: {
                    parent_comment_id:parent_comment_id,
                    product_id:product_id,
                    comment_name:comment_name,
                    comment_content:comment_content,
                    _token:_token
                },
                success:function(data){
                    $('.notify').html('<p class="text-danger" style="color:red">Thêm bình luận thành công!</p>');
                }
            });

        });*/
    });
</script>
{{-- TAO COMMENT SP --}}

{{-- ĐÁNH GIÁ SP --}}
<script type="text/javascript">
    //hàm khi sao ko được chọn sẽ là màu nâu
    function notSelect_by_proId(product_id){
        for (var count = 1; count <= 5 ; count++){
            $('#'+product_id+'-'+count).css('color', '#ccc');
        }
        listRatingText = {
            1: 'Không thích',
            2: 'Tạm được',
            3: 'Bình thường',
            4: 'Rất tốt',
            5: 'Tuyệt vời'
        }
    }
    //hover chuột đánh giá sao
    $(document).on('mouseenter', '.rating', function(){
        
        var index = $(this).data('index');
        var product_id = $(this).data('pro_id');
        $('.text').text(listRatingText[index]).show();
        notSelect_by_proId(product_id);
        for (var count = 1; count <= index ; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });
    //nha chuot khong danh gia
    $(document).on('mouseleave', '.rating', function(){
        // $('.text').text('').show();
        var index = $(this).data('index');
        var product_id = $(this).data('pro_id');
        // var rating = $(this).data('rating');
        notSelect_by_proId(product_id);
        for (var count = 1; count <= index ; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });
    $(document).on('click', '.rating', function(){
        var index = $(this).data('index');
        var product_id = $(this).data('pro_id');
        $('.text').text(listRatingText[index]).show();
        notSelect_by_proId(product_id);
        for (var count = 1; count <= index ; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
        $(document).on('click', '.add_review', function(){
            var star = $(this).data('star');
            var product_id = $(this).data('pro_id');
            var fullname = $('.review_name').val();
            var content = $('.review_content').val();
            alert(star)
            // alert(product_id)
            // alert(fullname)
            // alert(content)
        });
        // var _token = $('input[name="_token"]').val();
        // $.ajax({
        //     url: "{{url('add_rating')}}",
        //     method: 'post',
        //     data: {
        //         index:index,
        //         product_id:product_id,
        //         _token:_token
        //     },
        //     success:function(data){
        //         if(data == 'done'){
        //             alert("Bạn đã đánh giá "+index+" trên 5 sao");
        //             location.reload();
        //         }else{
        //             alert('Lỗi đánh giá!');
        //         }
        //     }
        // });
    });
</script>




{{-- <script type="text/javascript">
    //hàm khi sao ko được chọn sẽ là màu nâu
    function notSelect_by_proId(product_id){
        for (var count = 1; count <= 5 ; count++){
            $('#'+product_id+'-'+count).css('color', '#ccc');
        }
        listRatingText = {
            1: 'Không thích',
            2: 'Tạm được',
            3: 'Bình thường',
            4: 'Rất tốt',
            5: 'Tuyệt vời'
        }
    }
    //hover chuột đánh giá sao
    $(document).on('mouseenter', '.rating', function(){
        
        var index = $(this).data('index');
        var product_id = $(this).data('pro_id');
        $('.text').text('').text(listRatingText[index]).show();
        notSelect_by_proId(product_id);
        for (var count = 1; count <= index ; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });
    //nha chuot khong danh gia
    $(document).on('mouseleave', '.rating', function(){
        $('.text').text('').show();
        var index = $(this).data('index');
        var product_id = $(this).data('pro_id');
        var rating = $(this).data('rating');
        notSelect_by_proId(product_id);
        for (var count = 1; count <= rating ; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });
    $(document).on('click', '.rating', function(){
        var index = $(this).data('index');
        // alert(index)
        var product_id = $(this).data('pro_id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('add_rating')}}",
            method: 'post',
            data: {
                index:index,
                product_id:product_id,
                _token:_token
            },
            success:function(data){
                if(data == 'done'){
                    alert("Bạn đã đánh giá "+index+" trên 5 sao");
                    location.reload();
                }else{
                    alert('Lỗi đánh giá!');
                }
            }
        });
    });
</script> --}}