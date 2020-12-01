<base href="{{ asset('') }}">
<div marginheight="0" marginwidth="0" style="background:#f0f0f0">
    <div id="wrapper" style="background-color:#f0f0f0">
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="margin:0 auto;width:600px!important;min-width:600px!important" class="container">
            <tbody>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border-bottom:1px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle" style="width:500px;height:60px">
                                        <a href="#" style="border:0" target="_blank" width="130" height="35" style="display:block;border:0px">
                                            {{-- <img src="{{URL::to('frontend/images/logo.jpg')}}" height="100" width="115" style="display:block;border:0px;float: left;">  --}}
                                            <b style="float: left;line-height: 100px;color: red;font-size: 20px;">Mobile Shop</b>
                                        </a>
                                    </td>
                                    <td align="right" valign="middle" style="padding-right:15px">
                                        <a href="" style="border:0"> 
                                            <img src="https://i.imgur.com/eL1uAJx.png" height="36" width="115" style="display:block;border:0px"> 
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#ff3333;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                                        Thông báo đặt hàng thành công
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                                        Chào <b>{{ $orders->fullname }}</b>!
                                        <br> Cám ơn bạn đã mua sắm tại <b>Mobile Shop</b>
                                        <br>
                                        <br> Đơn hàng của bạn đang 
                                        <b>chờ shop</b>  
                                        <b>xác nhận</b> (trong vòng 24h)
                                        <br> Chúng tôi sẽ thông tin <b>trạng thái đơn hàng</b> trong email tiếp theo.
                                        <br> Bạn vui lòng kiểm tra email thường xuyên nhé.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff">
                        <table style="width:580px;border:1px solid #ff3333;border-top:3px solid #ff3333" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                        <b>Mã đơn hàng của bạn: </b> 
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{ $orders->id }}
                                        </a>
                                        <p>Ngày đặt hàng: ({{ $orders->created_at }})</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                        <b>Người nhận: </b> 
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{ $orders->fullname }}
                                        </a>
                                        <p>Số điện thoại: ({{ $orders->phone }})</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                                        <b>Địa chỉ: </b> 
                                        <a href="#" style="color:#ed2324;font-weight:bold;text-decoration:none" target="_blank">{{ $orders->street }}-{{$orders->ward->name}}-{{$orders->district->name}}-{{$orders->province->name}}
                                        </a>
                                        
                                    </td>
                                </tr>
                                
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            {{-- <th>Tên Shop</th> --}}
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Thành tiền</th>
                                            {{-- <th>Người nhận</th> --}}
                                            {{-- <th>Số điện thoại</th> --}}
                                            {{-- <th>Địa chỉ</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderdetail as $o)
                                        <tr>
                                            <td>{{ $o->product->name }}</td>
                                            {{-- <td>Mobile Shop - 0972 912 878</td> --}}
                                            <td>{{ $o->quantity }}</td>
                                            <td>{{ number_format($o->price) }}</td>
                                            <td>{{ number_format($o->price*$o->quantity) }}</td>
                                            {{-- <td>{{ $orders->fullname }}</td> --}}
                                            {{-- <td>{{ $orders->phone }}</td> --}}
                                            {{-- <td>{{ $orders->street }}-{{$orders->ward->name}}-{{$orders->district->name}}-{{$orders->province->name}}</td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <tr>
                                    <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                                        <a href="#" style="border:0px" target="_blank"> 
                                            <img src="https://i.imgur.com/f92hL68.jpg" height="29" width="191" alt="Chi tiết đơn hàng" style="border:0px"> 
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="background:#ffffff;padding-top:20px">
                        <table style="width:500px" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px"> 
                                        Đây là thư tự động từ hệ thống. Vui lòng không trả lời email này.
                                        <br> Nếu có bất kỳ thắc mắc hay cần giúp đỡ, Bạn vui lòng ghé thăm 
                                        <b style="font-family:Arial,Helvetica,sans-serif;font-size:13px;text-decoration:none;font-weight:bold">Trung tâm trợ giúp</b> của chúng tôi tại địa chỉ: 
                                        <a href="#" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#0066cc;text-decoration:none;font-weight:bold" target="_blank">
                                            help.mobileshop.vn
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> 
</div>