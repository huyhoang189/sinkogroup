<style>
.related-post {
    width: 30%;
    float: left;
}

.post-details {
    width: 70%;
    float: right;
}

</style>
<div class="entry-content single-page">

    <?php
    // Lấy tên chuyên mục của bài viết
    $categories = get_the_category();
    $category_names = array();
    foreach ($categories as $category) {
        $category_names[] = $category->slug;
    }

    // Kiểm tra xem bài viết thuộc chuyên mục "НОВОСТИ" hay không
    if (in_array('НОВОСТИ', $category_names)) {
        // Hiển thị bài viết liên quan bên trái
        ?>
        <div class="related-post" style="width: 30%; float: left;">
            <?php
            $orig_post = $post;
            global $post;
            $categories = get_the_category($post->ID);
            if ($categories) {
                $category_ids = array();
                foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                $args = array(
                    'category__in'     => $category_ids,
                    'post__not_in'     => array($post->ID),
                    'posts_per_page'   => 100, // Số lượng bài viết liên quan sẽ hiển thị.
                    'caller_get_posts' => 1
                );
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) {
                    while ($my_query->have_posts()) {
                        $my_query->the_post();
                        ?>
                        <div class="related-post-item">
                            <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                            <!-- Có thể hiển thị thêm thông tin bài viết khác nếu cần -->
                        </div>
                        <?php
                    }
                }
            }
            $post = $orig_post;
            wp_reset_query();
            ?>
        </div>

        <?php
        // Hiển thị ngày tạo và nội dung bài viết bên phải
        ?>
        <div class="post-details" style="width: 70%; float: right;">
            <p class="post-date"><?php echo get_the_date(); ?></p>
            <?php the_content(); ?>
        </div>
        <?php
    } else {
        ?>
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'flatsome'),
            'after'  => '</div>',
        ));
        ?>
        <?php
        // Lấy URL của ảnh đại diện của bài viết
        $post_thumbnail_url = get_the_post_thumbnail_url($post->ID, 'large');

        // Kiểm tra xem có ảnh đại diện không
        if ($post_thumbnail_url) {
            ?>
            <div class="post-thumbnail">
                <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
            </div>
            <?php
        }
        ?>
    <?php } ?>

</div><!-- .entry-content single-page -->

<footer class="entry-meta text-<?php echo flatsome_option('blog_posts_title_align');?>">
<?php
	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list( __( ', ', 'flatsome' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );


	// But this blog has loads of categories so we should probably display them here
	if ( '' != $tag_list ) {
		$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'flatsome' );
	} else {
		$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'flatsome' );
	}
	
	printf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
?>
</footer><!-- .entry-meta -->


<?php if(flatsome_option('blog_author_box')) { ?>
<div class="entry-author author-box">
	<div class="flex-row align-top">
		<div class="flex-col mr circle">
			<div class="blog-author-image">
				<?php 
					$user = get_the_author_meta('ID');
					echo get_avatar($user,90); 
				?>
			</div>
		</div><!-- .flex-col -->
		<div class="flex-col flex-grow">
			<h5 class="author-name uppercase pt-half">
				<?php echo esc_html( get_the_author_meta( 'display_name' ) );?>
			</h5>
			<p class="author-desc small"><?php echo esc_html(get_the_author_meta('user_description'));?></p>
		</div><!-- .flex-col -->
	</div>
</div>
<?php } ?>



<?php $orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 3, // Number of related posts that will be shown.
'caller_get_posts'=>1
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
?>
<div class="related-post">
<div class="clearfix"></div>
   <div class="row large-columns-1 medium-columns-1 small-columns-1">
</div>
 </div>

<?php
}
}
$post = $orig_post;
wp_reset_query(); ?>
