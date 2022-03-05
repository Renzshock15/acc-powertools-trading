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
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transfer" aria-expanded="false"><i class="fas fa-arrow-right ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Transfer</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="recieve" aria-expanded="false"><i class="fas fa-arrow-left ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Receive</span></a></li>
                </div>
                @if(Auth::user()->access->name === "Store")
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link sales-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-piggy-bank" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Sales</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="sales-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales" aria-expanded="false"><i class="far fa-money-bill-alt ml-3" aria-hidden="true"></i><span class="hide-menu">Daily Sales</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales_returns" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-undo ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Returns</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="repairs" aria-expanded="false"><i class="fas fa-wrench" aria-hidden="true"></i><span class="hide-menu">Repairs</span></a></li>
                @endif
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transaction" aria-expanded="false"><i class="far fa-clipboard" aria-hidden="true"></i><span class="hide-menu">Transactions</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Sales Returns</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <!-- <div class="input-group date" data-provide="datepicker">
                    <input type="date" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div> -->

                <div class="input-group">
                    <input type="text" placeholder="" class="form-control mt-2" id="input_search" name="input_search" autocomplete="off">
                    <button class="btn btn-danger text-white mt-2" id="search"><i class="fas fa-search"></i></button>
                </div>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Sales Transactions</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" placeholder="Receipt No." class="form-control mt-2" id="search_receipt" name="search_receipt" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="date" class="form-control mt-2" id="search_date" name="search_date" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-danger text-white mt-3 mb-2 float-right" id="btn_search_receipt"><i class="fas fa-search"></i> Transaction</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="show_products">
                        <div class="table-responsive">
                            <table class="table" id="inventory_table">
                                <thead>
                                    <tr>
                                        <th class="border-top-0 for-hide">Id</th>
                                        <th class="border-top-0" width="50%">Product Name</th>
                                        <th class="border-top-0" width="15%">Qty</th>
                                        <th class="border-top-0" width="25%">Total Price</th>
                                        <th class="border-top-0 text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Return Item</h3>
                            <div class="row border">
                                <div class="col-6 mt-3">
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12 p-0">To Transaction Receipt</label>
                                        <div class="col-sm-12 border-bottom px-0">
                                            <select class="form-control p-0 border-0" name="transaction_form" id="transaction_form">
                                                <option selected="">Select</option>
                                                @foreach ($data['sales_receipts'] as $sales_receipt)
                                                <option value="{{ $sales_receipt->id }}">{{ $sales_receipt->transaction_receipt }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger mt-2" role="alert" id="transaction_select_error">
                                            <p>Select transaction receipt</p>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">From Transaction Receipt</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" class="form-control p-0 border-0 bg-white" name="receipt_no" id="receipt_no" autocomplete="off" readonly>
                                        </div>
                                        <span class="text-danger mt-2" role="alert" id="number_required_error">
                                            <p>This field is required</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table" id="item_sale_list">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0" width="5%">ID</th>
                                                <th class="border-top-0" width="35%">Item name</th>
                                                <th class="border-top-0" width="20%">Serial</th>
                                                <th class="border-top-0 text-center" width="10%">Qty</th>
                                                <th class="border-top-0 text-right" width="20%">Price</th>
                                                <th class="border-top-0 text-right for-hide">Tid</th>
                                                <th class="border-top-0 text-right" width="10%">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group mb-2 float-left mt-2">
                                        <div class="col-sm-12 px-0">
                                            <button class="btn btn-info text-white" name="submit_sale" id="submit_sale">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-md-12 p-0 mt-2 text-right">Total Price</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12 p-0">
                                                <div class="form-group">
                                                    <input type="number" class="form-control p-0 border-0 bg-white text-right mt-1" name="product_total_price" id="product_total_price" disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close close-reload" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-4x"></i>
                    <div class="text-dark mt-3">
                        <h5>Sale transaction is successfully completed</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-reload" id="close-reload">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add item qty from return -->
<div class="modal fade" id="select_item_qty_return" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Qty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center text-warning">
                    <i class="fas fa-box-open fa-4x"></i>
                    <div class="text-dark mt-3 px-3" id="show_confirm_return">
                    </div>
                </div>
                <div class="row justify-content-center for-hide">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center" name="product-name" id="inventory-id_return" readonly">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center for-hide">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center" name="product-name" id="transacted_item_id_return" readonly">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center for-hide">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center" name="product-name" id="product_serial_return" readonly">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center bg-white" name="product-name" id="product-name_return" disabled="true">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-1 for-hide">
                    <div class="col-1">
                        <div class="form-group">
                            <label class="col-md-12 p-0 mt-2">Price</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-md-12 border-bottom p-0">
                            <input type="number" class="form-control p-0 border-0 border-bottom" name="product_price" id="product_price_return">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-1">
                    <div class="col-1">
                        <div class="form-group">
                            <label class="col-md-12 p-0 mt-2">Qty</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col-md-12 border-bottom p-0">
                            <input type="number" class="form-control p-0 border-0 border-bottom" name="selected_item_qty" id="selected_item_qty_return" value="0">
                        </div>
                    </div>
                    <div class="col-1 text-danger mt-2 p-0" id="error-msg_return">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button class="btn btn-success text-white" name="confirm_adds" id="confirm_adds_return">Add to list</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- No Product selected -->
<div class="modal fade" id="no_product_on_list" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
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
                        <p>Oooops! select product first</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- No Search query -->
<div class="modal fade" id="complete_search_field" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
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
                        <p>Oooops! complete the field</p>
                        <p>Receipt no. and date</p>
                    </div>
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
        $('.for-hide').hide();
        $('#number_required_error').hide()
        $('#transaction_select_error').hide()

        calculate_sale_price();
        remove_product_to_list()

        $(document).on('click', '#btn_search_receipt', function() {
            var reciept_no = $('#search_receipt').val();
            var receipt_date = $('#search_date').val();

            if (reciept_no === '' || receipt_date === '') {
                $('#complete_search_field').modal('show');
            }

            if (reciept_no != '' && receipt_date != '') {
                //Token hand shake
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('store/show_item_returns') }}",
                    method: 'post',
                    data: {
                        reciept_no: reciept_no,
                        receipt_date: receipt_date
                    },
                    success: function(response) {
                        $('#show_products').html(response.transacted_item);
                        $('#receipt_no').val(reciept_no + '-' + receipt_date);
                        $('.for-hide').hide();
                    }
                });
            }


        });

        $(document).on('click', '.select-items', function() {
            var current_row = $(this).closest("tr")
            var item_id = current_row.find("td:eq(0)").text();
            var item_name = current_row.find("td:eq(1)").text();
            var item_qty = current_row.find("td:eq(2)").text();
            var item_price = current_row.find("td:eq(3)").text();
            var item_serial = current_row.find("td:eq(4)").text();
            var item_transaction_id = current_row.find("td:eq(5)").text();

            $('#selected_item_qty_return').val(item_qty);
            $('#inventory-id_return').val(item_id);
            $('#product-name_return').val(item_name);
            $('#product_price_return').val(item_price);
            $('#product_serial_return').val(item_serial);
            $('#transacted_item_id_return').val(item_transaction_id);
            $('#error-msg_return').hide();
            $('#select_item_qty_return').modal('show');
            confirm_add_return(item_qty)
        });

        $(document).on('click', '#submit_sale', function() {

            if ($('#transaction_form').val() === "Select") {
                $('#transaction_select_error').show()
            }

            if ($('#transaction_form').val() != "Select") {
                $('#transaction_select_error').hide()

                var row_count = count_items();

                if (row_count == 0) {
                    $('#no_product_on_list').modal('show');
                } else {
                    // Token hand shake
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                        }
                    });

                    var table_sale_list = {
                        inventory_id: [],
                        product_serial: [],
                        product_qty: [],
                        product_tot_price: [],
                        transacted_item_id: []
                    }

                    $('.inv_id').each(function() {
                        table_sale_list.inventory_id.push($(this).text());
                    });
                    $('.product_serial').each(function() {
                        table_sale_list.product_serial.push($(this).text());
                    });
                    $('.product_qty').each(function() {
                        table_sale_list.product_qty.push($(this).text());
                    });
                    $('.product_tot_price').each(function() {
                        table_sale_list.product_tot_price.push($(this).text());
                    });
                    $('.transacted_item_id').each(function() {
                        table_sale_list.transacted_item_id.push($(this).text());
                    });

                    $.ajax({
                        url: "{{ url('store/transact_change_item') }}",
                        method: 'post',
                        data: {
                            table_sale_list: table_sale_list,
                            transaction_receipt: $('#transaction_form').val(),
                            receipt_no: $('#receipt_no').val()
                        },
                        success: function(response) {
                            if (response.success == true) {
                                $('#success').modal('show');
                            }
                            success_transaction();
                        }
                    });
                }
            }
            success_transaction();
        });
    });

    function confirm_add_return(qty) {
        $(document).on('click', '#confirm_adds_return', function() {
            if ($('#selected_item_qty_return').val() > qty || $('#selected_item_qty_return').val() <= 0) {
                $('#error-msg_return').show();
            } else {
                var actual_item_price = $('#product_price_return').val() / qty;
                var item_return_price = to_negative(actual_item_price * $('#selected_item_qty_return').val());
                $('#item_sale_list').append('<tr><td class="inv_id">' + $('#inventory-id_return').val() + '</td><td>' + $('#product-name_return').val() + '</td><td class="product_serial">' + $('#product_serial_return').val() + '</td><td class="text-center product_qty">' + $('#selected_item_qty_return').val() + '</td><td class="text-right product_tot_price">' + item_return_price.toFixed(2) + '</td><td class="for-hide transacted_item_id">' + $('#transacted_item_id_return').val() + '</td><td class="text-center"><button class="btn btn-danger text-white" name="remove-item" id="remove-item"><i class="fas fa-times"></i></button><td></td></tr>')
                $('#select_item_qty_return').modal('hide');
                calculate_sale_price();
                hide()
            }
            $('#inventory-id_return').val().remove();
            $('#product-name_return').val().remove();
            $('#product_price_return').val().remove();
            $('#selected_item_qty_return').val().remove();
            $('#product_serial_return').val().remove();
            $('#transacted_item_id_return').val().remove();
        });
    }

    function to_negative(price) {
        var negative_price = price * -1;
        return negative_price;
    }

    function hide() {
        $('.for-hide').hide();
    }

    function calculate_sale_price() {
        var total_price = 0.00;
        $('#item_sale_list tbody tr').each(function() {
            var current_row = $(this);
            var product_price = parseInt(current_row.find("td:eq(4)").text());
            total_price = total_price + product_price;
        });

        $('#product_total_price').val(total_price.toFixed(2));
    }

    function remove_product_to_list() {
        $("#item_sale_list").on("click", "#remove-item", function() {
            $(this).closest("tr").remove();
            calculate_sale_price();
        });
    }

    function count_items() {
        var row_count = 0;
        $('#item_sale_list tbody tr').each(function() {
            var current_row = $(this);
            var product_row = parseInt(current_row.find("td:eq(4)").text());
            row_count = row_count + 1;
        });

        return row_count;
    }

    function success_transaction() {
        $('#close-reload').on('click', function() {
            $('#success').modal('hide');
            location.reload();
        });
    }
</script>