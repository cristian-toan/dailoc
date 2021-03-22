function $$$(id) {
	return document.getElementById(id);
}
function	Forward(url) {
	window.location.href = url;
}
function	_postback() {
	return void(1);
}

//----------------------------------------------------------------------------------------------------------------------
function ajaxFunction() {
	var xmlHttp=null;
	try {
		// Firefox, Internet Explorer 7. Opera 8.0+, Safari.
		xmlHttp = new XMLHttpRequest();
	}
	catch (e) {
		// Internet Explorer 6.
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				return false;
			}
		}
	}
}

//----------------------------------------------------------------------------------------------------------------------
/**
 *
 * @param obj
 * @returns {string}
 */
function $query(obj) {
	var query = "";
	$(obj).find("input").each(function(i){
		var t = $(obj).find("input").eq(i);
		if ((t.attr("type") != "checkbox") && (t.attr("type") != "radio") ) {
			if (t.attr("type") != "password") {
				query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
			} else {
				query += "&"+t.attr("name")+"="+document.getElementById(t.attr("name")).value;
			}
		}
		else {
			if(t.attr("type") == "checkbox") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			}
			else if (t.attr("type") == "radio") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			}
		}
	});
	$(obj).find("button").each(function(i){
		var t = $(obj).find("button").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});
	$(obj).find("textarea").each(function(i) {
		var t = $(obj).find("textarea").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});
	$(obj).find("select").each(function(i) {
		var t = $(obj).find("select").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});

	return query.substring(1);
}

//----------------------------------------------------------------------------------------------------------------------
function $query_unt(obj) {
	var query = "";
	$(obj).find("input").each(function(i){
		var t = $(obj).find("input").eq(i);
		if((t.attr("type") != "button") && (t.attr("type") != "submit") && (t.attr("type") != "reset") && (t.attr("type") != "hidden")) {
			if ((t.attr("type") != "checkbox") && (t.attr("type") != "radio") ) {
				t.val('');
			} else {
				t.attr("checked", false);
			}
		} else {}
	});
	$(obj).find("textarea").each(function(i) {
		var t = $(obj).find("textarea").eq(i);
		t.val('');
	});
	return true;
}
//----------------------------------------------------------------------------------------------------------------------
function showLoader() {
	$("#_loading").html("<div style=\"position: fixed; top: 50%; right: 50%; text-align: center; background: transparent; z-index: 999999999;\"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div>").hide().fadeIn(10);
	block = true;
}

//----------------------------------------------------------------------------------------------------------------------
function closeLoader() {
	$("#_loading").html("").hide().fadeOut(100);
	block = false;
}

//----------------------------------------------------------------------------------------------------------------------
function showResult(type,data) {
	closeLoader();
	$("#"+type+"").html(data).hide().fadeIn(100);
	block = false;
}

