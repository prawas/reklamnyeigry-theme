<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kristinka
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		$postcount=0;

		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			?>

			<div class="articles-wrapper">

			<?php

	$vse_mesta=[2, 6, 9, 12, 18];
	$banner_1=['<img src="/wp-content/themes/reklamnyeigry-theme/images/728 x 90_1.jpg">', '<img src="/wp-content/themes/reklamnyeigry-theme/images/728 x 90_2.jpg">'];
	$banner_2=['<img src="/wp-content/themes/reklamnyeigry-theme/images/300х600_1.jpg">', '<img src="/wp-content/themes/reklamnyeigry-theme/images/300х600_2.jpg">'];

			$a=rand(1,5);
			if ($a<=4){
				$mesto=$vse_mesta[array_rand($vse_mesta, 1)];
			}
			echo $mesto;


			
			/* Start the Loop */
			
			while ( have_posts() ) : the_post();
				$postcount++;
							
								/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
				
				if ($postcount == 2 || $postcount == 9 ): ?>
						<div class="banner">
							  <?php if (function_exists ('adinserter')) echo adinserter (1);  
							
							if ($mesto==$postcount){
								echo $banner_1[array_rand($banner_1, 1)];
							}?>

						</div>

					<?php 	
				
				endif;

				if ($postcount%6==0):?>
					<article class="kristinka-magazine post" >
						<div class="banner2" >
						<?php if (function_exists ('adinserter')) echo adinserter (2);

								if ($mesto==$postcount){
									echo $banner_2[array_rand($banner_2, 1)];
								}?>

						</div>
					</article>
				<?php 
				endif;

			endwhile; ?>

			</div>

		<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
kristinka_sidebar_select();
get_footer();



