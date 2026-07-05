<?php
	require_once("../auth.php");
	require_once("../conecta.php");

	$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

	if (!$id) {
		$_SESSION["msg"] = "Produto inválido";
		$_SESSION["cor"] = "red";
		header("location: listar.php");
		exit;
	}

	$sql = "DELETE FROM produtos WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "i", $id);

	if (mysqli_stmt_execute($stmt)) {
		$_SESSION["msg"] = "Produto excluído com sucesso";
		$_SESSION["cor"] = "green";
	} else {
		$_SESSION["msg"] = "Erro ao excluir o produto";
		$_SESSION["cor"] = "red";
	}

	mysqli_close($conn);
	header("location: listar.php");
	exit;
