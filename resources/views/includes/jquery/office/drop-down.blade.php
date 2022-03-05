<script>
    $(document).ready(function() {
        $('.stocks-menu').hide();
        $('.admin-menu').hide();
        $('.other-menu').hide();

        $('.stock-button').on('click', function() {
            $('.stocks-menu').slideToggle();
            if ($('.admin-menu').is(':hidden') && $('.other-menu').is(':hidden')) {

            } else {
                $('.admin-menu').slideUp();
                $('.other-menu').slideUp();
            }
        });

        $('.admin-button').on('click', function() {
            $('.admin-menu').slideToggle();
            if ($('.stocks-menu').is(':hidden') && $('.other-menu').is(':hidden')) {

            } else {
                $('.stocks-menu').slideUp();
                $('.other-menu').slideUp();
            }
        });

        $('.other-button').on('click', function() {
            $('.other-menu').slideToggle();
            if ($('.stocks-menu').is(':hidden') && $('.admin-menu').is(':hidden')) {

            } else {
                $('.stocks-menu').slideUp();
                $('.admin-menu').slideUp();
            }
        });

    });
</script>