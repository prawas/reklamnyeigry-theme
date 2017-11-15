<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kristinka

 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php

// You can start editing here -- including this comment!
if ( have_comments() ) : ?>
<h2 class="comments-title">
	
		<?php printf( esc_html( _nx( 'Комментарий к рекламной акции &ldquo;%2$s&rdquo;:', 'Комментарии к рекламной акции &ldquo;%2$s&rdquo;:', get_comments_number(), 'comments title', 'kristinka' ) ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
		?>
	</h2>

<div id="comments" class="comments-area">

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'kristinka' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'kristinka' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'kristinka' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>


	
<ol id="comment-list" >

      <?php
        function verstaka_comment($comment, $args){
          $GLOBALS['comment'] = $comment; 

          ?>

          <div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
            <section class='full_comment' >
            	<div class='full_comment_row' >
              		<div class="ava_in_tabl"  >
              	
                	 <?php echo get_avatar($comment, $size='50', '' ); ?>
                 	</div>
                       
               		<div class="comment_text" >
               			<div class="tabl_comment"><span class="comment-author"><?=get_comment_author_link() ?></span>
                			<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
              
             		 		<?php comment_text() ?>
              			</div>
              		</div>
              </div>
            </section>
              
           </div>
           </div>

            
      <?php }
        $args = array(

          'reply_text' => 'Ответить',
          'callback' => 'verstaka_comment'

        );
        wp_list_comments($args);
      ?>
    </ol>

	

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'kristinka' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'kristinka' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'kristinka' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- #comment-nav-below -->
	<?php
	endif; // Check for comment navigation.

	?>
	</div><!-- #comments -->
	<?php

endif; // Check for have_comments().


// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p class="no-comments"><?php esc_html_e( 'Комментарии отключены.', 'kristinka' ); ?></p>
<?php
endif;
?>

<?php comment_form(); ?>
