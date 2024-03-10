<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
		.site-main{
			 vertical-align: baseline;
   			 font-family: 'Cuprum';
		}
        #myTable {
            width: 70%; /* Đặt chiều rộng là 70% */
            margin-top: 20px;
            border-collapse: collapse;
			margin-left: auto; /* Để căn giữa theo chiều ngang */
			margin-right: auto; /* Để căn giữa theo chiều ngang */
        }

        #myTable td {
            border-bottom: 1px solid #ddd; /* Thêm đường biên ở phía dưới của mỗi ô */
            padding: 8px;
            text-align: left;
        }
		#myTable tbody tr:hover {
			cursor: pointer;
			background-color: #f0f0f0; /* Thay đổi màu nền khi di vào */
		}
        .modal-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
		.mainTable{
			display: flex;
			padding-top:50px;
			width:100%;
		}
        body {
			vertical-align: baseline;
    font-family: 'Cuprum';
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
		.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
    background-color: #f9f9f9;
    color: #333;
    margin: 0 5px;
}

.pagination .current {
    background-color: #ddd;
    display: inline-block;
    margin: 0 6px;
    text-align: center;
    width: 24px;
    height: 24px;
    border-radius: 12px;
    -webkit-border-radius: 12px;
}

.pagination .dots {
    margin: 0 5px;
}

.pagination .prev, .pagination .next {
    border: none; /* Loại bỏ border cho Previous và Next */
}
		.page-head{
			display: flex;
			justify-content:end;
			margin-top: 30px;
		}
.page-head .right {
        background: #40703d;
        position: relative;
        display: table-cell;
        padding: 17px 0px 14px 50px ;
	    width : 68%;
        border-radius: 30px 0px 0px 0px;
        margin-right: 30px;
    }
    .page-head .right h1 {
        color: #fff;
        font-size: 19px;
        text-transform: uppercase;
        font-family: 'Cuprum';
    }
		.content-area{
			padding-top:30px;
			padding-bottom:30px;
		}
		#myTable .tags-column {
			border-bottom: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		.filter-container {
			margin-bottom: 20px; 
			width: 40%;
			position: absolute;
    		right: 130px;
    		top: 19px;	
		}

		.filter-container label,
		.filter-container select {
			display: inline-block;
			vertical-align: middle;
		}

		.filter-container select {
			margin-left: 10px;
		}
		.sidebar{
			width: 24%;
		}
		.content{
			width: 87%;
		}
    </style>
</head>

<body>
    <?php
/*
Template Name: Recipes
*/
get_header();

$posts_per_page = 5;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type' => 'post', 'posts_per_page' => $posts_per_page, 'paged' => $paged, 'category_name' => 'common');
$posts_query = new WP_Query($args);

?>

<div id="primary" class="content-area">
	<div class="page-head">
		<div class="cell right">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
   <main id="main" class="site-main" role="main">
	  <div class="mainTable">
		  <div class="cell sidebar left">
			  <img src="http://103.149.28.238:81/wp-content/uploads/2024/03/img1.jpg" alt="" style="margin: -50px 0px 0px 0px;">
		  </div>
		  <div class="cell right content">
			  <table id="myTable">
			 <!-- <div class="filter-container">
				 <div class="Selceter" style="display:flex;">
				<select id="tagFilter">
					  <option value="all">Выберите продукт</option>
					  <option value="курица">курица</option>
					  <option value="мясо">мясо</option>
					  <option value="рыба">рыба</option>
					 </select>
					 <select id="tagFilter1">
					  <option value="all">Выберите маринад</option>
					  <option value="моментальный-маринад">Моментальный маринад</option>
					  <option value="классический-маринад">Классический маринад</option>
				  	</select>
				 </div>
		  	</div> -->
         <tbody>
				<?php
				if ($posts_query->have_posts()) :
				   while ($posts_query->have_posts()) :
					  $posts_query->the_post();
				?>
					  <tr class="post-item" data-post-id="<?php echo get_the_ID(); ?>">
						 <td class="open-modal" data-post-id="<?php echo get_the_ID(); ?>"><?php the_title(); ?></td>
						 <td class="tags-column">
							<?php
							$tags = get_the_tags();
							if ($tags) {
								$half_count = ceil(count($tags) / 2);
								$counter = 0;

								foreach ($tags as $tag) {
									$counter++;

									echo $tag->name;

									if ($counter == $half_count) {
										echo '</td><td class="tags-column">';
									} else {
										echo ($counter < count($tags)) ? ', ' : '';
									}
								}
							}
							?>
						</td>
					  </tr>
				<?php
				   endwhile;
				else :
				   echo 'Нет сообщений.';
				endif;
				wp_reset_postdata();
				?>
			 </tbody>
		  </table>
		  </div>
      </div>
	  <!-- Phân trang phía dưới bảng -->
	  <div class="pagination">
		  <?php
			  echo paginate_links(array(
				  'total' => $posts_query->max_num_pages,
				  'prev_text' => 'Previous', // 
				  'next_text' => 'Next',     // 
				  'mid_size' => 1,            // 
			  ));
		  ?>
	   </div>
   </main><!-- #main -->
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
        document.addEventListener('DOMContentLoaded', function () {
            $('.open-modal').on('click', function () {
                var postId = $(this).data('post-id');
                displayModal(postId);
            });

            $('#closeBtn').on('click', function () {
                $('#myModal').css('display', 'none');
            });
			
			
			$('#tagFilter').on('change', function () {
			var selectedTag = $(this).val();
				getPostsByTag(selectedTag);
			});
			$('#tagFilter1').on('change', function () {
			var selectedTag = $(this).val();
				getPostsByTag(selectedTag);
			});
			function getPostsByTag(tag) {
				$.ajax({
					type: 'GET',
					url: ajaxurl,
					data: {
						action: 'get_posts_by_tag',
						tag: tag,
					},
					success: function (response) {
						$('#myTable tbody').html(response);
					}.bind(this)
				});
			}
			
            function displayModal(postId) {
                $.ajax({
                    type: 'GET',
                    url: ajaxurl, 
                    data: {
                        action: 'get_post_content',
                        post_id: postId,
                    },
                    success: function (response) {
						$('#modal-title').text(response.title);
						$('#modal-content').html(response.content);
						// Hiển thị hình ảnh nếu có
						if (response.thumbnail) {
							$('#thumbnail-img').attr('src', response.thumbnail);
							$('.image-container').show(); // Hiển thị container ảnh
						} else {
							$('.image-container').hide(); // Ẩn container ảnh nếu không có ảnh
						}
						// Hiển thị modal
						$('#myModal').css('display', 'block');
					}.bind(this)
                });
            }
        });
    </script>

    <?php get_footer(); ?>
</body>

</html>
