@extends('layout')
@section('content')
    <form action="{{route('contact.sendMail')}}" method="POST" role="form">
        @csrf
        <legend>Liên hệ người dùng</legend>
    
        <div class="form-group">
            <label for="">Your Mail</label>
            <input type="text" class="form-control" name="email" id="" placeholder="Input field">
        </div>
        <div class="form-group">
            <label for="">Your Question</label>
            <textarea name="content" style="resize: none; border:1px solid; border-radius: 5px" id="ckeditor3" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

