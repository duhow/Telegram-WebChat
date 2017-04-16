<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Chat</title>

	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html,body{ height: 100% }
		header{ background: #222; color: white; }
		footer{ height: 34px; position: fixed !important; bottom: 0; left: 0; background: #AAA; }
		main .media { margin-top: 10px !important; padding-bottom: 10px; border-bottom: 1px solid #CCC;}
		main .media img { width: 32px; }
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h1>Chat</h1>
		</header>
		<main class="col-xs-12">
		</main>
		<footer class="col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Escribir mensaje...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" disabled>
						<i class="fa fa-send"></i>
					</button>
				</span>
			</div><!-- /input-group -->
		</footer>
	</div>
	<script type="text/javascript">
		var userpic = "";
		var userpic_empty = "https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y";

		function addMessage(text, from){
			var align = (from == 1 ? "right" : "left");
			var photo = userpic_empty;
			if(from == 1){
				if(userpic){ photo = userpic; }
				else{ photo = userpic_empty; }
			}

			var code = '<div class="media">';
			if(align == "left"){ code += '<div class="media-left"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'; }
			code += '<div class="media-body text-'+ align +'"><p>' + text + '</p></div>';
			if(align == "right"){ code += '<div class="media-right"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'; }
			code += '</div>';

			$("main").append(code);
		}

		$(function(){
			addMessage("Hola vendedor!", 1);
			addMessage("Hola usuario!", 0);
		});
	</script>
</body>
</html>
