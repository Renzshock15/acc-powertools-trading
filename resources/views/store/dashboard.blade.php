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
            <ul id="sidebarnav">
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
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark active" href="dashboard" aria-expanded="false" style="color:#febf52; font-weight:500;"><i class="fas fa-home fa-fw" aria-hidden="true" style="color:#febf52;"></i><span class="hide-menu">Home</span></a></li>
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
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ml-auto">
                        <li><a href="#">Dashboard</a></li>
                    </ol>
                    <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger  d-none d-md-block pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade
                                to Pro</a> -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-12">
                        <div class="white-box pt-2 pb-1 mb-2">
                            <h5 class="box-title mt-1" id="bell-notification">Notification <a role="button" id="show_notification"><span><i class="fas fa-caret-down ml-2"></i></span></a>
                                <div class="float-right"><span class="badge mt-1">{{ $data['notifications']->count() }}</span><span><i class="far fa-bell ml-1 {{ $data['notifications']->count()!=0?'text-danger': ''}}"></i></span></div>
                            </h5>
                            <div class="white-box px-0 p-0" id="notification-data">
                                @foreach($data['notifications'] as $notification)
                                <div class="alert alert-success">
                                    <h5>{{ $notification->message }}</h5>
                                    <a href="{{ $notification->link.'/'.$notification->transaction_id }}" class="btn btn-success text-white btn-sm rounded" aria-pressed="true"><i class="fas fa-arrow-right mr-1" aria-hidden="true"></i>Go</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="white-box">
                            <h3 class="box-title">Monthly Sales</h3>
                            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="">
                    <div class="row">
                        @foreach($data['brands'] as $brand)
                        <div class="col-lg-4 col-md-6">
                            <div class="card bg-c-{{$brand->brand_color->brand_color}}">
                                <div class="card-body {{$brand->brand_color->text_color === 'white' ? 'text-'.$brand->brand_color->text_color: ''}}">
                                    <h5 class="card-title">{{ $brand->name }}</h5>
                                    @php($product_count = 0)
                                    @php($product_total_price = 0.00)
                                    @foreach($data['inventories'] as $inventory)
                                    @if($brand->name === $inventory->product->brand->name)
                                    @php($product_count = $product_count + $inventory->quantity)
                                    @php($product_price = $inventory->quantity * minusPercentage($inventory->product->price, $inventory->product->discount))
                                    @php($product_total_price = $product_total_price + $product_price)
                                    @endif
                                    @endforeach
                                    <h5 class=""><i class=" fas fa-boxes" aria-hidden="true"></i>{{' Total Stocks  '.$product_count}}</h5>
                                    <h5 class=""><i class=" fas fa-tag" aria-hidden="true"></i>{{' Stocks Price  '.number_format($product_total_price, 2, '.', ',')}}</h5>
                                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center"> 2021 © RENZOTECH
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
@include('layouts.store.footer')
@include('includes.jquery.store.drop-down')
@include('includes.jquery.store.logo-loader')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });

        $.ajax({
            url: "{{ url('store/chart_data') }}",
            method: 'post',
            data: {
                transaction_id: 1
            },
            success: function(response) {
                chart_data(response.monthly_sales);

            }
        });

        // notification_shake();
        notification_data()

        $(document).on('click', '#show_notification', function() {
            $('#notification-data').slideToggle();
        });
    });

    function chart_data(monthly_sales) {

        var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        var yValues = [monthly_sales[1], monthly_sales[2], monthly_sales[3], monthly_sales[4], monthly_sales[5], monthly_sales[6], monthly_sales[7], monthly_sales[8], monthly_sales[9], monthly_sales[10], monthly_sales[11], monthly_sales[12]];
        var barColors = ["royalblue", "green", "blue", "orange", "hotpink", "yellow", "aqua", "violet", "lawngreen", "yellowgreen", "grey", "red"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            // options: {...}
        });
    }

    // function notification_shake() {
    //     setInterval(function() {
    //         $('#bell-notification').shake();
    //     }, 3000);
    // }

    function notification_data() {
        var notification_count = "{{ $data['notifications']->count() }}";
        if (parseInt(notification_count) <= 0) {
            $('#show_notification').hide()
        }

        $('#notification-data').hide();
    }
</script>