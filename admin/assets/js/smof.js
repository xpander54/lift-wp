/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance!
 */
jQuery(document).ready(function($){

    //(un)fold options in a checkbox-group
    jQuery('.fld').click(function() {
        var $fold='.f_'+this.id;
        $($fold).slideToggle('normal', "swing");
    });

    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') {
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }

    //hides warning if js is enabled
    $('#js-warning').hide();

    //Tabify Options
    $('.group').hide();

    // Display last current tab
    if ($.cookie("of_current_opt") === null) {
        $('.group:first').fadeIn('fast');
        $('#of-nav li:first').addClass('current');
    } else {

        var hooks = $('#hooks').html();
        hooks = jQuery.parseJSON(hooks);

        $.each(hooks, function(key, value) {

            if ($.cookie("of_current_opt") == '#of-option-'+ value) {
                $('.group#of-option-' + value).fadeIn();
                $('#of-nav li.' + value).addClass('current');
            }

        });

    }

    //Current Menu Class
    $('#of-nav li a').click(function(evt){
        // event.preventDefault();

        $('#of-nav li').removeClass('current');
        $(this).parent().addClass('current');

        var clicked_group = $(this).attr('href');

        $.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });

        $('.group').hide();

        $(clicked_group).fadeIn('fast');
        return false;

    });

    //Expand Options
    var flip = 0;

    $('#expand_options').click(function(){
        if(flip == 0){
            flip = 1;
            $('#of_container #of-nav').hide();
            $('#of_container #content').width(760);
            $('#of_container .group').add('#of_container .group h2').show();

            $(this).removeClass('expand');
            $(this).addClass('close');
            $(this).text('Close');

        } else {
            flip = 0;
            $('#of_container #of-nav').show();
            $('#of_container #content').width(600);
            $('#of_container .group').add('#of_container .group h2').hide();
            $('#of_container .group:first').show();
            $('#of_container #of-nav li').removeClass('current');
            $('#of_container #of-nav li:first').addClass('current');

            $(this).removeClass('close');
            $(this).addClass('expand');
            $(this).text('Expand');

        }

    });

    //Update Message popup
    $.fn.center = function () {
        this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
        this.css("left", 250 );
        return this;
    }


    $('#of-popup-save').center();
    $('#of-popup-reset').center();
    $('#of-popup-fail').center();

    $(window).scroll(function() {
        $('#of-popup-save').center();
        $('#of-popup-reset').center();
        $('#of-popup-fail').center();
    });


    //Masked Inputs (images as radio buttons)
    $('.of-radio-img-img').click(function(){
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });
    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    //Masked Inputs (background images as radio buttons)
    $('.of-radio-tile-img').click(function(){
        $(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
        $(this).addClass('of-radio-tile-selected');
    });
    $('.of-radio-tile-label').hide();
    $('.of-radio-tile-img').show();
    $('.of-radio-tile-radio').hide();

    //AJAX Upload
    function of_image_upload() {
        $('.image_upload_button').each(function(){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: { // Additional data to send
                    action: 'of_ajax_post_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension){
                    clickedObject.text('Uploading'); // change button text, when user selects file
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function(){
                        var text = clickedObject.text();
                        if (text.length < 13){	clickedObject.text(text + '.'); }
                        else { clickedObject.text('Uploading'); }
                    }, 200);
                },
                onComplete: function(file, response) {
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button


                    // If nonce fails
                    if(response==-1){
                        var fail_popup = $('#of-popup-fail');
                        fail_popup.fadeIn();
                        window.setTimeout(function(){
                            fail_popup.fadeOut();
                        }, 2000);
                    }

                    // If there was an error
                    else if(response.search('Upload Error') > -1){
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        $(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    }
                    else{
                        var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

                        $(".upload-error").remove();
                        $("#image_" + clickedID).remove();
                        clickedObject.parent().after(buildReturn);
                        $('img#image_'+clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });

        });

    }

    of_image_upload();

    //AJAX Remove Image (clear option value)
    $('.image_reset_button').live('click', function(){

        var clickedObject = $(this);
        var clickedID = $(this).attr('id');
        var theID = $(this).attr('title');

        var nonce = $('#security').val();

        var data = {
            action: 'of_ajax_post_action',
            type: 'image_reset',
            security: nonce,
            data: theID
        };

        $.post(ajaxurl, data, function(response) {

            //check nonce
            if(response==-1){ //failed

                var fail_popup = $('#of-popup-fail');
                fail_popup.fadeIn();
                window.setTimeout(function(){
                    fail_popup.fadeOut();
                }, 2000);
            }

            else {

                var image_to_remove = $('#image_' + theID);
                var button_to_hide = $('#reset_' + theID);
                image_to_remove.fadeOut(500,function(){ $(this).remove(); });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            }


        });

    });

    // Style Select
    (function ($) {
        styleSelect = {
            init: function () {
                $('.select_wrapper').each(function () {
                    $(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
                });
                $('.select').live('change', function () {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
                $('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
            }
        };
        $(document).ready(function () {
            styleSelect.init()
        })
    })(jQuery);


    /** Aquagraphite Slider MOD */

        //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".slide_edit_button").live( 'click', function(){
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });

    // Update slide title upon typing
    function update_slider_title(e) {
        var element = e;
        if ( this.timer ) {
            clearTimeout( element.timer );
        }
        this.timer = setTimeout( function() {
            $(element).parent().prev().find('strong').text( element.value );
        }, 100);
        return true;
    }

    $('.of-slider-title').live('keyup', function(){
        update_slider_title(this);
    });


    //Remove individual slide
    $('.slide_delete_button').live('click', function(){
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slide?");
        if (agree) {
            var $trash = $(this).parents('li');
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0,
            }, 500, function() {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });

    //Add new slide
    $(".slide_add_button").live('click', function(){
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#'+sliderId).attr('rel');

        var numArr = $('#'+sliderId +' li').find('.order').map(function() {
            var str = this.id;
            str = str.replace(/\D/g,'');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1 ) { maxNum = 0};
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //Sort slides
    jQuery('.slider').find('ul').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).sortable({
            placeholder: "placeholder",
            opacity: 0.6
        });
    });


    /**	Sorter (Layout Manager) */
    jQuery('.sorter').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.6,
            update: function() {
                $(this).find('.position').each( function() {

                    var listID = $(this).parent().attr('id');
                    var parentID = $(this).parent().parent().attr('id');
                    parentID = parentID.replace(id + '_', '')
                    var optionID = $(this).parent().parent().parent().attr('id');
                    $(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

                });
            }
        });
    });


    /**	Ajax Backup & Restore MOD */
        //backup button
    $('#of_backup_button').live('click', function(){

        var answer = confirm("Click OK to backup your current saved options.")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'backup_options',
                security: nonce
            };

            $.post(ajaxurl, data, function(response) {

                //check nonce
                if(response==-1){ //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }

                else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    //restore button
    $('#of_restore_button').live('click', function(){

        var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'restore_options',
                security: nonce
            };

            $.post(ajaxurl, data, function(response) {

                //check nonce
                if(response==-1){ //failed

                    var fail_popup = $('#of-popup-fail');
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }

                else {

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /**	Ajax Transfer (Import/Export) Option */
    $('#of_import_button').live('click', function(){

        var answer = confirm("Click OK to import options.")

        if (answer){

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var import_data = $('#export_data').val();

            var data = {
                action: 'of_ajax_post_action',
                type: 'import_options',
                security: nonce,
                data: import_data
            };

            $.post(ajaxurl, data, function(response) {
                var fail_popup = $('#of-popup-fail');
                var success_popup = $('#of-popup-save');

                //check nonce
                if(response==-1){ //failed
                    fail_popup.fadeIn();
                    window.setTimeout(function(){
                        fail_popup.fadeOut();
                    }, 2000);
                }
                else
                {
                    success_popup.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /** AJAX Save Options */
    $('#of_save').live('click',function() {

        var nonce = $('#security').val();

        $('.ajax-loading-img').fadeIn();

        //get serialized data from all our option fields
        var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

        var data = {
            type: 'save',
            action: 'of_ajax_post_action',
            security: nonce,
            data: serializedReturn
        };

        $.post(ajaxurl, data, function(response) {
            var success = $('#of-popup-save');
            var fail = $('#of-popup-fail');
            var loading = $('.ajax-loading-img');
            loading.fadeOut();

            if (response==1) {
                success.fadeIn();
            } else {
                fail.fadeIn();
            }

            window.setTimeout(function(){
                success.fadeOut();
                fail.fadeOut();
            }, 2000);
        });

        return false;

    });


    /* AJAX Options Reset */
    $('#of_reset').click(function() {

        //confirm reset
        var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

        //ajax reset
        if (answer){

            var nonce = $('#security').val();

            $('.ajax-reset-loading-img').fadeIn();

            var data = {

                type: 'reset',
                action: 'of_ajax_post_action',
                security: nonce,
            };

            $.post(ajaxurl, data, function(response) {
                var success = $('#of-popup-reset');
                var fail = $('#of-popup-fail');
                var loading = $('.ajax-reset-loading-img');
                loading.fadeOut();

                if (response==1)
                {
                    success.fadeIn();
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
                else
                {
                    fail.fadeIn();
                    window.setTimeout(function(){
                        fail.fadeOut();
                    }, 2000);
                }


            });

        }

        return false;

    });


    /**	Tipsy @since v1.3 */
    if (jQuery().tipsy) {
        $('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
            fade: true,
            gravity: 's',
            opacity: 0.7,
        });
    }


    /**
     * JQuery UI Slider function
     * Dependencies 	 : jquery, jquery-ui-slider
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    jQuery('.smof_sliderui').each(function() {

        var obj   = jQuery(this);
        var sId   = "#" + obj.data('id');
        var val   = parseInt(obj.data('val'));
        var min   = parseInt(obj.data('min'));
        var max   = parseInt(obj.data('max'));
        var step  = parseInt(obj.data('step'));

        //slider init
        obj.slider({
            value: val,
            min: min,
            max: max,
            step: step,
            slide: function( event, ui ) {
                jQuery(sId).val( ui.value );
            }
        });

    });


    /**
     * Switch
     * Dependencies 	 : jquery
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    jQuery(".cb-enable").click(function(){
        var parent = $(this).parents('.switch-options');
        jQuery('.cb-disable',parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.main_checkbox',parent).attr('checked', true);

        //fold/unfold related options
        var obj = jQuery(this);
        var $fold='.f_'+obj.data('id');
        jQuery($fold).slideDown('normal', "swing");
    });
    jQuery(".cb-disable").click(function(){
        var parent = $(this).parents('.switch-options');
        jQuery('.cb-enable',parent).removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('.main_checkbox',parent).attr('checked', false);

        //fold/unfold related options
        var obj = jQuery(this);
        var $fold='.f_'+obj.data('id');
        jQuery($fold).slideUp('normal', "swing");
    });
    //disable text select(for modern chrome, safari and firefox is done via CSS)
    if (($.browser.msie && $.browser.version < 10) || $.browser.opera) {
        $('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
    }


    /**
     * Google Fonts
     * Dependencies 	 : google.com, jquery
     * Feature added by : Smartik - http://smartik.ws/
     * Date 			 : 03.17.2013
     */
    function GoogleFontSelect( slctr, mainID ){

        var _selected = $(slctr).val(); 						//get current value - selected and saved
        var _linkclass = 'style_link_'+ mainID;
        var _previewer = mainID +'_ggf_previewer';

        if( _selected ){ //if var exists and isset

            //Check if selected is not equal with "Select a font" and execute the script.
            if ( _selected !== 'none' && _selected !== 'Select a font' ) {

                //remove other elements crested in <head>
                $( '.'+ _linkclass ).remove();

                //replace spaces with "+" sign
                var the_font = _selected.replace(/\s+/g, '+');

                //add reference to google font family
                $('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');

                //show in the preview box the font
                $('.'+ _previewer ).css('font-family', _selected +', sans-serif' );

            }else{

                //if selected is not a font remove style "font-family" at preview box
                $('.'+ _previewer ).css('font-family', '' );

            }

        }

    }

    //init for each element
    jQuery( '.google_font_select' ).each(function(){
        var mainID = jQuery(this).attr('id');
        GoogleFontSelect( this, mainID );
    });

    //init when value is changed
    jQuery( '.google_font_select' ).change(function(){
        var mainID = jQuery(this).attr('id');
        GoogleFontSelect( this, mainID );
    });



}); //end doc ready

jQuery(document).ready(function($) {
	var colors = {
		color_0: {
			body_background: '#e5e5e5',
			header_background: '#ffffff',
			header_background_alternative: '#f5f5f5',
			header_border: '#e8e8e8',
			header_fade: '#999999',
			header_navigation: '#666666',
			header_navigation_hover: '#f8862c',
			header_navigation_active: '#666666',
			main_background: '#ffffff',
			main_background_alternative: '#f0f0f0',
			main_border: '#e8e8e8',
			main_text: '#666666',
			main_heading: '#333333',
			main_primary: '#f8862c',
			main_secondary: '#666666',
			main_fade: '#999999',
			alt_background: '#f0f0f0',
			alt_background_alternative: '#ffffff',
			alt_border: '#dddddd',
			alt_text: '#555555',
			alt_heading: '#333333',
			alt_primary: '#f8862c',
			alt_secondary: '#666666',
			alt_fade: '#999999',
			subfooter_background: '#333333',
			subfooter_border: '#444444',
			subfooter_text: '#aaaaaa',
			subfooter_heading: '#ffffff',
			subfooter_link: '#dddddd',
			subfooter_link_hover: '#ffffff',
			subfooter_fade: '#777777',
			footer_background: '#222222',
			footer_border: '#222222',
			footer_text: '#666666',
			footer_link: '#999999',
			footer_link_hover: '#ffffff'
		},
		color_1: {
			body_background: '#56627f',
			header_background: '#56627f',
			header_background_alternative: '#4b5670',
			header_border: '#606c8a',
			header_fade: '#97a0ac',
			header_navigation: '#dcdfe6',
			header_navigation_hover: '#ffffff',
			header_navigation_active: '#ffffff',
			main_background: '#ffffff',
			main_background_alternative: '#edf2f5',
			main_border: '#e1e4eb',
			main_text: '#5b657c',
			main_heading: '#3d4862',
			main_primary: '#31c5c7',
			main_secondary: '#a186d3',
			main_fade: '#9ea4b5',
			alt_background: '#e9eff2',
			alt_background_alternative: '#ffffff',
			alt_border: '#d5d8de',
			alt_text: '#5b657c',
			alt_heading: '#3d4862',
			alt_primary: '#31c5c7',
			alt_secondary: '#a186d3',
			alt_fade: '#9ea4b5',
			subfooter_background: '#3d4862',
			subfooter_border: '#56627f',
			subfooter_text: '#97a0ac',
			subfooter_heading: '#cfd9de',
			subfooter_link: '#cfd9de',
			subfooter_link_hover: '#ffffff',
			subfooter_fade: '#7d8797',
			footer_background: '#56627f',
			footer_border: '#56627f',
			footer_text: '#bbc0cc',
			footer_link: '#e0e3ea',
			footer_link_hover: '#ffffff'
		},
		color_2: {
			body_background: '#000000',
			header_background: '#1a1a1a',
			header_background_alternative: '#111111',
			header_border: '#282828',
			header_fade: '#777777',
			header_navigation: '#cccccc',
			header_navigation_hover: '#f5b800',
			header_navigation_active: '#ffffff',
			main_background: '#1a1a1a',
			main_background_alternative: '#222222',
			main_border: '#282828',
			main_text: '#cccccc',
			main_heading: '#ffffff',
			main_primary: '#f8862c',
			main_secondary: '#f5b800',
			main_fade: '#777777',
			alt_background: '#111111',
			alt_background_alternative: '#222222',
			alt_border: '#282828',
			alt_text: '#cccccc',
			alt_heading: '#ffffff',
			alt_primary: '#f8862c',
			alt_secondary: '#f5b800',
			alt_fade: '#666666',
			subfooter_background: '#111111',
			subfooter_border: '#222222',
			subfooter_text: '#666666',
			subfooter_heading: '#cccccc',
			subfooter_link: '#999999',
			subfooter_link_hover: '#f5b800',
			subfooter_fade: '#444444',
			footer_background: '#1a1a1a',
			footer_border: '#222222',
			footer_text: '#444444',
			footer_link: '#777777',
			footer_link_hover: '#f5b800'
		},
		color_3: {
			body_background: '#ecf0f1',
			header_background: '#2c3e50',
			header_background_alternative: '#253444',
			header_border: '#374b5f',
			header_fade: '#75818a',
			header_navigation: '#dadfe0',
			header_navigation_hover: '#ffffff',
			header_navigation_active: '#1abc9c',
			main_background: '#ffffff',
			main_background_alternative: '#ecf0f1',
			main_border: '#dce2e5',
			main_text: '#576676',
			main_heading: '#2c3e50',
			main_primary: '#1abc9c',
			main_secondary: '#ffa412',
			main_fade: '#9ba5a8',
			alt_background: '#ecf0f1',
			alt_background_alternative: '#ffffff',
			alt_border: '#d0d6d9',
			alt_text: '#576676',
			alt_heading: '#2c3e50',
			alt_primary: '#1abc9c',
			alt_secondary: '#ffa412',
			alt_fade: '#9ba5a8',
			subfooter_background: '#2c3e50',
			subfooter_border: '#415569',
			subfooter_text: '#a5aeb0',
			subfooter_heading: '#ffffff',
			subfooter_link: '#dadfe0',
			subfooter_link_hover: '#ffa412',
			subfooter_fade: '#879598',
			footer_background: '#253444',
			footer_border: '#253444',
			footer_text: '#75818a',
			footer_link: '#a5aeb0',
			footer_link_hover: '#ffa412'
		},
		color_4: {
			body_background: '#ebe9e6',
			header_background: '#4e4037',
			header_background_alternative: '#40332b',
			header_border: '#615147',
			header_fade: '#96908a',
			header_navigation: '#c2bbb6',
			header_navigation_hover: '#f0a71d',
			header_navigation_active: '#ffffff',
			main_background: '#ffffff',
			main_background_alternative: '#f3f2f0',
			main_border: '#e3e0db',
			main_text: '#7a7067',
			main_heading: '#4e4037',
			main_primary: '#f0a71d',
			main_secondary: '#4e4037',
			main_fade: '#a8a19b',
			alt_background: '#4e4037',
			alt_background_alternative: '#40332b',
			alt_border: '#615148',
			alt_text: '#c2bbb6',
			alt_heading: '#ffffff',
			alt_primary: '#f0a71d',
			alt_secondary: '#f0a71d',
			alt_fade: '#8b8178',
			subfooter_background: '#4e4037',
			subfooter_border: '#615148',
			subfooter_text: '#a8a19b',
			subfooter_heading: '#ffffff',
			subfooter_link: '#e0dad5',
			subfooter_link_hover: '#f0a71d',
			subfooter_fade: '#8b8178',
			footer_background: '#40332b',
			footer_border: '#40332b',
			footer_text: '#7a7067',
			footer_link: '#a8a19b',
			footer_link_hover: '#f0a71d'
		},
		color_5: {
			body_background: '#dddddd',
			header_background: '#1a1a1a',
			header_background_alternative: '#000000',
			header_border: '#242424',
			header_fade: '#888888',
			header_navigation: '#cccccc',
			header_navigation_hover: '#ffffff',
			header_navigation_active: '#ffffff',
			main_background: '#ffffff',
			main_background_alternative: '#f0f0f0',
			main_border: '#dddddd',
			main_text: '#666666',
			main_heading: '#333333',
			main_primary: '#32beeb',
			main_secondary: '#333333',
			main_fade: '#999999',
			alt_background: '#f0f0f0',
			alt_background_alternative: '#ffffff',
			alt_border: '#cccccc',
			alt_text: '#555555',
			alt_heading: '#333333',
			alt_primary: '#32beeb',
			alt_secondary: '#333333',
			alt_fade: '#999999',
			subfooter_background: '#1a1a1a',
			subfooter_border: '#222222',
			subfooter_text: '#666666',
			subfooter_heading: '#ffffff',
			subfooter_link: '#999999',
			subfooter_link_hover: '#32beeb',
			subfooter_fade: '#444444',
			footer_background: '#1a1a1a',
			footer_border: '#222222',
			footer_text: '#666666',
			footer_link: '#999999',
			footer_link_hover: '#32beeb'
		},
		color_6: {
			body_background: '#f0f0f0',
			header_background: '#ffffff',
			header_background_alternative: '#f5f5f5',
			header_border: '#e8e8e8',
			header_fade: '#999999',
			header_navigation: '#666666',
			header_navigation_hover: '#ff5842',
			header_navigation_active: '#ff5842',
			main_background: '#ffffff',
			main_background_alternative: '#f0f0f0',
			main_border: '#e8e8e8',
			main_text: '#666666',
			main_heading: '#333333',
			main_primary: '#ff5842',
			main_secondary: '#555555',
			main_fade: '#999999',
			alt_background: '#fae6cd',
			alt_background_alternative: '#ffffff',
			alt_border: '#dec7ab',
			alt_text: '#6d665e',
			alt_heading: '#333333',
			alt_primary: '#ff5842',
			alt_secondary: '#444444',
			alt_fade: '#9e8f7e',
			subfooter_background: '#333333',
			subfooter_border: '#444444',
			subfooter_text: '#aaaaaa',
			subfooter_heading: '#ffffff',
			subfooter_link: '#dddddd',
			subfooter_link_hover: '#ffffff',
			subfooter_fade: '#777777',
			footer_background: '#222222',
			footer_border: '#222222',
			footer_text: '#666666',
			footer_link: '#999999',
			footer_link_hover: '#ffffff'
		},
		color_7: {
			body_background: '#2e3436',
			header_background: '#2e3436',
			header_background_alternative: '#212526',
			header_border: '#2e3436',
			header_fade: '#6d7778',
			header_navigation: '#c4cbcc',
			header_navigation_hover: '#fcaf3e',
			header_navigation_active: '#6ebb25',
			main_background: '#ffffff',
			main_background_alternative: '#e6eced',
			main_border: '#dce4e5',
			main_text: '#616566',
			main_heading: '#2e3436',
			main_primary: '#6ebb25',
			main_secondary: '#fcaf3e',
			main_fade: '#a0a7a8',
			alt_background: '#e6eced',
			alt_background_alternative: '#ffffff',
			alt_border: '#cdd0d1',
			alt_text: '#616566',
			alt_heading: '#2e3436',
			alt_primary: '#6ebb25',
			alt_secondary: '#fcaf3e',
			alt_fade: '#a0a7a8',
			subfooter_background: '#212526',
			subfooter_border: '#2e3436',
			subfooter_text: '#6d7778',
			subfooter_heading: '#ffffff',
			subfooter_link: '#c4cbcc',
			subfooter_link_hover: '#fcaf3e',
			subfooter_fade: '#50595a',
			footer_background: '#2e3436',
			footer_border: '#2e3436',
			footer_text: '#6d7778',
			footer_link: '#c4cbcc',
			footer_link_hover: '#fcaf3e'
		},
		color_8: {
			body_background: '#13161a',
			header_background: '#21282e',
			header_background_alternative: '#1a1e23',
			header_border: '#21282e',
			header_fade: '#757b83',
			header_navigation: '#b0b6be',
			header_navigation_hover: '#71a7d3',
			header_navigation_active: '#ffffff',
			main_background: '#21282e',
			main_background_alternative: '#1a1e23',
			main_border: '#303940',
			main_text: '#b0b6be',
			main_heading: '#ffffff',
			main_primary: '#71a7d3',
			main_secondary: '#71a7d3',
			main_fade: '#757b83',
			alt_background: '#1a1e23',
			alt_background_alternative: '#21282e',
			alt_border: '#303940',
			alt_text: '#b0b6be',
			alt_heading: '#ffffff',
			alt_primary: '#71a7d3',
			alt_secondary: '#71a7d3',
			alt_fade: '#757b83',
			subfooter_background: '#1a1e23',
			subfooter_border: '#21282e',
			subfooter_text: '#545a61',
			subfooter_heading: '#b0b6be',
			subfooter_link: '#b0b6be',
			subfooter_link_hover: '#71a7d3',
			subfooter_fade: '#545a61',
			footer_background: '#21282e',
			footer_border: '#1a1e23',
			footer_text: '#545a61',
			footer_link: '#757b83',
			footer_link_hover: '#71a7d3'
		},
		color_9: {
			body_background: '#f0edee',
			header_background: '#73656a',
			header_background_alternative: '#66575c',
			header_border: '#73656a',
			header_fade: '#b3aaad',
			header_navigation: '#e0dadc',
			header_navigation_hover: '#ffffff',
			header_navigation_active: '#ffffff',
			main_background: '#ffffff',
			main_background_alternative: '#f0edee',
			main_border: '#e8e3e4',
			main_text: '#665c5e',
			main_heading: '#513c40',
			main_primary: '#9e647c',
			main_secondary: '#683b51',
			main_fade: '#b3aaad',
			alt_background: '#73656a',
			alt_background_alternative: '#66575c',
			alt_border: '#887a7e',
			alt_text: '#e0dadc',
			alt_heading: '#ffffff',
			alt_primary: '#e9a5be',
			alt_secondary: '#e9a5be',
			alt_fade: '#b3aaad',
			subfooter_background: '#66575c',
			subfooter_border: '#66575c',
			subfooter_text: '#b3aaad',
			subfooter_heading: '#ffffff',
			subfooter_link: '#e0dadc',
			subfooter_link_hover: '#ffffff',
			subfooter_fade: '#b3aaad',
			footer_background: '#73656a',
			footer_border: '#73656a',
			footer_text: '#b3aaad',
			footer_link: '#b3aaad',
			footer_link_hover: '#ffffff'
		},
		color_10: {
			body_background: '#e5e5e5',
			header_background: '#ffffff',
			header_background_alternative: '#f5f5f5',
			header_border: '#e8e8e8',
			header_fade: '#999999',
			header_navigation: '#666666',
			header_navigation_hover: '#39b54a',
			header_navigation_active: '#39b54a',
			main_background: '#ffffff',
			main_background_alternative: '#f0f0f0',
			main_border: '#e8e8e8',
			main_text: '#666666',
			main_heading: '#333333',
			main_primary: '#39b54a',
			main_secondary: '#5c665f',
			main_fade: '#999999',
			alt_background: '#f0f0f0',
			alt_background_alternative: '#ffffff',
			alt_border: '#dddddd',
			alt_text: '#555555',
			alt_heading: '#333333',
			alt_primary: '#39b54a',
			alt_secondary: '#5c665f',
			alt_fade: '#999999',
			subfooter_background: '#333333',
			subfooter_border: '#444444',
			subfooter_text: '#aaaaaa',
			subfooter_heading: '#ffffff',
			subfooter_link: '#dddddd',
			subfooter_link_hover: '#ffffff',
			subfooter_fade: '#777777',
			footer_background: '#222222',
			footer_border: '#222222',
			footer_text: '#666666',
			footer_link: '#999999',
			footer_link_hover: '#ffffff'
		},
		color_11: {
			body_background: '#dce2e5',
			header_background: '#ffffff',
			header_background_alternative: '#f2f5f5',
			header_border: '#e8e8e8',
			header_fade: '#999999',
			header_navigation: '#666666',
			header_navigation_hover: '#31c5c7',
			header_navigation_active: '#429edb',
			main_background: '#ffffff',
			main_background_alternative: '#ebf0f0',
			main_border: '#e8e8e8',
			main_text: '#666666',
			main_heading: '#333333',
			main_primary: '#429edb',
			main_secondary: '#31c5c7',
			main_fade: '#999999',
			alt_background: '#ebf0f0',
			alt_background_alternative: '#ffffff',
			alt_border: '#dddddd',
			alt_text: '#555555',
			alt_heading: '#333333',
			alt_primary: '#429edb',
			alt_secondary: '#31c5c7',
			alt_fade: '#999999',
			subfooter_background: '#ffffff',
			subfooter_border: '#e8e8e8',
			subfooter_text: '#999999',
			subfooter_heading: '#ffffff',
			subfooter_link: '#666666',
			subfooter_link_hover: '#31c5c7',
			subfooter_fade: '#999999',
			footer_background: '#ffffff',
			footer_border: '#e8e8e8',
			footer_text: '#999999',
			footer_link: '#666666',
			footer_link_hover: '#31c5c7'
		}
	}

	function update_custom_colors(color_scheme){
		for (var field_id in color_scheme) {
			var color_hex = color_scheme[field_id];
			jQuery('#section-' + field_id + ' .colorSelector').ColorPickerSetColor(color_hex);
			jQuery('#section-' + field_id + ' .colorSelector').children('div').css('backgroundColor', color_hex);
			jQuery('#section-' + field_id + ' .of-color').val(color_hex);

		}
	}

	jQuery('#color_scheme').change(function() {
		switch ($(this).val()){
			case 'White Orange': update_custom_colors(colors.color_0); break;
			case 'Mild Purple': update_custom_colors(colors.color_1); break;
			case 'Dark Orange': update_custom_colors(colors.color_2); break;
			case 'Midnight Turquoise': update_custom_colors(colors.color_3); break;
			case 'Yellow-Brown': update_custom_colors(colors.color_4); break;
			case 'Stylish Cyan': update_custom_colors(colors.color_5); break;
			case 'White Red': update_custom_colors(colors.color_6); break;
			case 'Juicy Green': update_custom_colors(colors.color_7); break;
			case 'Twilight': update_custom_colors(colors.color_8); break;
			case 'Good Vine': update_custom_colors(colors.color_9); break;
			case 'White Green': update_custom_colors(colors.color_10); break;
			case 'White Blue': update_custom_colors(colors.color_11); break;
		}

	});

	jQuery('#section-header_is_extended .controls').live('click', function(){
		if (jQuery('#section-header_is_extended .controls .cb-enable').hasClass('selected')) {
			jQuery('#section-header_show_language').fadeIn();
			jQuery('#section-header_show_language .controls').click();
		} else {
			jQuery('#section-header_show_language').fadeOut();
			jQuery('#section-header_language_type').fadeOut();
			jQuery('#section-header_language_amount').fadeOut();
			jQuery('#section-header_language_1_name').fadeOut();
			jQuery('#section-header_language_2_name').fadeOut();
			jQuery('#section-header_language_2_url').fadeOut();
			jQuery('#section-header_language_3_name').fadeOut();
			jQuery('#section-header_language_3_url').fadeOut();
			jQuery('#section-header_language_4_name').fadeOut();
			jQuery('#section-header_language_4_url').fadeOut();
			jQuery('#section-header_language_5_name').fadeOut();
			jQuery('#section-header_language_5_url').fadeOut();
			jQuery('#section-header_language_6_name').fadeOut();
			jQuery('#section-header_language_6_url').fadeOut();
			jQuery('#section-header_language_7_name').fadeOut();
			jQuery('#section-header_language_7_url').fadeOut();
			jQuery('#section-header_language_8_name').fadeOut();
			jQuery('#section-header_language_8_url').fadeOut();
			jQuery('#section-header_language_9_name').fadeOut();
			jQuery('#section-header_language_9_url').fadeOut();
			jQuery('#section-header_language_10_name').fadeOut();
			jQuery('#section-header_language_10_url').fadeOut();
		}
	});

	jQuery('#section-header_show_language .controls').live('click', function(){
		if (jQuery('#section-header_show_language .controls .cb-enable').hasClass('selected')) {
			jQuery('#section-header_language_type').fadeIn();
			jQuery('#header_language_type').change();
		} else {
			jQuery('#section-header_language_type').fadeOut();
			jQuery('#section-header_language_amount').fadeOut();
			jQuery('#section-header_language_1_name').fadeOut();
			jQuery('#section-header_language_2_name').fadeOut();
			jQuery('#section-header_language_2_url').fadeOut();
			jQuery('#section-header_language_3_name').fadeOut();
			jQuery('#section-header_language_3_url').fadeOut();
			jQuery('#section-header_language_4_name').fadeOut();
			jQuery('#section-header_language_4_url').fadeOut();
			jQuery('#section-header_language_5_name').fadeOut();
			jQuery('#section-header_language_5_url').fadeOut();
			jQuery('#section-header_language_6_name').fadeOut();
			jQuery('#section-header_language_6_url').fadeOut();
			jQuery('#section-header_language_7_name').fadeOut();
			jQuery('#section-header_language_7_url').fadeOut();
			jQuery('#section-header_language_8_name').fadeOut();
			jQuery('#section-header_language_8_url').fadeOut();
			jQuery('#section-header_language_9_name').fadeOut();
			jQuery('#section-header_language_9_url').fadeOut();
			jQuery('#section-header_language_10_name').fadeOut();
			jQuery('#section-header_language_10_url').fadeOut();
		}
	});


	jQuery('#header_language_type').live('change', function(){
		if (jQuery(this).val() == 'Your own links') {
			jQuery('#section-header_language_amount').fadeIn();
			jQuery('#section-header_language_1_name').fadeIn();
			jQuery('#header_language_amount').change();
		} else {
			jQuery('#section-header_language_amount').fadeOut();
			jQuery('#section-header_language_1_name').fadeOut();
			jQuery('#section-header_language_2_name').fadeOut();
			jQuery('#section-header_language_2_url').fadeOut();
			jQuery('#section-header_language_3_name').fadeOut();
			jQuery('#section-header_language_3_url').fadeOut();
			jQuery('#section-header_language_4_name').fadeOut();
			jQuery('#section-header_language_4_url').fadeOut();
			jQuery('#section-header_language_5_name').fadeOut();
			jQuery('#section-header_language_5_url').fadeOut();
			jQuery('#section-header_language_6_name').fadeOut();
			jQuery('#section-header_language_6_url').fadeOut();
			jQuery('#section-header_language_7_name').fadeOut();
			jQuery('#section-header_language_7_url').fadeOut();
			jQuery('#section-header_language_8_name').fadeOut();
			jQuery('#section-header_language_8_url').fadeOut();
			jQuery('#section-header_language_9_name').fadeOut();
			jQuery('#section-header_language_9_url').fadeOut();
			jQuery('#section-header_language_10_name').fadeOut();
			jQuery('#section-header_language_10_url').fadeOut();
		}
	});

	jQuery('#header_language_amount').live('change', function(){
		for(var i = 2; i <= 10; i++) {
			if (i <= jQuery(this).val()-0) {
				jQuery('#section-header_language_'+i+'_name').fadeIn();
				jQuery('#section-header_language_'+i+'_url').fadeIn();
			} else {
				jQuery('#section-header_language_'+i+'_name').fadeOut();
				jQuery('#section-header_language_'+i+'_url').fadeOut();
			}
		}
	});

	jQuery('#section-header_is_extended .controls').click();

    jQuery('.of-color').on('change', function(){
        jQuery(this).siblings('.colorSelector').ColorPickerSetColor(jQuery(this).val());
        jQuery(this).siblings('.colorSelector').children('div').css('backgroundColor', jQuery(this).val());
    });

});