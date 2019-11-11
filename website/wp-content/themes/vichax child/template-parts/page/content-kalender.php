<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Vichax
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = vichax_utility()->utility; ?>

	<header class="entry-header">
		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title screen-reader-text',
				'html'  => '<h1 %1$s>%4$s</h1>',
				'echo'  => true,
			) );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="container">
			<h3>Zukünftige Ereignisse:</h3>

			<?PHP
			$args = array('type'=> 'post', 'order' => 'ASC', 'hide_empty' => 1 );
			$taxonomies = array('event-category');
			$terms = get_terms( $taxonomies, $args);
			
			// var_dump($terms);
			echo '<select id="sf-future-events-select"><option value="">Alle Terminkategorien</option>';
			foreach($terms as $term) {
				echo '<option value="' . $term->slug . '">'. $term->name .'</option>';
			}
			echo '</select>';
			?>

			<div id="sf-future-events-content">
				<?php 
				$event_template = sf_get_event_template();
				echo do_shortcode("[eo_events numberposts=5 order=ASC showpastevents=false]{$event_template}[/eo_events]");
				?>
			</div>

			<div class="sf-future-events-clear"></div>

			<div class="sf-event-legend">
			<?PHP 
			foreach($terms as $term) {
				echo '<div class="sf-event-legend-cell">'.$term->name . ' <span style="background-color:' . $term->color . ';"></span></div>';
			}
			?>
			</div>

			<?PHP			
			echo do_shortcode('[eo_fullcalendar headerLeft="prev,next today" headerCenter="title" headerRight="category" timeformat="j. F" ]');
			?>

			<?PHP
			echo do_shortcode('[eo_subscribe title="Kalender Abonnieren" type="webcal" class="sf-calendar-subscribe"] Events abonnieren [/eo_subscribe]');
			?>
		</div>
	
		<?php the_content(); ?>
		
		<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'vichax' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links__item">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'vichax' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'vichax' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
