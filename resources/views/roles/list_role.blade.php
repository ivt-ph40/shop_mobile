@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách vai trò
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
            <th>Tên</th>
            <th>Mô tả</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
            <tr>
              <td>{{ $role->id }}</td>
              <td>{{ $role->name }}</td>
              <td>{{ $role->display_name }}</td>
              <td>
                <a href="{{route('roles.edit', $role->id)}}" class="active" ui-toggle-class=""><button><i class="fa fa-pencil-square-o text-success text-active"></i></button></a>
              </td>
              <td>
                <form action="{{route('roles.destroy', $role->id)}}" method="post">
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
  </div>
</div>
@endsection