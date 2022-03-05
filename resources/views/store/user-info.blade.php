@include('layouts.store.header')
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
            <div class="mt-2 text-center">
                <h5 style="color: black;"><strong>{{ Auth::user()->store->name }}</strong></h5>
                <h5 style="color: black;"><strong>{{ Auth::user()->store->city }}</strong></h5>
            </div>
            <div class="d-md-none">
                <div class="text-center">
                    <img src="../images/uploads/profiles/{{ Auth::user()->image }}" alt="user-img" width="100" class="img-circle" style="border-radius:50%">
                </div>
                <div class="text-center m-2">
                    <span class="font-medium">{{Auth::user()->first_name}}</span>
                </div>
            </div>

            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard" aria-expanded="false"><i class="fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Home</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="product" aria-expanded="false"><i class="fas fa-tag" aria-hidden="true"></i><span class="hide-menu">Products</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false"><i class="fas fa-boxes" aria-hidden="true"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="transfer" aria-expanded="false"><i class="fas fa-arrow-right ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Transfer</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="recieve" aria-expanded="false"><i class="fas fa-arrow-left ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Receive</span></a></li>
                </div>
                @if(Auth::user()->access->name === "Store")
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link sales-button" role="button" aria-expanded="false"><i class="fas fa-piggy-bank" aria-hidden="true"></i><span class="hide-menu">Sales</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="sales-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales" aria-expanded="false"><i class="far fa-money-bill-alt ml-3" aria-hidden="true"></i><span class="hide-menu">Daily Sales</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales_returns" aria-expanded="false"><i class="fas fa-undo ml-3" aria-hidden="true"></i><span class="hide-menu">Returns</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="repairs" aria-expanded="false"><i class="fas fa-wrench" aria-hidden="true"></i><span class="hide-menu">Repairs</span></a></li>
                @endif
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transaction" aria-expanded="false"><i class="far fa-clipboard" aria-hidden="true"></i><span class="hide-menu">Transactions</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="profile" aria-expanded="false" style="color:#febf52; font-weight:500;">
                        <i class="fa fa-user" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Profile</span></a>
                </li>


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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">User Info</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="profile">Profile</a></li>
                    </ol>

                </div>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">Change User Name</h3>
                    <form action="save_username" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">User name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ old('user_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('user_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('user_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">New user name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="new_user_name" id="new_user_name" value="{{ old('new_user_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('new_user_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('new_user_name') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">Change Password</h3>
                    <form action="save_password" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Old Password</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="old_password" id="password" value="{{ old('old_passwordd') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('old_password'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('old_password') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">New Password</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('password'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Confirm Password</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center"> 2021 © RENZOTECH
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
                        <img width="100%" alt="user" src="../images/app/upload-photo.jpg" id="productImg">
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

<div class="modal fade" id="username-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <p>User name successfully change</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-reload" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Close</button>
            </div>
            <!-- <form id="redirect-to-transfers" action="{{ route('transfer_list') }}" method="POST" style="display: none;">
                @csrf
            </form> -->
        </div>
    </div>
</div>

<div class="modal fade" id="password-success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <p>Password successfully change</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-reload" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Close</button>
            </div>
            <!-- <form id="redirect-to-transfers" action="{{ route('transfer_list') }}" method="POST" style="display: none;">
                @csrf
            </form> -->
        </div>
    </div>
</div>

<div class="modal fade" id="password-error" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <p>Password is incorrect</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-reload" data-dismiss="modal">Close</button>
            </div>
            <!-- <form id="redirect-to-transfers" action="{{ route('transfer_list') }}" method="POST" style="display: none;">
                @csrf
            </form> -->
        </div>
    </div>
</div>

</div>

@include('layouts.store.footer')
@include('includes.jquery.store.drop-down')
@include('includes.jquery.store.logo-loader')

</script>
@if(Session::has('store-success-username'))
<script>
    $('#username-success').modal('show');
</script>
@endif

@if(Session::has('store-success-password'))
<script>
    $('#password-success').modal('show');
</script>
@endif

@if(Session::has('store-error-username'))
<script>
    $('#password-error').modal('show');
</script>
@endif