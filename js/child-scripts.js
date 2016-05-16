(function($){
   
  "use strict";

	// Prevent the patient approved and top contact info from sticking when user scrolls

  var hdr = $('#Top_bar').height();
	var patientImg = $('.mps-patientApproved');
	var contact = $('.mps-topContactInfo');

	$(window).scroll(function(){
		if( $(this).scrollTop() > hdr ){
			patientImg.addClass('hide-header-img');
			contact.addClass('hide-header-img');

			$('.logo').css({'margin' : '0'});
		}else{
			patientImg.removeClass('hide-header-img');
			contact.removeClass('hide-header-img');

			$('.logo').css({'margin' : '0 30px 0 20px'});
		}
	});

	// Sticky Nav < 979px 

	var menuWrapper = $('.mps-header-background .menu_wrapper');
	
	$(window).scroll(function(){
		if($(this).width() >= 979){
			if($(this).scrollTop() > hdr){
				menuWrapper.addClass('mps-sticky-nav').animate({'top': 0},300);;
			}else{
				menuWrapper.removeClass('mps-sticky-nav');
			}
		}
		if($(this).width() < 979){
			menuWrapper.removeClass('mps-sticky-nav');
		}
	});

	//Popup Optin and Contact Form

	jQuery.fn.center = function() {
	    this.css("position","absolute");
	    this.css("top", Math.max(0, (($(window).height()
	    - $(this).outerHeight()) / 2) +
	    $(window).scrollTop()) + "px");
	    return this;
	};

	var $overlay = $("<div class='mps-overlay'></div>");
	$("body").append($overlay);

	$overlay.center(); 

	$(window).resize(function() {
	    $overlay.center();
	});

	if($(window).width() >= 768){
		$('.mps-centered').css({
		   'width'   : '70%'
		});
	}else if($(window).width() > 415){
		$('.mps-centered').css({
		   'width'   : '70%'
		});
	}else{
		$('.mps-centered').css({
		   'width'   : '100%'
		});
	}

	$('.mps-optin-popup').click(function(){

		$('.mps-display-optin').css({
			'display' : 'block'
		});

		$overlay.show();
		$('.mps-centered').hide();
		$('.mps-centered').show();

	});

	$('.mps-consult-popup').click(function(){

		$('.mps-display-consult').css({
			'display' : 'block'
		});

		$overlay.show();
		$('.mps-centered').hide();
		$('.mps-centered').show();

	});

	$overlay.click(function(){
	    if($('.mps-centered').hasClass('mpsGalleryOpen')){
	    	$('.mps-centered').removeClass('mpsGalleryOpen');
	    }
	    $(this).hide();
	    $('.mps-centered').hide(800);
	    $('.mps-display-optin, .mps-display-consult').css({'display' : 'none'});
	});

	$('.mps-centered .xbutton').click(function(){

		$overlay.hide();
		$('.mps-centered').hide(800);
		$('.mps-display-optin, .mps-display-consult').css({'display' : 'none'});

	});

	//////////////////////////////////////////////////////////////////////////
	// Post Gallery //
	var $mpsPostLink = $('.image_links.double a:first-child');
	if(!$('body').hasClass('blog') && $mpsPostLink.length){
		$(window).resize(function() {
			if($(window).width() >= 768){
				$('.image_links.double').show();
			}else{
				$('.image_links.double').hide();
			}
		});

		var $mpsImgWrapper = $('<div class="mps-lb-img"></div>');
		var $mpsPostImg = $('<img>');
		var $mpsTitle = $('<div class="mps-lb-title"></div>');
		var $mpsDesc = $('<div class="mps-lb-desc"></div>');
		var $mpsLeft = $('<div class="mps-lb-left mps-lb-nav">&#x2039;</div>');
		var $mpsRight = $('<div class="mps-lb-right mps-lb-nav">&#x203a;</div>');
		var $mpsXbtn = $('<div class="mps-lb-x mps-lb-nav">x</div>');
		var imgArr = $(".image_wrapper a img").map(function(){
			var patientMeta = $(this).parent().parent().parent().next();
			return {
				src: $(this).attr('src'),
				width: $(this).width(),
				height: $(this).height(),
				title: patientMeta.find('.entry-title').text(),
				desc: patientMeta.find('.post-excerpt').text()
			};
		}).get();

		$('.xbutton').hide();
		$('.mps-centered').css('max-height', '500px');
		$('.mps-centered').append($mpsTitle, $mpsImgWrapper.append($mpsPostImg), $mpsLeft, $mpsRight, $mpsDesc);

		$mpsPostLink.on('click', function(e){
			e.preventDefault();
			var patientImage = $(this).parent().parent().children('a').children('img');
			var patientSrc = patientImage.attr('src');
			var patientMeta = $(this).parent().parent().parent().next();
			var patientTitle = patientMeta.find('.entry-title').text();
			var patientDesc = patientMeta.find('.post-excerpt').text();

			$('.mps-centered').addClass('mpsGalleryOpen');
			$('.mps-centered').css('width', adjustedWidth(500, patientImage.width(), patientImage.height()));
			$mpsPostImg.attr('src', patientSrc);
			$mpsTitle.text(patientTitle);
			$mpsDesc.text(patientDesc);
			
			$overlay.show();
			$('.mps-centered').hide();
			$('.mps-centered').show();
		});

		$mpsRight.on('click', function(e){
			e.preventDefault();
			var currentImgSrc = $(this).siblings('.mps-lb-img').children('img').attr('src');
			var nextImg = imgArr[findNextIdx(imgArr, currentImgSrc, '+')] !== undefined ? 
										imgArr[findNextIdx(imgArr, currentImgSrc, '+')] : imgArr[0];
			$('.mps-centered').css('width', adjustedWidth(500, nextImg.width, nextImg.height));
			$mpsPostImg.attr('src', nextImg.src);
			$mpsTitle.text(nextImg.title);
			$mpsDesc.text(nextImg.desc);
		});

		$mpsLeft.on('click', function(e){
			e.preventDefault();
			var currentImgSrc = $(this).siblings('.mps-lb-img').children('img').attr('src');
			var nextImg = imgArr[findNextIdx(imgArr, currentImgSrc, '-')] !== undefined ? 
										imgArr[findNextIdx(imgArr, currentImgSrc, '-')] : imgArr[imgArr.length - 1];
			$('.mps-centered').css('width', adjustedWidth(500, nextImg.width, nextImg.height));
			$mpsPostImg.attr('src', nextImg.src);
			$mpsTitle.text(nextImg.title);
			$mpsDesc.text(nextImg.desc);
		});

		$(document).keydown(function(e){
			var isGalleryOpen = $('.mps-centered').hasClass('mpsGalleryOpen');
			//left arrow
			if (e.keyCode === 37 && isGalleryOpen) {
				$mpsLeft.click();
			}
			//right arrow
			if (e.keyCode === 39 && isGalleryOpen) {
				$mpsRight.click();
			}
		});

		// $mpsXbtn.on('click', function(){
		// 	$(this).hide();
		// 	$overlay.hide();
		// 	$('.mps-centered').hide(600);
		// });
	}

	function adjustedWidth(nH, oW, oH){
		// new width = new height ( original width / original height )
		return Math.floor(nH * (oW / oH));
	}

	function findNextIdx(arr, currentSrc, direction){
		var increment = direction === '+' ? 1 : -1;
		return arr.reduce(function(acc, cur, idx){
			if(cur.src === currentSrc){
				acc = idx;
			} 
			return acc;
		}, -1) + increment;
	}

})(jQuery);