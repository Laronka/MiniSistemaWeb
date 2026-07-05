<?php

	// ==============================
	// ARQUIVO: categorias/processa.php
	// ==============================
	// Processa o formulário de cadastro e edição de categorias.
	// Implementa o CREATE e o UPDATE do CRUD.
	require_once("../auth.php");

	if (!isset($_POST["categoria"])) {
		header("location: listar.php");
		exit;
	}

	$categoria = $_POST["categoria"];

	$id = isset($_POST["id"]) ? $_POST["id"] : 0;

	if (empty($categoria)) {
		$_SESSION["msg"] = "Preencha o nome da categoria";
		$_SESSION["cor"] = "red";
		header("location: " . (!empty($id) ? "editar.php?id=$id" : "cadastrar.php"));
		exit;
	}

	require_once("../conecta.php");

	// Se o ID existir e não estiver vazio, é uma edição
	// Se não, é uma nova inserção
	if (!empty($id)) {

		$sql = "UPDATE categorias SET categoria = ? WHERE id = ?";

		$stmt = mysqli_prepare($conn, $sql);

		mysqli_stmt_bind_param($stmt, "si", $categoria, $id);

	} else {

		$sql = "INSERT INTO categorias (categoria) VALUES (?)";

		$stmt = mysqli_prepare($conn, $sql);

		
		mysqli_stmt_bind_param($stmt, "s", $categoria);

	}

	if (mysqli_stmt_execute($stmt)) {

		if (!empty($id)) {
			$_SESSION["msg"] = "Categoria alterada com sucesso";
		} else {
			$_SESSION["msg"] = "Categoria cadastrada com sucesso";
		}

		$_SESSION["cor"] = "green";

	} else {

		$_SESSION["msg"] = "Erro ao salvar a categoria";
		$_SESSION["cor"] = "red";

	}

	mysqli_close($conn);

	header("location: listar.php");
	exit;
