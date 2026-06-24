<?php

	// ==============================
	// ARQUIVO: categorias/listar.php
	// ==============================
	// Exibe todas as categorias cadastradas no banco de dados.
	// Equivalente ao mostrar.php do exemplo de clientes.

	// --------------------------------------------
	// PROTEÇÃO DA PÁGINA
	// --------------------------------------------
	// Verifica se o usuário está logado.
	// Se não estiver, redireciona para o login.
	require_once("../auth.php");

	// --------------------------------------------
	// CONEXÃO COM O BANCO DE DADOS
	// --------------------------------------------
	require_once("../conecta.php");

	// --------------------------------------------
	// COMANDO SQL (RETRIEVE DO CRUD)
	// --------------------------------------------
	// Busca todas as categorias ordenadas pelo nome
	$sql = "SELECT * FROM categorias ORDER BY categoria ASC";

	// Executa a consulta no banco de dados
	$resultado = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Categorias</title>
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
			margin: 40px auto;
			padding: 0 20px;
		}

		.topo {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}

		.topo h4 {
			font-size: 1.4rem;
			color: #1a1a2e;
		}

		.btn {
			background-color: #4a6fa5;
			color: #fff;
			text-decoration: none;
			padding: 8px 16px;
			border-radius: 5px;
			font-size: 0.9rem;
			transition: background 0.2s;
		}

		.btn:hover {
			background-color: #3a5a8f;
		}

		.btn-small {
			padding: 4px 10px;
			font-size: 0.8rem;
			border-radius: 4px;
			text-decoration: none;
			color: #fff;
			margin-right: 4px;
		}

		.btn-editar {
			background-color: #4a6fa5;
		}

		.btn-editar:hover {
			background-color: #3a5a8f;
		}

		.btn-excluir {
			background-color: #c0392b;
		}

		.btn-excluir:hover {
			background-color: #a93226;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 2px 10px rgba(0,0,0,0.08);
		}

		thead {
			background-color: #1a1a2e;
			color: #fff;
		}

		th, td {
			padding: 12px 16px;
			text-align: left;
			font-size: 0.9rem;
		}

		tbody tr:nth-child(even) {
			background-color: #f8f9fa;
		}

		tbody tr:hover {
			background-color: #eef1f7;
		}

		.mensagem {
			padding: 10px 16px;
			border-radius: 5px;
			margin-bottom: 20px;
			font-size: 0.9rem;
			font-weight: 500;
		}

		.mensagem.green {
			background-color: #d4edda;
			color: #155724;
			border-left: 4px solid #28a745;
		}

		.mensagem.red {
			background-color: #fdecea;
			color: #721c24;
			border-left: 4px solid #c0392b;
		}

		.vazio {
			text-align: center;
			padding: 30px;
			color: #666;
			font-size: 0.95rem;
		}
	</style>
</head>
<body>

	<?php require_once("../menu.php") ?>

	<div class="conteudo">

		<?php
			// --------------------------------------------
			// FLASH MESSAGE
			// --------------------------------------------
			// Verifica se existe uma mensagem salva na sessão
			// (vinda do processa.php após inserir/editar/excluir)
			if (isset($_SESSION["msg"])):
		?>
			<div class="mensagem <?= $_SESSION["cor"] ?>">
				<?= $_SESSION["msg"] ?>
			</div>
		<?php
			// Remove os dados da sessão após exibir a mensagem
			unset($_SESSION["msg"]);
			unset($_SESSION["cor"]);
			endif;
		?>

		<div class="topo">
			<h4>Categorias Cadastradas</h4>
			<a class="btn" href="cadastrar.php">+ Nova Categoria</a>
		</div>

		<?php
			// --------------------------------------------
			// EXIBIÇÃO DOS DADOS
			// --------------------------------------------
			// Verifica se a consulta retornou algum registro
			if (mysqli_num_rows($resultado) > 0) {
		?>

		<table>
			<thead>
				<tr>
					<th>Categoria</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// Percorre todos os registros retornados pelo banco
					while ($row = mysqli_fetch_array($resultado)) {
						$id = $row["id"];
						echo ("<tr>");
						echo ("<td>" . $row["categoria"] . "</td>");
						echo ("
							<td>
								<a class='btn-small btn-editar' href='editar.php?id=$id'>Editar</a>
								<a class='btn-small btn-excluir' href='excluir.php?id=$id' onclick=\"return confirm('Deseja excluir esta categoria?')\">Excluir</a>
							</td>
						");
						echo ("</tr>");
					}
				?>
			</tbody>
		</table>

		<?php
			} else {
				// Caso não existam registros cadastrados
				echo ("<p class='vazio'>Nenhuma categoria cadastrada ainda.</p>");
			}

			// --------------------------------------------
			// FECHANDO CONEXÃO
			// --------------------------------------------
			mysqli_close($conn);
		?>

	</div>

</body>
</html>