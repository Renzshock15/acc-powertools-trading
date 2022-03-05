@include('layouts.office.header1')

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <div class="d-md-none mt-3">
                    <div class="text-center">
                        <img src="../../images/uploads/profiles/{{ Auth::user()->image }}" alt="user-img" width="100" class="img-circle" style="border-radius:50%">
                    </div>
                    <div class="text-center m-2">
                        <span class="font-medium">{{Auth::user()->first_name}}</span>
                    </div>
                </div>
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../dashboard" aria-expanded="false"><i class="fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Home</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="../product" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-tag" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Products</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false"><i class="fas fa-boxes" aria-hidden="true"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../stock_receive" aria-expanded="false"><i class="fas fa-arrow-left ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Receive</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../factory_defect" aria-expanded="false"><i class="fas fa-warehouse ml-3" aria-hidden="true"></i><span class="hide-menu">Factory Defect</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../deliveries" aria-expanded="false"><i class="fas fa-truck" aria-hidden="true"></i><span class="hide-menu">Deliveries</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../transaction" aria-expanded="false"><i class="far fa-clipboard" aria-hidden="true"></i><span class="hide-menu">Transactions</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../repairs" aria-expanded="false"><i class="fas fa-wrench" aria-hidden="true"></i><span class="hide-menu">Repairs</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../profile" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link other-button" role="button" aria-expanded="false"><i class="fas fa-layer-group" aria-hidden="true"></i><span class="hide-menu">Others</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="other-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../brands" aria-expanded="false"><i class="fa fa-tags ml-3" aria-hidden="true"></i><span class="hide-menu">Brands</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../suppliers" aria-expanded="false"><i class="fas fa-user-friends ml-3" aria-hidden="true"></i><span class="hide-menu">Suppliers</span></a></li>
                </div>
                @if(Auth::user()->role->name === 'Full')
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link admin-button" role="button" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i><span class="hide-menu">Admin</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="admin-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../users" aria-expanded="false"><i class="fa fa-users ml-3" aria-hidden="true"></i><span class="hide-menu">Users</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../locations" aria-expanded="false"><i class="fas fa-location-arrow ml-3" aria-hidden="true"></i><span class="hide-menu">Locations</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../others" aria-expanded="false"><i class="fas fa-users-cog ml-3" aria-hidden="true"></i><span class="hide-menu">Others</span></a></li>
                </div>
                @endif

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span class="hide-menu">Logout</span></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="blank.html" aria-expanded="false"><i class="fa fa-columns" aria-hidden="true"></i><span class="hide-menu">Blank</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="404.html" aria-expanded="false"><i class="fa fa-info-circle" aria-hidden="true"></i><span class="hide-menu">404</span></a></li> -->
                <!-- <li class="text-center p-20 upgrade-btn">
                            <a href="https://wrappixel.com/templates/ampleadmin/" class="btn btn-block btn-danger text-white" target="_blank">Upgrade to
                                Pro</a>
                        </li> -->
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title text-uppercase font-medium font-14">Product Info</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="../product">Products</a></li>
                    </ol>
                    <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                                to Pro</a> -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="" method="post" action="{{ $data['product_id'] }}">
                            @csrf
                            <div class="row">
                                <!--Image view-->
                                <div class="image-preview border border-info mb-4 mx-auto ml-lg-2" style="width: 200px;" data-toggle="modal" data-target="#photoModal">
                                    <img width="100%" alt="user" src="{{old('image_name') ? '../../images/uploads/products/'.old('image_name') : '../../images/app/upload-photo.jpg'}}" id="image-product">
                                </div>
                            </div>
                            <div class="form-group mb-4 d-none">
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="image_name" id="image_name" value="{{ old('image_name') }}">
                                </div>
                            </div>
                            <div class="row">
                                <!-- Code -->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Code</label>
                                        <div class="col-md-12 p-0">
                                            <input type="text" placeholder="e.g ABCD" class="form-control" name="product_code" id="product_code" value="{{ old('product_code') }}" autocomplete="off">
                                        </div>
                                        @if ($errors->has('product_code'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_code') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!--Prodcut Name-->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Product Name</label>
                                        <div class="col-md-12 p-0">
                                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') }}" autocomplete="off">
                                        </div>
                                        @if ($errors->has('product_name'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_name') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--Description-->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Description</label>
                                        <div class="col-md-12 p-0">
                                            <textarea rows="6" class="form-control" name="product_description" id="product_description" value="{{ old('product_description') }}"></textarea>
                                        </div>
                                        @if ($errors->has('product_description'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_description') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--Price-->
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Product Price</label>
                                        <div class="col-md-12 p-0">
                                            <input type="number" class="form-control" name="product_price" id="product_price" value="{{ old('product_price') }}">
                                        </div>
                                        @if ($errors->has('product_price'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_code') }}
                                        </span>
                                        @endif
                                    </div>
                                    <!--Discount-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="col-md-12 p-0">Product Discount</label>
                                                <div class="col-md-12 p-0">
                                                    <input type="number" class="form-control" name="product_discount" placeholder="%" id="product_discount" value="{{ old('product_discount') }}">
                                                </div>
                                                @if ($errors->has('product_discount'))
                                                <span class="text-danger mt-2" role="alert">
                                                    {{ $errors->first('product_discount') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="col-sm-12 p-0">Product Unit</label>
                                                <div class="col-sm-12 px-0">
                                                    <select class="form-control " name="product_unit" id="product_unit">
                                                        <option selected="">Select</option>
                                                        @foreach ($data['units'] as $unit)
                                                        @if($data['product']->unit_id == $unit->id OR old('product_unit') == $unit->id)
                                                        <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                                                        @else
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('product_unit'))
                                                <span class="text-danger mt-2" role="alert">
                                                    {{ $errors->first('product_unit') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <!--Brand-->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12 p-0">Product Brand</label>
                                        <div class="col-sm-12 px-0">
                                            <select class="form-control" name="product_brand" id="product_brand">
                                                <option selected="">Select</option>
                                                @foreach ($data['brands'] as $brand)
                                                @if(old('product_brand') == $brand->id)
                                                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                                @else
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('product_brand'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_brand') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!--Category-->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12 p-0">Product Category</label>
                                        <div class="col-sm-12 px-0">
                                            <select class="form-control" name="product_category" id="product_category">
                                                <option selected="">Select</option>
                                                @foreach ($data['categories'] as $categories)
                                                @if(old('product_category') == $categories->id)
                                                <option value="{{ $categories->id }}" selected>{{ $categories->name }}</option>
                                                @else
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('product_category'))
                                        <span class="text-danger mt-2" role="alert">
                                            {{ $errors->first('product_category') }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4 float-right">
                                <div class="col-sm-12 px-0">
                                    <button class="btn btn-dark text-white" name="saveProduct" id="save_product">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="footer text-center"> 2020 © RENZOTECH
    </footer>
</div>
<!-- Upload photo modal -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Uplpad Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="white-box pb-0 pt-2 pl-2 pr-2">
                    <div class="previewImg border border-info">
                        <img width="100%" alt="user" src="../../images/app/upload-photo.jpg" id="productImg">
                    </div>
                    <div class="px-1 mt-2"><span class="text-danger" role="alert" id="img_error"></span></div>
                    <div class="form-group mt-2">
                        <form action="" enctype="multipart/form-data" method="post">
                            {{csrf_field()}}
                            <div class="row ">
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="customFile" multiple="multiple">
                                        <label class="custom-file-label" for="customFile">Choose image</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id="selectPhoto" disabled="true">Select</button>
            </div>
        </div>
    </div>
</div>

<!-- New Product Success Modal -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close-redirect-to-product" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>The product has been successfully updated</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-redirect-to-product" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>

@include('layouts.office.footer1')
@include('includes.jquery.office.drop-down')
@include('includes.jquery.office.product-info')
@include('includes.jquery.office.logo-loader')