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
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="repairs" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-wrench" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Repairs</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link other-button" role="button" aria-expanded="false"><i class="fas fa-layer-group" aria-hidden="true"></i><span class="hide-menu">Others</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="other-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="brands" aria-expanded="false"><i class="fa fa-tags ml-3" aria-hidden="true"></i><span class="hide-menu">Brands</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="suppliers" aria-expanded="false"><i class="fas fa-user-friends ml-3" aria-hidden="true"></i><span class="hide-menu">Suppliers</span></a></li>
                </div>
                @if(Auth::user()->role->name === 'Full')
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link admin-button" role="button" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i><span class="hide-menu">Admin</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="admin-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users" aria-expanded="false"><i class="fa fa-users ml-3" aria-hidden="true"></i><span class="hide-menu">Users</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-3 mb-2">Repairs</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box pb-1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Filter</label>
                                <div class="col-sm-12 px-0">
                                    <select class="form-control" name="search_filter" id="search_filter">
                                        <option selected="">Name</option>
                                        <option value="Product Serial">Serial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Search Product</label>
                                <div class="col-sm-12 px-0">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." class="form-control" id="search_item" name="search_item" autocomplete="off">
                                        <button class="btn btn-dark text-white" name="" id="searchRepair"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Status</label>
                                <div class="col-sm-12 px-0">
                                    <select class="form-control" name="repair_status" id="repair_status">
                                        <option selected="">All</option>
                                        <option value="To receive">To receive</option>
                                        <option value="Received">Received</option>
                                        <option value="Out">Out</option>
                                        <option value="Return">Return</option>
                                        <option value="To deliver">To deliver</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">For Repair List</h3>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <div id="tbody">
                            @include('office.repair-data')
                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

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

<!-- status -->
<div class="modal fade" id="customer_details" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success text-dark">
                    <div id="customer_show">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- To deliver status -->
<div class="modal fade" id="modal-not-yet" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
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
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>Ooopss!!! product is already delivered</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_repair_status" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="get_repair_id" id="get_repair_id" autocomplete="off">
                <div class="form-group mb-4">
                    <label class="col-sm-12 p-0">Repair Status</label>
                    <div class="col-sm-12 px-0">
                        <select class="form-control " name="select_status" id="select_status">
                            <option value="To receive">To receive</option>
                            <option value="Received">Received</option>
                            <option value="Out">Out</option>
                            <option value="Return">Return</option>
                            <option value="To deliver">To deliver</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="submit-status">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success_update" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                        <h5>Repair status has been change</h5>
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
        $(document).on('click', '.click_product_name', function() {
            var customer_name = $(this).data('name');
            var customer_number = $(this).data('number');
            var user = $(this).data('user');

            $('#customer_show').html('<h5>Customer Name: ' + customer_name + '</h5><h5>Customer Number: ' + customer_number + '</h5></h5><h5>Encoded By: ' + user + '</h5>');
            $('#customer_details').modal('show');
        });

        $(document).on('click', '.click_status', function() {
            var repair_status = $(this).data('status');
            var repair_id = $(this).data('id');
            if (repair_status === 'Delivered') {
                $('#modal-not-yet').modal('show');
            } else {
                $('#select_status').val(repair_status);
                $('#get_repair_id').val(repair_id);
                $('#modal_repair_status').modal('show');
            }
        });

        $(document).on('click', '#submit-status', function() {
            $('.loading-logo-container').fadeIn();
            var status = $('#select_status').val();
            var id = $('#get_repair_id').val();
            $.ajax({
                url: "/office/submit_status?id=" + id + "&status=" + status,
                success: function(data) {
                    if (data.update_status == true) {
                        $('.loading-logo-container').fadeOut();
                        $('#success_update').modal('show');
                    }
                }
            })
        });

        $(document).on('click', '.close_reload', function() {
            location.reload();
        });

        function fetch_data(page, query, status, filter) {
            $.ajax({
                url: "/office/fetch_data_for_repair?page=" + page + "&query=" + query + "&status=" + status + "&filter=" + filter,
                success: function(data) {
                    $('#tbody').html('');
                    $('#tbody').html(data);
                }
            })
        }

        $(document).on('click', '#searchRepair', function() {
            var status = $('#repair_status').val();
            var query = $('#search_item').val();
            var page = $('#hidden_page').val(1);
            var filter = $('#search_filter').val();
            fetch_data(page, query, status, filter);
        });


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
            // var sort_type = $('#hidden_sort_type').val();
            var query = $('#search_item').val();
            var status = $('#repair_status').val();
            var filter = $('#search_filter').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query, status, filter);
        });

        $(document).on('change', '#repair_status', function() {
            var status = $('#repair_status').val();
            var query = $('#search_item').val();
            var page = $('#hidden_page').val(1);
            var filter = $('#search_filter').val();
            fetch_data(page, query, status, filter);
        });

    });
</script>