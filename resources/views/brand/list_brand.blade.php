@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu
    </div>
    <div class="table-responsive">
      @if (Session::get('message'))
        <p style="color:red" align="center">{{Session::get('message')}}</p>
      @endif
      @if (Session::get('thongbao'))
        <p style="color:red" align="center">{{Session::get('thongbao')}}</p>
      @endif
      @if (Session::get('thongbao1'))
        <p style="color:red" align="center">{{Session::get('thongbao1')}}</p>
      @endif
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Id</th>
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Hiển thị</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_brand as $brand)
            <tr>
              <td>{{$brand->id}}</td>
              <td>{{ $brand->name }}</td>
              <td><span class="text-ellipsis">{{ $brand->description }}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($brand->status == 0){
                ?>
                    <a href="{{ URL::to('brand/active/'.$brand->id) }}" style="color:red; width: 30px"><i class="fas fa-lock"></i></a>
                <?php
                  }else{
                ?>
                    <a href="{{ URL::to('brand/unactive/'.$brand->id) }}" style="width: 30px"><i class="fas fa-lock-open"></i></a>
                <?php
                  }
                 ?>
              </span></td>
              <td>
                <a href="{{ URL::to('brand/edit/'.$brand->id) }}" class="active" ui-toggle-class=""><button><i class="fa fa-pencil-square-o text-success text-active"></i></button></a>
                {{-- <a href="{{ URL::to('brand/delete/'.$brand->id) }}" class="active" ui-toggle-class="" style="float:right" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></a> --}}
              </td>
              <td>
                <form action="{{ route('brand.delete', $brand->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></button>
                </form>
              </td>
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
    </div>
  </div>
  {{$list_brand->links()}}
</div>
@endsection