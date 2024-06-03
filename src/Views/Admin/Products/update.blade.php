@extends('layouts.master')
@section('title')
    Add-Products
@endsection
@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center mb-3">
        <div class="col-10">
            <h2 class="text-center">Cập nhập sản phẩm</h2>
            <div class="row">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                        <option selected>Chọn danh mục cho sản phẩm</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" {{ $product['c_name'] == $category['name'] ? 'selected': '' }}>{{ $category['name'] }}</option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="employeeName" name="name" value="{{ $product['p_name'] }}"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Giá sản phẩm</label>
                        <input type="price" class="form-control" id="employeeName" name="price" value="{{ $product['p_price'] }}"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Số lượng sản phẩm</label>
                        <input type="price" class="form-control" id="employeeName" name="quantity" value="{{ $product['p_quantity'] }}"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3 m">
                        <label for="employeeName" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="employeeName" name="image" value="{{ $product['p_image'] }}"
                            placeholder="Enter emploree name">
                            <img src="{{ $product['p_image'] }}" width="50" height="50" alt="">
                    </div>
                    
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="productDescription" name="description" value="" rows="4"
                            placeholder="Nhập mô tả sản phẩm">{{ $product['p_description'] }}</textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập nhập sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
