jQuery(document).ready(function ($) {
    // Thêm nút xem trước bên cạnh file
    $(document).on('click', '.attachment', function () {
		console.log("adsd")
        var attachment_id = $(this).data('id');
        var preview_container = $(this).find('.media-preview-container');

        // Kiểm tra xem xem trước đã được tạo hay chưa
        if (preview_container.length === 0) {
            // Tạo container cho xem trước
            preview_container = $('<div class="media-preview-container"></div>');
            $(this).append(preview_container);

            // Gửi request Ajax để lấy thông tin về file
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'get_media_info',
                    attachment_id: attachment_id
                },
                success: function (response) {
                    if (response.success) {
                        // Hiển thị thông tin về file trong xem trước
                        var html = '<strong>Tên file:</strong> ' + response.data.title + '<br>';
                        html += '<strong>Mô tả:</strong> ' + response.data.description + '<br>';
                        // Thêm thông tin khác tùy thuộc vào nhu cầu

                        preview_container.html(html);
                    } else {
                        preview_container.html('<span class="error">' + response.data + '</span>');
                    }
                }
            });
        } else {
            // Nếu xem trước đã được tạo, ẩn hoặc hiển thị nó
            preview_container.toggle();
        }
    });
});