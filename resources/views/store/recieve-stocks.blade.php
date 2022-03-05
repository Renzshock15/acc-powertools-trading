@include('layouts.store.header1')
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
                    <img src="../../images/uploads/profiles/{{ Auth::user()->image }}" alt="user-img" width="100" class="img-circle" style="border-radius:50%">
                </div>
                <div class="text-center m-2">
                    <span class="font-medium">{{Auth::user()->first_name}}</span>
                </div>
            </div>

            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../dashboard" aria-expanded="false"><i class="fas fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Home</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../product" aria-expanded="false"><i class="fas fa-tag" aria-hidden="true"></i><span class="hide-menu">Products</span></a></li>

                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-boxes" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../transfer" aria-expanded="false"><i class="fas fa-arrow-right ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Transfer</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="../recieve" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-arrow-left ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Stock Receive</span></a></li>
                </div>
                @if(Auth::user()->access->name === "Store")
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link sales-button" role="button" aria-expanded="false"><i class="fas fa-piggy-bank" aria-hidden="true"></i><span class="hide-menu">Sales</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="sales-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../sales" aria-expanded="false"><i class="far fa-money-bill-alt ml-3" aria-hidden="true"></i><span class="hide-menu">Daily Sales</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../sales_returns" aria-expanded="false"><i class="fas fa-undo ml-3" aria-hidden="true"></i><span class="hide-menu">Returns</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="repairs" aria-expanded="false"><i class="fas fa-wrench" aria-hidden="true"></i><span class="hide-menu">Repairs</span></a></li>
                @endif
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../transaction" aria-expanded="false"><i class="far fa-clipboard" aria-hidden="true"></i><span class="hide-menu">Transactions</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../profile" aria-expanded="false">
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Stock Receive</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="{{ route('stock_recieve') }}">Receive Items</a></li>
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
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">{{ 'From: '.$data['transaction_from']->from }}</h3>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table" id="inventory_table">
                            <thead>
                                <tr>
                                    <th class="border-top-0 cell-hidden">No.</th>
                                    <th class="border-top-0 cell-hidden">I Id</th>
                                    <th class="border-top-0 cell-hidden">T Id</th>
                                    <th class="border-top-0 cell-hidden">Note</th>
                                    <th class="border-top-0">Product Name</th>
                                    <th class="border-top-0 text-center" width="10%">Qty</th>
                                    <th class="border-top-0 text-center" width="10%">Status</th>
                                    <th class="border-top-0 text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['transacted_items'] as $transacted_item)
                                <tr>
                                    <td class="cell-hidden transacted_item_id">{{ $transacted_item->id }}</td>
                                    <td class="cell-hidden inventory_id">{{ $transacted_item->inventory_id }}</td>
                                    <td class="cell-hidden transaction_id">{{ $transacted_item->transaction_id }}</td>
                                    <td class="cell-hidden note">{{ $transacted_item->note }}</td>
                                    <td>{{ $transacted_item->inventory->product->code.' '.$transacted_item->inventory->product->name }}</td>
                                    <td class="text-center product_qty" id="qty{{ $transacted_item->id }}" contenteditable="true">
                                        <div class="p-2 rounded border" id="cell_back{{ $transacted_item->id }}">
                                            {{ $transacted_item->quantity }}
                                        </div>
                                    </td>
                                    <td class="text-center text-white">
                                        <div class="p-2 rounded bg-info" id="cell_status{{ $transacted_item->id }}">
                                            <div id="status_check{{ $transacted_item->id }}">
                                                Not check
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-center">
                                        <button class="btn btn-success text-white qty-confirm" name="" id="check{{ $transacted_item->id }}" data-id="{{ $transacted_item->id }}"><i class="fas fa-check"></i></button>
                                        <button class="btn btn-danger text-white edit-qty" name="" id="edit{{ $transacted_item->id }}" data-id="{{ $transacted_item->id }}"><i class="far fa-edit"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2 float-right mt-2">
                                <div class="col-sm-12 px-0">
                                    <button class="btn btn-primary text-white" name="recieve_transafer" id="recieve_transafer">Recieve</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Pending Item Lists</h3>
                        </div>
                    </div>
                    <div id="show_products">
                        <div class="table-responsive">
                            <table class="table" id="inventory_tables">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div> -->
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

