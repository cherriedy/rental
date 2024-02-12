var room_create = {
    uploadImages: function () {
        FilePond.registerPlugin(FilePondPluginImagePreview);

        const images_inputElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(images_inputElement);

        FilePond.setOptions({
            server: {
                process: routes.images.store,
                revert: routes.images.destroy,
                headers: {
                    'X-CSRF-TOKEN': routes.csrf_token,
                },
            },
            allowImagePreview: true,
            imagePreviewMaxHeight: 150,
            labelIdle: `Kéo & thả ảnh hoặc <span class="filepond--label-action">Tải lên</span>`,
        });
    },

    storeRoom: function () {
        $('#create-room-form').submit(function (e) {
            e.preventDefault();

            var url = routes.rooms.store;
            let formData = $('#create-room-form').serialize();

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: "JSON",
                success: function (response) {
                    if (response.status_code == 422) {
                        response.errors.forEach(error => {
                            $.notify(error, "error");
                        });
                    } else if (response.status_code == 200) {
                        $.notify(response.message, "success");
                        window.location.replace(routes.redirect);
                    }
                },
                error: function (response) {
                    $.notify('Ầy, có vẻ là lỗi rồi!', "erorr");
                }
            });
        });
    },

    init: function () {
        this.uploadImages();
        this.storeRoom();
    },
}

jQuery(document).ready(function ($) {
    room_create.init();
});
