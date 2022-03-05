@include('layouts.pages.header-login')
<div class="loading-logo-container">
    <div class="square-container">
        <div class="small-square-loader">

        </div>
        <div class="small-square-container">
            <img src="images/app/ACC1.svg" alt="" class="loading-logo">
            <div class="loading-text">L O A D I N G</div>
        </div>
    </div>
</div>
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

    </div>

    <div style="width:100%;">
        <div class="row" style="padding:15% 0; display:block">
            <h1 style="font-size:20px; text-align:center; margin:auto; color:white; position:relative">Your access has been denied</h1>
            <p style="font-size:16px; text-align:center; position:relative; color:white;">By: Management </p>
            <p style="font-size:16px; text-align:center; position:relative; color:white;"><a style="font-size:16px; text-align:center; position:relative; color:white;" href="login" type="button" class="btn-lightblue">Return to login</a></p>
        </div>
    </div>
</div>

@include('layouts.pages.footer-login')
@include('includes.jquery.users.user-login')
<script>
    $(window).on('load', function() {
        $('.loading-logo-container').fadeOut();
    })
</script>