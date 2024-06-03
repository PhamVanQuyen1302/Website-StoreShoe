@extends('layouts.master')
@section('title')
    Update-Categories
@endsection
@section('content')
    <div class="col-5">
        <div class="row">
            <form action="" enctype="multipart/form-data" method="POST" class="row g-3">
                <div class="col-md-12">
                    <label for="fullnameInput" class="form-label">Kích cỡ</label>
                    <input type="text" class="form-control" id="fullnameInput" name="size" value="{{ $size['size'] }}"
                        placeholder="Enter your name">
                </div>
                @if (!empty($_SESSION['err']))
                    @foreach ($_SESSION['err'] as $error)
                        <span class="text-danger">{{ $error }}</span><br>
                    @endforeach
                    @php
                        unset($_SESSION['err']);
                    @endphp
                @endif
                <div class="col-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Cập nhập Kích cỡ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection