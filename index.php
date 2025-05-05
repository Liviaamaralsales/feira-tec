<?php
require_once 'back/connect.php';

if(session_status() === PHP_SESSION_NONE){
  session_start();
}

#será utilizado na aba de votação
/* if(!$_SESSION['id']){
  echo "<script>alert('Você precisa estar logado para votar.')</script>";
  die("Você precisa efetuar o login para votar.<br><a href='./tela_login.php'>Voltar para a tela de login</a>");
} */

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Home</title>
  </head>
  <body
    style="
      background-image: url('../img/bg-roxo.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    "
  >
    <header>
      <img src="../img/mcm-logo.png" alt="logo" />
      <h1>Inicio</h1>
      <img src="../img/cps-logo.png" alt="logo" />
    </header>
    <main>
      <div class="home-holder">
        <div class="home-conteiner">
        <?php
        if(@$_SESSION['id']){
          echo "Bem-vindo " . $_SESSION['nome'] . "!";
        }
        ?>
          <a href="#" class="btn-1 btn"
            ><p>Mapa</p>
            <div class="dots-1">&gt;</div></a
          >
          <a href="#" class="btn-1 btn"
            ><p>Projeto</p>
            <div class="dots-1">&gt;</div></a
          >
          <a href="views/tela_login.php" class="btn-2 btn"
            ><p>Entrar</p>
            <div class="dots-2">&gt;</div></a
          >
          <a href="views/tela_cadastro.php" class="btn-2 btn"
            ><p>Cadastrar</p>
            <div class="dots-2">&gt;</div></a
          >
          <a href="views/tela_home.php" class="btn-3 btn"
            ><p>Anônimo</p>
            <div class="dots-3">&gt;</div></a
          >
          <a href="#" class="btn-3 btn"
            ><p>Acessibilidade</p>
            <div class="dots-3">&gt;</div></a
          >
          <a href="views/sobre_etec.php" class="avaliar"><strong>Conheça o Vestibulinho</strong></a>
        </div>
      </div>
    </main>
  </body>
</html>