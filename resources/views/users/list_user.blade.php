@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách người dùng
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
            <th>Giới tính</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>
                @if ($user->gender == 1)
                  {{'Nam'}}
                @else
                {{'Nữ'}}
                @endif
              </td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone }}</td>
              <td><span class="text-ellipsis">{{ $user->street }} - {{ $user->ward->name }} - {{ $user->district->name }} - {{ $user->province->name }}</span></td>
              <td>
                <a href="{{route('users.edit', $user->id)}}" class="active" ui-toggle-class=""><button><i class="fa fa-pencil-square-o text-success text-active"></i></button></a>
              </td>
              <td>
                <form action="{{route('users.destroy', $user->id)}}" method="post">
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