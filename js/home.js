$(window).ready(function() {
    $('#log_in_button').click(function(event) {

    	$('#input_name').focus();
		$('#home_page').css('z-index', '0.3').css('opacity', '0.3');
		$('#grey').fadeIn(1000);
		$('#box, #box2').fadeIn(1000);
		$('#box, #box2').css('z-index', '2000');
		$(".box_words2_1").click(function() {
			$('#box2').slideUp(1000);
			$('#box1').slideDown(1000);
			$('#box1').css('z-index', '2000');
			$(this).fadeOut(1000);
			$(".box_words2_2").fadeIn(1000);
			$(".box_words2_2").click(function() {
				$('#box1').slideUp(1000);
				$('#box2').slideDown(1000);
				$('#box2').css('z-index', '2000');
				$(this).fadeOut(1000);
				$(".box_words2_1").fadeIn(1000);
			});
		});
		$('.box_close').click(function () {
			$('#home_page').animate({
				'opacity': '1.0',
				'z-index': '1.0',
				}, 1000
			);
			$('#grey').fadeOut(1000);
			$('#box').fadeOut(1000);
			$('#box1').fadeOut(1000);
			$('#box2').fadeOut(1000);
		});
		$('#grey').one('click',function() {
			$('#home_page').animate({
				'opacity': '1.0',
				'z-index': '1.0',
				}, 1000
			);
			$('#grey').fadeOut(1000);
			$('#box').fadeOut(1000);
			$('#box1').fadeOut(1000);
			$('#box2').fadeOut(1000);
		});
		
		event.stopPropagation();
	});
});
$(document).keyup(function(e) {
	if (e.keyCode == 27){
			$('#home_page').animate({
				'opacity': '1.0',
				'z-index': '1.0',
				}, 1000
			);
			$('#grey').fadeOut(1000);
			$('#box').fadeOut(1000);
			$('#box1').fadeOut(1000);
			$('#box2').fadeOut(1000);
		} 

});
$(window).load(function() {
	$('.live-tile').click(function() {
		var a = $(this).attr('id');
		var b = parseInt(a);
		if(b%2 == 0 )
		{
			var c = b - 1;
			$('#' + a).addClass('two-wide');
			$('#' + c).hide();
	}
		else
		{
			var d = b + 1;
			$('#' + a).addClass('two-wide');
			$('#' + d).hide();
		}
	});
});

//login validation

//function login_script_load(){
	
	//$('#login_form').submit(function() {
	//alert('ok');
	//var xmlhttp;
	//if(window.XMLHttpRequest) {
	//	xmlhttp = new XMLHttpRequest();
//	}else{
//		xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
	//}
	//xmlhttp.onreadystatechange = function(){
	//	if(xmlhttp.readyState ==4 && xmlhttp.status == 200){
	//		document.getElementById('error_div').innerHTML = xmlhttp.responseText;
//		}
//	}
//	parameter1 = 'username='+document.getElementById('input_name').value;
//	parameter2 = 'password='+document.getElementById('input_password').value;
//	
//	xmlhttp.open('POST', 'login.php', true);
//	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//	xmlhttp.send(parameter2);
//	xmlhttp.send(parameter1);
//	});
	
//}
//user page 
 
//now onsubmit function
//$('#login_form').on('click',function(e){
	//e.preventDefault();
//	login();
//});
//function login(){
//		var $logAdd = $base_url+'login_form';
//            $('#login_form').on('submit',function(){
//             var username = $('#username').val();
//             var password = $('#password').val();
//             // check uname and pass
//            if($.trim(username) ==''){
//                var error = 'PLEASE ENTER USERNAME';
//                $('#error_div').html( error);
//                return false;
//            }else {
//				if($.trim(password) ==''){
//					var error = '* Password Field Empty ';
//					$('#error_div').html( error);
//					return false;
//				}
//              else{  
//                    $('#error_div').html('');
//                }
//            }
//            var data =  "username="+username+"&pass="+password;
//            $.ajax({
//                type:'POST',
//                url:"login.php",
//                data:data,
//                dataType:'json',
//                success:function(d){
//                if(errors !='')
//                    {
//                        $('#error_div').html(errors);
//                    }
//                    else{
//                            $('#error_div').html(errors);
//                    
//                    }
//                    
//                   }
//                });
//             
//             return false; // return false to stop automatic submission 
//           });
//    }