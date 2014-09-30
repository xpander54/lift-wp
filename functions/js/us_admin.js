jQuery(document).ready(function(){
	jQuery('#page_template').change(function(){
		jQuery('.meta-box-conditional').hide();

		switch(jQuery(this).val()) {
			case "page-portfolio-2-columns.php":
			case "page-portfolio-3-columns.php":
			case "page-portfolio-4-columns.php":
				jQuery('.meta-box-page-portfolio').show();
				break;
		}
	});

	jQuery('#page_template').change();

});