<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

$erro = $_SESSION["erro"] ?? "";
unset($_SESSION["erro"]);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
      color: #333;
    }

    .card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 16px rgba(0,0,0,0.10);
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 360px;
    }

    .card h1 {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 0.25rem;
      color: #1a1a2e;
    }

    .card p.subtitulo {
      font-size: 0.875rem;
      color: #666;
      margin-bottom: 1.75rem;
    }

    .campo {
      display: flex;
      flex-direction: column;
      gap: 0.35rem;
      margin-bottom: 1.1rem;
    }

    .campo label {
      font-size: 0.825rem;
      font-weight: 600;
      color: #444;
      letter-spacing: 0.02em;
    }

    .campo input {
      padding: 0.6rem 0.75rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
      transition: border-color 0.2s;
      outline: none;
    }

    .campo input:focus {
      border-color: #4a6fa5;
    }

    .erro {
      background: #fdecea;
      color: #c0392b;
      border-left: 3px solid #c0392b;
      padding: 0.6rem 0.75rem;
      border-radius: 4px;
      font-size: 0.85rem;
      margin-bottom: 1.1rem;
    }

    button[type="submit"] {
      width: 100%;
      padding: 0.7rem;
      background-color: #4a6fa5;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 0.5rem;
    }

    button[type="submit"]:hover {
      background-color: #3a5a8f;
    }
  </style>
</head>
<body>

  <div class="card">
    <h1>Bem-vindo</h1>
    <p class="subtitulo">Faça login para acessar o sistema</p>

    <?php if ($erro): ?>
      <div class="erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif ?>

    <form action="processa_login.php" method="POST">
      <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required autofocus placeholder="seu@email.com">
      </div>

      <div class="campo">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required placeholder="••••••••">
      </div>

      <button type="submit">Entrar</button>
    </form>
  </div>

</body>
</html>