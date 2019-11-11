<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Vichax
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<?php $utility       = vichax_utility()->utility;
	$permalink           = $utility->satellite->get_post_permalink();
	$blog_featured_image = get_theme_mod( 'blog_featured_image', vichax_theme()->customizer->get_default( 'blog_featured_image' ) );
	?>

	<div class="post-list__item-content">

		<header class="entry-header">

			<?php vichax_sticky_label(); ?>

			<?php $title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h3 %1$s><a href="%2$s" rel="bookmark">%4$s</a></h3>';

			$utility->attributes->get_title( array(
					'class' => 'entry-title',
					'html'  => $title_html,
					'echo'  => true,
			) );
			?>

			<a class="post-featured-content post-quote" href="<?php echo esc_url( $permalink ); ?>">
				<?php do_action( 'cherry_post_format_quote' ); ?>
			</a>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php $blog_content = get_theme_mod( 'blog_posts_content', vichax_theme()->customizer->get_default( 'blog_posts_content' ) );
			$length             = ( 'full' === $blog_content ) ? -1 : 55;
			$content_visible    = ( 'none' !== $blog_content ) ? true : false;
			$content_type       = ( 'full' !== $blog_content ) ? 'post_excerpt' : 'post_content';

			$utility->attributes->get_content( array(
					'visible'      => $content_visible,
					'length'       => $length,
					'content_type' => $content_type,
					'echo'         => true,
			) );
			?>
			<?php if ( 'small' === $blog_featured_image ) :
				get_template_part( 'template-parts/content-entry-meta-loop' );
			endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php vichax_share_buttons( 'loop' ); ?>

			<?php $btn_text = get_theme_mod( 'blog_read_more_text', vichax_theme()->customizer->get_default( 'blog_read_more_text' ) );
			$btn_visible    = $btn_text ? true : false;

			$utility->attributes->get_button( array(
				'visible' => $btn_visible,
				'class'   => 'link',
				'text'    => $btn_text,
				'icon'    => '',
				'html'    => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
				'echo'    => true,
			) );
			?>
		</footer><!-- .entry-footer -->
	</div><!-- .post-list__item-content -->

</article><!-- #post-## -->
