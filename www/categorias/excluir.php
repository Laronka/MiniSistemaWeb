<?php
	require_once("../auth.php");
	require_once("../conecta.php");

	$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

	if (!$id) {
		$_SESSION["msg"] = "Categoria inválida";
		$_SESSION["cor"] = "red";
		header("location: listar.php");
		exit;
	}

	$sql = "DELETE FROM categorias WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "i", $id);

	if (mysqli_stmt_execute($stmt)) {
		$_SESSION["msg"] = "Categoria excluída com sucesso";
		$_SESSION["cor"] = "green";
	} else {
		// Erro mais comum aqui: tentar excluir uma categoria que tem produtos vinculados.
		// O banco rejeita por causa da chave estrangeira (fk_produto_categoria).
		$_SESSION["msg"] = "Erro ao excluir. Verifique se há produtos vinculados a esta categoria";
		$_SESSION["cor"] = "red";
	}

	mysqli_close($conn);
	header("location: listar.php");
	exit;
