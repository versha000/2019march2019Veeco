<?php
$timeline_style=$attribute['style'];
if($template=="timeline") {
	$timeline_style='style-1';
}
else if($template=="classic-timeline") {
	$timeline_style='style-2';
}


$size='large';
$ev_post_img='';
$feat_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($event_id),$size);
if($feat_img_url[0]) {
  $ev_post_img=$feat_img_url[0];
}
else {
  $ev_post_img=ECT_PLUGIN_URL."images/event-template-bg.png";
}


if ($i % 2 == 0) {
	$even_odd = "even";
}
else {
	$even_odd = "odd";
}

if($timeline_style=="style-1")
{
	if($events_date_header !==''){
		$events_html .= '<div class="ect-timeline-year">
						<div class="year-placeholder">' . $events_date_header . '</div>
						</div>';
	}		
									
	$events_html .= '<div id="post-'. $event_id .'" class="ect-timeline-post '.$even_odd.' '.$event_type.' '.$timeline_style.'">';
	$events_html .= '<div class="timeline-meta">';
	$events_html .= $event_schedule;
	$events_html .= $venue_details_html;
	$events_html .= $event_cost ;
	$events_html .= '</div>';	
	$events_html .= '<div class="timeline-dots"></div>';
	$events_html .= '<div class="timeline-content ' .$even_odd.'">';
	$events_html .= '<h2 class="content-title">' . $event_title .'</h2>';
	$events_html .= '<a class="timeline-ev-img" href="'.esc_url( tribe_get_event_link($event_id)).'"><img src= "'.$ev_post_img.'"/></a>';
	$events_html .= $event_content;
	$events_html .= '</div>';
	$events_html .= '</div>';
	$i++;
}
elseif($timeline_style=="style-2")
{
	if($events_date_header !==''){
		$events_html .= '<div class="ect-timeline-year">
						<div class="year-placeholder">' . $events_date_header . '</div>
						</div>';
	}		
									
	$events_html .= '<div id="post-'. $event_id .'" class="ect-timeline-post even '.$event_type.' '.$timeline_style.'">';
	$events_html .= '<div class="timeline-meta">';
	$events_html .= $event_schedule;
	$events_html .= $venue_details_html;
	$events_html .= $event_cost ;
	$events_html .= '</div>';	
	$events_html .= '<div class="timeline-dots"></div>';
	$events_html .= '<div class="timeline-content even">';
	$events_html .= '<a class="timeline-ev-img" href="'.esc_url( tribe_get_event_link($event_id)).'"><img src= "'.$ev_post_img.'"/></a>';
	$events_html .= '<h2 class="content-title">' . $event_title .'</h2>';
	//$events_html .= '<img src= "'.$ev_post_img.'"/>';
	$events_html .= $event_content;
	$events_html .= '</div>';
	$events_html .= '</div>';
}
else {
	if($events_date_header !==''){
		$events_html .= '<div class="ect-timeline-year">
						<div class="year-placeholder">' . $events_date_header . '</div>
						</div>';
	}		
									
	$events_html .= '<div id="post-'. $event_id .'" class="ect-timeline-post even '.$event_type.' '.$timeline_style.'">';	
	$events_html .= '<div class="timeline-dots"></div>';
	$events_html .= '<div class="timeline-content even">';
	$events_html .= '<h2 class="content-title">' . $event_title .'</h2>';
	//$events_html .= '<img src= "'.$ev_post_img.'"/>';
	$events_html .= '<div class="timeline-meta">';
	$events_html .= $event_schedule;
	$events_html .= $venue_details_html;
	$events_html .= $event_cost ;
	$events_html .= '<a href="'.esc_url( tribe_get_event_link($event_id) ).'" class="ect-events-read-more" rel="bookmark">'.esc_html__( 'Find out more', 'the-events-calendar' ).' &raquo;</a>';
	$events_html .= '</div>';
	$events_html .= '</div>';
	$events_html .= '</div>';
}
	
