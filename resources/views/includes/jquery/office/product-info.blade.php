<script>
    $(document).ready(function() {
        var imageName = '';
        var imagePath = '';
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            var fd = new FormData();
            var files = $('#customFile')[0].files[0];
            fd.append('customFile', files);

            // Token hand shake
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            $.ajax({
                url: "{{ url('office/image') }}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.imagePath != '') {
                        $('#productImg').attr('src', '../../' + response.imagePath + '/' + response.image);
                        $('.previewImg').show();
                        $('#img_error').html('<strong></strong>');
                        imageName = response.image;
                        imagePath = response.imagePath;
                        toggleSelect('selectPhoto', true);
                        selectPhoto(imageName, imagePath);
                    } else {
                        $('#img_error').html('<strong>' + response.errors.customFile[0] + '</strong>');
                        $('#imageName').val('');
                        $('#productImg').attr('src', '../../images/app/upload-photo.jpg');
                        $('.previewImg').show();
                        $('#image_name').val('');
                        $('#image-product').attr('src', '../../images/app/upload-photo.jpg');
                        $('.image-preview').show();
                        imageName = '';
                        imagePath = '';
                        toggleSelect('selectPhoto', false);
                        selectPhoto(imageName, imagePath);
                    }
                }
            });

        });

        // Select the current selected photo on select
        function selectPhoto(imageName, imagePath) {
            $('#selectPhoto').click(function() {
                if (imageName != '') {
                    $('#image-product').attr('src', '../../' + imagePath + '/' + imageName);
                    $('.image-preview').show();
                    $('#image_name').val(imageName);
                    $('#photoModal').modal('hide');
                } else {
                    $('#image-product').attr('src', '../../images/app/upload-photo.jpg');
                    $('.image-preview').show();

                }

            });
        }

        getShowProductInfo()

        // Disable and enable select button on image upload
        function toggleSelect(elementId, condition) {
            if (condition === true) {
                $('#' + elementId).prop('disabled', false);
            } else {
                $('#' + elementId).prop('disabled', true);
            }

        }

        // Display product info
        function getShowProductInfo() {
            $('#image_name').val("{{ $data['product']->image }}");
            $('#product_code').val("{{ $data['product']->code }}");
            $('#product_name').val("{{ $data['product']->name }}");
            $('#product_description').val("{{ $data['product']->description }}");
            $('#product_price').val("{{ $data['product']->price }}");
            $('#product_discount').val("{{ $data['product']->discount }}");
            $('#product_brand').val("{{ $data['product']->brand_id }}");
            $('#product_category').val("{{ $data['product']->category_id }}");
            $('#image-product').attr('src', "{{$data['product']->image ? '../../images/uploads/products/'.$data['product']->image : '../../images/app/upload-photo.jpg'}}");
        }

        $(document).on('click', '.close-redirect-to-product', function() {
            window.location.href = "{{ url('office/product') }}";
        });

    });
</script>
@if(Session::has('store-success'))
<script>
    $('#success').modal('show');
</script>
@endif
@if(old('product_description') != '')
<script>
    $('#product_description').val("{{ old('product_description') }}");
</script>
@endif