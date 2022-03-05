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
                <li class="">Home</li>
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
    <div class="menu-bar">
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </div>
    <!-- <div class="registration-form">
        <form action="">
            <div class="input-header">
                <h2>Registration Form</h2>
            </div>
            <div class="input-group">
                <label for="fname">First Name: </label>
                <input type="text" id="fname">
            </div>
            <div class="input-group">
                <label for="lname">Last Name: </label>
                <input type="text" id="lname">
            </div>
            <div class="input-group">
                <label for="bname">Bussiness Name: </label>
                <input type="text" id="bname">
            </div>
            <div class="input-group">
                <label for="add">Address: </label>
                <textarea type="text" id="add" rows="3"></textarea>
            </div>
            <div class="input-group">
                <label for="email">Email: </label>
                <input type="email" id="email">
            </div>
            <div class="input-group">
                <label for="contactNo">Contact no: </label>
                <input type="email" id="contactNo">
            </div>
            <div class="input-group">
                <button type="submit" class="btn-pink">Register</button>
            </div>
        </form>
    </div> -->
    <div style="width:100%;">
        <div class="row" style="color: white; padding:15% 0">
            <h1 style="font-size:50px; text-align:center; margin:auto;">Coming Soon</h1>
            <p style="font-size:20px; text-align:center;">2021</p>
        </div>
    </div>
</div>
@include('layouts.pages.footer')
@include('includes.jquery.users.registration')