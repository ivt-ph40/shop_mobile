@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua hàng
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên tài khoản</th>
            <th>Họ tên</th>
            <th>Địa chỉ</th>
          </tr>
        </thead>
        <tbody>
          
            <tr>
              
              <td>
                @if ($orders->user == null)
                  {{null}}
                @else
                {{ $orders->user->name }}
                @endif
              </td>
              <td>{{ $orders->fullname }}</td>
              <td><span class="text-ellipsis">{{ $orders->street }} - {{ $orders->ward->name }} - {{ $orders->district->name }} - {{ $orders->province->name }}</span></td>
              <td>
          </tr>
         
          
          
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông đơn hàng
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            {{-- <th>id</th> --}}
            <th>Mã đơn hàng</th>
            <th>Số lượng tồn kho</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 0;
          @endphp
          @foreach ($orderDetail as $o_det)
          @php
            $i++;
          @endphp
            <tr>
              <td>{{$i}}</td>
              {{-- <td>{{$o_det->id}}</td> --}}
              <td>{{$o_det->order_id}}</td>
              <td>{{$o_det->product_qty}}</td>
              <td>{{ $o_det->name }}</td>
              <td>
                <input style="width: 50px" type="text" disabled="" name="product_qty" class="product_qty" value="{{ $o_det->quantity }}" onlyread>
                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$o_det->product_id}}">
              </td>
              <td>$ {{ number_format($o_det->price) }}</td>
              <td>$ {{ number_format($o_det->price*$o_det->quantity) }}</td>
          </tr>
          @endforeach
          <tr>
              <th colspan="6">Tổng thanh toán</th>
              <th></th>
          </tr>
          
          
        </tbody>
      </table>
      <form action="" method="post">
        @csrf
        <label for="">Tình trạng đơn hàng</label>
        <select style="width: 200px" name="status_id" id="input" class="form-control order_details" required="required">
          <option value="">--Chọn trạng thái--</option>
          @foreach ($order_status as $status)
            <option id="{{$orders->id}}" 
            @if ($statusId->contains($status->id))
              {{'selected'}}
            @endif
             value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
      </form>
    </div>
    
  </div>
</div>
@endsection