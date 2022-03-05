<script>
    $(document).ready(function() {
        $('.stocks-menu').hide();
        $('.sales-menu').hide();

        $('.stock-button').on('click', function() {
            $('.stocks-menu').slideToggle();
            if ($('.sales-menu').is(':hidden')) {

            } else {
                $('.sales-menu').slideUp();
            }
        });

        $('.sales-button').on('click', function() {
            $('.sales-menu').slideToggle();
            if ($('.stocks-menu').is(':hidden')) {

            } else {
                $('.stocks-menu').slideUp();
            }
        });


    });
</script>