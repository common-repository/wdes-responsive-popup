/* Version: 1.3.5 */
jQuery(document).ready(function($){
	$( '.close-overlay' ).click(function(e) {
		e.preventDefault();
		$( '.pro-overlay').remove();
	});
	if($('body').hasClass('nav-menus-php') && $('ul#menu-to-edit').length){		
		$('ul#menu-to-edit li.menu-item').each(function(index, element) {
			var menuid = $(this).find('.edit-menu-item-title').attr('id'),
			menuid = menuid.split('-'),
			menuid = menuid[menuid.length-1];
			$(this).find('.edit-menu-item-title').parent().parent().before(menuOptions(menuid));
		});
	}
	function menuOptions(itemid){
		var notice = '';
		if(! popup['asps']){
			notice = popup['notice'];
		}
		var menustart = '<p class="description description-wide wdes-popup-menu"><strong class="menu-item-wdes-popup">Select Your Popup</strong><span for="menu-item-wdes-popup-'+itemid+'"><br>' + notice + '<select id="menu-item-wdes-popup-'+itemid+'" class="widefat edit-menu-item-target wdes-popup" name="menu-item-wdes-popup['+itemid+']"><option value="">Select Options</option>';
		var menuoption = '';
		for(a=0;a<popup['ids'].length;a++){
			if(popup['active_ids'][itemid]==popup['ids'][a]){
				menuoption = menuoption + '<option value="'+popup['ids'][a]+'" selected="selected">'+popup['names'][a]+'</option>';
			}else{
				menuoption = menuoption + '<option value="'+popup['ids'][a]+'">'+popup['names'][a]+'</option>';
			}
		}
		var menuend = '</select></span></p>';
		return menustart + menuoption + menuend;
	}
	$('.wdes-popup-menu .menu-item-wdes-popup').on('click',function(){
		$( this ).parent().toggleClass('active-popup');
	});
	if($('#wdes-popup-settings').length==0){ return;}
	var wdes_media_upload='',
		data_id='',
		ac_checkbox='',
		SelectVal='',
		animation=$('select#popup_animation').val();
	if(animation=='Appear from center'){
		$('.wdes-table.wdes-popup-appear-from-center').addClass('wdes-popup-hide');
	}
	$('#wdes-popup-settings select').on('change',function(e){
		SelectVal=$(this).val();
		if(SelectVal=='Appear from center'){
			$('.wdes-table.wdes-popup-appear-from-center').addClass('wdes-popup-hide');
		}else{
			$('.wdes-table.wdes-popup-appear-from-center').removeClass('wdes-popup-hide');
		}
	});
	$('#wdes-popup-settings form .wdes-table.wdes-h4').click(function(e) {
		if($(this).hasClass('wdes-active')){ return;}
		$('#wdes-popup-settings .wdes-toggle-content').each(function(index,element) {
			$(this).hide('show').prev('.wdes-h4').removeClass('wdes-active');
		});
		var activeclass=$(this).next('.wdes-toggle-content').attr('class');
		var activeclass=activeclass.replace('wdes-toggle-content ','');
		$('#wdes-popup-active').val(activeclass);
		$(this).addClass('wdes-active').next('.wdes-toggle-content').show('show',function(){
			var scrollto=$(this).offset().top - 90;
			$('html,body').animate({ scrollTop: scrollto },500);
		});
	});
	$('.wdes-chose-one').click(function(e) {
		var data_id=$(this).attr('id');
		$('.wdes-chose-one').removeClass('wdes-active');
		$(this).addClass('wdes-active');
		$('#color-scheme').val(data_id);
		$('#wdes-popup-settings').removeClass('wdes-popup-custom wdes-popup-accent');
		$('#wdes-popup-settings').addClass(data_id);
	});
	$('#wdes-popup-settings .wdes-change-image').click(function(e) {
		e.preventDefault();
		data_id=$(this).attr('data-id');
		if(wdes_media_upload) {
			wdes_media_upload.open();
			return;
		}
		wdes_media_upload=wp.media.frames.file_frame=wp.media({
			title: 'Choose an image',
			button: { text: 'Choose image' },
			multiple: false
		});
		wdes_media_upload.on('select',function() {
			attachment=wdes_media_upload.state().get('selection').first().toJSON();
			$('#'+data_id+'_preview').empty();
			$('#'+data_id).val(attachment.url);
			$('#'+data_id+'_preview').append('<img src="'+attachment.url+'" />');
		});
		wdes_media_upload.open();
	}); 
	$('#wdes-popup-settings .wdes-clear-value').click(function(e) {
		e.preventDefault();
		data_id=$(this).attr('data-id');
		$('#'+data_id).val('');
	});
	$('.cookie-table #apply_cookie_in').click(function(e) {
		if($(this).val() == 'All'){
			if($('.cookie-table input.checkbox-home:checked').val()){
				$('.cookie-table input.checkbox-home').trigger('click');
			}
			if($('.cookie-table input.checkbox-pages:checked').val()){
				$('.cookie-table input.checkbox-pages').trigger('click');
			}
			if($('.cookie-table input.checkbox-posts:checked').val()){
				$('.cookie-table input.checkbox-posts').trigger('click');
			}
			if($('.cookie-table input.checkbox-archives:checked').val()){
				$('.cookie-table input.checkbox-archives').trigger('click');
			}
		}
		if(($(this).val() != 'All') && $('.cookie-table input.checkbox-all:checked').val() ){
			$('.cookie-table input.checkbox-all').trigger('click');
		}
		$('.cookie-table #apply_cookie_in').each(function(index, element) {
            if($(this).val() && ($(this).val() == 'All')){
			}
        });
	});
	$('#wdes-popup-settings input[type="checkbox"]').click(function(e) {
		if( $( this ).hasClass( 'normal' ) ){ return; }
		var hs_id=$(this).attr('data-id');
		if($(this).is(':checked')){
			$(this).val(1);
		}else{
			$(this).val(0);
		}
		if($(this).val()==0){
			$('#wdes-popup-settings .hide-show').addClass('wdes-popup-hide ');
		}else{
			$('#wdes-popup-settings .hide-show').removeClass('wdes-popup-hide ');
		}
	});
	$('#wdes-popup-settings input#reset').click(function(e) {
		$('input[name="_wp_http_referer"]').val($('input[name="_wp_http_referer"]').val()+'&reset=true');
	});
	$('#wdes-popup-settings input#submit').click(function(e) {
		$('input[name="_wp_http_referer"]').val($('input[name="_wp_http_referer"]').val().replace('&reset=true',''));
	});
	$('#wdes-popup-settings .table-tab').click(function(e) {
		$(this).toggleClass('table-tab-active');
		$('.'+$(this).attr('id')).toggleClass('wdes-popup-hide');
	});
 	wdes_color_picker();
	function wdes_color_picker() {
		if($('#wdes-popup-settings .wdes-color-picker').length){
			Color.prototype.toString=function() {
				if (this._alpha < 1) {
					return this.toCSS('rgba',this._alpha).replace(/\s+/g,'');
				}
				var hex=parseInt(this._color,10).toString(16);
				if (this.error) return '';
				if (hex.length < 6) {
					for (var i=6 - hex.length - 1; i >= 0; i--) {
						hex='0'+hex;
					}
				}
				return '#'+hex;
			};
			$('#wdes-popup-settings .wdes-color-picker').each(function(index) {
				var $control=$(this),
					value=$control.val().replace(/\s+/g,''),
					alpha_val=100,
					$alpha,$alpha_output;
				if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
					alpha_val=parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
				}
				$control.wpColorPicker({
					clear: function(event,ui) {
						$alpha.val(100);
						$alpha_output.val(100+'%');
					}
				});
				$('<div class="wdes-alpha-wrap" style="display:none;">'+'<label>Alpha: <output class="rangevalue">'+alpha_val+'%</output></label>'+'<input type="range" min="1" max="100" value="'+alpha_val+'" name="alpha" class="wdes-alpha-field">'+'</div>').appendTo($control.parents('.wp-picker-container:first').addClass('wdes-color-picker-group').find('.wp-picker-holder')); 			
				$alpha=$control.parents('.wp-picker-container:first').find('.wdes-alpha-field');
				$alpha_output=$control.parents('.wp-picker-container:first').find('.wdes-alpha-wrap output');
				$alpha.bind('change keyup',function() {
					var alpha_val=parseFloat($alpha.val()),
						iris=$control.data('a8cIris'),
						color_picker=$control.data('wpWpColorPicker');
					$alpha_output.val($alpha.val()+'%');
					iris._color._alpha=alpha_val / 100.0;
					$control.val(iris._color.toString());
					color_picker.toggler.css({
						backgroundColor: $control.val()
					});
				}).val(alpha_val).trigger('change');
			});
		}
	}
	function lastarray(x){
		return x-1;
	}
});