// IF JS IS ENABLED, REMOVE 'no-js' AND ADD 'js' CLASS
jQuery('html').removeClass('no-js').addClass('js');

jQuery(document).ready(function($) {
	//FITVIDS
	$(".entry-content").fitVids();
	
	//RESPONSIVE MENU
	$('#mobile-nav').meanmenu();

	//FORM VALIDATION
	if (jQuery().validate) { jQuery("#commentform").validate(); }

	//INITIAL SKROLLR ACTIONS
	var iOS = parseFloat(('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ''])[1]).replace('undefined', '3_2').replace('_', '.').replace('_', '')) || false;

	if (iOS > 8) {
	   _skrollr = skrollr.init({ mobileCheck: function () { return false } });
	} else {
	   _skrollr = skrollr.init({forceHeight: false});
	}

	//FULLSCREEN SINGLE POST HERO
	$(function(){
		//$(window).load(function(){ //ON LOAD
			var pageHeight = jQuery(window).height();
			var loggedinHeight = pageHeight - 32;

			if( $('body').hasClass('admin-bar') ) {
				$('.single-post .post-grid.head, .page .post-grid.head').css({ "height": loggedinHeight + 'px' });
				
			} else {
				$('.single-post .post-grid.head, .page .post-grid.head').css({ "height": pageHeight + 'px' });
			}
		//});
		$(window).resize(function(){ //ON RESIZE
			var pageHeight = jQuery(window).height();
			var loggedinHeight = pageHeight - 32;

			if( $('body').hasClass('admin-bar') ) {
				$('.single-post .post-grid.head, .page .post-grid.head').css({ "height": loggedinHeight + 'px' });
			} else {
				$('.single-post .post-grid.head, .page .post-grid.head').css({ "height": pageHeight + 'px' });
			}
		});
	});

	//COMMENTS
	var $commentform = $('#commentform');
	if ( $commentform.length ) {
		var commentformHeight = $commentform.height(),
			$cancelComment = $('#cancel-comment'),
			$commentTextarea = $('#comment');
		$commentTextarea.css({
			height : 60
		});
		$commentform.css({
			height : 60,
			overflow : 'hidden'
		}).on('click', function() {
			var $this = $(this);
			$this.animate({
				height : commentformHeight,
			}, 300);
			$commentTextarea.css({
				height : 'auto',
				overflow : 'visible'
			});
			$cancelComment.on('click', function(e) {
				e.preventDefault();
				$this.animate({
					height : 60,
				}, 300, function(){
					$commentTextarea.css({
						height : 60,
						overflow : 'hidden'
					});
				});
				return false;
			});
		});
	}

	//IE SIDEBAR TOGGLE SPECIFIC
	var $browserMSIE = $.browser.msie;
	var $browserVersion = parseInt($.browser.version, 10);
	
	if ($browserMSIE && $browserVersion === 8 || $browserMSIE && $browserVersion === 9) {
	$(document).on("click", '.ie .sidebar-btn' , function(){ 
		if ($('#theme-wrapper').hasClass('ie-side-menu')) {
			$('#theme-wrapper').removeClass('ie-side-menu');
		 	$('.hidden-sidebar').css('display','none').css('z-index','-1');
		 	$('.sidebar-btn').removeClass('active');
		 } else {
		 	$('#theme-wrapper').addClass('ie-side-menu');
		 	$('.hidden-sidebar').css('display','block').css('z-index','99');
		 	$('.sidebar-btn').addClass('active');
		} 
	 });
	} else {}

	var ua = navigator.userAgent,
    	clickevent = (ua.match(/iPad/i) || ua.match(/iPhone/i) || ua.match(/Android/i)) ? "touchstart" : "click";
   	    
	//MENU BUTTON TRIGGER
	$(document).on(clickevent, 'a.sidebar-btn, .nav-overlay', function(event){
	event.preventDefault();
		if ($('#theme-wrapper').hasClass('side-menu')) {
		  closeMenu();
		} else {
		  openMenu();
		}
	});
	 
	//OPEN
	function openMenu(){
	 	$('.hidden-sidebar').css('display','block');
	 	$('.sidebar-btn').addClass('active');
	 	$('#theme-wrapper').addClass('side-menu');
	 	$('#theme-wrapper').addClass('side-trans');
	 	$('.safari #theme-wrapper').addClass('no-flick');
	 	setTimeout(function(){$('.hidden-sidebar').css('z-index','5');},800);
	}
	
	//CLOSE 
	function closeMenu(){
		$('.hidden-sidebar').css('z-index','-1');
		$('.sidebar-btn').removeClass('active');
	     $('#theme-wrapper').removeClass('side-menu');
	     setTimeout(function(){$('#theme-wrapper').removeClass('side-trans');},800);
	     $('.safari #theme-wrapper').removeClass('no-flick');
		setTimeout(function(){ $('.hidden-sidebar').css('z-index','-1'); },800);
	}

	Bean_Likes.Bean_Likes_Init();
	Bean_Media.setupAudioPosts();

});

//BEAN LIKES FUNCTIONS
var Bean_Likes = {
	Bean_Reload_Likes: function(who) {
	var text = jQuery("#" + who).html();
	var patt= /(\d)+/;

	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	jQuery("#" + who).html('<span class="count">' + text + '</span>');
	},

	Bean_Likes_Init: function() {
	jQuery(".bean-likes").click(function() {
		var classes = jQuery(this).attr("class");
		classes = classes.split(" ");

		if(classes[1] == "active") {
			return false;
		}
		var classes = jQuery(this).addClass("active");
		var id = jQuery(this).attr("id");
		id = id.split("like-");
		jQuery.ajax({
		  type: "POST",
		  url: "index.php",
		  data: "likepost=" + id[1],
		  success: Bean_Likes.Bean_Reload_Likes("like-" + id[1])
		});
		return false;
	});
	}
};

//FUNCTIONS FOR HANDLING POSTS OF TYPE 'AUDIO'
var Bean_Media = {
	setupAudioPosts: function() {

		if(jQuery().jPlayer) {
			jQuery(".jp-audio").each(function() {
				var mp3 = jQuery(this).data("file");
				var cssSelectorAncestor = '#' + jQuery(this).attr("id");

				jQuery(this).find(".jp-jplayer").jPlayer( {
					ready : function () {
							jQuery(this).jPlayer("setMedia", {
							mp3: mp3,
							end: ""
						});
					},
					size: {
					    width: "100%",
					},
					swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
					cssSelectorAncestor: cssSelectorAncestor,
					supplied: (mp3 ? "mp3": "") + ", all"
				});
			});
		}
		jQuery(".jp-audio .jp-interface").css("display", "block");

	},
};