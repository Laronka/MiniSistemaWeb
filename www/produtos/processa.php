<?php
	require_once("../auth.php");

	if (!isset($_POST["nome"])) {
		header("location: listar.php");
		exit;
	}

	$nome           = $_POST["nome"];
	$descricao      = $_POST["descricao"];
	$id_categoria   = $_POST["id_categoria"];
	$preco          = $_POST["preco"];
	$disponibilidade = $_POST["disponibilidade"];
	$id             = isset($_POST["id"]) ? $_POST["id"] : 0;

	if (empty($nome) || empty($id_categoria) || empty($preco)) {
		$_SESSION["msg"] = "Preencha todos os campos obrigatórios";
		$_SESSION["cor"] = "red";
		header("location: " . (!empty($id) ? "editar.php?id=$id" : "cadastrar.php"));
		exit;
	}

	require_once("../conecta.php");

	if (!empty($id)) {

		$sql = "UPDATE produtos SET 
					nome = ?, 
					descricao = ?, 
					id_categoria = ?, 
					preco = ?, 
					disponibilidade = ? 
				WHERE id = ?";

		$stmt = mysqli_prepare($conn, $sql);
		// s = string, i = integer, d = double
		mysqli_stmt_bind_param($stmt, "ssidii", $nome, $descricao, $id_categoria, $preco, $disponibilidade, $id);

	} else {

		$sql = "INSERT INTO produtos (nome, descricao, id_categoria, preco, disponibilidade) 
				VALUES (?, ?, ?, ?, ?)";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt, "ssidi", $nome, $descricao, $id_categoria, $preco, $disponibilidade);

	}

	if (mysqli_stmt_execute($stmt)) {
		$_SESSION["msg"] = !empty($id) ? "Produto alterado com sucesso" : "Produto cadastrado com sucesso";
		$_SESSION["cor"] = "green";
	} else {
		$_SESSION["msg"] = "Erro ao salvar o produto";
		$_SESSION["cor"] = "red";
	}

	mysqli_close($conn);
	header("location: listar.php");
	exit;
