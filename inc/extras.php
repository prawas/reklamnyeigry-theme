<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kristinka
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kristinka_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'kristinka_body_classes' );

/****************************************************************************************/

add_filter( 'body_class', 'kristinka_body_class' );
/**
 * Throwing different body class for the different layouts in the body tag
 */
function kristinka_body_class( $classes ) {
  
  $kristinka_default_layout = get_theme_mod( 'kristinka_default_layout', 'right_sidebar' );

  if( $kristinka_default_layout == 'right_sidebar' ) { $classes[] = ''; }
  elseif( $kristinka_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
  elseif( $kristinka_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
  elseif( $kristinka_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

  return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'kristinka_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function kristinka_sidebar_select() {

  $kristinka_default_layout = get_theme_mod( 'kristinka_default_layout', 'right_sidebar' );

  if( $kristinka_default_layout == 'right_sidebar' or $kristinka_default_layout == 'left_sidebar') { get_sidebar(); }

}
endif;

/****************************************************************************************/

add_filter( 'excerpt_length', 'kristinka_excerpt_length' );

function kristinka_excerpt_length( $length ) {
  return 24;
}

add_filter( 'excerpt_more', 'kristinka_excerpt_more' );

function kristinka_excerpt_more( $more ) {
  return '';
}

/****************************************************************************************/

add_action('wp_head', 'kristinka_custom_css');
/**
* Hooks the Custom Internal CSS to head section
*/
function kristinka_custom_css() {
  $kristinka_internal_css = '';
  $primary_color = esc_attr(get_theme_mod( 'kristinka_primary_color', '#249ccc' ));
  if( $primary_color != '#249ccc' ) {
    $kristinka_internal_css .= 'button,input[type="button"],input[type="reset"],input[type="submit"]{background: '.$primary_color.';}
    #masthead nav{border-top: 4px solid '.$primary_color.';}
    a{color: '.$primary_color.';}
    .main-navigation li:hover > a,.main-navigation li.focus > a,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.main-navigation .current-menu-ancestor > a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,a.more-link,#comments .reply a {background-color: '.$primary_color.';}
    .widget .widget-title{border-bottom: 4px solid '.$primary_color.';}';
  }

  if( !empty( $kristinka_internal_css ) ) {
    echo '<!-- '.get_bloginfo('name').' Internal Styles -->';
    ?><style type="text/css"><?php echo $kristinka_internal_css; ?></style>
    <?php
  }
}

/**************************************************************************************/

add_action('wp_head', 'kristinka_custom_user_css');
/**
* Hooks the Custom User CSS to head section
*/
function kristinka_custom_user_css() {
  $kristinka_user_css = esc_attr(get_theme_mod( 'kristinka_custom_css' ));

  if( !empty( $kristinka_user_css ) ) {
    echo '<!-- '.get_bloginfo('name').' Custom User CSS Styles -->';
    ?><style type="text/css"><?php echo $kristinka_user_css; ?></style>
    <?php
  }
}

/**************************************************************************************/

if ( ! function_exists( 'kristinka_social_links' ) ) :
/**
 * This function is for social links display on header
 */
function kristinka_social_links() {

 $kristinka_social_links = array( 'kristinka_social_facebook'   => __( 'Facebook', 'kristinka' ),
  'kristinka_social_twitter'     => __( 'Twitter', 'kristinka' ),
  'kristinka_social_googleplus'  => __( 'Google-Plus' , 'kristinka' ),
  'kristinka_social_instagram'   => __( 'Instagram', 'kristinka' ),
  'kristinka_social_pinterest'   => __( 'Pinterest', 'kristinka' ),
  'kristinka_social_youtube'     => __( 'YouTube', 'kristinka' )
  );
  ?>
  <div class="social-icon">
    <ul>
      <?php
      $i=0;
      $kristinka_links_output = '';
      foreach( $kristinka_social_links as $key => $value ) {
        $link = get_theme_mod( $key , '' );
        if ( !empty( $link ) ) {
          if ( get_theme_mod( $key.'_checkbox', 0 ) == 1 ) { $new_tab = 'target="_blank"'; } else { $new_tab = ''; }
          $kristinka_links_output .=
          '<li><a href="'.esc_url( $link ).'" '.$new_tab.'><i class="fa fa-'.strtolower($value).'"></i></a></li>';
        }
        $i++;
      }
      echo $kristinka_links_output;
      ?>
    </ul>
  </div><!-- .social-links -->
  <?php
}
endif;

/****************************************************************************************/

function kristinka_the_custom_logo() {
   if ( function_exists( 'the_custom_logo' ) ) {
      the_custom_logo();
   }
}
