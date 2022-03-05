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
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link stock-button" role="button" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-boxes" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Stocks</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="stocks-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inventory" aria-expanded="false"><i class="fa fa-box ml-3" aria-hidden="true"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="transfer" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-arrow-right ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Stock Transfer</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Create Transfer</h4>
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
                    <button class="btn btn-warning text-white mt-2" id="search"><i class="fas fa-search"></i></button>
                </div>

            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-7">
                <div class="white-box">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="box-title">Stock Lists</h3>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="tbody">
                            @include('store.transfer-inventory-data')
                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Transfer Form</h3>
                        </div>
                    </div>
                    <div class="row border">
                        <div class="col-12 mt-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Transfer to</label>
                                <div class="col-sm-12 px-0">
                                    <select class="form-control p-0" name="transfer_location" id="transfer_location">
                                        <option selected="">Select</option>
                                        @foreach ($data['stores'] as $store)
                                        @if(Auth::user()->access->name === 'Warehouse')
                                        @if($store->name === 'Office')
                                        <option value="{{ $store->name.' - '.$store->street.' '.$store->city }}">{{ $store->name.' - '.$store->street.' '.$store->city }}</option>
                                        @endif
                                        @else
                                        <option value="{{ $store->name.' - '.$store->street.' '.$store->city }}">{{ $store->name.' - '.$store->street.' '.$store->city }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger mt-2" role="alert" id="transfer_location_error">
                                    <p>Please select location</p>
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
                                        <th class="border-top-0" width="45%">Item name</th>
                                        <th class="border-top-0 text-center" width="10%">Qty</th>
                                        <th class="border-top-0 text-right" width="15%">Price</th>
                                        <th class="border-top-0 text-right" width="15%">Total Price</th>
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
                                    <button class="btn btn-danger text-white" name="transfer_process" id="transfer_process">Process Transfer</button>
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
    <footer class="footer text-center"> 2021 © RENZOTECH
    </footer>

</div>

<!-- Add item qty -->
<div class="modal fade" id="select_item_qty" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                    <div class="text-dark mt-3 px-3" id="show_confirm">
                    </div>
                </div>
                <div class="row justify-content-center for-hide">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center" name="product-name" id="inventory-id" readonly">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center for-hide">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center" name="actual_qty" id="actual_qty" readonly">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control p-0 border-0 text-center bg-white" name="product-name" id="product-name" disabled="true">
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
                            <input type="number" class="form-control p-0 border-0 border-bottom" name="product_price" id="product_price">
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
                            <input type="number" class="form-control p-0 border-0 border-bottom" name="selected_item_qty" id="selected_item_qty" value="0">
                        </div>
                    </div>
                    <div class="col-1 text-danger mt-2 p-0" id="error-msg">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button class="btn btn-success text-white" name="confirm_add" id="confirm_add">Add to list</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Product exist alert -->
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

<!-- Delete Product Success Modal -->
<div class="modal fade" id="successss" tabindex="-1" role="dialog" aria-labelledby="success" aria-hidden="true">
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

<!-- Transaction completed -->
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
                        <h5>Request transfer is completed</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-reload" data-dismiss="modal" onclick="event.preventDefault();
                                                     document.getElementById('redirect-to-transfers').submit();">Close</button>
            </div>
            <form id="redirect-to-transfers" action="{{ route('transfer_list') }}" method="POST" style="display: none;">
                @csrf
            </form>
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
        $('#transfer_location_error').hide();

        function fetch_data(page, query) {
            $.ajax({
                url: "/store/fetch_data_for_transfer?page=" + page + "&query=" + query,
                success: function(data) {
                    $('#tbody').html('');
                    $('#tbody').html(data);
                    $('.for-hide').hide();
                    add_to_list()
                }
            })
        }

        $(document).on('click', '#search', function() {
            var query = $('#input_search').val();

            var page = $('#hidden_page').val(1);
            fetch_data(page, query);
        });


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
            // var sort_type = $('#hidden_sort_type').val();
            var query = $('#input_search').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query);
        });

        add_to_list()
        calculate_sale_price();
        remove_product_to_list()
        submit_sale_transaction()
    });

    function check_if_free() {

        $('#is_free').prop('checked', false);
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

    function add_to_list() {
        $('.add_to_sale_list').on('click', function() {
            var current_row = $(this).closest("tr")
            var product_id = current_row.find("td:eq(0)").text();
            var product_name = current_row.find("td:eq(2)").text() + ' ' + current_row.find("td:eq(3)").text();
            var product_price = current_row.find("td:eq(4)").text();
            var product_qty = current_row.find("td:eq(5)").text();

            $('#selected_item_qty').val(0);
            $('#inventory-id').val(product_id);
            $('#product-name').val(product_name);
            $('#product_price').val(product_price);
            $('#actual_qty').val(product_qty);
            $('#error-msg').hide();
            $('#select_item_qty').modal('show');

            $('#confirm_add').click(function() {

                if ($('#selected_item_qty').val() == 0 || $('#selected_item_qty').val() > parseInt($('#actual_qty').val())) {
                    $('#error-msg').show();

                } else {
                    var actual_product_price = ($('#selected_item_qty').val() * $('#product_price').val());

                    $('#item_sale_list').append('<tr><td class="inv_id">' + $('#inventory-id').val() + '</td><td>' + $('#product-name').val() + '<td class="text-center product_qty">' + $('#selected_item_qty').val() + '</td><td class="text-right product_price">' + $('#product_price').val() + '</td></td><td class="text-right product_tot_price">' + actual_product_price.toFixed(2) + '</td><td class="text-center"><button class="btn btn-danger text-white" name="remove-item" id="remove-item"><i class="fas fa-times"></i></button><td></td></tr>')
                    $('#select_item_qty').modal('hide');
                    calculate_sale_price();

                }
                $('#inventory-id').val().remove();
                $('#product-name').val().remove();
                $('#product_price').val().remove();
                $('#selected_item_qty').val().remove();
                $('#actual_qty').val().remove();
                actual_product_price.remove();


            });

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

    function submit_sale_transaction() {
        $('#transfer_process').on('click', function() {

            if ($('#transfer_location').val() === "Select") {
                $('#transfer_location_error').show()
            }


            if ($('#transfer_location').val() != "Select") {
                $('#transfer_location_error').hide()

                var row_count = count_items();
                if (row_count == 0) {
                    $('#no_product_on_list').modal('show');
                } else {
                    $('.loading-logo-container').fadeIn();
                    // Token hand shake
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                        }
                    });

                    var table_sale_list = {
                        inventory_id: [],
                        product_qty: [],
                        product_price: [],
                        product_tot_price: []
                    }

                    $('.inv_id').each(function() {
                        table_sale_list.inventory_id.push($(this).text());
                    });

                    $('.product_qty').each(function() {
                        table_sale_list.product_qty.push($(this).text());
                    });

                    $('.product_price').each(function() {
                        table_sale_list.product_price.push($(this).text());
                    });

                    $('.product_tot_price').each(function() {
                        table_sale_list.product_tot_price.push($(this).text());
                    });


                    $.ajax({
                        url: "{{ url('store/transfer_request') }}",
                        method: 'post',
                        data: {
                            table_sale_list: table_sale_list,
                            transfer_location: $('#transfer_location').val(),
                        },
                        success: function(response) {

                            if (response.success == true) {
                                $('.loading-logo-container').fadeOut();
                                $('#success').modal('show');

                            }

                            // success_transafer();
                        }
                    });


                }

            }

            // success_transafer();

        });


    }

    // function success_transafer() {
    //     $('#close-reload').on('click', function() {
    //         $('#success').modal('hide');
    //         window.location.href = 'newPage.html';
    //     });
    // }
</script>