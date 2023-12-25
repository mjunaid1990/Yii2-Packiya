// bookmark site
function bookmarksite(title,url) {
	if(document.all) {
		// Internet Explorer
		window.external.AddFavorite( url, title );
	}
	else if (window.sidebar && window.sidebar.addPanel) {
		// Mozilla
		window.sidebar.addPanel( title, url, "" );
	}
	else {
		// Chrome,Opera(unsupported)/Unknown
		alert( 'Press <Ctrl-D> to this add page to your bookmarks' );
	}
}

toggleModal = function(theModal,theIframe,thePreloader,duration) {

	var currentSource = $('#' + theModal + '>#' + theIframe).attr('src');

	$('#' + theModal + '>#' + theIframe).show();
	var currentHeight = $('#' + theModal + '>#' + theIframe).contents().height();

	// Max out the height we animate to
	var animateToHeight = (currentHeight<=770)?currentHeight:770;

	if (currentSource.length)
	{
		$('#' + theModal).animate({ height: animateToHeight }, duration, 'linear', function() {
			$('#' + theModal + '>#' + theIframe).show();
			$('#' + theModal + '>#' + thePreloader).hide();

			if (animateToHeight == 770)
			{
				$('#' + theModal + '>#' + theIframe).attr('scrolling','auto');
			}
		});
	}
}

