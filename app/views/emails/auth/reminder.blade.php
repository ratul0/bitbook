<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form:
			<br/>

			{{ URL::to('password/reset', array($token)) }}

			<br/>
			<br/>
			Thanks.
		</div>
	</body>
</html>
