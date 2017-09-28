<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<h1>Welcome to the Tools Admin</h1>
	<p>
		Click the following link to register to the application.
		<a href="http://toolsadmin.dev/register?mail={{$invite->email}}&typeUser_id={{$invite->typeUser_id}}&token={{$invite->token}}" class="btn btn-primary">Register</a>
	</p>
</body>
</html>