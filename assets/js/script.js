/* Version: 1.3.5 */
jQuery(document).ready(function($){
	var timeout = ( function(){var timers = {};return function( callback, ms, x_id ){if ( !x_id ){ x_id = ''; }if ( timers[x_id] ){ clearTimeout( timers[x_id] ); }timers[x_id] = setTimeout( callback, ms );};})(),id,xstyle,xtop,slr=300,show_popup=false,allottedtime,expiration,ifautofit = 0,pagetype=0,
	get = function get(key) {
		var pageURL = decodeURIComponent(window.location.search.substring(1)),URLvar = pageURL.split('&'),keyName,i;	  
		for (i = 0; i < URLvar.length; i++) {
			keyName = URLvar[i].split('=');	  
			if (keyName[0] === key) {
				return keyName[1] === undefined ? true : keyName[1];
			}
		}
	};
	if(get('js_debug')){
		console.log(popup);
		console.log(document.cookie);
	}
	if((! popup.onLoad_id && popup.cookie) || (popup.onLoad_id && popup.cookie)){
		pagetype = 'wdes_popup=' + popup.cookie.page_type;
		if(get('js_debug')){
			console.log(pagetype);
			console.log(document.cookie.indexOf(pagetype));
		}
		if(document.cookie.indexOf(pagetype) == -1){
			if(cookie('by','hours')){
				if(get('js_debug')){
					console.log('Error 7');
				}
				show_popup = true,
				allottedtime = 1000 * 60 * 60 * popup.cookie.within * 1,
				expiration = new Date((new Date()).valueOf() + allottedtime);
				document.cookie = pagetype+";expires=" + expiration.toUTCString();
			}
			if(cookie('by','days')){
				if(get('js_debug')){
					console.log('Error 6');
				}
				show_popup = true,
				allottedtime = 1000 * 60 * 60 * 24 * popup.cookie.within,
				expiration = new Date((new Date()).valueOf() + allottedtime);
				document.cookie = pagetype+";expires=" + expiration.toUTCString();
			}
			if(cookie('by','months')){
				if(get('js_debug')){
					console.log('Error 5');
				}
				show_popup = true,
				allottedtime = 1000 * 60 * 60 * 24 * 31 * popup.cookie.within,
				expiration = new Date((new Date()).valueOf() + allottedtime);
				document.cookie = pagetype+";expires=" + expiration.toUTCString();
			}
			if(cookie('by','years')){
				if(get('js_debug')){
					console.log('Error 4');
				}
				show_popup = true,
				allottedtime = 1000 * 60 * 60 * 24 * 31 * 12 * popup.cookie.within,
				expiration = new Date((new Date()).valueOf() + allottedtime);
				document.cookie = pagetype+";expires=" + expiration.toUTCString();
			}
			if(get('js_debug')){
				console.log('Error 3');
			}
		}
		id='#wdes-popup-'+popup.cookie.id,
		xstyle=popup.cookie.animation;
	}
	if(popup.onLoad_id && ! popup.cookie){
		if(get('js_debug')){
			console.log('Error 8');
		}
		show_popup = true,
		id='#wdes-popup-'+popup.onLoad_id.id,
		xstyle=popup.onLoad_id.animation;
	}
	if(popup.onLoad_id && popup.cookie){
		if(get('js_debug')){
			console.log('Error 9');
		}
		if(popup.onLoad_id != popup.cookie.id){
			/*show_popup, conflict on cookie popup*/
			if(document.cookie.indexOf(pagetype) == -1){show_popup = true;}
			id='#wdes-popup-'+popup.onLoad_id.id,
			xstyle=popup.onLoad_id.animation;
		}
	}
	$(window).bind('load',function(){
		var mainid = '';
		if($('.wdes-popup-main').length){
			if(get('js_debug')){
				console.log('Error 1');
			}
			$('.wdes-popup-main').each(function(index, element) {
				mainid = $(this).attr('id');
				totitleid = mainid.replace('wdes-popup-','.wdes-popup-title-');
				if($(this).find('.tml-errors').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}
				if($(this).find('.tml-error').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}
				if($(this).find('.error').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}
				if($(this).find('.success').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}
				if($(this).find('.gform_validation_error').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}
				if($(this).find('.gform_confirmation_message').length && ! $('html').hasClass('wdes-popup-fixed')){
					$(totitleid).trigger('click');
				}			
			});
		}
		if(show_popup){
			if(get('js_debug')){
				console.log('Error 2');
			}
			xtop = $( window ).scrollTop();
			if($(id).hasClass(xx('fit-to-the-screen'))){
				$(x(id,'fff-bc')).height(window.innerHeight);
			}
			if(!$(id).length){return;}
			$(x(id,'cell')).css('max-width',$(id).width());
			if(popup.onLoad_id.autofit){
				ifautofit = 1;
			}else{
				$('body,html').animate({scrollTop:0},300,function(){
					if($('html').outerHeight()+20>=window.innerHeight){
						$('html').addClass(xx('has-scroll'));
					}
					if($(id).hasClass(xx('fit-to-the-screen')) && ($(x(id,'group')).outerHeight() + 90)>window.innerHeight){
						$('html').addClass(xx('hide-scroll'));
					}
					$('html,body').addClass(xx('fixed min-width-full'));
				});
			}
			$(x(0,'main')).hide();
			$(x(id,'table')).removeClass(xx('opacity-1'));
			$(x(id,'inner')).removeClass(xx('opacity-1'));
			$(id).fadeIn('fast',function(){
				has_scroll(id);
				if(xstyle=='top-to-bottom'){$(x(id,'ttb')).addClass(xx('top-0'));}
				if(xstyle=='bottom-to-top'){$(x(id,'btt')).addClass(xx('bottom-0'));}
				if(xstyle=='left-to-right'){
					if($(id).hasClass(xx('fit-to-the-screen'))||$(id).hasClass(xx('custom-width-and-full-height'))){
						setTimeout(function(){
							$(x(id,'ltr')).addClass(xx('left-0'));
						},slr);
					}else{
						$(x(id,'ltr')).addClass(xx('left-0'));
					}
				}
				if(xstyle=='right-to-left'){
					if($(id).hasClass(xx('fit-to-the-screen'))||$(id).hasClass(xx('custom-width-and-full-height'))){
						setTimeout(function(){
							$(x(id,'rtl')).addClass(xx('right-0'));
						},slr);
					}else{
						$(x(id,'rtl')).addClass(xx('right-0'));
					}
				}
				setTimeout(function(){
					$(x(id,'table')).addClass(xx('opacity-1'));
					$(x(id,'inner')).addClass(xx('opacity-1'));
				},100);
			});
			
		}
	});
	$(window).resize(function(){
		$(x(id,'table')).removeClass(xx('opacity-1'));
		$(x(id,'inner')).removeClass(xx('opacity-1'));
		timeout(function(){
			has_scroll(id);
			$(x(id,'table')).addClass(xx('opacity-1'));
			$(x(id,'inner')).addClass(xx('opacity-1'));
			$(x(id,'cell')).css('max-width',$(id).width());
			if($(id).hasClass(xx('fit-to-the-screen'))){
				$(x(id,'fff-bc')).height(window.innerHeight);
			}
		},300);
	});
	$(this).delegate(x(0,'title'),'click',function(e){
		e.preventDefault();
		xtop = $( window ).scrollTop(),
		id=$(this).attr('content-id'),
		xstyle=$(this).attr('popup-style');
		if($(id).hasClass(xx('fit-to-the-screen'))){
			$(x(id,'fff-bc')).height(window.innerHeight);
		}
		notice($(this).attr('id'),id);
		if(!$(id).length){return;}
		$(x(id,'cell')).css('max-width',$(id).width());
		if($(this).attr('auto-fit')){
			ifautofit = 1;
		}else{
			$('body,html').animate({scrollTop:0},300,function(){
				if($('html').outerHeight()+20>=window.innerHeight){
					$('html').addClass(xx('has-scroll'));
				}
				if($(id).hasClass(xx('fit-to-the-screen')) && ($(x(id,'group')).outerHeight() + 90)>window.innerHeight){
					$('html').addClass(xx('hide-scroll'));
				}
				$('html,body').addClass(xx('fixed min-width-full'));
			});
		}
		$(x(0,'main')).hide();
		$(x(id,'table')).removeClass(xx('opacity-1'));
		$(x(id,'inner')).removeClass(xx('opacity-1'));
		$(id).fadeIn('fast',function(){
			has_scroll(id);
			if(xstyle=='top-to-bottom'){$(x(id,'ttb')).addClass(xx('top-0'));}
			if(xstyle=='bottom-to-top'){$(x(id,'btt')).addClass(xx('bottom-0'));}
			if(xstyle=='left-to-right'){
				if($(id).hasClass(xx('fit-to-the-screen'))||$(id).hasClass(xx('custom-width-and-full-height'))){
					setTimeout(function(){
						$(x(id,'ltr')).addClass(xx('left-0'));
					},slr);
				}else{
					$(x(id,'ltr')).addClass(xx('left-0'));
				}
			}
			if(xstyle=='right-to-left'){
				if($(id).hasClass(xx('fit-to-the-screen'))||$(id).hasClass(xx('custom-width-and-full-height'))){
					setTimeout(function(){
						$(x(id,'rtl')).addClass(xx('right-0'));
					},slr);
				}else{
					$(x(id,'rtl')).addClass(xx('right-0'));
				}
			}
			setTimeout(function(){
				$(x(id,'table')).addClass(xx('opacity-1'));
				$(x(id,'inner')).addClass(xx('opacity-1'));
			},100);
		});
	});
	$(this).delegate('.wdes-popup-close','click',function(e){
		$(id).fadeOut('fast');
		$('html').removeClass(xx('hide-scroll'));
		$('html,body').removeClass(xx('fixed has-scroll min-width-full'));
		if(ifautofit){
			ifautofit = 0;
		}else{
			$('body,html').animate({scrollTop:xtop},300);
		}
		if(xstyle=='top-to-bottom'){$(x(id,'ttb')).removeClass(xx('top-0'));}	
		if(xstyle=='bottom-to-top'){$(x(id,'btt')).removeClass(xx('bottom-0'));}	
		if(xstyle=='left-to-right'){$(x(id,'ltr')).removeClass(xx('left-0'));}
		if(xstyle=='right-to-left'){$(x(id,'rtl')).removeClass(xx('right-0'));}
	});	
	$(this).delegate('.wdes-popup-overlay','click',function(e){
		if($(this).hasClass(xx('disable'))){return;}
		$(id).fadeOut('fast');
		$('html').removeClass(xx('hide-scroll'));
		$('html,body').removeClass(xx('fixed has-scroll min-width-full'));
		if(ifautofit){
			ifautofit = 0;
		}else{
			$('body,html').animate({scrollTop:xtop},300);
		}	
		if(xstyle=='top-to-bottom'){$(x(id,'ttb')).removeClass(xx('top-0'));}
		if(xstyle=='bottom-to-top'){$(x(id,'btt')).removeClass(xx('bottom-0'));}
		if(xstyle=='left-to-right'){$(x(id,'ltr')).removeClass(xx('left-0'));}
		if(xstyle=='right-to-left'){$(x(id,'rtl')).removeClass(xx('right-0'));}
	});
	var siid,mderesizecount = 0, mderesize, scrollheight = 0;
	$( this ).click( function( e ){
		var mde = $(x(id,'group'));
		if(!mde.is(e.target) && mde.has(e.target).length === 0 && mde.length){
	 		clearInterval(siid);
		}else{
			onresize(mde);
		}
	});
	$(this).delegate('.wdes-popup-group input','change',function(e){
		clearInterval(siid);
	});
	function onresize(mde){
		if($(id).css('display') != 'block'){return;}
		if(!$(id).length){return;}
		if(($(x(id,'group')).outerHeight() + a) > window.innerHeight && (scrollheight != $(x(id,'scroll')).outerHeight())){		
	 		siid = setInterval(function(){
				if($(x(id,'scroll')).outerHeight() != scrollheight && ! $(x(id,'scroll')).hasClass('wdes-popup-has-scroll')){
					mde.resize();
				}
				clearInterval(siid);
				scrollheight = $(x(id,'scroll')).outerHeight();
			},2000);
		}	 		
	}
	function cookie(key,value){
		if(key == 'id'){if(popup.cookie.id == value){return true;}}
		if(key == 'by'){if(popup.cookie.by == value){return true;}}
		if(key == 'time'){if(popup.cookie.time == value){return true;}}
		if(key == 'within'){if(popup.cookie.within == value){return true;}}
		if(key == 'animation'){if(popup.cookie.animation == value){return true;}}
		return false;
	}
	function has_scroll(id){
		var xyz=60,a=90,b=100;
		if(xstyle=='left-to-right'){xyz=0;}		
		$(x(id,'scroll')).height('');
		$(x(id,'close')).removeClass(xx('close-top'));
		$(x(id,'scroll')).removeClass(xx('has-scroll'));
		$(id).removeClass(xx('active-scroll'));
		if($(id).hasClass(xx('fit-to-the-screen'))){b=0;}
		if($(x(id,'close')).hasClass(xx('rt-15'))){$(x(id,'close')).removeClass(xx('right-30'));}
		setTimeout(function(){
			if(($(x(id,'group')).outerHeight() + a)>window.innerHeight){
				if($(id).hasClass(xx('custom-width-and-full-height'))){
					$(x(id,'scroll')).height(window.innerHeight);
				}else{
					$(x(id,'scroll')).height(window.innerHeight - b);
				}
				$(x(id,'scroll')).addClass(xx('has-scroll'));
				$(id).addClass(xx('active-scroll'));
				if($(x(id,'close')).hasClass(xx('rt-15'))){$(x(id,'close')).addClass(xx('right-30'));}
			}else{
				if($(id).hasClass(xx('fit-to-the-screen'))||$(id).hasClass(xx('custom-width-and-full-height'))){
					if($(id).hasClass(xx('left-to-right')) || $(id).hasClass(xx('right-to-left'))){
						$(x(id,'scroll')).height(window.innerHeight);
					}
				}else{	
					$(x(id,'scroll')).height('');
				}
				$(x(id,'scroll')).removeClass(xx('has-scroll'));
				$(id).removeClass(xx('active-scroll'));
			}
			if($(id).hasClass(xx('fit-to-the-screen'))){
				$(x(id,'scroll')).height(window.innerHeight);
			}
			if(($(x(id,'group')).outerWidth() + 100)>window.innerWidth){
				$(id).addClass(xx('fullwidth'));
				if(!$(id).hasClass(xx('custom-width-and-full-height'))){$(x(id,'close')).addClass(xx('right-0'));}
				$(x(id,'close')).addClass(xx('close-top'));
			}else{
				$(id).removeClass(xx('fullwidth'));
				if(!$(x(id,'close')).hasClass(xx('close-style-9'))&&!$(x(id,'close')).hasClass(xx('close-style-10'))){
					$(x(id,'close')).removeClass(xx('right-0'));
				}
				$(x(id,'close')).removeClass(xx('close-top'));
			}
			if($(x(id,'close')).hasClass(xx('close-style-2'))||$(x(id,'close')).hasClass(xx('close-style-3'))||$(x(id,'close')).hasClass(xx('close-style-4'))){
				$(x(id,'close')).removeClass(xx('close-top'));
			}
			if(!$(id).hasClass(xx('fit-to-the-screen'))&&$(id).hasClass(xx('fullwidth'))&&$(x(id,'close')).hasClass(xx('close-style-7'))){
				$(x(id,'close')).addClass(xx('top--40'));
			}
			if(!$(id).hasClass(xx('fit-to-the-screen'))&&$(id).hasClass(xx('fullwidth'))&&$(x(id,'close')).hasClass(xx('close-style-8'))){
				$(x(id,'close')).addClass(xx('top--40'));
			}
			if(!$(id).hasClass(xx('fullwidth'))&&$(x(id,'close')).hasClass(xx('close-style-7'))){
				$(x(id,'close')).removeClass(xx('top--40'));
			}
			if(!$(id).hasClass(xx('fullwidth'))&&$(x(id,'close')).hasClass(xx('close-style-8'))){
				$(x(id,'close')).removeClass(xx('top--40'));
			}
			if($(id).hasClass(xx('custom-width-and-full-height'))){
				if($(id).hasClass(xx('fullwidth'))){
					$(x(id,'close')).removeClass(xx('close-top top--40 left--30 left--40'));
					$(x(id,'close')).addClass(xx('right-30 top-15'));
					if($(x(id,'scroll')).hasClass(xx('has-scroll'))){$('html').addClass(xx('hide-scroll'));}
				}else{
					if(! $(id).hasClass(xx('main-close-style-3')) && ! $(id).hasClass(xx('custom-width-and-full-height'))){
						$(x(id,'close')).removeClass(xx('right-30 top-15'));
					}
					if($(id).hasClass(xx('right-to-left'))){
						if($(x(id,'scroll')).hasClass(xx('has-scroll'))){$('html').addClass(xx('hide-scroll'));}
						var style_7 = $(id).hasClass(xx('main-close-style-7'));
						var style_8 = $(id).hasClass(xx('main-close-style-8'));
						if(style_7 || style_8){
							$(x(id,'close')).addClass(xx('left--40'));
						}else{
							if(! $(id).hasClass(xx('main-close-style-3')) && ! $(id).hasClass(xx('custom-width-and-full-height'))){
								$(x(id,'close')).addClass(xx('left--30'));
							}
						}
					}else{
						$('html').removeClass(xx('hide-scroll'));
					}
				}
			}
		},100);
	}
	function notice(id,cid){
		$('.wdes-popup-notice').remove();
		if(!$(cid).length){$('#'+id).parent().before('<span class="wdes-popup-notice">Can\'t found ' + cid + ' </span>');}
	}
	function x(id,x){
		var abc=x.split(' '),abd='',space=' ',allx=abc.length;
		if(!abc){ return; }
		for(a=0; a < allx; a++){
			if((allx - 1)==a){ space=''; }
			abd=abd + '.wdes-popup-' + abc[a] + space;
		}
		if(id==0){return abd;}else{return id + ' ' + abd;}
	}
	function xx(x){
		var abc=x.split(' '),abd='',space=' ',allx=abc.length;
		if(!abc){return;}
		for(a=0; a < allx; a++){
			if((allx - 1)==a){space='';}
			abd=abd + 'wdes-popup-' + abc[a] + space;
		}
		return abd;
	}
	function wdesget(key){
		var pageURL = decodeURIComponent(window.location.search.substring(1)),
			URLvar = pageURL.split('&'),
			keyName,
			i;
		for (i = 0; i < URLvar.length; i++) {
			keyName = URLvar[i].split('=');
	 
			if (keyName[0] === key) {
				return keyName[1] === undefined ? true : keyName[1];
			}
		}
	}
});