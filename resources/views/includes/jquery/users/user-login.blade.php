@if ($errors->has('password') || $errors->has('username'))
<script>
    $(document).ready(function() {
        const element = document.querySelector('#loginForm');
        element.classList.add('animated', 'shake');
        setTimeout(function() {
            element.classList.remove('shake');
        }, 1000);

    });
</script>
@endif