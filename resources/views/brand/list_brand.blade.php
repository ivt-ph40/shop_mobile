@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Hiển thị</th>
            <th>Ngày thêm</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_brand as $brand)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $brand->name }}</td>
              <td><span class="text-ellipsis">{{ $brand->description }}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($brand->status == 0){
                ?>
                    <a href="{{ URL::to('brand/active/'.$brand->id) }}" style="color:red"><span class="fa-thumb-style fas fa-thumbs-down"></span></a>
                <?php
                  }else{
                ?>
                    <a href="{{ URL::to('brand/unactive/'.$brand->id) }}"><span class="fa-thumb-style fas fa-thumbs-up"></span></a>
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
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection