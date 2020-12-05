<!DOCTYPE html>
<head>
<title>Admin layout Pages</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('backend/css/font.css" type="text/css')}}"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.js')}}"></script>

<link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.6.3/css/all.css')}}">

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                @if (Session::get('image'))
                    <img alt="" src="{{URL::to('upload/users/'.Session::get('image'))}}">
                @endif
                <span class="username">
                    @if (Session::get('name'))
                        {{Session::get('name')}}
                    @endif
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                {{-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                <li><a href="{{ route('users.logout') }}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="" href="{{ route('home.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="{{ route('admin.show_dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{route('order.index')}}">
                        <i class="fa fa-book"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục thể loại sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('category.add_category') }}">Thêm danh mục</a></li>
                        <li><a href="{{ route('category.index') }}">Liệt kê danh mục</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục thương hiệu</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{ route('brand.add_brand') }}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{ route('brand.index') }}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('product.add_product') }}">Thêm sản phẩm</a></li>
                        <li><a href="{{ route('product.index') }}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('users.create')}}">Thêm người dùng</a></li>
                        <li><a href="{{route('users.index')}}">Danh sách người dùng</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Quản lý vai trò</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('roles.create')}}">Thêm vai trò</a></li>
                        <li><a href="{{route('roles.index')}}">Danh sách vai trò</a></li>
                    </ul>
                </li>
                
                {{-- <li>
                    <a href="login.html">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
                </li> --}}
            </ul>           
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
		
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>

{{-- chọn thư viện ảnh cho sản phẩm --}}
<script>
    $(document).ready(function(){
        load_image();
        function load_image(){
            var pro_id = $('.pro_id').val();
            var _token = $("input[name='_token']").val();
            // alert(pro_id)
            $.ajax({
                url: "{{url('/select_image')}}",
                method: 'post',
                data: {
                    pro_id : pro_id,
                    _token : _token
                },
                success:function(data){
                    $('#image_load').html(data);
                }
            });
        }
        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;
            if (files.length > 4){
                error += '<p>Bạn chỉ được chọn tối đa 4 ảnh</p>';
            } else if(files.length == ''){
                error += '<p>Bạn không được phép bỏ trống</p>';
            } else if(files.size > 2000000){
                error += '<p>File ảnh không được lớn hơn 2MB</p>';
            }
            if(error == ''){

            } else{
                $('#file').val('');
                $('#error_image').html('<span class="text-danger">'+error+'</span>');
                return flase;
            }
        });
        $(document).on('blur', '.edit_image_name', function(){
            var img_id = $(this).data('img_id');
            var img_text = $(this).text();
            var _token = $("input[name='_token']").val();
            $.ajax({
                url: '{{url('/update/image_name')}}',
                method: 'post',
                data: {
                    img_id:img_id,
                    img_text:img_text,
                    _token:_token
                },
                success:function(data){
                    load_image();
                    $('#error_image').html('<span class="text-danger">Cập nhật tên ảnh thành công!</span>');
                }
            });
        });
        $(document).on('click', '.delete_image', function(){
            var img_id = $(this).data('id');
            var _token = $("input[name='_token']").val();
            if (confirm('Bạn có chắc chắn muốn xóa?')){
                $.ajax({
                    url: '{{url('/delete_image')}}',
                    method: 'post',
                    data: {
                        img_id: img_id,
                        _token: _token
                    },
                    success:function(data){
                        load_image();
                        $('#error_image').html('<span class="text-danger">Xóa thành công!</span>');
                    }
                });
            }
        });
        $(document).on('change', '.file_image', function(){
            var img_id = $(this).data('img_id');
            var image = document.getElementById('file-'+img_id).files[0];
            var form_data = new FormData();
            form_data.append("file", image);
            form_data.append("img_id", img_id);
            $.ajax({
                url: '{{url('/update_image')}}',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    load_image();
                    $('#error_image').html('<span class="text-danger">Cập nhật thành công!</span>');
                }
            });
        });
    });
</script>
{{-- chọn thư viện ảnh cho sản phẩm --}}

<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
    {{-- <script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
    <script> 
    CKEDITOR.replace('ckeditor1'); 
    CKEDITOR.replace('ckeditor2'); 
    </script> --}}

    {{-- quản lý order --}}
    <script>
        $('.order_details').change(function(){
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();
            // alert(_token)
            //lay so luong
            quantity = [];
            $('input[name="product_qty"]').each(function(){
                quantity.push($(this).val());
            });

            //lay order_id
            order_product_id = [];
            $('input[name="order_product_id"]').each(function(){
                order_product_id.push($(this).val());
            });
            $.ajax({
                url : "{{url('/order/update-order-quantity')}}",
                method : 'post', 
                data : {
                    order_status : order_status,
                    order_id : order_id, 
                    _token : _token,
                    quantity : quantity,
                    order_product_id : order_product_id
                },
                success:function(data){
                    alert('Cập nhật thành công!');
                    location.reload();
                }
            });
        });
    </script>
	<!-- //calendar -->
</body>
</html>
