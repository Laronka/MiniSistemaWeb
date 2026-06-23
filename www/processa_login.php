<?php

	
	session_start();

	if (!isset($_POST["email"])) {
		header("location: login.php");
		exit;
	}
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	
	// VALIDAÇÃO BÁSICA DOS CAMPOS
	
	if (empty($email) || empty($senha)) {
		$_SESSION["erro"] = "Preencha todos os campos";
		header("location: login.php");
		exit;
	}


	// CONEXÃO COM O BANCO DE DADOS
	
	require_once("conecta.php");

	
	$sql = "SELECT * FROM usuarios WHERE email = ?";

	// Inicia a consulta antes da execução
	$stmt = mysqli_prepare($conn, $sql);

	// Define os parâmetros da consulta
	// s = string
	mysqli_stmt_bind_param($stmt, "s", $email);

	// Executa a consulta com os valores definidos
	mysqli_stmt_execute($stmt);

	// Recupera o resultado da consulta
	$resultado = mysqli_stmt_get_result($stmt);

	// --------------------------------------------
	// VERIFICAÇÃO DO USUÁRIO
	// --------------------------------------------
	// Testa se encontrou exatamente 1 registro com o e-mail informado
	if (mysqli_num_rows($resultado) == 1) {

		// Armazena os dados do usuário encontrado
		$usuario = mysqli_fetch_array($resultado);

		
		// VERIFICAÇÃO DA SENHA
		// password_verify() compara a senha digitada com o
		// hash bcrypt armazenado no banco de dados.
		if (password_verify($senha, $usuario["senha"])) {

			// LOGIN BEM-SUCEDIDO — GRAVA A SESSÃO
			$_SESSION["id"]    = $usuario["id"];
			$_SESSION["nome"]  = $usuario["nome"];
			$_SESSION["email"] = $usuario["email"];

			// Fecha a conexão com o banco
			mysqli_close($conn);

			// Redireciona para a página principal do sistema
			header("location: index.php");
			exit;

		}
	}
	// LOGIN MALSUCEDIDO
	$_SESSION["erro"] = "E-mail ou senha inválidos";

	mysqli_close($conn);

	header("location: login.php");
	exit;
