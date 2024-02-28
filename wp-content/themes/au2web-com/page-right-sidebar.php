<?php
get_header(); ?>
<?php do_action( 'flatsome_before_page' ); ?>
<div class="row">
<div id="content" class="large-12 left col col-divided small-col-first" role="main">
	<div class="page-inner">
		<?php if(get_theme_mod('default_title', 0)){ ?>
			<header class="entry-header">
				<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php } ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
			
			<?php if ( comments_open() || '0' != get_comments_number() ){
						comments_template(); } ?>

		<?php endwhile; // end of the loop. ?>
	</div><!-- .page-inner -->
</div><!-- .#content large-9 left -->
</div><!-- .row -->
</div><!-- .page-right-sidebar container -->

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>