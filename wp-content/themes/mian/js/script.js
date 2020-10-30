var slcl = false, initDraw = true, curind = 0, isgotopro = true,  jssor_slider_instance, almb = true ;
var allowsend  = true;
$(function(){

	if($('.terms-child').hasClass('term-info')) {
		scroll_top = $(window).scrollTop();
		var term_width  = $('.header-menu').height() + $('.page-banner').height();
		$('body, html').animate({ scrollTop: term_width }, '1000');
	}
	$('.scrollspy').scrollSpy();
	if( $(window).width() <= 1000 && $("#banner_mobile").length > 0){
		if($("#banner_mobile").data("bmobile") !="") {
			$("#banner_mobile").attr("src",  $("#banner_mobile").data("bmobile")) ;
		}
	}
	$(window).scroll(function(){
		if( $(this).scrollTop() > 100) {
			if(!$(".header-menu").hasClass("stick")) {
				$(".header-menu").addClass("stick");
				$('.header-menu').addClass('fadeInDown');
        		$('.header-menu').addClass('animated');
			}
		} else {
			if($(".header-menu").hasClass("stick")) {
				$(".header-menu").removeClass("stick");
				$('.header-menu').removeClass('fadeInDown');
			}
		}	
	});
	
	// if($(".terms").length > 0) {
	// 	if($(window).width() >= 1000) {
	// 		$(".terms").append("<div class='curanimation'></div>");
	// 		setTimeout(function(){
	// 			var wItem = $(".terms-item.slick-active").width() ;
	// 			var wPadd = $(".terms").css("padding-left").replace("px", "") * 1 ;
	// 			$(".curanimation").css({
	// 				"left": wPadd + $(".terms-item.hasactive").data("slick-index") * wItem + "px",
	// 				"width": wItem  + "px",
	// 				"opacity": 1
	// 			});
	// 			$(".terms-item").hover(function(){
	// 				$( ".curanimation" ).animate({
	// 				    "left":  (wItem * $(this).index()) + wPadd
	// 				  }, 500, function() {
	// 			  	});
	// 			},
	// 			function(){
					
	// 			});
	// 		}, 500);
	// 	}
		
		
	// }
	
})

jssor_1_slider_init = function() {
	
	var wWindow = $(window).width();
	var hWindow = $(window).height();
	
	$("#jssor_1").width(wWindow);
	$("#jssorc_1").width(wWindow);
	
	$("#jssor_1").height(hWindow - 80);
	$("#jssorc_1").height(hWindow - 80);
	
    var jssor_1_SlideshowTransitions = [
      {$Duration:800,$Opacity:2}
    ];
	
	var jssor_1_SlideoTransitions = [
	    [
	      	{
	      		b:-1,d:1,o:-1
      		},
	      	{
	      		b:0,d:1200,o:1,y: -20
			} 
		],
		[
	      	{
	      		b:-1,d:1,o:-1
      		},
	      	{
	      		b:0,d:500,o:1
			} 
		],
      
    ];
	
	
    var jssor_1_options = {
      $AutoPlay: 1,
      $SlideshowOptions: {
        $Class: $JssorSlideshowRunner$,
        $Transitions: jssor_1_SlideshowTransitions,
        $TransitionsOrder: 1
      },
      $CaptionSliderOptions: {
        $Class: $JssorCaptionSlideo$,
        $Transitions: jssor_1_SlideoTransitions,
        $Breaks: [
          [{d:2000,b:5600}],
          [{d:2000,b:9300}],
          [{d:2000,b:22700}]
        ]
      },
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 1920;

    function ScaleSlider() {
        var containerElement = jssor_1_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

            jssor_1_slider.$ScaleWidth(expectedWidth);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }

    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*#endregion responsive code end*/
};

function sendContact(){
	
	if($("#firstname").val() == "") {
        $("#firstname").focus();
        $("#firstname").addClass("errorinput");
        return false;
    } 
	$("#firstname").removeClass("errorinput");
	
    if($("#lastname").val() == "") {
        $("#lastname").focus();
        $("#lastname").addClass("errorinput");
        return false;
    } 
    $("#lastname").removeClass("errorinput");
    if($("#youremail").val() == "") {
        $("#youremail").focus();
        $("#youremail").addClass("errorinput");
        return false;
    }
    
    if(!isValidEmailAddress($("#youremail").val())) {
        $("#youremail").focus();
        $("#youremail").addClass("errorinput");
        return false;
    }
    $("#youremail").removeClass("errorinput");
    if($("#phonenumber").val() == "") {
        $("#phonenumber").focus();
        return false;
    } 
    
    if(allowsend) {
    	$("#sendloading").show();
    	$("#btnsend").addClass('disabled');
        allowsend = false;
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {
                action: 'sendcontact',
                data: $("#formContact").serialize()
            },
            success: function( result ) {
                if(result == 1){                
                	$("#sendloading").hide();
                	$("#btnsend").removeClass('disabled');
                	$.fancybox.open($("#thankyou"));
                	allowsend = true;
                }
            }
        }); 
    }
    return false;
}

