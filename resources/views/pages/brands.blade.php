@include('layouts.pages.header')
<div class="nav-bar">
    <div class="nav-logo">
        <a href="/"><img src="images/app/ACC1.svg" alt=""></a>
    </div>

</div>
<div class="nav-links" id="nav-links">
    <div class="menu-close">
        <i class="fa fa-close" onclick="closeMenu()"></i>
    </div>
    <ul>
        <a href="/">
            <li>Home</li>
        </a>
        <a href="brands">
            <li class="active">Brands</li>
        </a>
        <a href="contact-us">
            <li>Contact us</li>
        </a>
        <!-- <a href="">
            <li>Login</li>
        </a> -->
    </ul>
</div>
<div class="menu-bar">
    <i class="fa fa-bars" onclick="showMenu()"></i>
</div>
<!-- <div class="brand-slider">
    <ul id="autoWidth" class="cS-hidden">
        <li class="item-a">
            <a href="#">
                <div class="box">
                    <img src="" alt="">
                </div>
            </a>
        </li>
        <li class="item-a">
            <a href="#">
                <div class="box">
                    <img src="" alt="">
                </div>
            </a>
        </li>
        <li class="item-a">
            <a href="#">
                <div class="box">
                    <img src="" alt="">
                </div>
            </a>
        </li>
        <li class="item-a">
            <a href="#">
                <div class="box">
                    <img src="" alt="">
                </div>
            </a>
        </li>
    </ul>

</div> -->
<div style="width:100%;">
    <div class="row" style="padding:15% 0">
        <h1 style="font-size:50px; text-align:center; margin:auto;">Coming Soon</h1>
        <p style="font-size:20px; text-align:center;">2021</p>
    </div>
</div>
@include('layouts.pages.footer')