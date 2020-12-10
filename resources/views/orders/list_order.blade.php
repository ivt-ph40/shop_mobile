@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khách hàng đã đặt hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">             
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      @if (session()->has('message'))
        <div class="alert alert-primary" role="alert" style="color:red" align="center">
          {{session()->get('message')}}
        </div>
      @endif
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>STT</th>
            <th>id</th>
            <th>Tài khoản</th>
            <th>Họ tên</th>
            <th>email</th>
            <th>Địa chỉ</th>
            <th>Tình trạng</th>
            <th>Số điện thoại</th>  
            <th>Ngày đặt</th>  
            <th colspan="2">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 0;
          @endphp
          @foreach ($orders as $order)
          @php
            $i++;
          @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{ $order->id }}</td>
              <td>
                @if ($order->user == null)
                  {{null}}
                @else
                {{ $order->user->name }}
                @endif
              </td>
              <td>{{ $order->fullname }}</td>
              <td>{{ $order->email }}</td>
              <td><span class="text-ellipsis">{{ $order->street }} - {{ $order->ward->name }} - {{ $order->district->name }} - {{ $order->province->name }}</span></td>
              <td>
                @if ($order->order_status->id == 1)
                  <button style="width: 100px" class="btn-primary">{{$order->order_status->name}}</button>
                @elseif($order->order_status->id == 2)
                <button style="width: 100px" class="btn-success">{{$order->order_status->name}}</button>
                @elseif($order->order_status->id == 3)
                <button style="width: 100px" class="btn-success">{{$order->order_status->name}}</button>
                @elseif($order->order_status->id == 4)
                <button style="width: 100px" class="btn-danger">{{$order->order_status->name}}</button>
                @endif
              </td>
              <td><span class="text-ellipsis">{{$order->phone}}</span></td>
              <td>{{ $order->created_at }}</td>
              <td><a href="{{route('order.view_order', $order->id)}}"><button><i class="fas fa-eye"></i></button></a></td>
              <td>
                <form action="" method="post">
                  @method('delete')
                  @csrf
                  <button type="submit" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></button>
                </form>
              </td>
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $orders->links() }}
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection
