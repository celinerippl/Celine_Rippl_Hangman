<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registrierung</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
	<form action="index.php" method="POST">
		<ul>
			<li>
				<label for="email">E-Mail</label>
				<input type="email" id="email" name="email" />
			</li>
			<li>
				<label for="password">Passwort</label>
				<input type="password" id="password" name="password" />
			</li>
			<li>
				<button type="submit">Login</button>
			</li>
			<li>
				<button onclick="window.location.href='registration.php'">Registration</button>
			</li>
		</ul>
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			form_listeners();
		});

		function form_listeners() {

			$(document).on("submit", "form", function(e) {

				e.preventDefault();

				$.ajax({
					url: 'ajax.php',
					dataType: 'text',
					type: 'post',
					data: $("form").serialize(),
					success: function(data) {

						response = $.parseJSON(data);

						if (response.status == "success") {

							$("form ul").slideUp(500, function() {

								$(this).replaceWith('<a class="link" href="hangman.php">Play Hangman</a>');
								$("form a").fadeIn(300);


							});

							
						} 
						else {

							$("form ul").slideUp(500, function() {

								$(this).replaceWith('<h2 class="hidden">Überprüfen Sie ihre Login Daten.</h2>');
								$("form h2").fadeIn(300);
							});
						}
					}
				});
			});
		}
	</script>
</body>

</html>