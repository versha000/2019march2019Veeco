<?php
/*
 Plugin Name:The Events Calendar Shortcode and Templates 
 Plugin URI:https://eventscalendartemplates.com/
 Description:The Events Calendar Shortcode and Templates addon provides best events list page template design and events shortcode generator functionality for <a href="http://wordpress.org/plugins/the-events-calendar/">The Events Calendar (by Modern Tribe)</a> plugin (Gutenberg compatible).
 Version:1.3
 Requires at least: 3.5
 Tested up to: 5.0
 Requires PHP: 5.6
 Stable tag: trunk
 Author:Cool Plugins
 Author URI:https://coolplugins.net/
 License URI:https://www.gnu.org/licenses/gpl-2.0.html
 Domain Path: /languages
 Text Domain:ect
*/

if (!defined('ABSPATH')) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
if (!defined('ECT_VERSION_CURRENT')) {
    define('ECT_VERSION_CURRENT', '1.3');
}


/*** Defined constent for later use */
define('ECT_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('ECT_PLUGIN_DIR', plugin_dir_path( __FILE__ ));


/*** EventsCalendarTemplates main class by CoolPlugins.net */
if (!class_exists('EventsCalendarTemplates')) {
    class EventsCalendarTemplates {

    	/*** Construct the plugin object  */
        public function __construct() {

			/*** Check The Event Calendar is installed or not */	
			add_action( 'plugins_loaded', array( $this, 'check_event_calender_installed' ));
			
			/*** Load required files */
			add_action( 'plugins_loaded',array($this,'ect_load_files'));

			/*** This hook creates setting panel */
			add_action( 'tf_create_options','ect_Options');			

        	/*** Enqueued script and styles */
			add_action('wp_enqueue_scripts', array($this, 'ect_styles'));
			add_action('admin_enqueue_scripts',array($this,'ect_tc_css'));
			
			/*** tinymce shortcode generator hook */
			add_action('after_setup_theme', array($this, 'ect_add_tc_button'));

			/*** Template Setting Page Link */
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this,'ect_template_settings_page'));

			/*** ECT main shortcode */
			add_shortcode('events-calendar-templates', array( $this,'ect_shortcodes'));
			
			foreach (array('post.php','post-new.php') as $hook) {
				add_action("admin_head-$hook", array( $this,'ect_cats'));
			}

			//added notice for save settings
			add_action('admin_init',array($this,'ectf_set_notice_timing'));
			add_action( 'admin_notices',array($this,'ectf_admin_save_settings_notice'));

			/*** Include Gutenberg Block */
			require_once(ECT_PLUGIN_DIR.'/gutenberg-block/ect-block.php' );

		}

		/*** Check The Events calender is installled or not. If user has not installed yet then show notice */	
		public  function check_event_calender_installed(){
			if ( ! class_exists( 'Tribe__Events__Main' ) or ! defined( 'Tribe__Events__Main::VERSION' )) {
				add_action( 'admin_notices', array( $this, 'Install_ECT_Notice' ) );
			}
		}
        public function Install_ECT_Notice(){
        	if ( current_user_can( 'activate_plugins' ) ) {
        		$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';	
        		$title = __( 'The Events Calendar', 'tribe-events-ical-importer' );
        		echo '<div class="error CTEC_Msz"><p>' . sprintf( __( 'In order to use this addon, Please first install the latest version of <a href="%s" class="thickbox" title="%s">%s</a> and add an event.', 'ect' ), esc_url( $url ), esc_attr( $title ),esc_attr( $title ) ) . '</p></div>';
        	}
		}
			
		/*** Load required files */
		public function ect_load_files() {
			/*** Check whether the Titan Framework plugin is activated, and notify if it isn't */
			require_once( 'titan-framework/titan-framework-embedder.php' );
						
			/*** Include settings and dynamic css file */
			require_once(ECT_PLUGIN_DIR.'/includes/ect-settings.php');

			/*** Plugin review notice file */ 
			require_once(ECT_PLUGIN_DIR.'/includes/ect-feedback-notice.php');
			new ECTFeedbackNotice();
		}

		/*** Register CSS style assets */
		public function ect_styles(){
			wp_register_style('ect-common-styles', ECT_PLUGIN_URL . 'css/ect-common-styles.css',null, null,'all' );	
			wp_register_style('ect-timeline-styles', ECT_PLUGIN_URL . 'css/ect-timeline.css',null, null,'all' );
			wp_register_style('ect-list-styles', ECT_PLUGIN_URL . 'css/ect-list-view.css',null, null,'all' );	
		}
		/*** Admin side shortcode generator style CSS */
		public function ect_tc_css() {
			wp_enqueue_style('sg-btn-css', plugins_url('/css/shortcode-generator.css', __FILE__));
		}
		/*** Load CSS styles based on template. */
		public function ect_load_requried_assets($template) {
			wp_enqueue_style('ect-common-styles');
			if(in_array($template,array("timeline","classic-timeline",'timeline-view'))) {
				wp_enqueue_style('ect-timeline-styles');
			}
			else{
				wp_enqueue_style('ect-list-styles');
			}	
		}

		/*** Integrate shortcode generator in tinymce editor */
		public function ect_add_tc_button() {
			global $typenow;
			/*** check user permissions */
			if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
				return;
			} 
				
			/*** check if WYSIWYG is enabled */
			if ( get_user_option('rich_editing') == 'true') {
				add_filter("mce_external_plugins",array($this,"ect_add_tinymce_plugin"));
				add_filter('mce_buttons',array($this,'ect_register_tc_button'));
			}
		}	
		public function ect_add_tinymce_plugin($plugin_array) 
		{
			$plugin_array['ect_tc_button'] = plugins_url( '/js/shortcode-generator.js', __FILE__ ); 
			return $plugin_array;
		}
		public function ect_register_tc_button($buttons) {
		   array_push($buttons, "ect_tc_button");
		   return $buttons;
		}

		/*** Add links in plugin install list */
		public function ect_template_settings_page($links){
			$links[] = '<a style="font-weight:bold" href="'. esc_url( get_admin_url(null, 'edit.php?post_type=tribe_events&page=edit.php%3Fpost_type%3Dtribe_events-events-template-settings') ) .'">Template Settings</a>';
			// $links[] = '<a  style="font-weight:bold" href="https://eventscalendartemplates.com/" target="_blank">View Demos</a>';
			return $links;
		}
   
		/*** ECT main shortcode */	
   		public function ect_shortcodes($atts){
       		if ( !function_exists( 'tribe_get_events' ) ) {
				return;
			}
			global $wp_query, $post;
			global $more;
			$more = false;
			/*** Set shortcode default attributes */
			$attribute = shortcode_atts( apply_filters( 'ect_shortcode_atts', array(
				'template' => 'default',
				'style' => 'style-1',
				'category' => 'all',
				'date_format' => 'default',
				'start_date' => '',
				'end_date' => '',
				'time' => 'future',
				'order' => 'ASC',
				'limit' => '10',
				'hide-venue' => 'no',

				'event_tax' => '',
				'month' => '',
				'tags' => '',
				'icons' => '',
				'layout' => '',
				'title' => '',
				'design' => ''		
			), $atts ), $atts);
			/*** Default var for later use */
			$output='';
			$events_html='';
			$template=isset($attribute['template'])?$attribute['template']:'default';
			$style=isset($attribute['style'])?$attribute['style']:'style-1';

			/*** Load CSS styles based on template. */
			$this->ect_load_requried_assets($template);

			/*** create query args based on shortcode attributes */
			if($attribute['category']!="all"){
				if ( $attribute['category'] ) {
					if ( strpos( $attribute['category'], "," ) !== false ) {
						$attribute['category'] = explode( ",", $attribute['category'] );
						$attribute['category'] = array_map( 'trim',$attribute['category'] );
					} else {
						$attribute['category'] = $attribute['category'];
					}

					$attribute['event_tax'] = array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'tribe_events_cat',
							'field' => 'name',
							'terms' =>$attribute['category'],
						),
						array(
							'taxonomy' => 'tribe_events_cat',
							'field' => 'slug',
							'terms' =>$attribute['category'],
						)
					);
				}
			}

			$prev_event_month='';
			$prev_event_year='';
			$meta_date_compare = '>=';
			$attribute['key']='_EventStartDate'; 
			if ($attribute['time']=='past') {
				$meta_date_compare = '<';
			}
			$meta_date_date = current_time( 'Y-m-d H:i:s' );
			$attribute['meta_date'] = array(
				array(
					'key' =>'_EventEndDate',
					'value' => $meta_date_date,
					'compare' => $meta_date_compare,
					'type' => 'DATETIME'
				));		
			if (!empty($attribute['start_date']) && !empty($attribute['end_date'])) {
				$attribute['meta_date'] = array(
				array(
					'key' =>'_EventStartDate',
					'value' => array($attribute['start_date'],$attribute['end_date']),
					'compare' => 'BETWEEN',
					'type' => 'DATETIME'
				));
			}

			/*** Fetch events based upon mentioned values */
			$all_events = tribe_get_events( apply_filters( 'ect_args_filter', array(
				'post_status' => 'publish',
				'hide_upcoming' => true,
				'posts_per_page' => $attribute['limit'],
				'tax_query'=> $attribute['event_tax'],
				'meta_key' => $attribute['key'],
				'orderby' => 'meta_value',
				'order' => $attribute['order'],
				'meta_query' =>$attribute['meta_date'],
			), $attribute, $meta_date_date, $meta_date_compare ) );
			
			$i=0;
			if ($all_events) {		
				foreach( $all_events as $post ):setup_postdata( $post );
				$event_title='';
				$event_content='';
				$event_img='';
				$event_schedule='';
				$event_day='';
				$event_cost='';
				$event_venue='';			
				$events_date_header='';
				$no_events='';
				$event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'ect-featured-event' : 'ect-simple-event';
				$event_id=$post->ID;
			
				/*** Event date headers for timeline template */
				$show_headers = apply_filters( 'tribe_events_list_show_date_headers', true );
				if ( $show_headers ) {
					$event_year= tribe_get_start_date( $post, false, 'Y' );
					$event_month= tribe_get_start_date( $post, false, 'm' );
					$month_year_format= tribe_get_date_option( 'monthAndYearFormat', 'F Y' );
					if ($prev_event_month != $event_month || ( $prev_event_month == $event_month && $prev_event_year != $event_year ) ) {		
						$prev_event_month=$event_month;
						$prev_event_year= $event_year;
						$date_header= sprintf( "<span class='month-year-box'>%s</span>", tribe_get_start_date( $post, false, $month_year_format ) );		
						$events_date_header.='<!-- Month / Year Headers -->';
						$events_date_header.=$date_header;	
					}
				}

				/*** Event venue details */
				$venue_details_html='';
				$venue_details = tribe_get_venue_details();
				$has_venue_address = (!empty( $venue_details['address'] ) ) ? ' location' : '';				
				/*** Setup an array of venue details for use later in the template */
				if($attribute['hide-venue']!="yes") {
					if($template=="classic-list" || $template=="modern-list" || $template=="default") {
						$venue_details_html.='<div class="ect-list-venue '.$template.'-venue">';
					}
					else {
						$venue_details_html.='<div class="'.$template.'-venue">';
					}

					if (tribe_has_venue()) :
					if(!empty($venue_details['address']) && isset($venue_details['linked_name'])){
						$venue_details_html.='<span class="ect-icon"><i class="ect-icon-location"></i></span>';
					}		
					$venue_details_html.='<!-- Event Venue Info -->
					<span class="ect-venue-details ect-address">
					<div>';
					$venue_details_html.=implode(',', $venue_details );
					$venue_details_html.='</div>';
					if ( tribe_get_map_link() ) {
						$venue_details_html.='<span class="ect-google">'.tribe_get_map_link_html().'</span>';
					}
					$venue_details_html.='</span>';
					endif ;

					$venue_details_html.='</div>';
				}

				/*** Event Cost */
				if ( tribe_get_cost() ) : 
					$event_cost='<!-- Event Ticket Price Info -->
					<div class="ect-rate-area">
					<span class="ect-icon"><i class="ect-icon-ticket"></i></span>
					<span class="ect-rate">'.tribe_get_cost(null, true ).'</span>
					</div>';
				endif;

				/*Date Format START*/
				$ev_time=$this->ect_tribe_event_time(false);
				if($attribute['date_format']=="DM") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'M' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="MD") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'M' ).'</span>
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="FD") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'F' ).'</span>
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="DF") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'F' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="FD,Y") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'F' ).'</span>
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'<i class="date-comma">, </i></span>
									<span class="ev-yr">'.tribe_get_start_date($event_id, false, 'Y' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="MD,Y") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'M' ).'</span>
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'<i class="date-comma">, </i></span>
									<span class="ev-yr">'.tribe_get_start_date($event_id, false, 'Y' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="MD,YT") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'M' ).'</span>
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'<i class="date-comma">, </i></span>
									<span class="ev-yr">'.tribe_get_start_date($event_id, false, 'Y' ).'</span>
									<span class="ev-time"><span class="ect-icon"><i class="ect-icon-clock"></i></span> '.$ev_time.'</span>
									</div>';
				}
				else if($attribute['date_format']=="DML") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'M' ).'</span>
									<span class="ev-time">'.tribe_get_start_date($event_id, false, 'l' ).'</span>
									</div>';
				}
				else if($attribute['date_format']=="full") {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'F' ).'</span>
									<span class="ev-yr">'.tribe_get_start_date($event_id, false, 'Y' ).'</span>
									<span class="ev-time"><span class="ect-icon"><i class="ect-icon-clock"></i></span> '.$ev_time.'</span>
									</div>';
				}
				else {
					$event_schedule='<div class="ect-date-area '.$template.'-schedule">
									<span class="ev-day">'.tribe_get_start_date($event_id, false, 'd' ).'</span>
									<span class="ev-mo">'.tribe_get_start_date($event_id, false, 'F' ).'</span>
									<span class="ev-yr">'.tribe_get_start_date($event_id, false, 'Y' ).'</span>
									</div>';
				}
				/*** event day */
				$event_day='<span class="event-day">'.tribe_get_start_date($event_id, true, 'l').'</span>';
				/*Date Format END*/

				// Organizer
				$organizer = tribe_get_organizer();

				/*** Event title */
				$event_title='<a class="ect-event-url" href="'.esc_url( tribe_get_event_link()).'" rel="bookmark">'. get_the_title().'</a>';
					
				/*** Event description - content */
				$event_content='<!-- Event Content --><div class="ect-event-content">';
				$event_content.=tribe_events_get_the_excerpt($event_id, wp_kses_allowed_html( 'post' ) );
				$event_content.='<a href="'.esc_url( tribe_get_event_link($event_id) ).'" class="ect-events-read-more" rel="bookmark">'.esc_html__( 'Find out more', 'the-events-calendar' ).' &raquo;</a></div>';
							
				/*** Load templates based on shortcode */
				if(in_array($template,array("timeline","classic-timeline",'timeline-view'))) {
					include(ECT_PLUGIN_DIR.'/templates/timeline-template.php');	
				}
				else if(in_array($template,array("default","classic-list",'modern-list'))) {
					include(ECT_PLUGIN_DIR.'/templates/list-template.php');	
				}
				else {
					include(ECT_PLUGIN_DIR.'/templates/list-template.php');	
				}
					
				endforeach;
				wp_reset_postdata();
			}
			else { 
				$no_events='<span class="ect-icon"><i class="ect-icon-bell"></i></span>' .__('There are no upcoming events at this time.','ect');
			} 


			$catCls=$attribute['category'];
		
			/*** Generate output based on template */
			if($no_events){
				$output.='<div id="ect-no-events"><p>'.$no_events.'</p></div>';
			}
			else {
				if(in_array($template,array("timeline","classic-timeline",'timeline-view'))){
					if($template=="timeline") {
						$style='style-1';
					}
					else if($template=="classic-timeline") {
						$style='style-2';
					}
	
					$output .='<!=========Events Timeline Template=========>';
					$output .= '<div id="event-timeline-wrapper" class="'. $catCls.' '.$style.'">';
					$output .= '<div class="cool-event-timeline">';
					$output .=$events_html;
					$output .= '</div></div>';
				}
				else {	
					$output .='<!=========Events list Template=========>';
					$output.='<div id="ect-events-list-content">';
					$output.='<div id="list-wrp" class="ect-list-wrapper '. $catCls.'">';
					$output.=$events_html;
					$output.='</div></div>';		
				}
			}

			return $output;
		}
		/*** ECT main shortcode - END */

			  
		// get events dates and time
		public function ect_tribe_event_time( $display = true ) {
			global $post;
			$event = $post;
			if ( tribe_event_is_all_day( $event ) ) { // all day event
				if ( $display ) {
					_e( 'All day', 'the-events-calendar' );
				}
				else {
					return __( 'All day', 'the-events-calendar' );
				}
			}
			elseif ( tribe_event_is_multiday( $event ) ) { // multi-date event
				$start_date = tribe_get_start_date( null, false );
				$end_date = tribe_get_end_date( null, false );
				if ( $display ) {
					printf( __( '%s - %s', 'ect' ), $start_date, $end_date );
				}
				else {
					return sprintf( __( '%s - %s', 'ect' ), $start_date, $end_date );
				}
			}
			else {
				$time_format = get_option( 'time_format' );
				$start_date = tribe_get_start_date( $event, false, $time_format );
				$end_date = tribe_get_end_date( $event, false, $time_format );
				if ( $start_date !== $end_date ) {
					if ( $display ) {
						printf( __( '%s - %s', 'ect' ), $start_date, $end_date );
					}
					else {
						return sprintf( __( '%s - %s', 'ect' ), $start_date, $end_date );
					}
				}
				else {
					if ( $display ) {
						printf( '%s', $start_date );
					}
					else {
						return sprintf( '%s', $start_date );
					}
				}
			}
		}

		// check event recurring event
		public function ect_tribe_event_recurringinfo( $before = '', $after = '', $link_all = true ) {
			if ( !function_exists('tribe_is_recurring_event') ) {
				return false;
			}
			global $post;
			$info = '';
			if ( tribe_is_recurring_event( $post->ID ) ) {
				if ( function_exists( 'tribe_get_recurrence_text' ) ) {
					$info .= tribe_get_recurrence_text( $post->ID );
				}
				if ( $link_all && function_exists( 'tribe_all_occurences_link' ) ) {
					$info .= sprintf( ' <a href="%s">%s</a>', esc_url( tribe_all_occurences_link( $post->ID, false ) ), __( '(See All)', 'ect' ) );
				}
			}
			if ( $info ) {
				$info = $before.$info.$after;
			}
			return $info;
		}

		// set settings on plugin activation
  		 public static function activate() {
              update_option("ect-v",ECT_VERSION_CURRENT);
              update_option("ect-type","FREE");
              update_option("ect-installDate",date('Y-m-d h:i:s') );
              update_option("ect-ratingDiv","no");
        }

		// admin side timing
		public function ectf_set_notice_timing(){
		if(version_compare(get_option('ect-v'),'1.3', '<')){		
			set_transient( 'ectf-assn-timing', true, DAY_IN_SECONDS);
			}
			if(get_option('ect-type')=="FREE"){
			if( isset( $_GET['ectf_disable_notice'] ) && !empty( $_GET['ectf_disable_notice'] ) ){
				$rs=delete_transient( 'ectf-assn-timing' );
				update_option('ect-v',ECT_VERSION_CURRENT);
				}
			}
		}

		// Admin Notice for save settings
		function ectf_admin_save_settings_notice(){
			/* Check transient */
		if(version_compare(get_option('ect-v'),'1.3', '<')){
				if( get_transient( 'ectf-assn-timing' ) ){
					$dont_disturb_url = esc_url( get_admin_url() . '?ectf_disable_notice=1' );
					?>
					<div class="updated notice is-dismissible">
					<p><strong>
					Thanks for updating! The Events Calendar Shortcode And Templates.
					</strong><br/><i style="color:red;">It is a major design & gutenberg friendly update.
					After update, please clear your cache and update/save template settings
					& shortcode again for best design results. 
					<a style="font-weight:bold" href="<?php echo esc_url( get_admin_url(null, 'edit.php?post_type=tribe_events&page=edit.php%3Fpost_type%3Dtribe_events-events-template-settings') )?>"> Update Template Settings</a> | <a href="<?php echo $dont_disturb_url ?>" class="ect-review-done "> Already Saved !</a></i>
					</p>
					</div>
					<?php
					delete_transient( 'ectf-assn-timing' );
				}
			}
		}

		// get TEC event categories for shortcode generator
		public function ect_cats() {
			if(version_compare(get_bloginfo('version'),'4.5.0', '>=') ){
				$terms = get_terms(array(
				'taxonomy' => 'tribe_events_cat',
				'hide_empty' => false,
				));
			} else{
				$terms = get_terms('tribe_events_cat', array('hide_empty' => false,
			) );
			}

			if (!empty($terms) || !is_wp_error($terms)) {
				$ctl_terms_l['all']='All Categories';
				foreach ($terms as $term) {
					$ctl_terms_l[$term->slug] =$term->slug;
				}
			}
			
			if (isset($ctl_terms_l) && array_filter($ctl_terms_l) != null) {
				$category =json_encode($ctl_terms_l);
			} else {
				$category = json_encode(array('0' => 'No category'));
			}
			?>
			<!-- TinyMCE Shortcode Plugin -->
			<script type='text/javascript'>
				var ect_cat_obj = {
					'category':'<?php echo $category; ?>'
				};
			</script>
			<!-- TinyMCE Shortcode Plugin -->
			<?php
		}
    }
}
/*** EventsCalendarTemplates main class - END */

/*** Installation and uninstallation hooks */
register_activation_hook(__FILE__, array('EventsCalendarTemplates', 'activate'));
  
/*** THANKS - CoolPlugins.net :) */
$ect=new EventsCalendarTemplates;
