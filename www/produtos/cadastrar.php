<?php
	require_once("../auth.php");
	require_once("../conecta.php");

	// Busca as categorias para popular o select
	$sql_cats = "SELECT * FROM categorias ORDER BY categoria ASC";
	$categorias = mysqli_query($conn, $sql_cats);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Novo Produto</title>
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }

		body {
			font-family: 'Segoe UI', sans-serif;
			background-color: #f0f2f5;
			color: #333;
		}

		.conteudo {
			max-width: 600px;
			margin: 40px auto;
			padding: 0 20px;
		}

		.conteudo h4 { font-size: 1.4rem; color: #1a1a2e; margin-bottom: 24px; }

		.card {
			background: #fff;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
			padding: 30px;
		}

		.campo { display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; }

		.campo label { font-size: 0.85rem; font-weight: 600; color: #444; }

		.campo input,
		.campo select,
		.campo textarea {
			padding: 8px 12px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 0.95rem;
			outline: none;
			transition: border-color 0.2s;
			font-family: inherit;
		}

		.campo input:focus,
		.campo select:focus,
		.campo textarea:focus { border-color: #4a6fa5; }

		.campo textarea { resize: vertical; min-height: 80px; }

		.radios { display: flex; gap: 20px; margin-top: 4px; }

		.radios label {
			display: flex;
			align-items: center;
			gap: 6px;
			font-size: 0.95rem;
			font-weight: normal;
			cursor: pointer;
		}

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
		<h4>Novo Produto</h4>

		<div class="card">
			<form action="processa.php" method="POST">

				<div class="campo">
					<label for="nome">Nome do Produto</label>
					<input type="text" id="nome" name="nome" required autofocus placeholder="Ex: Arroz integral 1kg">
				</div>

				<div class="campo">
					<label for="descricao">Descrição</label>
					<textarea id="descricao" name="descricao" placeholder="Descreva o produto..."></textarea>
				</div>

				<div class="campo">
					<label for="categoria">Categoria</label>
					<select id="categoria" name="id_categoria" required>
						<option value="">Selecione uma categoria</option>
						<?php while ($cat = mysqli_fetch_array($categorias)): ?>
							<option value="<?= $cat["id"] ?>"><?= htmlspecialchars($cat["categoria"]) ?></option>
						<?php endwhile; ?>
					</select>
				</div>

				<div class="campo">
					<label for="preco">Preço (R$)</label>
					<input type="number" id="preco" name="preco" required step="0.01" min="0" placeholder="0,00">
				</div>

				<div class="campo">
					<label>Disponibilidade</label>
					<div class="radios">
						<label>
							<input type="radio" name="disponibilidade" value="1" checked>
							Disponível
						</label>
						<label>
							<input type="radio" name="disponibilidade" value="0">
							Indisponível
						</label>
					</div>
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
