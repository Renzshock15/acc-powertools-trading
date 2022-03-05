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
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="inventory" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fa fa-box ml-3" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Inventory</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="transfer" aria-expanded="false"><i class="fas fa-arrow-right ml-3" aria-hidden="true"></i><span class="hide-menu">Stock Transfer</span></a></li>
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
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mt-2 mb-1">
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Inventory</h4>
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
                                <label class="col-sm-12 p-0">Product Code / Name</label>
                                <div class="col-sm-12 px-0">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." class="form-control" id="search_item" name="search_item" autocomplete="off">
                                        <button class="btn btn-dark text-white" name="" id="searchProduct"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group mb-4">
                                <label class="col-sm-12 p-0">Brands</label>
                                <div class="col-sm-12 px-0">
                                    <select class="form-control" name="brand_name" id="brand_name">
                                        <option selected="">All</option>
                                        @foreach($data['brands'] as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
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
                        <div class="col-6">
                            <h3 class="box-title">Inventory List</h3>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger float-right" id="btn-getpdf"><i class="far fa-file-pdf mr-1"></i>PDF</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="tbody">
                            @include('store.inventory-list-data')
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

<!-- Modal -->
<div class="modal fade" id="show_product_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <div id="product_title_name"></div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="">
                    <img width="100%" alt="user" src="" id="productImg">
                </div>
                <div class="p-2">
                    <div id="product_desc"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
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
        function fetch_data(page, query, brand) {
            $('.loading-logo-container').fadeIn();
            $.ajax({
                url: "/store/get_inventory_list_data?page=" + page + "&query=" + query + "&brand=" + brand,
                success: function(data) {
                    $('.loading-logo-container').fadeOut();
                    $('#tbody').html('');
                    $('#tbody').html(data);
                }
            })
        }

        $(document).on('click', '#searchProduct', function() {
            var query = $('#search_item').val();
            var page = $('#hidden_page').val(1);
            var brand = $('#brand_name').val();
            fetch_data(page, query, brand);
        });


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
            // var sort_type = $('#hidden_sort_type').val();
            var query = $('#search_item').val();
            var brand = $('#brand_name').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query, brand);
        });

        $(document).on('change', '#brand_name', function() {
            var brand = $('#brand_name').val();
            var query = $('#search_item').val();
            var page = $('#hidden_page').val(1);
            fetch_data(page, query, brand);
        });

        $(document).on('click', '#btn-getpdf', function() {
            var brand = $('#brand_name').val();
            window.open('stocks_pdf/' + brand);
        });
        // Check if Product exist in the store inventory

        $(document).on('click', '.add_inventory', function() {
            var product_id = $(this).data('id');
            var product_name = $(this).data('label');


            // Token hand shake
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            var redirect_url = 'add_new_inventory/' + product_id;
            window.location.href = redirect_url;
        });

        $(document).on('click', '.repack_inventory', function() {
            var product_id = $(this).data('id');
            var product_name = $(this).data('label');


            // Token hand shake
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            var redirect_url = 'repack_inventory/' + product_id;
            window.location.href = redirect_url;
        });

        $(document).on('click', '.show_details', function() {
            var product_image = $(this).data('img');
            var product_name = $(this).data('name');
            var product_description = $(this).data('details');
            var image_to_be_shown = '';

            if (product_image === '') {
                image_to_be_shown = '../images/app/upload-photo.jpg';
            } else {
                image_to_be_shown = '../images/uploads/products/' + product_image;
            }

            $('#productImg').attr('src', image_to_be_shown);
            $('#product_title_name').html(product_name);
            $('#product_desc').html('<p class="p-2">' + product_description + '</p>')
            $('#show_product_details').modal('show');
        });
    });
</script>