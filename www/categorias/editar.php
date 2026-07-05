<?php
	require_once("../auth.php");
	require_once("../conecta.php");

	$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

	$sql = "SELECT * FROM categorias WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	$resultado = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($resultado) == 1) {
		$categoria = mysqli_fetch_array($resultado);
	} else {
		$_SESSION["msg"] = "Categoria não encontrada";
		$_SESSION["cor"] = "red";
		header("location: listar.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Categoria</title>
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }

		body {
			font-family: 'Segoe UI', sans-serif;
			background-color: #f0f2f5;
			color: #333;
		}

		.conteudo {
			max-width: 500px;
			margin: 40px auto;
			padding: 0 20px;
		}

		.conteudo h4 {
			font-size: 1.4rem;
			color: #1a1a2e;
			margin-bottom: 24px;
		}

		.card {
			background: #fff;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
			padding: 30px;
		}

		.campo { display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; }

		.campo label { font-size: 0.85rem; font-weight: 600; color: #444; }

		.campo input {
			padding: 8px 12px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 0.95rem;
			outline: none;
			transition: border-color 0.2s;
		}

		.campo input:focus { border-color: #4a6fa5; }

		.acoes { display: flex; gap: 10px; margin-top: 10px; }

		.btn {
			padding: 8px 20px;
			border-radius: 5px;
			font-size: 0.9rem;
			font-weight: 600;
			text-decoration: none;
			cursor: pointer;
			border: none;
			transition: background 0.2s;
		}

		.btn-salvar { background-color: #4a6fa5; color: #fff; }
		.btn-salvar:hover { background-color: #3a5a8f; }
		.btn-cancelar { background-color: #e0e0e0; color: #333; }
		.btn-cancelar:hover { background-color: #ccc; }
	</style>
</head>
<body>

	<?php require_once("../menu.php") ?>

	<div class="conteudo">
		<h4>Editar Categoria</h4>

		<div class="card">
			<form action="processa.php" method="POST">

				<input type="hidden" name="id" value="<?= $categoria['id'] ?>">

				<div class="campo">
					<label for="categoria">Nome da Categoria</label>
					<input type="text" id="categoria" name="categoria" required autofocus
						value="<?= htmlspecialchars($categoria['categoria']) ?>">
				</div>

				<div class="acoes">
					<button type="submit" class="btn btn-salvar">Salvar</button>
					<a class="btn btn-cancelar" href="listar.php">Cancelar</a>
				</div>

			</form>
		</div>
	</div>

</body>
</html>
