@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê tất cả các loại sản phẩm
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
            <th>Tên danh mục</th>
            <th>Tên Slug</th>
            <th>Mô tả</th>
            <th>Hiển thị</th>
            {{-- <th>Parent Id</th> --}}
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_category as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->slug }}</td>
              <td><span class="text-ellipsis">{{ $category->description }}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($category->status == 0){
                ?>
                    <a href="{{ URL::to('category/active/'.$category->id) }}" style="color:red; width: 30px"><i class="fas fa-lock"></i></a>
                <?php
                  }else{
                ?>
                    <a href="{{ URL::to('category/unactive/'.$category->id) }}" style="width: 30px"><i class="fas fa-lock-open"></i></a>
                <?php
                  }
                 ?>
              </span></td>
              {{-- <td><span class="text-ellipsis">
                @if ($category->parent_id == null)
                  {{0}}
                  @else
                  {{ $category->parent_id }}
                @endif
              </span></td> --}}
              <td>
                <a href="{{ URL::to('category/edit/'.$category->id) }}" class="active" ui-toggle-class=""><button><i class="fa fa-pencil-square-o text-success text-active"></i></button></a>
                {{-- <a href="{{ URL::to('category/delete/'.$category->id) }}" class="active" ui-toggle-class="" style="float:right" onclick="return confirm('Are you sure delete?')"><i class="fa fa-times text-danger text"></i></a> --}}
              </td>
              <td>
                <form action="{{ route('category.delete', $category->id) }}" method="post">
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
  {{$list_category->links()}}

</div>
@endsection