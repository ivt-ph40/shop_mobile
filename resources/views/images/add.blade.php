@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thư viện ảnh
            </header>
            <br>
            @if (Session::get('message'))
                <h4 align="center" style="color:red">{{ Session::get('message') }}</h4>
            @endif
            <form action="{{url('/insert_image/'.$pro_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="file[]" id="file" accept="image/*" class="form-control" multiple>
                        <span id="error_image"></span>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="upload" class="btn btn-primary" value="Tải ảnh">
                    </div>
                </div>
            </form>
            <div class="panel-body">
                <input type="hidden" name="pro_id" id="inputPro_id" class="pro_id" value="{{$pro_id}}">
                <form action="" method="post">
                @csrf
                <div id="image_load">
                    {{-- <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên hình ảnh</th>
                                <th>Hình ảnh</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ạaajakj</td>
                                <td>ạaajakj</td>
                                <td>ạaajakj</td>
                                <td>ạaajakj</td>
                            </tr>
                        </tbody>
                    </table> --}}
                </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection