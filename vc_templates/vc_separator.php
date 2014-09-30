<?php
$attributes = shortcode_atts(
	array(
		'type' => "",
		'size' => "",
		'icon' => "star",
	), $atts);

if ($attributes['icon'] == '') {
	$attributes['icon'] = 'star';
}

$type_class = ($attributes['type'] != '')?' type_'.$attributes['type']:'';
$size_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';

$output = 	'<div class="g-hr'.$type_class.$size_class.'">
						<span class="g-hr-h">
							<i class="fa fa-'.$attributes['icon'].'"></i>
						</span>
					</div>';

echo $output;