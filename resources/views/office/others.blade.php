@include('layouts.office.header')
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <div class="d-md-none mt-3">
                    <div class="text-center">
                        <img src="../images/uploads/profiles/{{ Auth::user()->image }}" alt="user-img" width="100" class="img-circle" style="border-radius:50%">
                    </div>
                    <div class="text-center m-2">
                        <span class="font-medium">{{Auth::user()->first_name}}</span>
                    </div>
                </div>
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard" aria-expanded="false"><i class="fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Home</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="product" aria-expanded="false"><i class="fas fa-tag" aria-hidden="true"></i><span class="hide-menu">Products</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false"><i class="fas fa-boxes" aria-hidden="true"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="stock_receive" aria-expanded="false"><i class="fas fa-arrow-left ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Receive</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="factory_defect" aria-expanded="false"><i class="fas fa-warehouse ml-3" aria-hidden="true"></i><span class="hide-menu">Factory Defect</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="deliveries" aria-expanded="false"><i class="fas fa-truck" aria-hidden="true"></i><span class="hide-menu">Deliveries</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transaction" aria-expanded="false"><i class="far fa-clipboard" aria-hidden="true"></i><span class="hide-menu">Transactions</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="repairs" aria-expanded="false"><i class="fas fa-wrench" aria-hidden="true"></i><span class="hide-menu">Repairs</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link other-button" role="button" aria-expanded="false"><i class="fas fa-layer-group" aria-hidden="true"></i><span class="hide-menu">Others</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="other-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="brands" aria-expanded="false"><i class="fa fa-tags ml-3" aria-hidden="true"></i><span class="hide-menu">Brands</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="suppliers" aria-expanded="false"><i class="fas fa-user-friends ml-3" aria-hidden="true"></i><span class="hide-menu">Suppliers</span></a></li>
                </div>
                @if(Auth::user()->role->name === 'Full')
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark active admin-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fa fa-cogs" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Admin</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="admin-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users" aria-expanded="false"><i class="fa fa-users ml-3" aria-hidden="true"></i><span class="hide-menu">Users</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="locations" aria-expanded="false"><i class="fas fa-location-arrow ml-3" aria-hidden="true"></i><span class="hide-menu">Locations</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="others" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-users-cog ml-3" style=" color:#febf52;" aria-hidden="true"></i><span class="hide-menu">Others</span></a></li>
                </div>
                @endif

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span class="hide-menu">Logout</span></a>

                </li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-2 mb-1">Others</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <!-- <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="">Locations</a></li>
                    </ol>
                   
                </div> -->
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Position Form</h3>
                        </div>
                    </div>
                    <form action="save_position" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Position Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="position_name" id="position_name" value="{{ old('position_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('position_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('position_name') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Position list</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="store_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="85%">Name</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['positions'] as $position)
                                <tr>
                                    <td class="">{{ $position->id }}</td>
                                    <td class="">{{ $position->name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_position/{{$position->id}}" name="" id=""><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['positions']->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Unit Form</h3>
                        </div>
                    </div>
                    <form action="save_unit" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Unit Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="unit_name" id="unit_name" value="{{ old('unit_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('unit_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('unit_name') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Position list</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="store_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="85%">Name</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['units'] as $unit)
                                <tr>
                                    <td class="">{{ $unit->id }}</td>
                                    <td class="">{{ $unit->name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_unit/{{$unit->id}}" name="" id=""><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['units']->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Receipt Form</h3>
                        </div>
                    </div>
                    <form action="save_receipt" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Receipt Type</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="receipt_type" id="receipt_type" value="{{ old('receipt_type') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('receipt_type'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('receipt_type') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Abbreviation</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="abbreviation_name" id="abbreviation_name" value="{{ old('abbreviation_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('abbreviation_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('abbreviation_name') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Position list</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="store_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="60%">Type</th>
                                    <th class="border-top-0" width="25%">Abbreviation</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['receipts'] as $receipt)
                                <tr>
                                    <td class="">{{ $receipt->id }}</td>
                                    <td class="">{{ $receipt->type }}</td>
                                    <td class="">{{ $receipt->abbreviation }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_unit/{{$unit->id}}" name="" id=""><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['receipts']->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Category Form</h3>
                        </div>
                    </div>
                    <form action="save_category" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Category Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('category_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('category_name') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">category list</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="store_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="85%">Name</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['categories'] as $category)
                                <tr>
                                    <td class="">{{ $category->id }}</td>
                                    <td class="">{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_category/{{$category->id}}" name="" id=""><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['categories']->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Location Type Form</h3>
                        </div>
                    </div>
                    <form action="save_location_type" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Location Type</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="location_type" id="location_type" value="{{ old('location_type') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('location_type'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('location_type') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Location type list</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="store_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="85%">Name</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['location_names'] as $location_name)
                                <tr>
                                    <td class="">{{ $location_name->id }}</td>
                                    <td class="">{{ $location_name->name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_location_name/{{$location_name->id}}" name="" id=""><i class="far fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['location_names']->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center"> 2020 © RENZOTECH
    </footer>

</div>

<!-- modal new position -->
<div class="modal fade" id="modal-position-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New position has been added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_reload" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal new unit -->
<div class="modal fade" id="modal-unit-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New unit has been added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_reload" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal new receipt -->
<div class="modal fade" id="modal-receipt-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New receipt type has been added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_reload" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-category-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New category has been added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_reload" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-location-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New location type has been added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_reload" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

</div>

@include('layouts.office.footer')
@include('includes.jquery.office.drop-down')
@include('includes.jquery.office.logo-loader')
<script>
    $(document).ready(function() {
        $(document).on('click', '.close_reload', function() {
            location.reload();
        });
    });
</script>
@if(Session::has('save-position'))
<script>
    $('#modal-position-success').modal('show');
</script>
@endif
@if(Session::has('save-unit'))
<script>
    $('#modal-unit-success').modal('show');
</script>
@endif

@if(Session::has('save-receipt'))
<script>
    $('#modal-receipt-success').modal('show');
</script>
@endif
@if(Session::has('save-category'))
<script>
    $('#modal-category-success').modal('show');
</script>
@endif
@if(Session::has('save-location'))
<script>
    $('#modal-location-success').modal('show');
</script>
@endif