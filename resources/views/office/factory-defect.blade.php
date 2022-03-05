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
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-boxes" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="stock_receive" aria-expanded="false"><i class="fas fa-arrow-left ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Receive</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="factory_defect" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-warehouse ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Factory Defect</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Factory Defect</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="input-group">
                    <input type="text" placeholder="Search..." class="form-control mt-2" id="search_item" name="search_item" autocomplete="off">
                    <button class="btn btn-warning text-white mt-2" name="" id="searchProduct"><i class="fas fa-search"></i></button>
                </div>
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
                            <h3 class="box-title">For Return List</h3>
                        </div>
                        <div class="col-6">
                            <a href="create_factory_defect" class="btn btn-outline-warning mb-2 float-right m-l-20  waves-effect waves-light"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="inventory_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" width="5%">Id</th>
                                    <th class="border-top-0" width="15%">Date</th>
                                    <th class="border-top-0" width="55%">Return to</th>
                                    <th class="border-top-0" width="15%">Status</th>
                                    <th class="border-top-0 text-center" width="10%">Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['return_to_suppliers'] as $return_to_supplier)
                                <tr>
                                    <td class="">{{ $return_to_supplier->id }}</td>
                                    <td>{{ $return_to_supplier->return_date }}</td>
                                    <td>{{ $return_to_supplier->supplier->name }}</td>
                                    <td>{{ $return_to_supplier->status }}</td>
                                    <td class="text-center">
                                        @if($return_to_supplier->status === 'Pending')
                                        <button class="btn btn-success text-white check_returns" data-status="{{$return_to_supplier->status}}" data-id="{{$return_to_supplier->id}}"><i class="fas fa-check"></i></button>
                                        @else
                                        <a class="btn btn-dark text-white add_to_sale_list" href="return_to_supplier_pdf/{{$return_to_supplier->id}}" target="blank"><i class="fas fa-file-pdf"></i></a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data['return_to_suppliers']->links() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="footer text-center"> 2020 © RENZOTECH
    </footer>

</div>


<!-- User role admin alert -->
<div class="modal fade" id="role_admin" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="far fa-trash-alt fa-4x"></i>
                    <div class="text-dark mt-3 px-3" id="show_confirm">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="" method="post" id="confirm_delete_product">
                    @csrf
                    <button class="btn btn-danger" name="confirm_delete" id="confirm_delete">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User role not admin alert -->
<div class="modal fade" id="modal_status_change" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <input type="text" class="form-control" name="input_return_id" id="input_return_id" autocomplete="off">

                    <i class="fas fa-question fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>Are you sure?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="submit_status" id="submit_return_status" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- User role not admin alert -->
<div class="modal fade" id="modal_cancel_change" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">cancel Return Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <input type="text" class="form-control" name="input_return_id" id="cancel_return_id" autocomplete="off">

                    <i class="fas fa-question fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>Are you sure?</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="submit_status" id="cancel_return_status" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Success Modal -->
<div class="modal fade" id="modal_update_successs" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close_reload" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>The products are now ready to return</h5>
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
@include('includes.jquery.office.product')
@include('includes.jquery.office.logo-loader')
<script>
    $(document).ready(function() {
        $(document).on('click', '.check_returns', function() {
            var status = $(this).data('status');
            var return_id = $(this).data('id');

            if (status === 'Ready') {

            } else {
                $('#input_return_id').val(return_id);
                $('#modal_status_change').modal('show');
            }
        });

        $(document).on('click', '#submit_return_status', function() {
            $('.loading-logo-container').fadeIn();
            var return_id = $('#input_return_id').val();
            $.ajax({
                url: "/office/update_return_to_supplier?return_id=" + return_id,
                success: function(data) {
                    if (data.success == true) {
                        $('.loading-logo-container').fadeOut();
                        $('#modal_update_successs').modal('show');
                    }
                }
            })
        });

        $(document).on('click', '.close_reload', function() {
            location.reload();
        });

    });
</script>