<?php

	// ==============================
	// ARQUIVO: processa_login.php
	// ==============================
	// Este arquivo processa o formulário de login.
	// Verifica as credenciais do usuário no banco de dados
	// e inicia a sessão caso o login seja bem-sucedido.

	// --------------------------------------------
	// INICIANDO A SESSÃO
	// --------------------------------------------
	// Necessário para gravar mensagens de erro e
	// os dados do usuário logado entre as páginas
	session_start();

	// --------------------------------------------
	// VERIFICAÇÃO DE ENVIO DO FORMULÁRIO
	// --------------------------------------------
	// Garante que o usuário chegou aqui pelo formulário
	// e não acessando a URL diretamente
	if (!isset($_POST["email"])) {
		header("location: login.php");
		exit;
	}

	// --------------------------------------------
	// RECEBENDO DADOS DO FORMULÁRIO
	// --------------------------------------------
	$email = $_POST["email"];
	$senha = $_POST["senha"];

	// --------------------------------------------
	// VALIDAÇÃO BÁSICA DOS CAMPOS
	// --------------------------------------------
	if (empty($email) || empty($senha)) {
		$_SESSION["erro"] = "Preencha todos os campos";
		header("location: login.php");
		exit;
	}

	// --------------------------------------------
	// CONEXÃO COM O BANCO DE DADOS
	// --------------------------------------------
	require_once("conecta.php");

	// --------------------------------------------
	// CONSULTA PARAMETRIZADA (PREPARED STATEMENT)
	// --------------------------------------------
	// Busca o usuário pelo e-mail informado.
	// O uso de prepared statement evita SQL Injection:
	// o valor de $email é tratado como dado, não como comando SQL.
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

		// --------------------------------------------
		// VERIFICAÇÃO DA SENHA
		// --------------------------------------------
		// password_verify() compara a senha digitada com o
		// hash bcrypt armazenado no banco de dados.
		// Nunca comparamos senhas em texto puro.
		if (password_verify($senha, $usuario["senha"])) {

			// --------------------------------------------
			// LOGIN BEM-SUCEDIDO — GRAVA A SESSÃO
			// --------------------------------------------
			// Armazena os dados do usuário na sessão para
			// que as outras páginas saibam quem está logado
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

	// --------------------------------------------
	// LOGIN MALSUCEDIDO
	// --------------------------------------------
	// Chegou aqui significa que o e-mail não foi encontrado
	// ou a senha não conferiu. A mensagem é propositalmente
	// genérica para não revelar qual dos dois falhou.
	$_SESSION["erro"] = "E-mail ou senha inválidos";

	mysqli_close($conn);

	header("location: login.php");
	exit;
