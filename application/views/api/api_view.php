<!DOCTYPE html>
<html>
<head>
	<title>API Tester</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body>
<form>
	<input type="text" name="username" id="username" placeholder="Username" />
	<input type="text" name="password" id="password" placeholder="Password" />
	<a onclick="checkapi();">Login</a>
</form>
<script type="text/javascript">
	function checkapi()
	{
		var username = $('#username').val();
		var password = $('#password').val();
		$.ajax({
			url: 'http://192.168.10.102/sanutanu/index.php/api/login',
			type: 'GET',
			dataType: 'json',
			data: {username: username, password: password},
			success: function(resp){
				console.log(resp);
			},
			error: function(e){
				alert('error:');
			}
		});
	}
</script>





</body>
</html>