@extends('layouts.master')
@section('title')
    Update-ProductProperties
@endsection
@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <h2 class="text-center">Thêm thuộc tính sản phẩm</h2>
            <div class="row">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="form-select mb-3" name="product_id" aria-label="Default select example">
                        <option selected>Chọn sản phẩm</option>
                        @foreach ($products as $product)
                            <option value="{{ $product['id'] }}" {{ ($properties['p_name'] == $product['name']) ? 'selected': '' }}>{{ $product['name'] }}</option>
                        @endforeach
                    </select>
    
                    <select class="form-select mb-3" name="size_id" aria-label="Default select example">
                        <option selected>Chọn kích cỡ sản phẩm</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size['id'] }}" {{ ($properties['sizes'] == $size['size']) ? 'selected': '' }}>{{ $size['size'] }}</option>
                        @endforeach
                    </select>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập nhập thuộc tính</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
