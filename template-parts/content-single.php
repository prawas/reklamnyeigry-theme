<?php
/**
 * Template part for displaying single post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kristinka
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_post_thumbnail('kristinka-featured'); ?>

	<header class="entry-header">
		<?php

		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php kristinka_posted_on_single(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( );
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kristinka' ),
				'after'  => '</div>',
			) );
		?>

			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>

			
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php kristinka_entry_footer(); ?>
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