<!-- numeric error modal -->
<div class="modal fade" id="not_numeric_error" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qty Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3" id="">
                        <h5>Ooops!!! Invalid qty</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- not all check -->
<div class="modal fade" id="not_all_check" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Check Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                    <div class="text-dark mt-3" id="">
                        <h5>Ooops!!! Please check all item</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" aria-label="Close" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('redirect-to-transfers').submit();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>You successfully recieve all transfers</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-reload" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('redirect-to-recieve').submit();">Close</button>
            </div>
            <form id="redirect-to-recieve" action="{{ route('stock_recieve') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

</div>

@include('layouts.store.footer1')
@include('includes.jquery.store.drop-down')
@include('includes.jquery.store.logo-loader')
<script>
    $(document).ready(function() {

        $('.cell-hidden').hide();
        $('.edit-qty').hide();
        make_cell_editable();
        cell_editable_lock();
        recieve_transafer();
    });

    function make_cell_editable() {
        var last_select_row = 0;
        var last_selected_id = 0;

        $('.qty-confirm').on('click', function() {

            var current_row = $(this).closest("tr")
            var item_qty = current_row.find("td:eq(5)").text().trim();

            if (check_if_numeric(item_qty) == true) {
                $('#not_numeric_error').modal('show');
            } else {
                var id = $(this).data('id');
                $('#qty' + id).attr('contenteditable', false);
                $('#cell_back' + id).removeClass('border')
                $('#cell_status' + id).removeClass('bg-info')
                $('#cell_status' + id).addClass('bg-success')
                $('#status_check' + id).html('checked')
                toggle_edit(id)

            }

        });
    }

    function cell_editable_lock() {
        $('.edit-qty').on('click', function() {
            var current_row = $(this).closest("tr")
            // var item_qty = current_row.find("td:eq(2)").text().trim();
            var id = $(this).data('id');
            $('#qty' + id).attr('contenteditable', true);
            $('#cell_back' + id).addClass('border')
            $('#cell_status' + id).removeClass('bg-success')
            $('#cell_status' + id).addClass('bg-info')
            $('#status_check' + id).html('Not check')
            toggle_edit(id)
        });
    }

    function toggle_edit(id) {
        $('#edit' + id).toggle();
        $('#check' + id).toggle();
    }

    function check_if_numeric(string) {
        if (isNaN(string) == true) {
            return true;
        } else {
            return false;
        }
    }

    function check_if_all_item_is_checked() {
        var unchecked_counter = 0;
        $('#inventory_table tbody tr').each(function() {
            var current_row = $(this);
            var check_status = current_row.find("td:eq(6)").text().trim();
            if (check_status === 'Not check') {
                unchecked_counter = unchecked_counter + 1;
            }
        });

        if (unchecked_counter > 0) {
            return false;
        } else {
            return true;
        }
    }

    function recieve_transafer() {
        $('#recieve_transafer').on('click', function() {
            var is_all_item_checked = check_if_all_item_is_checked();

            if (is_all_item_checked == true) {
                $('.loading-logo-container').fadeIn();
                var table_sale_list = {
                    transacted_item_id: [],
                    inventory_id: [],
                    transaction_id: [],
                    note: [],
                    product_qty: []
                }

                $('.transacted_item_id').each(function() {
                    table_sale_list.transacted_item_id.push($(this).text());
                });
                $('.inventory_id').each(function() {
                    table_sale_list.inventory_id.push($(this).text());
                });
                $('.transaction_id').each(function() {
                    table_sale_list.transaction_id.push($(this).text());
                });
                $('.note').each(function() {
                    table_sale_list.note.push($(this).text());
                });
                $('.product_qty').each(function() {
                    table_sale_list.product_qty.push($(this).text());
                });



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('store/recieved_items') }}",
                    method: 'post',
                    data: {
                        table_sale_list: table_sale_list
                    },
                    success: function(response) {
                        // alert(response.success);
                        if (response.success == true) {
                            $('.loading-logo-container').fadeOut();
                            $('#success').modal('show');
                        }
                    }
                });

            } else {
                $('#not_all_check').modal('show');
            }
        });
    }
</script>