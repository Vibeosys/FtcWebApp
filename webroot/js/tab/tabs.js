jQuery.noConflict()(function($) {
    "use strict";

    $(document).ready(function() {
		
		/* ---------------------------------------------------------------------- */
		/*	--------------------------- Vertical Tab ---------------------------- */
		/* ---------------------------------------------------------------------- */	

		$('.fc_VerticalTab').easyResponsiveTabs({
			type: 'vertical', //Types: default, vertical, accordion
			width: 'auto', //auto or any width like 600px
			fit: true, // 100% fit in a container
			closed: '', // accordion or '' Start closed if in accordion view
			tabidentify: 'hor_1', // The tab groups identifier
			active_Hash: false,// activate hash
			activate: function(event) { // Callback function if tab is switched
				var $tab = $(this);
				var $info = $('#nested-tabInfo2');
				var $name = $('span', $info);
				$name.text($tab.text());
				$info.show();
			}
		});
		
		$('.VerticalTab_6').easyResponsiveTabs({
			type: 'vertical', //Types: default, vertical, accordion
			width: 'auto', //auto or any width like 600px
			fit: true, // 100% fit in a container
			closed: '', // accordion or '' Start closed if in accordion view
			tabidentify: 'hor_1', // The tab groups identifier
			active_Hash: true,// activate hash
			activate: function(event) { // Callback function if tab is switched
				var $tab = $(this);
				var $info = $('#nested-tabInfo3');
				var $name = $('span', $info);
				$name.text($tab.text());
				$info.show();
			}
		});
			
		/* ---------------------------------------------------------------------- */
		/* ------------------------- Effect tabs -------------------------------- */
		/* ---------------------------------------------------------------------- */

		var animation_style_1 = 'fadeIn';
		
		$('.VerticalTab_1 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_1 .resp-tabs-container').addClass('animated ' + animation_style_1);
			$('.VerticalTab_1 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_1 .resp-tabs-container').removeClass('animated ' + animation_style_1);
			});


			return false;
		});
		
		var animation_style_2 = 'fadeIn';
		
		$('.VerticalTab_2 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_2 .resp-tabs-container').addClass('animated ' + animation_style_2);
			$('.VerticalTab_2 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_2 .resp-tabs-container').removeClass('animated ' + animation_style_2);
			});


			return false;
		});
		
		var animation_style_3 = 'fadeIn';
		
		$('.VerticalTab_3 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_3 .resp-tabs-container').addClass('animated ' + animation_style_3);
			$('.VerticalTab_3 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_3 .resp-tabs-container').removeClass('animated ' + animation_style_3);
			});


			return false;
		});
		
		var animation_style_4 = 'fadeIn';
		
		$('.VerticalTab_4 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_4 .resp-tabs-container').addClass('animated ' + animation_style_4);
			$('.VerticalTab_4 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_4 .resp-tabs-container').removeClass('animated ' + animation_style_4);
			});


			return false;
		});
		
		
		var animation_style_5 = 'fadeIn';
		
		$('.VerticalTab_5 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_5 .resp-tabs-container').addClass('animated ' + animation_style_5);
			$('.VerticalTab_5 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_5 .resp-tabs-container').removeClass('animated ' + animation_style_5);
			});


			return false;
		});
		
		var animation_style_6 = 'fadeIn';
		
		$('.VerticalTab_6 ul.resp-tabs-list li[class^=tabs-]').click(function() {

			$('.VerticalTab_6 .resp-tabs-container').addClass('animated ' + animation_style_6);
			$('.VerticalTab_6 .resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.VerticalTab_6 .resp-tabs-container').removeClass('animated ' + animation_style_6);
			});


			return false;
		});
		
		
		/* ---------------------------------------------------------------------- */
		/* ---------------------------- icon menu ------------------------------- */
		/* ---------------------------------------------------------------------- */

		$(".resp-tabs-container h2.resp-accordion").each(function() {

			if ($(this).hasClass('resp-tab-active')) {
				$(this).append("<i class='fa fa-angle-up arrow-tabs'></i>");
			} else {
				$(this).append("<i class='fa fa-angle-down arrow-tabs'></i>");
			}
		});

		$(".resp-tabs-container h2.resp-accordion").click(function() {
			if ($(this).hasClass('resp-tab-active')) {
				$(this).find("i.arrow-tabs").removeClass("fa-angle-down").addClass("fa-angle-up");
			}

			$(".resp-tabs-container h2.resp-accordion").each(function() {

				if (!$(this).hasClass('resp-tab-active')) {
					$(this).find("i.arrow-tabs").removeClass("fa-angle-up").addClass("fa-angle-down");
				}
			});


    });
	   
	   
	   

    }); // close


}); // close