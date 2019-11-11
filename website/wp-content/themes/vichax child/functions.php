<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action('wp_enqueue_scripts', 'main_js', 100);
function main_js()
{
    wp_dequeue_script('parent_theme_script_handle');
    wp_enqueue_script('child_theme_script_handle', get_stylesheet_directory_uri().'/main.js', array('jquery'));
    wp_localize_script('child_theme_script_handle', 'ajax_var', array('url' => admin_url('admin-ajax.php')));
    
    wp_enqueue_script('child_theme_script_sidebar', get_stylesheet_directory_uri().'/sticky-sidebar.js', array('jquery'));	
}

add_filter( 'eventorganiser_event_tooltip', '_nha_fala_tooltip', 10, 3 );
function _nha_fala_tooltip( $description, $event_id, $occurrence_id, $post ){
    $start = 'Anfang: ' . eo_get_the_start( 'j. F H:i', $event_id, $occurrence_id);
    // $time = 'Zeit: ' . eo_get_the_start( 'H:i', $event_id, null, $occurrence_id );
    $end = 'Ende: ' . eo_get_the_end('j. F H:i', $event_id, $occurrence_id);
    $venue = 'Tagungsort: ' . eo_get_venue_name( eo_get_venue( $event_id ) );
    $description = $start . '<br>' . $end . '<br>' . $venue ;
    return $description;
}

add_action('wp_ajax_sf_future_events_select', 'sf_future_events_select');
add_action('wp_ajax_nopriv_sf_future_events_select', 'sf_future_events_select');

add_action('wp_head', 'nha_fala_favicons');

function nha_fala_favicons()
{
?>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png" />
<?php
}

function sf_future_events_select() {
	$select='';
	if ($_POST['select']!='') {
        $event_category = (string) stripslashes($_POST['select']);
		$select = " event_category='{$event_category}'";
    }
	$event_template = sf_get_event_template();
    $shortcode = "
        [eo_events numberposts=5 order=ASC showpastevents=false {$select}]
        {$event_template}
        [/eo_events]
    ";
	echo do_shortcode($shortcode);
	wp_die(); 
}

function sf_get_event_template()
{
    return '
<div class="future-event-item" data-duration="%event_duration{%d}%">
    <div class="future-event-datetime">
        <span class="future-event-start">%start{j. F}{H:i}%</span> &mdash; 
        <span class="future-event-end"><span class="end-date">%end{j. F}{}%</span>%end{}{H:i}%</span>
        <div class="future-event-duration">%event_duration{%d}% tage</div>
    </div>
    <div class="future-event-details">
        <a class="future-event-link" href="%event_url%">%event_title%</a>
        <div class="future-event-venue"><p>%event_venue%</p></div>
    </div>
</div>
';
}
