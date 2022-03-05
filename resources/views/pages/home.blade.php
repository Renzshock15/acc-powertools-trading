@include('layouts.pages.header')
<div class="nav-bar">
    <div class="nav-logo">
        <a href="/"><img src="images/app/ACC1.svg" alt=""></a>
    </div>
    <div class="nav-links" id="nav-links">
        <div class="menu-close">
            <i class="fa fa-close" onclick="closeMenu()"></i>
        </div>
        <div class="nav-bord">
            <ul>
                <a href="/">
                    <li class="active">Home</li>
                </a>
                <a href="brands">
                    <li>Brands</li>
                </a>
                <a href="contact-us">
                    <li>Contact us</li>
                </a>

                <!-- <a href="">
            <li>Login</li>
        </a> -->
            </ul>


        </div>

    </div>
</div>

<div class="menu-bar">
    <i class="fa fa-bars" onclick="showMenu()"></i>
</div>
<div class="slider">
    <div class="myslider fade" style="display: block;">
        <div class="txt">
            <h1>Need Supplier?</h1>
            <a href="contact-us" type="button" class="btn-lightblue">Contact us</a>
            <a href="registration" type="button" class="btn-pink">Apply now</a>
            <p></p>
        </div>
        <img src="images/uploads/banners/supplier.jpg" alt="">
    </div>
    <div class="myslider fade">
        <div class="txt">
            <h1></h1>
            <p></p>
        </div>
        <img src="images/uploads/banners/demolition.jpg" alt="">
    </div>
    <div class="myslider fade">
        <div class="txt">
            <h1></h1>
            <p></p>
        </div>
        <img src="images/uploads/banners/Ingco20v.jpg" alt="">
    </div>
    <a class="pre" onclick="plusSlides(-1)">&#10094;</a>
    <a class="nex" onclick="plusSlides(1)">&#10095;</a>

    <div class="dotsbox" style="text-align: center;">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

</div>
<div class="banner">

    <h1>Need Supplier?</h1>
    <a href="contact-us" type="button" class="btn-lightblue">Contact us</a>
    <a href="registration" type="button" class="btn-pink">Apply now</a>
</div>

@include('layouts.pages.footer')