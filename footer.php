<?php global $smof_data; ?></div>
</div>
<!-- /MAIN -->

</div>
</div>
<!-- /CANVAS -->

<!-- FOOTER -->
<div class="l-footer type_normal">
	<div class="l-footer-h">
		<?php if (($smof_data['footer_show_widgets'] != 0 AND rwmb_meta('us_show_subfooter_widgets') == '') OR rwmb_meta('us_show_subfooter_widgets') == 'yes') { ?>
		<!-- subfooter: top -->
<div class="l-subfooter at_top">
<div class="l-subfooter-h g-cols cols_fluid">

    <div class="one-third">
        <?php dynamic_sidebar('footer_first') ?>
    </div>

    <div class="one-third">
        <?php dynamic_sidebar('footer_second') ?>
    </div>

    <div class="one-third">
        <?php dynamic_sidebar('footer_third') ?>
    </div>

</div>
</div>
		<?php } ?>
		<?php if (($smof_data['footer_show_footer'] != 0 AND rwmb_meta('us_show_footer') == '') OR rwmb_meta('us_show_footer') == 'yes') { ?>
		<!-- subfooter: bottom -->
		<div class="l-subfooter at_bottom">
			<div class="l-subfooter-h i-cf">

				<div class="w-copyright"><?php echo $smof_data['footer_copyright'] ?></div>

				<!-- NAV -->
				<nav class="w-nav">
					<div class="w-nav-h">


						<div class="w-nav-list layout_hor width_auto float_right level_1">
							<?php wp_nav_menu(
								array(
									'theme_location' => 'astra_footer_menu',
									'container'       => 'div',
									'container_class' => 'w-nav-list-h',
									'walker' => new Walker_Nav_Menu_us(),
									'items_wrap' => '%3$s',
									'fallback_cb' => false,

								));
							?>
						</div>
					</div>
				</nav><!-- /NAV -->

			</div>
		</div>
		<?php } ?>

	</div>
</div>
<!-- /FOOTER -->
<a class="w-toplink" href="#"><i class="fa fa-angle-up"></i></a>
<?php if ( ! empty($smof_data['mobile_nav_width'])) {?><script type="text/javascript">window.mobileNavWidth = "<?php echo $smof_data['mobile_nav_width']; ?>";</script><?php } ?>
<?php if($smof_data['tracking_code'] != "") { echo $smof_data['tracking_code']; } ?>
<?php wp_footer(); ?>
</body>
</html>