$(function() {

	//Scroll-Then-Fix Content
	if($('#headerContainer').length!==0 && $('#RSBanner').length!==0){
		var adPos=$('#RSBanner').position();

		var additionalMarginTop = 0;
		$('[data-read-policy]').each(function(){
            additionalMarginTop += $(this).height();
        });

		if(additionalMarginTop > 0){
            additionalMarginTop = additionalMarginTop + 68;
        }

		if($('#adUnit_container').length!==0) {
			$('#headerContainer').removeClass("fix-header");
			$('#bannerwrapper').css("marginTop",0);
			disableMenuFix = false;
			$(window).scroll(function(e) {
				if(!disableMenuFix){
					var scrollTop = $(window).scrollTop();
					if (scrollTop >= 92) {
						$('#headerContainer').addClass("fix-header-hidebanner");
						$('#bannerwrapper').css("marginTop",140);
						$('#RSBanner').addClass("fix-header-hidebanner");
						$('#RSBanner').css("marginTop",(145+additionalMarginTop));
						if(adPos.left >= 600){
							$('#RSBanner').css("marginLeft",810);
						}else{
							$('#RSBanner').css("marginRight",810);
						}
					} else {
						$('#headerContainer').removeClass("fix-header-hidebanner");
						$('#bannerwrapper').css("marginTop",0);
						$('#RSBanner').removeClass("fix-header-hidebanner");
						$('#RSBanner').css("marginTop",(10+additionalMarginTop));
						if(adPos.left >= 600){
							$('#RSBanner').css("marginLeft",10);
						}else{
							$('#RSBanner').css("marginRight",10);
						}
					}
				}
			});
		}else if($('#bannerpage').width()<=800) {
			$('#RSBanner').addClass("fix-header-hidebanner");
			$('#RSBanner').css("marginTop",(145+additionalMarginTop));
			if(adPos.left >= 600){
				$('#RSBanner').css("marginLeft",810);
			}else{
				$('#RSBanner').css("marginRight",810);
			}
		}else{
			$('#bannerpage').css("width",800);
			$('#bannerpage').css("marginLeft",0);
			$('#RSBanner').addClass("fix-header-hidebanner");
			$('#RSBanner').css("marginTop",(145+additionalMarginTop));
			if(adPos.left >= 600){
				$('#RSBanner').css("marginLeft",810);
			}else{
				$('#RSBanner').css("marginRight",810);
			}
		};
	}else if($('#RSBanner').length!==0){
		$('#RSBanner').css("marginTop",$('#header').height()+$('#nav').height());
	};

	$("li:has('.submenu')").click(function(e){

		if ($(e.target).parents(".submenu").length==0) {

			var arrowClassName='buttonWithArrow';
			var submenuWidth=$(".submenu",this).width();

			switch(this.id){
				case 'menu5':
					//Arrow Image
					if(submenuWidth>=200){
						arrowClassName='buttonWithWhiteArrow';
					}
					//Set menuActivityslider to be the same height as left hand side menu
					var menuActivitysliderHeight=$('#menuActivityslider').height();
					var activityLeftHeight=$('#activityLeft').height();
					if(menuActivitysliderHeight != null){
						if(menuActivitysliderHeight<activityLeftHeight){
							$('#menuActivityslider').height(activityLeftHeight-25);
						}
					}else{
						$('#menu5 .submenu').css('marginRight','0px');
						$('#menu5').removeClass("buttonWithWhiteArrow");
						$('#menu5').toggleClass('buttonWithArrow');
					}
					if($("#headerContainer").width() <= 1000){
						$('.submenu',this).css('marginLeft',-(($('.submenu',this).width())/30*15));
					}
					break;
				case 'menu6':
					if($("#headerContainer").width()-$('#'+this.id).offset().left <= 350 || $('#'+this.id).offset().left <= 300){
						if($('#'+this.id).offset().left >=500){
							$('.langMenu').css('left','-169px');
							$('.langMenu').css('boxShadow','-3px 3px 3px 0 rgba(0, 0, 0, 0.5)');
							$('.langMenu').css('borderRadius','7px 0 7px 7px');
							$('.submenu',this).css('marginLeft',-(($('.submenu',this).width())/30*25));
						}else{
							$('.langMenu').css('right','-169px');
							$('.langMenu').css('boxShadow','3px 0 -3px 3px rgba(0, 0, 0, 0.5)');
							$('.langMenu').css('borderRadius','7px 7px 7px 0');
							$('.submenu',this).css('marginRight',-(($('.submenu',this).width())/30*25));
						}
					}
					break;
				case 'menu7':
					//Arrow Image
					if(submenuWidth>=200){
						arrowClassName='buttonWithWhiteArrow';
					}
					if($('#'+this.id).offset().left >=500){
						$('.submenu',this).css('marginLeft',-(($('.submenu',this).width())/30*27));
					}else{
						$('.submenu',this).css('marginRight',-(($('.submenu',this).width())/30*27));
					}
					if($('.col_2_2',this).height()>$('.col_2_1',this).height()){
						$('.col_2_1',this).height($('.col_2_2',this).height());
					}else{
						$('.col_2_2',this).height($('.col_2_1',this).height());
					}
					break;
			}

			$(this).toggleClass(arrowClassName);
			$(".submenu",this).toggleClass('submenuShow');
    		$('.submenu',this).show();
		}
	});

	var closeSubMenu = function(menuSelector) {
		$(menuSelector + ' .submenu').removeClass('submenuShow');
		$(menuSelector).removeClass("buttonWithArrow");
		$(menuSelector).removeClass("buttonWithWhiteArrow");
	};
	$('html').bind('click touchstart', function() {
		// Close the dropdown menu's
		closeSubMenu('#menu5');
		closeSubMenu('#menu6');
		closeSubMenu('#menu7');
	});
	$('#menu5').bind('click touchstart', function(ev) {
		ev.stopPropagation();
		closeSubMenu('#menu6');
		closeSubMenu('#menu7');
	});
	$('#menu6').bind('click touchstart', function(ev) {
		ev.stopPropagation();
		closeSubMenu('#menu5');
		closeSubMenu('#menu7');
	});
	$('#menu7').bind('click touchstart', function(ev) {
		ev.stopPropagation();
		closeSubMenu('#menu5');
		closeSubMenu('#menu6');
	});

	//remove padding when there is not full screen mode
	if(!window.fullScreen && window.innerWidth != screen.width){
		//Fixes for CSS reponsive menu that does not works for IE7 to IE9
		if($("#headerContainer").width() <= 1000){
			$('#header-content.logo').css('width','35px');
			$('.upgrade-banner').css('display','none');
			$('.upgrade-button').css('display','block');
			//alert($('#menu1').offset().left);
		}else{
			$('#bannerwrapper').css('paddingLeft',($("#headerContainer").width()-($("#bannerpage").width()+180))/2+'px');
		}
		$('#bannerwrapper').css('paddingLeft','0px');
		$('#bannerwrapper').css('paddingRight','0px');
	}

	$("#closeModalWindow,#cancelButtonModalWindow").click(function(){
		if($("#cancelButtonModalWindow")) {
            resetAutoRenew ()
		}
        window.parent.jQuery('#modalWindow').dialog('close');
	});
    $("#confirmDisable").click(function(){
        var form = $("#renewChangeForm");
        if(form) {
            form.submit();
        }
    });

	function resetAutoRenew () {
        var allow = $("#renewChange");
        if(allow.length > 0) {
            // if user cancels the disable auto renew, reset checkbox.
            allow.get(0).checked = true;
            allow.val(1);
        }
	}
});
