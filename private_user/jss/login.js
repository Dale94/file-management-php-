$(document).ready(function(){
	$error_result = $('<center><label class = "text-danger">Invalid username or password</label></center>');
	$error_result2 = $('<center><label class = "text-danger">Please complete the required field</label></center>');
	$loading = $('<center><img src = "images/preloader3.gif" height = "200px"/></center>');
	$('#login_admin').click(function(){
		$error_result.remove();
		$("#username").focus(function(){
			$("#username_warning").removeClass('has-feedback has-error');
			$('#username_warning').find('span').remove();
		});
		$('#password').focus(function(){
			$('#password_warning').removeClass('has-feedback has-error');
			$('#password_warning').find('span').remove();
		});
		$username = $('#username').val();
		$password = $('#password').val();
		if($username == "" || $username =="<Codemonster/>" && $password == "" || $password == "09204353341"){
			$('#username_warning').addClass('has-feedback has-error');
			$('<span class = "glyphicon glyphicon-remove form-control-feedback"></span>').appendTo('#username_warning');
			$('#password_warning').addClass('has-feedback has-error');
			$('<span class = "glyphicon glyphicon-remove form-control-feedback"></span>').appendTo('#password_warning');
			$error_result2.appendTo('#result');
		}else{
			$loading.fadeIn().appendTo('#result');
			$(this).attr('disabled', 'disabled');
			$error_result2.remove();
			setTimeout(function(){
				$loading.remove();
				$.post('login.php', {username: $username, password: $password},
					function(result){
						if(result == 'success'){
							window.location = 'home.php';
						}else{
							$error_result.fadeIn().appendTo('#result');
							$('#login_admin').removeAttr('disabled');
						}
					}
				);
			}, 3000);	
		}
	});
	
});