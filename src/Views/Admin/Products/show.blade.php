@extends('layouts.master')
@section('title')
    List-Categories
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Chi tiết sản phẩm</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                       
                                        <th class="sort" data-sort="customer_name">Key</th>
                                        <th class="sort" data-sort="email">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $product['p_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tên sản phẩm</td>
                                        <td>{{ $product['p_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ảnh</td>
                                        <td>
                                            <img src="{{ $product['p_image'] }}" width="50" height="50"
                                                alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Mô tả</td>
                                        <td style="white-space: normal;">{{ $product['p_description'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Giá</td>
                                        <td>{{ number_format($product['p_price']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng</td>
                                        <td>{{ $product['p_quantity'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Danh mục</td>
                                        <td>{{ $product['c_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-danger edit-item-btn">
                                                        <a href="/admin/products">Quay lại</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find
                                        any orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
