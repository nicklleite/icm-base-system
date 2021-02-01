<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<title>Página não encontrada!</title>

		<style>
			html, body {
				width: 100%;
				height: 100%;
				margin: 0;
				padding: 0;
				overflow: hidden;
			}

			.overlay {
				background-color: rgba(0, 0, 0, .2);
				width: 100%;
				height: 100%;
				position: absolute;
				z-index: 0;
			}

			#bg-video {
				position: absolute;
				top: 50%;
				left: 50%;
				min-width: 100%;
				min-height: 100%;
				width: auto;
				height: auto;
				z-index: -9;
				-ms-transform: translateX(-50%) translateY(-50%);
				-moz-transform: translateX(-50%) translateY(-50%);
				-webkit-transform: translateX(-50%) translateY(-50%);
				transform: translateX(-50%) translateY(-50%);
			}

			.container {
				position: absolute;
				background-color: rgba(0, 0, 0, .7);
				padding: 20px;
				color: white;
				z-index: 99;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				margin:auto;
				width: 100%;
				max-width: 1200px;
			}
			.container h1 {
				font-weight: 700;
				font-size: 5rem;
			}
			.container p {
				margin: 50px 0;
			}
		</style>
	</head>
	<body>
		<div class="overlay"></div>

		<video autoplay muted loop id="bg-video">
			<source src="<?= base_url('assets/videos/background-404.mp4') ?>" type="video/mp4">
		</video>

		<div class="container text-center">
			<h1>Ninguém nunca vem aqui...</h1>
			<p class="lead">Quando alguém aparece por aqui, significa que a página não existe ou você não possui permissão para acessá-la.</p>
			<p class="lead">Talvez o que você esteja procurando esteja no <a href="<?= base_url('controle/dashboard') ?>" class="font-weight-bold">Dashboard</a></p>
			<small>¯\_(ツ)_/¯</small>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/116951efab.js" crossorigin="anonymous"></script>
	</body>
</html>