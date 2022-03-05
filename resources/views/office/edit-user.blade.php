@include('layouts.office.header1')
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
                        <img src="../../images/uploads/profiles/{{ Auth::user()->image }}" alt="user-img" width="100" class="img-circle" style="border-radius:50%">
                    </div>
                    <div class="text-center m-2">
                        <span class="font-medium">{{Auth::user()->first_name}}</span>
                    </div>
                </div>
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../dashboard" aria-expanded="false"><i class="fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Home</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../product" aria-expanded="false"><i class="fas fa-tag" aria-hidden="true"></i><span class="hide-menu">Products</span></a></li>
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
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark active admin-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fa fa-cogs" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Admin</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="admin-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="../users" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fa fa-users ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Users</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../locations" aria-expanded="false"><i class="fas fa-location-arrow ml-3" aria-hidden="true"></i><span class="hide-menu">Locations</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../others" aria-expanded="false"><i class="fas fa-users-cog ml-3" aria-hidden="true"></i><span class="hide-menu">Others</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Edit user</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="../users">Users</a></li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">Edit User information</h3>
                    <form action="../update_user" method="post">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ old('user_id') }}" autocomplete="off">
                            </div>

                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">First Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('first_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('first_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Middle Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('middle_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('middle_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Last Name</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('last_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('last_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 p-0">Position</label>
                            <div class="col-sm-12 px-0">
                                <select class="form-control " name="user_position" id="user_position">
                                    <option selected="">Select</option>
                                    @foreach ($data['positions'] as $position)
                                    @if(old('user_position') == $position->id)
                                    <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                    @else
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('user_position'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('user_position') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 p-0">Work Location</label>
                            <div class="col-sm-12 px-0">
                                <select class="form-control " name="work_location" id="work_location">
                                    <option selected="">Select</option>
                                    @foreach ($data['stores'] as $store)
                                    @if(old('work_location') == $store->id)
                                    <option value="{{ $store->id }}" selected>{{ $store->name.' - '.$store->street.' '.$store->city }}</option>
                                    @else
                                    <option value="{{ $store->id }}">{{ $store->name.' - '.$store->street.' '.$store->city }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('work_location'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('work_location') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 p-0">Role</label>
                            <div class="col-sm-12 px-0">
                                <select class="form-control " name="user_role" id="user_role">
                                    <option selected="">Select</option>
                                    @foreach ($data['roles'] as $role)
                                    @if(old('user_role') == $role->id)
                                    <option value="{{ $role->id }}" selected>{{ ($role->name === 'Full'? 'Full - Administrator' : 'Partial') }}</option>
                                    @else
                                    <option value="{{ $role->id }}">{{ ($role->name === 'Full'? 'Full - Administrator' : 'Partial') }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('user_role'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('user_role') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12 p-0">Access</label>
                            <div class="col-sm-12 px-0">
                                <select class="form-control " name="user_access" id="user_access">
                                    <option selected="">Select</option>
                                    @foreach ($data['accesses'] as $access)
                                    @if(old('user_access') == $access->id)
                                    <option value="{{ $access->id }}" selected>{{ $access->name }}</option>
                                    @else
                                    <option value="{{ $access->id }}">{{ $access->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('user_access'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('user_access') }}
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-dark mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center"> 2020 © RENZOTECH
    </footer>

</div>

<!-- Self deactivate alert -->
<div class="modal fade" id="self_deactivate_alert" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <!-- <i class="fas fa-check-circle fa-4x"></i> -->
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>Ooops!!! you are deactivating yourself</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- deactivate user modal -->
<div class="modal fade" id="activate_deactivate" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_deactivate-activate" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-dark">
                    <!-- <i class="fas fa-check-circle fa-4x"></i> -->
                    <i class="fas fa-user fa-2x"></i>
                    <div class="text-dark mt-3">
                        <div id="selected_user_message">

                        </div>
                    </div>

                </div>
                <div class="form-group mb-0">
                    <input type="hidden" class="form-control p-0 border-0 text-center" name="selected_user_id" id="selected_user_id">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_deactivate-activate">Close</button>
                <button type="button" class="btn btn-info" id="submit_user_deactivation-activation">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Transaction completed -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_redirect" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>User successfully updated</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_redirect" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

</div>

@include('layouts.office.footer1')
@include('includes.jquery.office.drop-down')
@include('includes.jquery.office.logo-loader')
<script>
    $(document).ready(function() {
        get_data();

        $(document).on('click', '.close_redirect', function() {
            window.location.href = "../users";
        });

    });

    function get_data() {
        $('#user_id').val("{{$data['user']->id}}");
        $('#first_name').val("{{$data['user']->first_name}}");
        $('#last_name').val("{{$data['user']->last_name}}");
        $('#middle_name').val("{{$data['user']->middle_name}}");
        $('#user_position').val("{{$data['user']->position_id}}");
        $('#work_location').val("{{$data['user']->store_id}}");
        $('#user_role').val("{{$data['user']->role_id}}");
        $('#user_access').val("{{$data['user']->access_id}}");
    }
</script>

@if(Session::has('update-user'))
<script>
    $('#success').modal('show');
</script>
@endif