<?php
	// ==============================
	// ARQUIVO: menu.php
	// ==============================
	// Menu de navegação compartilhado.
	// Incluído via require_once em todas as páginas protegidas.
	// Assim, qualquer alteração no menu reflete em todo o sistema.
?>
<style>
	nav {
		background-color: #1a1a2e;
		padding: 0 20px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		height: 56px;
	}

	nav .marca {
		color: #fff;
		font-size: 1.1rem;
		font-weight: 600;
		text-decoration: none;
	}

	nav ul {
		list-style: none;
		display: flex;
		gap: 8px;
		margin: 0;
		padding: 0;
	}

	nav ul a {
		color: #ccc;
		text-decoration: none;
		padding: 6px 14px;
		border-radius: 4px;
		font-size: 0.9rem;
		transition: background 0.2s, color 0.2s;
	}

	nav ul a:hover {
		background-color: #4a6fa5;
		color: #fff;
	}

	nav .sair {
		color: #e57373;
	}

	nav .sair:hover {
		background-color: #c0392b;
		color: #fff;
	}
</style>

<nav>
	<a class="marca" href="../index.php">Mini Sistema</a>
	<ul>
		<li><a class="sair" href="../logout.php">Sair</a></li>
	</ul>
</nav>
