<?php
$output = $title = $link = $size = $el_class = '';
extract(shortcode_atts(array(
	'title' => '',
	'link' => 'http://vimeo.com/23237102',
	'size' => ( isset($content_width) ) ? $content_width : 500,
	'el_class' => '',
	'ratio' => '16-9'
), $atts));

if ( $link == '' ) { return null; }

$video_w = ( isset($content_width) ) ? $content_width : 500;
$video_h = $video_w/1.61; //1.61 golden ratio
global $wp_embed;
$embed = $wp_embed->run_shortcode('[embed width="'.$video_w.'"'.$video_h.']'.$link.'[/embed]');

$css_class = 'wpb_video_widget wpb_content_element'.$el_class;

$ratio_class = ($ratio != '')?' ratio_'.$ratio:'';

//$output .= "\n\t".'<div class="'.$css_class.'">';
//    $output .= "\n\t\t".'<div class="wpb_wrapper">';
//        $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_video_heading'));
        $output .= '<div class="w-video'.$ratio_class.'"><div class="w-video-h">' . $embed . '</div></div>';
//        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
//    $output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_video_widget');

echo $output;