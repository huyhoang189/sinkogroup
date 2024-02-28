<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;            
        }

        #myModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            max-width: 600px;
            width: 90%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            border: none;
            padding: 5px;
            background-color: transparent;
        }

       .modal-body {
			display: flex;
			justify-content: center; /* Căn giữa theo chiều ngang */
			align-items: center; /* Căn giữa theo chiều dọc */
		}

		.image-container {
			flex: 1;
			text-align: left; /* Căn trái cho ảnh trong container */
		}

		#thumbnail-img {
			max-width: 100%;
			max-height: 100%;
			border-radius: 10px;
		}

		.text-container {
			flex: 2;
			padding-left: 20px;
		}

		.modal-content {
			max-height: 600px;
			overflow-y: auto;
		}

        .text-container {
            flex: 2;
            padding-left: 20px;
        }

        .modal-title {
            font-size: 1.8em;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .modal-content {
            max-height: 600px;
            overflow-y: auto;
        }

        .page-headpro {
            background: #f8f7fe;
            position: relative;
            float: right;
            display: table-cell;
        }

        .page-headpro .left {
            text-align: center;
            position: relative;
            width: 240px;
            display: table-cell;
            vertical-align: middle;
        }

        .page-headpro .right {
            display: table-cell;
            position: relative;
            width: 800px;
            padding: 25px 0px 25px 50px;
            border-radius: 30px 0px 0px 0px;
            -webkit-border-radius: 30px 0px 0px 0px;
            -moz-border-radius: 30px 0px 0px 0px;
        }

        .catalog article {
			width: 100%;
			border-bottom: 1px solid #d1d1d1;
			padding-bottom: 30px;
			margin-bottom: 30px;
			display: flex;
		}

		.catalog article .pic {
			width: 60%; /* Thay đổi kích thước của .pic thành 100% */
			text-align: center; /* Căn giữa nội dung trong .pic */
			vertical-align: middle;
		}

		.catalog article .pic img {
			max-width: 100%; /* Đảm bảo ảnh không vượt quá kích thước của .pic */
			max-height: 100%;
			border-radius: 10px;
		}

		.Tablecell {
			display: table-cell;
			padding-left: 20px; /* Thêm padding để tạo khoảng cách giữa ảnh và nội dung văn bản */
		}

		.thumbnail-image {
			max-width: 100%;
			height: auto;
			border-radius: 10px;
		}

		.catalog .Tablecell {
			display: table-cell;
			padding: 0 20px; /* Add padding to space out title and excerpt */
		}

		.custom-excerpt {
			font-size: 16px; /* Adjust the font size for better readability */
			color: #555; /* Change text color to a darker shade */
		}
    </style>
</head>

<body>
    <div class="page-headpro" style="width: 100%;">
        <div class="left"><img src="https://web.archive.org/web/20200202121019im_/http://sinkogroup.ru/upload/resize_cache/iblock/eb1/200_200_1/eb1de611490343ae008ca64f0616e947.png" alt=""></div>
        <div class="cell right catalog-menu" style="background-color: #ba9b43">
            <ul class="sectionsbylink">
                <?php
                // Lấy danh sách chuyên mục con của chuyên mục archive
                $archive_category_id = get_queried_object_id();
                $child_categories = get_categories(array('child_of' => $archive_category_id));

                // Hiển thị danh sách chuyên mục con
                foreach ($child_categories as $category) {
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="catalog">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
		?>
			<article>
				<div class="pic">
					<a href="" class="open-modal" data-postid="<?php the_ID(); ?>">
						<?php the_post_thumbnail('medium', ['class' => 'thumbnail-image']); ?>
					</a>
				</div>
				<div class="Tablecell">
					<h2><a href="" class="open-modal" data-postid="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
					<?php
					$raw_excerpt = get_the_excerpt();
					$stripped_excerpt = wp_strip_all_tags($raw_excerpt);
					echo '<p class="custom-excerpt">' . $stripped_excerpt . '</p>';
					?>
				</div>
			</article>
		<?php
			endwhile;
		endif;
		?>
	</div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeBtn">&times;</span>
            <div class="modal-body">
                <div class="image-container">
                    <img src="" alt="Post Thumbnail" id="thumbnail-img">
                </div>
                <div class="text-container">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <div id="modal-content" class="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.open-modal', function (e) {
                e.preventDefault();
                var postID = $(this).data('postid');
                var modal = $('#myModal');

                $.ajax({
                    type: 'GET',
                    url: ajaxurl,
                    data: {
                        action: 'get_post_content',
                        post_id: postID,
                    },
                    success: function (response) {
                        var postTitle = $(this).closest('.post').find('h2').text();
                        $('#modal-title').text(postTitle);
                        $('#modal-content').html(response.content);

                        // Hiển thị hình ảnh nếu có
                        if (response.thumbnail) {
                            $('#thumbnail-img').attr('src', response.thumbnail);
                            $('.image-container').show(); // Hiển thị container ảnh
                        } else {
							$('.image-container').hide(); // Ẩn container ảnh nếu không có ảnh
                        }

                        modal.css('display', 'block');
                    }.bind(this) // Đảm bảo rằng "this" trong success callback là đúng
                });
            });

            $('#closeBtn').on('click', function () {
                $('#myModal').css('display', 'none');
            });
        });
    </script>

</body>

</html>
                           
