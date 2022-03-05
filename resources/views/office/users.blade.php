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
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="users" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fa fa-users ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Users</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="locations" aria-expanded="false"><i class="fas fa-location-arrow ml-3" aria-hidden="true"></i><span class="hide-menu">Locations</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="others" aria-expanded="false"><i class="fas fa-users-cog ml-3" aria-hidden="true"></i><span class="hide-menu">Others</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Users</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <form method="post" action="users">
                    @csrf
                    <div class="input-group">
                        <input type="text" placeholder="Search name" class="form-control mt-2" id="search_item" name="search_item" autocomplete="off">
                        <button class="btn btn-warning text-white mt-2" name="" id="searchProduct"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="box-title">Users Control</h3>
                        </div>
                        <div class="col-6">
                            <a href="new_user" class="btn btn-dark mb-2 float-right m-l-20  waves-effect waves-light"><i class="fa fa-user" aria-hidden="true"></i> New</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="product_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Id</th>
                                    <th class="border-top-0">Photo</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Position</th>
                                    <th class="border-top-0">Work Location</th>
                                    <th class="border-top-0 text-center">Status</th>
                                    <th class="border-top-0 text-center" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['users'] as $user)
                                <tr>
                                    <td class="">{{ $user->id }}</td>
                                    <td><img src="{{ '../images/uploads/profiles/'.$user->image}}" alt="" style="width: 30px; border-radius:50%"></td>
                                    <td class="">{{ $user->last_name.', '.$user->first_name.' '.$user->middle_name }}</td>
                                    <td class="">{{ $user->position->name.($user->role->name === 'Full'? ' / (Administrator)':'') }}</td>
                                    <td class="">{{ $user->store->name.' - '.$user->store->street.' '.$user->store->city }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-{{$user->is_active == 0? 'success' : 'danger'}} text-white activate_deactivate" data-name="{{$user->first_name}}" data-id="{{$user->id}}" data-status="{{$user->is_active}}"><i class="fas fa-toggle-{{ $user->is_active == 0? 'on' : 'off' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-white" href="edit_user/{{$user->id}}" name="" id=""><i class="far fa-edit"></i></a>

                                    </td>
                                    <td class="text-center">

                                        <a class="btn btn-primary text-white" href="recovery/{{$user->id}}" name="" id=""><i class="fas fa-history"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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
                <div class="text-center text-danger">
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
                        <div id="success_message">

                        </div>
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

@include('layouts.office.footer')
@include('includes.jquery.office.drop-down')
@include('includes.jquery.office.logo-loader')
<script>
    $(document).ready(function() {
        $(document).on('click', '.activate_deactivate', function() {
            // var current_row = $(this).closest("tr")
            // var transaction_date = current_row.find("td:eq(1)").text();
            var selected_user_id = $(this).data('id');
            var selected_user_name = $(this).data('name');
            var is_active = $(this).data('status');
            var user_id = parseInt("{{Auth::user()->id}}");

            if (selected_user_id == user_id) {
                $('#self_deactivate_alert').modal('show');
            } else {
                var status = 'Activating ';
                if (is_active == 0) {
                    status = 'Deactivating '
                }
                $('#selected_user_id').val(selected_user_id);
                $('#selected_user_message').html('<h5>Are you sure?</h5><p>' + status + selected_user_name + '</p>')
                $('#activate_deactivate').modal('show');
            }
        });

        $(document).on('click', '.close_deactivate-activate', function() {
            $('#activate_deactivate').modal('hide');
            $('#selected_user_id').val().remove();
        });

        $(document).on('click', '#submit_user_deactivation-activation', function() {
            $('.loading-logo-container').fadeIn();
            $('#activate_deactivate').modal('hide');
            var selected_user_id = $('#selected_user_id').val();
            $.ajax({
                url: "/office/submit_activateDeactivate?id=" + selected_user_id,
                success: function(data) {
                    $('.loading-logo-container').fadeOut();
                    if (data.success == true) {
                        $('#success_message').html('<h5>User is now ' + data.message + '</h5>')

                        $('#success').modal('show');
                    }
                }
            })
        });

        $(document).on('click', '.close_redirect', function() {
            window.location.reload();
        })

    });
</script>