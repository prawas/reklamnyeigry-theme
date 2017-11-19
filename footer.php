<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kristinka
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar( 'footer' ); ?>

		<div class="site-info">

      <div class="pull-right">
        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
        <script src="//yastatic.net/share2/share.js"></script>
        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>
      </div>

			<a href="/">reklamnyeigry.by</a> &mdash; информационный портал о рекламных играх в Беларуси.
      <br/>
      Акции. Скидки. Промо-коды и много другой полезной информации специально для Вас!

		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
