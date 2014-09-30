<?php
global $smof_data;
define('IS_FULLWIDTH', TRUE);
get_header(); ?>
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
<?php get_template_part( 'templates/pagehead_portfolio' ); ?>

	<?php the_content(); ?>

<?php endwhile; else : ?>
	<?php _e('No posts were found.', 'us'); ?>
<?php endif; ?>
<?php get_footer(); ?>