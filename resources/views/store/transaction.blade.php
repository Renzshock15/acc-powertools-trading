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
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="transaction" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="far fa-clipboard" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Transactions</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile" aria-expanded="false">
                        <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Transactions</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="#">Transactions</a></li>
                    </ol>
                    <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                                to Pro</a> -->
                </div>

                <!-- </form> -->
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
                                <label class="col-sm-12 p-0">Search By:</label>
                                <div class="col-sm-12 px-0">
                                    <select class="form-control" name="search_type" id="search_type">
                                        <option selected="">Transaction No.</option>
                                        <option value="Product_code">Product Code</option>
                                        <option value="Product_name">Product Name</option>
                                        <option value="Receipt">Receipt / Packing List</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Search</label>
                                <div class="col-sm-12 px-0">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." class="form-control" id="search_item" name="search_item" autocomplete="off">
                                        <button class="btn btn-dark text-white" name="" id="btnSearch"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Date From</label>
                                <div class="col-sm-12 px-0">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date_from" name="date_from" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Date To</label>
                                <div class="col-sm-12 px-0">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date_to" name="date_to" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Transaction Lists</h3>
                        </div>

                        <!-- <div class="col-md-4 mb-2">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 mt-2">
                                    <label for="date_from">From</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="date" placeholder="" class="form-control" id="date_pick" name="date_from" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 mt-2">
                                    <label for="date_from">To</label>
                                </div>
                                <div class="col-lg-10 col-md-9">
                                    <input type="date" placeholder="" class="form-control" id="date_pick" name="date_from" autocomplete="off">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="table-responsive">
                        <div id="tbody">
                            @include('store.transaction-data')
                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="footer text-center"> 2021 © RENZOTECH
    </footer>

</div>

<!-- Product confirmation alert alert -->
<div class="modal fade" id="product_not_exist" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fa fa-plus-circle fa-4x"></i>
                    <div class="text-dark mt-3 px-3" id="show_confirm">

                    </div>

                    <div class="px-3">
                        <form action="" method="post" id="confirm_add_product" onsubmit="return false">
                            @csrf
                            <div class="row px-3">
                                <label class="col-md-4 mt-2 text-md-right text-dark">Add Qty</label>
                                <div class="col-md-5">
                                    <div class="border-bottom">
                                        <input type="number" class="form-control p-0 border-0 mx-md-auto" name="product_qty" id="product_qty" value="0">
                                    </div>
                                    <div id="errors-qty" class="mx-auto mt-2">

                                    </div>
                                </div>

                                <!-- @if ($errors->has('product_qty'))
                                <span class="text-danger mt-2" role="alert">
                                    {{ $errors->first('product_qty') }}
                                </span>
                                @endif -->
                                <div class="col-md-3">
                                </div>
                            </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button class="btn btn-success text-white" name="confirm_add" id="confirm_add">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Product exist alert -->
<div class="modal fade" id="product_is_exist" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inventory Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3" id="product_exist">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Success Modal -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
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
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>New inventory has been successfully added</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Not admin -->
<div class="modal fade" id="user_not_admin" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3" id="product_exist">
                        <p>Oooops! your role is not administrator</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cancelation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cancelation_reason_data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>

@include('layouts.store.footer')
@include('includes.jquery.store.drop-down')
@include('includes.jquery.store.logo-loader')
<script>
    $(document).ready(function() {

        function fetch_data(page, type, query) {
            $.ajax({
                url: "/store/fetch_data_for_rtransaction?page=" + page + "&type=" + type + "&query=" + query,
                success: function(data) {
                    $('#tbody').html('');
                    $('#tbody').html(data);
                    $('.for-hide').hide();
                    // add_to_list()
                }
            });
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
            // var sort_type = $('#hidden_sort_type').val();

            var query = $('#search_item').val();
            var type = $('#search_type').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, type, query);
        });

        $(document).on('click', '#btnSearch', function() {
            var query = $('#search_item').val();
            var type = $('#search_type').val();
            var page = $('#hidden_page').val(1);

            fetch_data(page, type, query);

        });

        // $(document).on('change', '#date_pick_to', function() {
        //     var date_from = $('#date_pick_from').val();
        //     var date_to = $('#date_pick_to').val();
        //     var page = $('#hidden_page').val(1);

        //     if (date_to != '') {
        //         var query = date_from + '/' + date_to;
        //         fetch_data(page, query);
        //     }

        // });

        $(document).on('click', '#cancel_transaction', function() {

            var user_role = '{{ Auth::user()->role->name }}';
            if (user_role === 'Full') {
                var current_row = $(this).closest("tr")
                var transaction_id = current_row.find("td:eq(0)").text();
                window.location.href = "cancel_transaction/" + transaction_id;
            } else {
                $('#user_not_admin').modal('show');
            }
        });

        $(document).on('click', '#show_reason', function() {
            var current_row = $(this).closest("tr")
            var transaction_id = current_row.find("td:eq(0)").text();
            $.ajax({
                url: "/store/fetch_data_for_reason?transaction_id=" + transaction_id,
                success: function(data) {
                    $('#cancelation_reason_data').html(data.cancelation_data)
                    $('#reasonModal').modal('show');
                }
            });

        });

    });
</script>