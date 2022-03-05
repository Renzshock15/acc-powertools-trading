<script>
    $(document).ready(function() {

        // Check if user is Admin
        var user = {
            user_role: "{{ Auth::user()->role->name }}",
            is_admin: "",
            check_user: function() {
                if (this.user_role == 'Full') {
                    this.is_admin = true;
                } else {
                    this.is_admin = false;
                }
            }
        };
        user_role_alert(user);

        // Alert if user role is not full
        function user_role_alert(user) {
            $(document).on('click', '.delete_product', function() {
                var product_id = $(this).data('id');
                var product_name = $(this).data('label');

                user.check_user();
                if (user.is_admin == true) {
                    $('#confirm_delete_product').attr('action', 'product/' + product_id);
                    $('#show_confirm').html('<h5>Are you sure you want to delete ' + product_name + ' ?</h5>')
                    $('#role_admin').modal('show');
                } else {
                    $('#user_role').html('<h5>Ooops!!! sorry you dont have full access</h5>')
                    $('#role_not_admin').modal('show');
                }
            })
        }
    });
</script>
@if(Session::has('delete-success'))
<script>
    $('#success').modal('show');
</script>
@endif