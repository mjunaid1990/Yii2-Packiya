$(function() {


	// add favorite
	$('.favorites-btn').click(function(e) {
		var $favoritesBtn = $(this);
		var memberid = $(this).attr('name');

		e.preventDefault();
		MENU.addRemoveFavorite($favoritesBtn,memberid);
	});

	// KK - send interest it was coded on purpose that you cannot remove interest simply by clicking on the button again.
	$('.interest-btn').live('click', function(e) {
		var memberid = $(this).attr('name');
		var $interestBtn = $(this);

		e.preventDefault();
		MENU.addInterest($interestBtn,memberid);
	});

	//Recommended Matches
	$(".member").hover(
		function(){
			$(".actionicons", this).show();
			$(".name", this).hide();
			$(".location", this).hide();
		},
		function(){
			$(".actionicons", this).hide();
			$(".name", this).show();
			$(".location", this).show();
		}
	);

	// Lazy Load Image for Profile photos
	$('img.memberPhoto').loadScroll(100);

	// Google Responsive Advs
	// if ($('#googleBanner1_default').length){
	// 	for(k=1; k<=3; k++){
	// 		if($("div.matches").width() == 670){
	// 			$('#googleBanner'+k+'_4columns').show();
	// 			$('#googleBanner'+k+'_4columns').html('<div id="membermenu_rhs_Banner-'+k+'" class="RHSGoogleAds"></div>');
	// 		}else if($("div.matches").width() == 505){
	// 			$('#googleBanner'+k+'_3columns').show();
	// 			$('#googleBanner'+k+'_3columns').html('<div id="membermenu_rhs_Banner-'+k+'" class="RHSGoogleAds"></div>');
	// 		}else{
	// 			$('#googleBanner'+k+'_default').show();
	// 			$('#googleBanner'+k+'_default').html('<div id="membermenu_rhs_Banner-'+k+'" class="RHSGoogleAds"></div>');
	// 		}
	// 		googletag.cmd.push(function() { googletag.display('membermenu_rhs_Banner-'+k); });
	// 	}
	// };

	// Sticky Scroll-Then-Fix
	

	// JWPlayer Video
    $('#play-video').click(function() {
        $('#video-popup').dialog({
            modal: true,
            height: 480,
            width: 760,
            resizable: false,
            open: function() { jwplayer('popup-video-container').play() },
            beforeClose: function() { jwplayer('popup-video-container').stop() },
            closeText: 'x',
            close: function() {}
        })
    });

    $('#renewRebillTooltip').qtip({
        content: {
            text: renewRebillToolTip
        },
        hide: 'unfocus',
        style: {
            width: 400,
            padding: 7,
            background: '#d0d0d0',
            color: '#333',
            textAlign: 'center',
            border: {
                width: 0,
                radius: 3,
                color: '#d0d0d0'
            },
            tip: 'topLeft',
            'font-size': 12,
            'line-height': 1.3
        }
    });
    

	// Member Benefits POPUP: Launching on click
    

    // disable button on click and checkbox's and link to change membership
    
});




// namespaced functions

// add / remove favorite


// add interest


// toggle online status


	// toggle profile status
