<?php
	
	// VERIFICAÇÃO DE SESSÃO
	session_start();

	// Verifica se o usuário está logado
	// Se $_SESSION["id"] não existir, significa que não há login ativo
	if (!isset($_SESSION["id"])) {
		header("location: login.php");
		exit;
	}
