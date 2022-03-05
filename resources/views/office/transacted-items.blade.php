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
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="../transaction" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="far fa-clipboard" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Transactions</span></a></li>
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
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link admin-button" role="button" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i><span class="hide-menu">Admin</span><span><i class="fas fa-caret-down rotate"></i></span></a></li>
                <div class="admin-menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../users" aria-expanded="false"><i class="fa fa-users ml-3" aria-hidden="true"></i><span class="hide-menu">Users</span></a></li>
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
                <h4 class="page-title text-uppercase font-medium font-14 mt-1">Transacted Items</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="../transaction">Transactions</a></li>
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
            <div class="col-sm-4">
                <div class="white-box">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="box-title">Transaction Info</h3>
                        </div>
                        <div class="col-6">
                            <a href="../generate_transaction_pdf/{{ $data['transaction']->id }}" target="blank" class="btn btn-warning mb-2 float-right m-l-20  waves-effect waves-light"><i class="far fa-file-pdf" aria-hidden="true"></i> PDF</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Transaction No.</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->id }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Transaction type</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->transaction_type->type_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Receipt</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->transaction_receipt }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">From</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->from }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">To</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->to }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Status</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->status }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Employee</label>
                        </div>
                        <div class="col-8">
                            <label for="">{{ $data['transaction']->user->first_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group text-dark p-0 mt-3">
                                <h3>Total transaction price</h3>
                                <div id="tot">

                                </div>
                                <!-- <input type="number" class="form-control p-0 border-0 bg-white mt-0" name="total_price" id="total_price" disabled="true"> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-8">
                <div class="white-box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="box-title">Item Lists</h3>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table" id="item_list">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Qty</th>
                                    <th class="border-top-0">Unit</th>
                                    <th class="border-top-0">Product Name</th>
                                    <th class="border-top-0">Serial</th>
                                    <th class="border-top-0">Unit Price</th>
                                    <th class="border-top-0">Total Price</th>
                                    <th class="border-top-0">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['transacted_items'] as $transacted_item)
                                <tr>
                                    <td>{{ $transacted_item->quantity }}</td>
                                    <td>{{ $transacted_item->quantity > 1? $transacted_item->inventory->product->unit->name.'s' : $transacted_item->inventory->product->unit->name }}</td>
                                    <td>{{ $transacted_item->inventory->product->code.' ' .$transacted_item->inventory->product->name}}</td>
                                    <td>{{ $transacted_item->serial }}</td>
                                    <td>{{ $transacted_item->inventory->product->price }}</td>
                                    <td>{{ $transacted_item->total_price }}</td>
                                    <td>{{ $transacted_item->note }}</td>
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

@include('layouts.office.footer1')
@include('includes.jquery.office.drop-down')
@include('includes.jquery.office.logo-loader')
<script>
    $(document).ready(function() {

        calculate_total_price();
    });

    function calculate_total_price() {
        var total_price = 0.00;
        $('#item_list tbody tr').each(function() {
            var current_row = $(this);
            var total_product_price = parseInt(current_row.find("td:eq(5)").text());
            total_price = total_price + total_product_price;
        });

        $('#total_price').val(total_price.toFixed(2));
        $('#tot').html('<h1>' + total_price.toFixed(2) + '</h1>')
    }
</script>