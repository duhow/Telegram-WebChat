<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Chat</title>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.0/sweetalert2.min.css">
	<style>
		html,body{ height: 100% }
		header{ background: #222; color: white; }
		header h2{ margin: 0; padding: 10px; }
		footer{ height: 34px; position: fixed !important; bottom: 0; left: 0; background: #AAA; }
		main .media { margin-top: 10px !important; padding-bottom: 10px; border-bottom: 1px solid #CCC;}
		main .media img { width: 32px; }
	</style>
</head>
<body>
	<div class="container">
		<header>
			<h2>Chat</h2>
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
	<script src="<?= base_url('js/chat.js'); ?>"></script>
	<script type="text/javascript">
		var userpic = "";
		var userpic_empty = "";
		var mid = "";
		var session = "";

		$(function(){
			Chat.ajax = "<?= site_url('chat/ajax'); ?>";
			Chat.addMessage("Hola vendedor!", 1);
			Chat.addMessage("Hola usuario!", 0);
		});
	</script>
</body>
</html>
