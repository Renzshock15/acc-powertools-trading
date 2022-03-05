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
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link sales-button" role="button" aria-expanded="false"><i class="fas fa-piggy-bank" aria-hidden="true"></i><span class="hide-menu">Sales</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="sales-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales" aria-expanded="false"><i class="far fa-money-bill-alt ml-3" aria-hidden="true"></i><span class="hide-menu">Daily Sales</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sales_returns" aria-expanded="false"><i class="fas fa-undo ml-3" aria-hidden="true"></i><span class="hide-menu">Returns</span></a></li>
                </div>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="repairs" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-wrench" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Repairs</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Add Repair</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="repairs">Repairs</a></li>
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
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-12">
                        <div class="white-box pb-1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12 p-0">Product Name</label>
                                        <div class="col-sm-12 px-0">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search..." class="form-control" id="input_search" name="input_search" autocomplete="off">
                                                <button class="btn btn-dark text-white" name="" id="searchProduct"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="white-box">
                            <h3 class="box-title">For Repair List</h3>
                            <div class="table-responsive">
                                <div id="tbody">
                                    @include('store.product-data')
                                </div>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="white-box">
                    <h3 class="box-title">For Repair Form</h3>
                    <form action="save_repair" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-sm-12 p-0">Receipt Type</label>
                                    <div class="col-sm-12 px-0">
                                        <select class="form-control " name="receipt_type" id="receipt_type">
                                            <option selected="">Select</option>
                                            @foreach ($data['receipts'] as $receipt)
                                            @if(old('receipt_type') == $receipt->abbreviation)
                                            <option value="{{ $receipt->abbreviation }}" selected>{{ $receipt->type }}</option>
                                            @else
                                            <option value="{{ $receipt->abbreviation }}">{{ $receipt->type }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('receipt_type'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('receipt_type') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Receipt Date</label>
                                    <div class="col-md-12 p-0">
                                        <input type="date" class="form-control" name="reciept_date" id="reciept_date" value="{{ old('reciept_date') }}" autocomplete="off">
                                    </div>
                                    @if ($errors->has('reciept_date'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('reciept_date') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Receipt No.</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control" name="receipt_no" id="receipt_no" value="{{ old('receipt_no') }}" autocomplete="off">
                            </div>
                            @if ($errors->has('receipt_no'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('receipt_no') }}
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Product Id</label>
                                    <div class="col-md-12 p-0">
                                        <input type="text" class="form-control bg-white" name="product_id" id="product_id" value="{{ old('product_id') }}" autocomplete="off" readonly>
                                    </div>
                                    @if ($errors->has('product_id'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('product_id') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Product Serial</label>
                                    <div class="col-md-12 p-0">
                                        <input type="text" class="form-control" name="product_serial" id="product_serial" value="{{ old('product_serial') }}" autocomplete="off">
                                    </div>
                                    @if ($errors->has('product_serial'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('product_serial') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Product Name</label>
                            <div class="col-md-12 p-0">
                                <div id="from_product_product_name">
                                    <input type="text" class="form-control bg-white" name="product_name" id="product_name" value="{{ old('product_name') }}" autocomplete="off" readonly>
                                </div>
                            </div>
                            @if ($errors->has('product_name'))
                            <span class="text-danger mt-2" role="alert">
                                {{ $errors->first('product_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Customer Name</label>
                                    <div class="col-md-12 p-0">
                                        <input type="text" class="form-control" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" autocomplete="off">
                                    </div>
                                    @if ($errors->has('customer_name'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('customer_name') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="col-md-12 p-0">Customer Number</label>
                                    <div class="col-md-12 p-0">
                                        <input type="text" class="form-control" name="customer_number" id="customer_number" value="{{ old('customer_number') }}" autocomplete="off">
                                    </div>
                                    @if ($errors->has('customer_number'))
                                    <span class="text-danger mt-2" role="alert">
                                        {{ $errors->first('customer_number') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
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
                        <h5>New product repair has been added</h5>
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

@include('layouts.store.footer')
@include('includes.jquery.store.drop-down')
@include('includes.jquery.store.logo-loader')
<!-- @include('includes.jquery.office.product') -->
<script>
    $(document).ready(function() {
        function fetch_data(page, query) {
            $.ajax({
                url: "/store/fetch_data_for_products?page=" + page + "&query=" + query,
                success: function(data) {
                    $('#tbody').html('');
                    $('#tbody').html(data);


                }
            })
        }

        $(document).on('click', '#searchProduct', function() {
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


        $(document).on('click', '.add_to_repair_form', function() {
            var current_row = $(this).closest("tr");
            $('#product_id').val(current_row.find("td:eq(0)").text());
            $('#product_name').val(current_row.find("td:eq(2)").text());


        });

        $(document).on('click', '.close_redirect', function() {
            window.location.href = "repairs";
        });
    });

    function hide_this() {
        $('.for-hide').hide();
    }
</script>
@if(Session::has('new-repair'))
<script>
    $('#success').modal('show');
</script>
@endif