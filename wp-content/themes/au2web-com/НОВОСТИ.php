<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .about {
        display: flex;
        justify-content: space-between;
        font-family: 'Cuprum';
    }

    .news {
        display: flex;
    }

    .cell.date {
        flex-basis: 15%;
        margin-right: 10px; /* Điều chỉnh khoảng cách giữa date và text nếu cần thiết */
    }

    .cell.text {
        flex-basis: 75%;
    }
    .content-area {
        padding-top: 30px;
        padding-bottom: 30px;
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
</style>


</head>

<body>
    <?php
    /*
    Template Name: НОВОСТИ
    */

    get_header(); ?>

    <div id="primary" class="content-area">
        <div class="page-head">
            <div class="cell right">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <main id="main" class="site-main" role="main">

            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'category_name'  => 'news',
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="about"> 
                    <article class="news-list"> 
                        <div class="news"> 
                            <div class="cell date" style="color: #28703d;"><?php echo get_the_date('d.m.y'); ?></div> 
                            <div class="cell text"> 
                                <h2><a href="<?php the_permalink(); ?>" style="color: #28703d;font-size: 18px;
    vertical-align: baseline;"><?php the_title(); ?></a></h2> 
                                <p><?php the_excerpt(); ?><a href="<?php the_permalink(); ?>" style="color: #28703d;text-decoration-line: underline;cursor: pointer;">Подробнее</a></p> 
                            </div> 
                        </div> 
                    </article> 
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo 'Không có bài viết.';
            endif;
            ?>

        </main>
    </div>

    <?php
    get_footer();
    ?>
</body>

</html>