//----------------------------------------------------------------------------------------------------------------------
$(document).ready(function() {
	$(window).scroll(function() {
		if($(this).scrollTop() > 50){
			$('#go-top').stop().animate({
				bottom: '50px'
			}, 500);
		}
		else{
			$('#go-top').stop().animate({
				bottom: '-50px'
			}, 500);
		}
	});
	$('#go-top').click(function() {
		$('html, body').stop().animate({
			scrollTop: 0
		}, 500, function() {
			$('#go-top').stop().animate({
				bottom: '-50px'
			}, 500);
		});
	});
	$('.auto-number').autoNumeric('init');
});
$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500 && window.innerWidth > 960) {
			$('.menu-cat-pro').addClass('fixed');
		} else {
			$('.menu-cat-pro').removeClass('fixed');
		};
	});
});
(function($) {
	$.fn.menumaker = function(options) {
		var navigation = $(this), settings = $.extend({
			title: "",
			format: "dropdown",
			sticky: false
		}, options);

		return this.each(function() {
			navigation.find('li ul').parent().addClass('has-sub');
			multiTg = function() {
				navigation.find(".has-sub ul li.active").parents('.has-sub').addClass('active');
			};
			multiTg();
		});
	};
	$(document).ready(function(){
		$(document).ready(function() {
			$("nav.navigation").menumaker({
				title: "",
				format: "multitoggle"
			});
		});
	});
})(jQuery);
//----------------------------------------------------------------------------------------------------------------------
function sendMail(type, id) {
	var dataList = $query('#'+id);
	showLoader();
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url='+type+'&'+dataList,
		dataType: "html",
		success: function(data){
			closeLoader();
			$query_unt('#'+id);
			alert(data);
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function check_contact(){
	var input = document.forms['frm_contact'].getElementsByTagName('input');
	var txtarea = document.forms['frm_contact'].getElementsByTagName('textarea');
	var err_field = $("[name='lang_field']").val();
	var err_email = $("[name='lang_email']").val();
	var err_phone = $("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if( value == ''){
				if(name != 'address'  && name != 'send_contact') {
					span.innerHTML = err_field;
				}
			}
			if(name == 'email' && value != '') {
				var return_val=email_filter.test(value);
				if(return_val==false){span.innerHTML = err_email;}
			}
			if(name == 'tel' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 8){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid #ff6e69';
			}
		}
		return !errors;
	}

	var register = document.getElementById('_send_contact');
	register.onclick = function(){
		return valid();
	}

	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #dfdfdf';
				valid();
			}
		}
	}
}

//----------------------------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------------------------
function check_order(){
	var input = document.forms['frmOrder'].getElementsByTagName('input');
	var txtarea = document.forms['frmOrder'].getElementsByTagName('textarea');

	var err_field = $('#txtEnterField').val();
	var err_email = $('#txtEnterMail').val();
	var err_tell = $('#txtEnterTell').val();

	var inputs = new Array();
	for(var i=0; i<(input.length+txtarea.length); i++){
	  if(i<input.length) inputs[i]=input[i];
	  else inputs[i]=txtarea[i-input.length];
	}
	var run_onchange = false;
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	var pass ='';
	function valid(){
	var errors = false;
	for(var i=0; i<inputs.length; i++){
		var value = inputs[i].value;
		var id = inputs[i].getAttribute('id');

	    var span = document.createElement('span');
	    var p = inputs[i].parentNode;
	    if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

	    if( value == ''){
		    if(id != 'txtAddress'  && id != 'btnSendOrder') {
		     	span.innerHTML = err_field;
		    }
	   	}
	   	if(id == 'txtEmail' && value != '') {
		    var returnval=emailfilter.test(value);
		    if(returnval==false){span.innerHTML = err_email;}
	   	}
	   	if(id == 'txtTell' && value != ''){
		    if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_tell;}
		    if(isNaN(value) == false && value.length < 10){span.innerHTML = err_tell;}
	   	}

	   if(span.innerHTML != ''){
		    inputs[i].parentNode.appendChild(span);
		    span.setAttribute('class', 'show-error');
		    errors = true;
		    run_onchange = true;
		    inputs[i].style.border = '1px solid #ff6e69';
	   	}
  	}
	  return !errors;
 	}

 	var register = document.getElementById('btnSendOrder');
 	register.onclick = function(){
  		return valid();
 	}

	for(var i=0; i<inputs.length; i++){
	 	var id = inputs[i].getAttribute('id');
	  	inputs[i].onchange = function(){
	   		if(run_onchange == true){
	    		this.style.border = '1px solid #e0e1e0';
	    	valid();
	   		}
	  	}
 	}
}
//----------------------------------------------------------------------------------------------------------------------
function check_register(){
	var input = document.forms['frm_register'].getElementsByTagName('input');
	var select = document.forms['frm_register'].getElementsByTagName('select');
	var err_field = $("[name='lang_field']").val();
	var err_email = $("[name='lang_email']").val();
	var err_phone = $("[name='lang_phone']").val();

	var inputs = new Array();
	for(var i=0; i<(input.length+select.length); i++){
		if(i<input.length) inputs[i]=input[i];
		else inputs[i]=select[i-input.length];
	}
	var run_onchange = false;
	var email_filter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}
			var input_unt = ['address', 'number', 'register_email'];
			var cke = input_unt.indexOf(name);
			if( value == '' && cke < 0){
				span.innerHTML = err_field;
			}
			if(name == 'email' && value != '') {
				var return_val = email_filter.test(value);
				if(return_val == false){ span.innerHTML = err_email; }
			}
			if(name == 'tel' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = err_phone;}
				if(isNaN(value) == false && value.length < 8){span.innerHTML = err_phone;}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
			}
		}
		return !errors;
	}

	var register = document.getElementById('_register_email');
	register.onclick = function(){
		return valid();
	}

	for(var i=0; i<inputs.length; i++){
		inputs[i].onchange = function(){
			if(run_onchange == true){
				valid();
			}
		}
	}
}

