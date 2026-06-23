<?php
	// Exibida após o login bem-sucedido.

	// PROTEÇÃO DA PÁGINA
	// Verifica se o usuário está logado.
	// Se não estiver, redireciona para o login.
	require_once("auth.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Início</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: 'Segoe UI', sans-serif;
			background-color: #f0f2f5;
			color: #333;
		}

		.conteudo {
			max-width: 800px;
			margin: 60px auto;
			padding: 0 20px;
			text-align: center;
		}

		.conteudo h1 {
			font-size: 1.8rem;
			color: #1a1a2e;
			margin-bottom: 10px;
		}

		.conteudo p {
			font-size: 1rem;
			color: #666;
			margin-bottom: 40px;
		}

		.cards {
			display: flex;
			gap: 20px;
			justify-content: center;
			flex-wrap: wrap;
		}

		.card {
			background: #fff;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
			padding: 30px 40px;
			text-decoration: none;
			color: #1a1a2e;
			font-weight: 600;
			font-size: 1rem;
			transition: box-shadow 0.2s, transform 0.2s;
			min-width: 160px;
		}

		.card:hover {
			box-shadow: 0 4px 18px rgba(0,0,0,0.13);
			transform: translateY(-2px);
		}

		.card span {
			display: block;
			font-size: 2rem;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>

	<?php require_once("menu.php") ?>

	<div class="conteudo">
		<h1>Bem-vindo!</h1>
		<p>O que você deseja gerenciar hoje?</p>

		<div class="cards">
			<a class="card" href="produtos/listar.php">
				<span>📦</span>
				Produtos
			</a>
			<a class="card" href="categorias/listar.php">
				<span>🗂️</span>
				Categorias
			</a>
		</div>
	</div>

</body>
</html>
