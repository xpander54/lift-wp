<?php
/*
Template Name: Page: Portfolio 2 Columns
*/
define('IS_FULLWIDTH', TRUE);
get_header(); ?>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<?php get_template_part( 'templates/pagehead' ); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>
<?php
$categories = get_terms('us_portfolio_category');
$categories_meta = rwmb_meta('us_portfolio_categories', array('taxonomy' => 'us_portfolio_category', 'type' => 'taxonomy'));
$categories_meta_array = array();
$categories_ids = array();

foreach ($categories_meta as $_category) {
    $categories_meta_array[] = $_category->term_id;
}

if (count($categories_meta)) {
    foreach($categories as $cat_id => $category)
    {
        if ( ! in_array($category->term_id, $categories_meta_array))
        {
            unset($categories[$cat_id]);
        }
        else
        {
            $categories_ids[] = $category->term_id;
        }
    }
}
if (rwmb_meta('us_portfolio_filter') AND count($categories)) {

?>
<div class="l-submain for_filters type_grey">
	<div class="l-submain-h g-html i-cf">
		<div class="w-filters">
			<div class="w-filters-h">
				<div class="w-filters-list">
					<div class="w-filters-item active">
						<a class="w-filters-item-link" href="javascript:void(0);" data-filter="*"><?php echo __('All', 'us'); ?></a>
					</div>
					<?php foreach($categories as $category) { ?>
					<div class="w-filters-item">
						<a class="w-filters-item-link" href="javascript:void(0);" data-filter=".<?php echo  $category->slug; ?>"><?php echo  $category->name; ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>

<div class="l-submain">
	<div class="l-submain-h g-html i-cf">

		<div class="w-portfolio columns_2 wide-margins type_sortable">
			<div class="w-portfolio-h">
				<div class="w-portfolio-list">
					<div class="w-portfolio-list-h">

	<?php
	global $wp_query, $smof_data;
	$portfolio_items = $smof_data['portfolio_items'];
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$args = array(
		'post_type' 		=> 'us_portfolio',
		'posts_per_page' 	=> $portfolio_items,
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
		'paged' 			=> $paged
	);

	if(count($categories_ids) > 0){
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'us_portfolio_category',
			'field' 	=> 'ID',
			'terms' 	=> $categories_ids
		);
	}

	$wp_query = new WP_Query($args);

	$portfolio_order_counter = 0;

	while ( $wp_query->have_posts() )
	{
		$wp_query->the_post();
		$portfolio_order_counter++;
		$item_categories_links = '';
		$item_categories_classes = '';
		$item_categories = get_the_terms(get_the_ID(), 'us_portfolio_category');
		if (is_array($item_categories))
		{
			foreach ($item_categories as $item_category)
			{
				$item_categories_links .= $item_category->name.' / ';
				$item_categories_classes .= ' '.$item_category->slug;
			}
		}
		if (mb_strlen($item_categories_links) > 0 )
		{
			$item_categories_links = mb_substr($item_categories_links, 0, -2);
		}
		?>
						<div class="w-portfolio-item order_<?php echo $portfolio_order_counter.$item_categories_classes ?>">
							<div class="w-portfolio-item-h">
								<a class="w-portfolio-item-anchor" href="<?php the_permalink() ?>">
									<div class="w-portfolio-item-image">
										<?php  if ( has_post_thumbnail() ) {
											the_post_thumbnail('portfolio-list');
										} else {
											?><img src="<?php echo get_template_directory_uri() ?>/img/placeholder/500x500.gif" alt=""><?php
										}?>
											<div class="w-portfolio-item-meta">
												<h2 class="w-portfolio-item-title"><?php the_title(); ?></h2>
												<i class="fa fa-mail-forward"></i>
											</div>
									</div>
								</a>
							</div>
						</div>
	<?php } ?>
					</div>
				</div>
	<?php if ($pagination = us_pagination()) { ?>
				<div class="w-portfolio-pagination">
					<div class="g-pagination align_center">
						<?php echo $pagination ?>
					</div>
				</div>
	<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
