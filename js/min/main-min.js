!function($){window.main={init:function(){$("a[href^=#].scroll-to-btn").click(function(){var a=$($(this).attr("href")),n=0!=a.length?a.offset().top:0;return $("html,body").animate({scrollTop:n},"slow"),!1}),$(".mobilenav").on("click",function(){console.log("click");var a=$("#header .main-navigation");a.is(":visible")?a.slideUp():a.slideDown()}),$(".selectbox.petrol").append('<span data-icon="2" class="icon"></span>'),$(".selectbox.gear").append('<span data-icon="1" class="icon"></span>'),$("select").selecter(),$(".gfield_radio li").on("click",function(a){$(".gfield_radio li label").removeClass("selected"),$("label",this).addClass("selected")}),$(".carousel").owlCarousel({animateOut:"fadeOut",animateIn:"fadeIn",loop:!0,margin:0,nav:!0,items:1,touchDrag:!0,navText:[,],autoplay:!0,autoplayTimeout:3e3,autoplayHoverPause:!0,autoplaySpeed:1e3,dots:!0})},loaded:function(){this.setBoxSizing(),this.ajaxPage.init()},setBoxSizing:function(){$("html").hasClass("no-boxsizing")&&$(".span:visible").each(function(){console.log($(this).attr("class"));var a=$(this),n=a.outerWidth(),e=a.width(),t=n-e,i=e-t;a.css("width",i)})},ajaxPage:{init:function(){main.ajaxPage.container=$("#ajax-page"),pageUrl=main.ajaxPage.pageUrl=window.location.href,main.ajaxPage.scrollPosition=0,$(".ajax-btn").unbind("click"),$(document).on("click",".ajax-btn",function(a){$(this).hasClass("no-scroll")?main.ajaxPage.scrollPosition=0:main.ajaxPage.scrollPosition=main.ajaxPage.container.offset().top,a.preventDefault(),main.ajaxPage.load($(this).attr("href")),$("html, body").delay(1e3).animate({scrollTop:main.ajaxPage.scrollPosition},300)}),$(document).on("click","#ajax-page .close-button",function(){main.ajaxPage.close()})},close:function(){$("#ajax-page").slideUp(function(){main.ajaxPage.container.html("")}),$("html, body").animate({scrollTop:main.ajaxPage.scrollPosition},300)},load:function(a){var n=main.ajaxPage.container,e=main.ajaxUrl(a);if(n.slideDown("2000"),$("html, body").animate({scrollTop:n.offset().top},800,"easeInOutQuad"),0==$(".content",n).length)i=$('<div class="loader"></div>').hide(),n.append(i),n.delay(200).animate({height:i.actual("outerHeight")},function(){i.fadeIn(),$.get(e,function(a){var e=$('<div class="content"></div>').hide();n.html(e),e.html(a),i.fadeOut(function(){$.fn.imagesLoaded?e.imagesLoaded(function(){n.animate({height:e.height()},function(){n.css({height:"auto"}),e.fadeIn(),n.slideDown("slow")})}):n.animate({height:e.actual("height")},function(){n.css({height:"auto"}),e.fadeIn()})})})});else{var t=$(".content",n),i=$('<div class="loader"></div>').hide();n.prepend(i),t.fadeTo(300,0,function(){i.fadeIn(),$.get(e,function(a){t.html(a),i.fadeOut(function(){n.animate({height:t.actual("height")},function(){t.fadeTo(300,1),n.css({height:"auto"})})})})})}}},ajaxUrl:function(a){var n=new RegExp("(\\?|\\&)ajax=.*?(?=(&|$))"),e=/\?.+$/;return n.test(a)?ajaxUrl=a.replace(n,"$1ajax=true"):e.test(a)?ajaxUrl=a+"&ajax=true":ajaxUrl=a+"?ajax=true",ajaxUrl},resize:function(){}},$(function(){main.init()}),$(window).load(function(){main.loaded(),"#terms-and-conditions"==window.location.hash&&$(".footer-text a").click()})}(jQuery);