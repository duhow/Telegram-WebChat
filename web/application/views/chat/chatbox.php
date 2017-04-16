<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat</title>

	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html,body{ height: 100% }
		header{ height: 40px; }
		footer{ height: 40px; position: fixed; bottom: 0; left: 0; background: #AAA; }
	</style>
</head>
<body>
	<div class="container">
		<header>
			<span>Chat</span>
		</header>
		<main class="col-xs-12">
		</main>
		<footer class="col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Escribir mensaje...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">
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

			var code = '<div class="media">'
					+ '<div class="media-'+ align +'"><a href="#"><img class="media-object" src="'+ photo +'"></a></div>'
					+ '<div class="media-body"><p>' + text + '</p></div>'
					+ '</div>';

			$("main").append(code);
		}

		$(function(){
			addMessage("Hola vendedor!", 1);
			addMessage("Hola usuario!", 0);
		});
	</script>
</body>
</html>
