<?php
$attributes = shortcode_atts(
	array(
		'title' => '',
		'open' => (@in_array('open', $atts) OR (isset($atts['open']) AND $atts['open'] == 1)),
		'icon' => '',
	), $atts);

global $first_tab, $auto_open, $is_timeline;
if ($auto_open) {
	$active_class = ($first_tab)?' active':'';
	$first_tab = FALSE;
} else {
	$active_class = ($attributes['open'])?' active':'';
}

if ($is_timeline) {

	$output = 	'<div class="w-timeline-section'.$active_class.'">
					<div class="w-timeline-section-h">
						<div class="w-timeline-section-title">
							<span class="w-timeline-section-title-bullet"></span>
							<span class="w-timeline-section-title-text">'.$attributes['title'].'</span>
						</div>
						<div class="w-timeline-section-content">
							'.do_shortcode($content).'
						</div>
					</div>
				</div>';
} else {

	$icon_class = ($attributes['icon'] != '')?' fa fa-'.$attributes['icon']:'';
	$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

	$output = 	'<div class="w-tabs-section'.$active_class.$item_icon_class.'">'.
		'<div class="w-tabs-section-title">'.
		'<span class="w-tabs-section-title-icon'.$icon_class.'"></span>'.
		'<span class="w-tabs-section-title-text">'.$attributes['title'].'</span>'.
		'<span class="w-tabs-section-title-control"><i class="fa fa-angle-down"></i></span>'.
		'</div>'.
		'<div class="w-tabs-section-content">'.
		'<div class="w-tabs-section-content-h">'.
		do_shortcode($content).
		'</div>'.
		'</div>'.
		'</div>';
}



echo $output;