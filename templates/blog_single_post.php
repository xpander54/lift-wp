<?php
global $smof_data;

$post_format = get_post_format()?get_post_format():'standard';

global $us_thumbnail_size, $post;
if (empty($us_thumbnail_size))
{
	$us_thumbnail_size = 'blog-grid';
}


if ($post_format == 'image')
{
	$preview = us_post_format_image_preview($us_thumbnail_size);
}
elseif ($post_format == 'gallery')
{
	if ($us_thumbnail_size == 'portfolio-list') {
		$preview = '<span class="w-blog-entry-preview-icon">
						<i class="fa fa-camera"></i>
					</span>';
	} else {
		$preview = us_post_format_gallery_preview(true, $us_thumbnail_size);
	}
}
elseif ($post_format == 'video')
{
	$preview = us_post_format_video_preview();

	if ($us_thumbnail_size == 'portfolio-list') {
		$preview = '<span class="w-blog-entry-preview-icon">
						<i class="fa fa-film"></i>
					</span>';
	}
}
elseif ($post_format == 'quote')
{
	if ($us_thumbnail_size == 'portfolio-list') {
		$preview = '<span class="w-blog-entry-preview-icon">
						<i class="fa fa-quote-left"></i>
					</span>';
	} else {
		$preview = (has_post_thumbnail())?get_the_post_thumbnail(get_the_ID(), $us_thumbnail_size):'';
	}
}
else
{
	$preview = (has_post_thumbnail())?get_the_post_thumbnail(get_the_ID(), $us_thumbnail_size):'';
}

if (empty($preview) AND $us_thumbnail_size == 'portfolio-list')
{
	$preview = '<img src="'.get_template_directory_uri().'/img/placeholder/500x500.gif" alt="">';
}
?>
<div <?php post_class('w-blog-entry') ?>>
	<div class="w-blog-entry-h">
		<a class="w-blog-entry-link" href="<?php the_permalink(); ?>">
            <?php  if ($preview) {
                echo '<span class="w-blog-entry-preview">'.$preview.'</span>';
            } ?>
			<?php
			if ($post_format == 'quote')
			{
				?><div class="w-blog-entry-title">
					<blockquote class="w-blog-entry-title-h"><?php the_title(); ?></blockquote>
				</div><?php
			}
			else
			{
				?><h2 class="w-blog-entry-title">
					<span class="w-blog-entry-title-h"><?php the_title(); ?></span>
				</h2><?php
			}
			?>
		</a>
		<div class="w-blog-entry-body">
			<div class="w-blog-entry-meta">
				<div class="w-blog-entry-meta-date">
					<i class="fa fa-clock-o"></i>
                    <span class="date updated"><?php echo get_the_date() ?></span>
				</div>
				<?php if ( ! isset($smof_data['post_meta_author']) OR $smof_data['post_meta_author'] == 1) { ?>
					<div class="w-blog-entry-meta-author">
						<i class="fa fa-user"></i>
						<?php if (get_the_author_meta('url')) { ?>
							<a class="w-blog-entry-meta-author-h" href="<?php echo esc_url( get_the_author_meta('url') ); ?>"><?php echo get_the_author() ?></a>
						<?php } else { ?>
							<span class="w-blog-entry-meta-author-h"><?php echo get_the_author() ?></span>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( ! isset($smof_data['post_meta_categories']) OR $smof_data['post_meta_categories'] == 1) { ?>
					<div class="w-blog-entry-meta-tags">
						<i class="fa fa-folder-open"></i>
						<?php the_category(', '); ?>
					</div>
				<?php } ?>
				<?php if ( ! isset($smof_data['post_meta_comments']) OR $smof_data['post_meta_comments'] == 1) { ?>
					<div class="w-blog-entry-meta-comments">
						<?php if ( ! (get_comments_number() == 0 AND ! comments_open() AND ! pings_open())) { echo '<i class="fa fa-comments"></i>'; }  ?>
						<?php comments_popup_link(__('No Comments', 'us'), __('1 Comment', 'us'), __('% Comments', 'us'), 'w-blog-entry-meta-comments-h', ''); ?>
					</div>
				<?php } ?>
			</div>

			<div class="w-blog-entry-short">
				<?php
				$excerpt = trim(get_the_excerpt());
				if(!empty($excerpt))
				{
					the_excerpt();
				}
				else
				{
					$excerpt = apply_filters('the_content', $post->post_content);
					$excerpt = apply_filters('the_excerpt', $excerpt);
					$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
					$excerpt_length = apply_filters('excerpt_length', 55);
					$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
					$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
					echo $excerpt;
				}
				?>
			</div>

			<a class="w-blog-entry-more g-btn type_default size_small" href="<?php the_permalink(); ?>"><?php echo __('Read More', 'us') ?></a>
		</div>
	</div>
</div>