function equalouterHeight(group) {
   tallest = 0;
   group.each(function() {
      thisHeight = $(this).outerHeight();
      if(thisHeight > tallest) {
         tallest = thisHeight;
      }
   });
   group.outerHeight(tallest);
}

function slick_slider (objstr, size1, size2, size3, size4) {
	
	var items = document.querySelectorAll(objstr+ ' img');
	if(items.length > 1) {
		$(objstr).slick({
		slidesToShow: size1,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000,
		responsive: [
			{
			breakpoint: 1440,
			settings: {
				slidesToShow: size2
			}
			},
			{
			breakpoint: 1023,
			settings: {
				slidesToShow: size3
			}
			},
			{
			breakpoint: 767,
			settings: {
				slidesToShow: size4
			}
			}
		]
		});
	}
}

function slickjs (objstr) {
	$(objstr).slick({
	  slidesToShow: 5,
	  responsive: [
	    {
	      breakpoint: 1440,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 1023,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 767,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});
}
function slickdev (objstr) {
	$(objstr).slick({
	  slidesToShow:3,
	  responsive: [
	    {
	      breakpoint: 1440,
	      settings: {
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 1023,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 767,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});
}
function slickhistory () {
	$(".slick-history").slick({
	  slidesToShow: 22,
	  slidesToScroll: 1,
	  infinite: true,
	  responsive: [
	    {
	      breakpoint: 767,
	      settings: {
	        centerMode: true,
	        slidesToShow: 3,
	        slidesToScroll: 1,
	        infinite: false
	      }
	    }
	  ]
	});
	
	$(".his-point").click(function(){
		var tmindex = $(this).index();
		slickMGoTo(".slick-history-content", tmindex);
	});	
}
function slickhistorycontent () {
	$(".slick-history-content").slick({
	  slidesToShow: 1,
	  centerPadding: 0
	  
	});
	
	$(".slick-history-content").on('afterChange', function(event, slick, currentSlide){
		$(".his-point").removeClass("slick-current");
		currentSlide = currentSlide + 1;
		$(".his-point:nth-child(" + currentSlide + ")").addClass("slick-current");
		if($(window).width() <= 767) {
			slickMGoTo(".slick-history", currentSlide - 1);
		}
		
    });
}

function slickgallery (sliderfor, slidernav) {
	$(sliderfor).slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: slidernav
	});
	$(slidernav).slick({
		slidesToShow: 3,
		slidesToScroll: 2,
		asNavFor: sliderfor,
		dots: false,
		focusOnSelect: true
	});
}

function slickawards () {
	$(".slick-awards").slick({
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1023,
	      settings: {
	        centerMode: true,
	        slidesToShow: 3,
	        centerPadding: '0px',
	      }
	    },
	    {
	      breakpoint: 767,
	      settings: {
	        centerMode: true,
	        slidesToShow: 1,
	        centerPadding: '0px',
	      }
	    }
	  ]
	});
	
}

function slickMGoTo(strobj, actIndex) {
	var slider = $( strobj );
	slider[0].slick.slickGoTo(parseInt(actIndex));
}
function slickMenu (objstr, number, curindex) {
	if(isNaN(curindex)){
		curindex = 0;
	}
	curindex = 1 * parseInt(curindex);
	if($(window).width()<= 1023) {
		if($(window).width() >= 768){
			if(curindex >=2 ) {curindex = curindex - 1;}
		}else if($(window).width() >= 375) {
			if(curindex >=2 ) {curindex = Math.ceil(curindex/2) + 1 ;}
		}
		else {
			if($(window).width()<= 767)
			curindex = 0;
		}
	}
	else if(curindex >=5 ) {curindex = curindex - 4;} else {
		curindex = 0;
	}
	$(objstr).slick({
	  slidesToShow: parseInt(number),
	  slidesToScroll: 1,
	  initialSlide: curindex,
	  responsive: [
	    {
	      breakpoint: 1023,
	      centerPadding: '0px',
	      initialSlide: curindex,
	      settings: {
	        centerMode: true,
	        slidesToShow: 3
	      }
	    },
	    {
	      breakpoint: 767,
	      centerPadding: '0px',
	      initialSlide: curindex,
	      settings: {
	        centerMode: true,
	        slidesToShow: 2,
	      }
	    }
	  ]
	});
}



function slickSubMenu (objstr, curindex) {
	
	$(objstr).slick({
	  slidesToShow:2,
	  slidesToScroll: 1,
	  initialSlide: curindex,
	});
}

function showClients() {
	$('.tab li').removeClass("active");
	$('.tab li:last-child').addClass("active");
	$('.slpartner').hide();
	$('.slclients').show();
	if(!slcl) {
		slickjs('.slclients'); slcl = true;
	}
	
}
function showPartners() {
	$('.tab li').removeClass("active");
	$('.tab li:first-child').addClass("active");
	$('.slclients').hide();
	$('.slpartner').show();
}

function drawSharp() {
	if(initDraw) {
		setTimeout(function(){
			$(".sharp3 .sharp01").css({
				"border-bottom-width": $(".sharp-contain").height() * 0.25 + "px",
				"border-left-width": $(".sharp-contain").width() * 0.1 + "px",
			});
			$(".sharp3 .sharp02").css({
				"border-bottom-width": $(".sharp-contain").height() * 0.5 + "px",
				"border-left-width": $(".sharp-contain").width() * 0.8 + "px",
			});
			$(".sharp3 .sharp03").css({
				"border-bottom-width": $(".sharp-contain").height() * 0.25 + "px",
				"border-left-width": $(".sharp-contain").width() * 0.1 + "px",
			});
			$(".sharp-contain").css({
				"opacity": 1
			});
			$(".his-text").css({
				"opacity": 1
			});
			$(".text-his-absolute").css({
				"top": $(".sharp-contain").height() * -0.25  + "px"
			});
			
		}, 1000);
		initDraw = false;
	} else {
		$(".sharp3 .sharp01").css({
			"border-bottom-width": $(".sharp-contain").height() * 0.25 + "px",
			"border-left-width": $(".sharp-contain").width() * 0.1 + "px",
		});
		$(".sharp3 .sharp02").css({
			"border-bottom-width": $(".sharp-contain").height() * 0.5 + "px",
			"border-left-width": $(".sharp-contain").width() * 0.8 + "px",
		});
		$(".sharp3 .sharp03").css({
			"border-bottom-width": $(".sharp-contain").height() * 0.25 + "px",
			"border-left-width": $(".sharp-contain").width() * 0.1 + "px",
		});
		$(".text-his-absolute").css({
			"top": $(".sharp-contain").height() * -0.25  + "px"
		});
		
	}
	
	
}

function hoverHistory() {
	$(".point").hover(function(){
		var ind = $(this).data("ind");
		if(curind != ind) {
			curind = ind;
			$(".point").removeClass("active");
			$(".point-contain").removeClass("active");
			$(".text-his").removeClass("active");
			$(".point" + curind).addClass("active");
			$(".point-contain" + curind).addClass("active");
			$(".text-his" + curind).addClass("active");
		}
	});
	
	$(".point-contain").hover(function(){
		var ind = $(this).data("ind");
		if(curind != ind) {
			curind = ind;
			$(".point").removeClass("active");
			$(".point-contain").removeClass("active");
			$(".text-his").removeClass("active");
			$(".point" + curind).addClass("active");
			$(".point-contain" + curind).addClass("active");
			$(".text-his" + curind).addClass("active");
		}
	});
	
}

jssor_pro_init = function() {
    var jssor_1_SlideshowTransitions = [
      {$Duration:800,$Opacity:2}
    ];

    var jssor_1_options = {
      $AutoPlay: 1,
      $SlideshowOptions: {
        $Class: $JssorSlideshowRunner$,
        $Transitions: jssor_1_SlideshowTransitions,
        $TransitionsOrder: 1
      },
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$,
        $AutoCenter: 0,
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$
      }
    };

    jssor_slider_instance = new $JssorSlider$("jssor_1", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 1484;

    function ScaleSlider() {
        var containerElement = jssor_slider_instance.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

            jssor_slider_instance.$ScaleWidth(expectedWidth);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }

	jssor_slider_instance.$On($JssorSlider$.$EVT_STATE_CHANGE, function(slideIndex)
    {
		if($(".numcur").length > 0) {
			$(".numcur").html(slideIndex + 1);
		}
    });
    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    /*#endregion responsive code end*/
};

function gotoproject(proid) {
	if(isgotopro ) {
		isgotopro = false;
        $.ajax({
            url: ajaxurl,
            type: 'post',
            async: false,
            data: {
                action: 'gotopro',
                proid: proid
            },
            success: function( result ) {
            	$('.pro-detail').html(result);
            	jssor_slider_instance .$Destroy();
			    //release memory
			    jssor_slider_instance  = null;
            	jssor_pro_init();
            	var plink = $("#changurl").data("plink");
            	plink = plink.replace("http:", "https:"); 
            	ChangeUrl($("#changurl").data("ptitle"), plink) ;
            	isgotopro = true;
            	scrollSPDV();
            }
        }); 
    }
}

function getPostFashion( proid, slink, sname) {
	$(".samecat").removeClass("active");
	$(".cat" + proid).addClass("active");
	if(isgotopro ) {
		isgotopro = false;
        $.ajax({
            url: ajaxurl,
            type: 'post',
            async: false,
            data: {
                action: 'getfashion',
                proid: proid
            },
            success: function( result ) {
            	$('.fashion-detail').html(result);
            	ChangeUrl(sname, slink) ;
            	isgotopro = true;
            }
        }); 
    }
}



function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
        $(document).prop('title', title);
    } else {
        
    }
}
function setActiveSPDV () {
	$(".menu-item-1111").addClass("current-menu-item");
}
function setActiveNews() {
	$(".menu-item-934").addClass("current-menu-item");
}
function setActiveCareer() {
	$(".menu-item-423").addClass("current-menu-item");
}
function setActiveCoDong () {
	$(".menu-item-945").addClass("current-menu-item");
}
function switchOffice(tmpi) {
	$(".tag-vanphong li").removeClass("active");
	$(".tag-vanphong li:nth-child(" + (tmpi + 1) + ")").addClass("active");
	$(".contentvp").removeClass("active");
	$(".contentvp" + tmpi).addClass("active");
}
function scrollSPDV() {
	$(".con-scrollbar").css("max-height", $(".pro-detail").height() - 340 + "px" );
	$(".con-scrollbar").mCustomScrollbar();
}
function scrollNext(){
	$('html,body').animate({
        scrollTop: $(".section-intro").offset().top - 160
    }, 700);
}

