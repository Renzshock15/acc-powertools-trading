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

    <div class="login-form">
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <!-- <?php if (!empty($data['msg_error'])) : ?>
                <div class="error-msg">
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i><?php echo '   ' . $data['msg_error']; ?></p>
                </div>
            <?php endif; ?>
            <?php if (!empty($data['login_success'])) : ?>
                <div class="login-success">
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i><?php echo '   ' . $data['login_success']; ?></p>
                </div>
            <?php endif; ?> -->
            <div class="login-header">
                <img src="images/app/ACC1.svg" alt="">
            </div>

            <div class="login-group">
                <label for="uname">Username </label>
                <input type="text" id="username" name="username" class="form-control mt-0{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" autocomplete="off">
                @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
                <div class="lockpass"><i class="fa fa-user" aria-hidden="true"></i></div>
            </div>
            <div class="login-group">
                <label for="lname">Password </label>
                <input type="password" id="password" class="form-control mt-0{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <div class="lockpass"><i class="fa fa-lock" aria-hidden="true"></i></div>
                <div class="txticon"><span onclick="readPassword()"><i class="fa fa-eye" aria-hidden="true" id="hide1"></i><i class="fa fa-eye-slash" aria-hidden="true" id="hide2"></i></span></div>
            </div>

            <div class="login-group">
                <button type="submit" class="btn-lightblue" name="btn-login">Login</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.pages.footer-login')
@include('includes.jquery.users.user-login')
<script>
    $(window).on('load', function() {
        $('.loading-logo-container').fadeOut();
    })
</script>