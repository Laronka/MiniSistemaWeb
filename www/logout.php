<?php

	// ==============================
	// ARQUIVO: logout.php
	// ==============================
	// Encerra a sessão do usuário e redireciona para o login.

	session_start();

	// --------------------------------------------
	// DESTRUINDO A SESSÃO
	// --------------------------------------------
	// Remove todos os dados gravados na sessão
	// (id, nome, email do usuário logado)
	session_destroy();

	// Redireciona para a tela de login
	header("location: login.php");
	exit;
