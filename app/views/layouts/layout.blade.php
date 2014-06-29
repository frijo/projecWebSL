<!doctype html>
<html lang="es">
	<head>
		@section('cabecera')
		<meta charset="UTF-8">
		<title>Music Box</title>
	
	 	{{ HTML::style('assets/css/bootstrap.min.css', array('media'== 'screen')) }}
	 	{{ HTML::style('assets/css/common.css', array('media'== 'screen')) }}
		@show
	</head>
	<body>
		@section('cuerpo')
			{{ HTML::ul($errors->all() )}}
		@show
	</body>
</html>