function toggleMenu(x) {
  x.classList.toggle("change");
  $(".bar-menu").slideToggle();
  $(".header-menu").toggleClass("togglemenu");
}

function nextsubmenu() {
	var countli = $(".slsubmobile ul li").length;
	var wul = $(".slsubmobile ul").width() / countli;
	var licur = $(".slsubmobile li.curmb").index()*1;
	var mleft = $( ".slsubmobile ul" ).css("margin-left").replace("px", "") * 1;
	wul = (licur + 1) * wul * -1;
	if( licur < (countli - 2)) {
		$(".slsubmobile li.curmb").removeClass("curmb");
		$(".slsubmobile li:nth-child(" + (licur + 2) + ")").addClass("curmb");
		$( ".slsubmobile ul" ).animate({
		    "margin-left": wul
		  }, 500, function() {
	  	});
	}
	
	/*
	
	
	if( (licur + 1) < countli && almb ) {
		almb = false;
		$(".slsubmobile li.curmb").removeClass("curmb");
		$(".slsubmobile li:nth-child(" + (licur + 2) + ")").addClass("curmb");
		wul = wul * 1;
		$( ".slsubmobile ul" ).animate({
		    "margin-left": "-=" +wul
		  }, 500, function() {
		  	almb = true;
	  	});
	}*/
		
}

function presubmenu() {
	var countli = $(".slsubmobile ul li").length;
	var wul = $(".slsubmobile ul").width() / countli;
	var licur = $(".slsubmobile li.curmb").index()*1;
	wul = wul * (licur - 1);
	var mleft = $( ".slsubmobile ul" ).css("margin-left").replace("px", "")*1;
	if(licur > 0 ) {
		$(".slsubmobile li.curmb").removeClass("curmb");
		$(".slsubmobile li:nth-child(" + licur + ")").addClass("curmb");
		$( ".slsubmobile ul" ).animate({
		    "margin-left":  wul
		  }, 500, function() {
	  	});
	} else {
	}
		
}



function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

function switchLanguage(strLocal){
    var curUrl =  window.location.href;
    if(strLocal == "vi"){
        curUrl = curUrl.replace("/en/", "/vi/");
    }else{
        var host = $("#gohome").attr("href") + "/";
        curUrl = curUrl.replace("/en/", "/");
        curUrl = curUrl.replace(host, host + "en/");
    }
     window.location.href = curUrl;
}