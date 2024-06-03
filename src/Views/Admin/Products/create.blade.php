@extends('layouts.master')
@section('title')
    Add-Products
@endsection
@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <h2 class="text-center">Thêm sản phẩm</h2>
            <div class="row">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="form-select mb-3" name="category_id" aria-label="Default select example">
                        <option selected>Chọn danh mục cho sản phẩm</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>

                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="employeeName" name="name"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Giá sản phẩm</label>
                        <input type="price" class="form-control" id="employeeName" name="price"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Số lượng sản phẩm</label>
                        <input type="price" class="form-control" id="employeeName" name="quantity"
                            placeholder="Enter emploree name">
                    </div>
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="employeeName" name="image"
                            placeholder="Enter emploree name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4"
                            placeholder="Nhập mô tả sản phẩm"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