//----------------------------------------------------------------------------------------------------------------------
jQuery(document).ready(function ($) {
	new WOW().init();
	$('#_program').bxSlider({
		mode: 'horizontal',
		auto: false,
		slideWidth: 281,
		maxSlides: 4,
		minSlides: 1,
		slideMargin: 0,
		pager: false,
		controls: true
	});
	$('#_photo').bxSlider({
		mode: 'horizontal',
		auto: true,
		slideWidth: 287,
		maxSlides: 1,
		minSlides: 1,
		slideMargin: 0,
		pager: false,
		controls: true,
		infiniteLoop: false,
		hideControlOnEnd: true
	});
	$('#_certify').bxSlider({
		slideWidth: 200,
		auto: true,
		speed: 5000,
		pause: 2000,
		maxSlides: 6,
		minSlides: 1,
		slideMargin: 0,
		pager: false,
		controls: true
	});
	$(".fancybox-group").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		prevEffect	: 'none',
		nextEffect	: 'none',
		closeBtn	: false,
		helpers     : {
			title	: { type : 'inside' },
			thumbs	: {
				width	: 50,
				height	: 50
			},
			buttons	: {}
		}
	});
	$(".fancy-box").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic'
	});
});

//----------------------------------------------------------------------------------------------------------------------

$(document).ready(function() {
	$("#btn-ordered").click(function(){
		var collapse_content_selector = $(this).attr('href');
		var toggle_switch = $(this);
		$(collapse_content_selector).toggle(function(){
			if($(this).css('display')=='none'){
				toggle_switch.val('Giao hàng');
			}else{
				toggle_switch.val('Đóng');
			}
		})
	});
});
//------------------------

$(document).ready(function() {
	var width = $( window ).width();
   	$( window ).resize(function() {
    	width = $( window ).width();
     	change_layout(width);
   	});
	   change_layout(width);
	   	function change_layout(width) {
	       	if (width < 840) {
	           $('.content-right').after($('.content-left'));
	       	}else{
	           $('.content-right').before($('.content-left'));
	       	}
	   }
});

//------------------------------

( function( $ ) {
$( document ).ready(function() {
$('#cssmenu > ul > li').click(function() {
  var checkElement = $(this).children('ul');
  if(checkElement.is(":visible")) {
      checkElement.slideUp('normal');
  }
  else if(checkElement.not(":visible")) {
    $('#cssmenu ul ul:visible').slideUp('normal');
      checkElement.slideDown('normal');
  }
});
});
} )( jQuery );

//-----------------------------------------------------
( function( $ ) {
	$( document ).ready(function() {		
		$('.header-right form .icon-search').click(function(){
			width_text = $('.header-right input[type="text"]').width();			
			if(width_text == 0){
				$('.header-right input[type="text"]').css('width', 200 + 'px');				
			}else{
                $('.header-right input[type="text"]').css('width', 0 + 'px');                
			}
		});
	});
})( jQuery );

//-----------------------------------------------------

$(document).ready(function() {
    var owl = $('.pro-special');
    owl.owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed:450,
        dots:false,
    });
})

//-------------------------

$(document).ready(function () {
	var owl = $('.gal-single-pro');
	owl.owlCarousel({
		items: 1,
		loop: true,
		margin: 20,
		autoplay: true,
		autoplayHoverPause: true,
		dots: false,
		nav: true,
	});
})