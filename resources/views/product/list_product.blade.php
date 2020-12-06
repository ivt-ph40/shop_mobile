@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
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
            <th>Id</th>
            <th>Tên sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Loại sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Mô tả</th>
            {{-- <th>Nội dung</th> --}}
            <th>Số lượng</th>
            <th>Giảm giá(%)</th>
            <th>Hình ảnh</th>
            <th>Trạng thái</th>  
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_product as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td><a href="{{ url('/image/add/'.$product->id) }}">Thêm thư viện ảnh</a></td>
              <td>{{ $product->category->name }}</td>
              <td>{{ $product->brand->name}}</td>
              <td><span class="text-ellipsis">{{ $product->description }}</span></td>
              {{-- <td><span class="text-ellipsis">{{ $product->content }}</span></td> --}}
              <td><span class="text-ellipsis">{{ $product->quantity }}</span></td>
              <td><span class="text-ellipsis">{{ $product->discount }}</span></td>
              <td><img src="upload/product/{{ $product->image }}" height="40px" alt=""></td>
              
              <td><span class="text-ellipsis">
                <?php
                  if($product->status == 0){
                ?>
                    <a href="{{ URL::to('product/active/'.$product->id) }}" style="color:red; width: 30px"><i class="fas fa-lock"></i></a>
                <?php
                  }else{
                ?>
                    <a href="{{ URL::to('product/unactive/'.$product->id) }}" style="width: 30px"><i class="fas fa-lock-open"></i></a>
                <?php
                  }
                 ?>
              </span></td>
              <td>
                <a href="{{ URL::to('product/edit/'.$product->id) }}" class="active" ui-toggle-class=""><button><i class="fa fa-pencil-square-o text-success text-active"></i></button></a>
              </td>
              <td>
                <form action="{{ route('product.delete', $product->id) }}" method="post">
                  @method('delete')
                  @csrf
                  <button type="submit" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></button>
                </form>
                {{-- <a href="{{ URL::to('product/delete/'.$product->id) }}" class="active" ui-toggle-class="" style="float:right" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></a> --}}
              </td>
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
    </div>
  </div>
  {{$list_product->links()}}
</div>
@endsection