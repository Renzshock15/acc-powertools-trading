@include('layouts.pages.header')
<div class="black-bg">
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
    <div class="contact-banner">
        <h3>ACC Power Tools Trading</h3>
        <p>Mobile : (02) 8 257 1714</p>
        <p>Email : haxprime8@gmail.com</p>
        <p>
        <p><a href="https://goo.gl/maps/adrjHke8kFGX3PJT8" target="_blank">005 new public market road<br>
                brgy plaza aldea<br>
                tanay rizal</a></p>
        </p>
        <p>infront of HERMIS DRUG STORE</p>
        <p>Opening Hours :<br>
            Monday – Saturday : 8:00 AM – 5:00 PM<br>
            Sunday : CLOSED</p>
        <p><a href="https://goo.gl/maps/adrjHke8kFGX3PJT8" target="_blank">Get Direction</a></p>

    </div>
</div>
@include('layouts.pages.footer')
@include('includes.jquery.users.contact-us')