<?php
	require_once("../auth.php");
	require_once("../conecta.php");

	$sql = "SELECT p.*, c.categoria FROM produtos p 
			INNER JOIN categorias c ON p.id_categoria = c.id 
			ORDER BY p.nome ASC";

	$resultado = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Produtos</title>
	<style>
		* { box-sizing: border-box; margin: 0; padding: 0; }

		body {
			font-family: 'Segoe UI', sans-serif;
			background-color: #f0f2f5;
			color: #333;
		}

		.conteudo {
			max-width: 1000px;
			margin: 40px auto;
			padding: 0 20px;
		}

		.topo {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}

		.topo h4 { font-size: 1.4rem; color: #1a1a2e; }

		.btn {
			background-color: #4a6fa5;
			color: #fff;
			text-decoration: none;
			padding: 8px 16px;
			border-radius: 5px;
			font-size: 0.9rem;
			transition: background 0.2s;
		}

		.btn:hover { background-color: #3a5a8f; }

		.btn-small {
			display: block;
			padding: 4px 10px;
			font-size: 0.8rem;
			border-radius: 4px;
			text-decoration: none;
			color: #fff;
			margin-bottom: 4px;
			text-align: center;
		}

		.btn-editar { background-color: #4a6fa5; }
		.btn-editar:hover { background-color: #3a5a8f; }
		.btn-excluir { background-color: #c0392b; }
		.btn-excluir:hover { background-color: #a93226; }

		table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
		}

		thead { background-color: #1a1a2e; color: #fff; }

		th, td { padding: 12px 16px; text-align: left; font-size: 0.9rem; }

		tbody tr:nth-child(even) { background-color: #f8f9fa; }
		tbody tr:hover { background-color: #eef1f7; }

		.badge {
			padding: 3px 10px;
			border-radius: 12px;
			font-size: 0.78rem;
			font-weight: 600;
		}

		.badge.disponivel { background-color: #d4edda; color: #155724; }
		.badge.indisponivel { background-color: #fdecea; color: #721c24; }

		.mensagem {
			padding: 10px 16px;
			border-radius: 5px;
			margin-bottom: 20px;
			font-size: 0.9rem;
			font-weight: 500;
		}

		.mensagem.green { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; }
		.mensagem.red { background-color: #fdecea; color: #721c24; border-left: 4px solid #c0392b; }

		.vazio { text-align: center; padding: 30px; color: #666; font-size: 0.95rem; }
	</style>
</head>
<body>

	<?php require_once("../menu.php") ?>

	<div class="conteudo">

		<?php if (isset($_SESSION["msg"])): ?>
			<div class="mensagem <?= $_SESSION["cor"] ?>">
				<?= $_SESSION["msg"] ?>
			</div>
		<?php
			unset($_SESSION["msg"]);
			unset($_SESSION["cor"]);
		endif; ?>

		<div class="topo">
			<h4>Produtos Cadastrados</h4>
			<a class="btn" href="cadastrar.php">+ Novo Produto</a>
		</div>

		<?php if (mysqli_num_rows($resultado) > 0): ?>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Categoria</th>
					<th>Preço</th>
					<th>Disponibilidade</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_array($resultado)):
					$id = $row["id"];
					$disp = $row["disponibilidade"];
				?>
				<tr>
					<td><?= $row["id"] ?></td>
					<td><?= htmlspecialchars($row["nome"]) ?></td>
					<td><?= htmlspecialchars($row["descricao"]) ?></td>
					<td><?= htmlspecialchars($row["categoria"]) ?></td>
					<td>R$ <?= number_format($row["preco"], 2, ',', '.') ?></td>
					<td>
						<span class="badge <?= $disp ? 'disponivel' : 'indisponivel' ?>">
							<?= $disp ? 'Disponível' : 'Indisponível' ?>
						</span>
					</td>
					<td>
						<a class="btn-small btn-editar" href="editar.php?id=<?= $id ?>">Editar</a>
						<a class="btn-small btn-excluir" href="excluir.php?id=<?= $id ?>"
							onclick="return confirm('Deseja excluir este produto?')">Excluir</a>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

		<?php else: ?>
			<p class="vazio">Nenhum produto cadastrado ainda.</p>
		<?php endif; ?>

		<?php mysqli_close($conn); ?>

	</div>

</body>
</html>
