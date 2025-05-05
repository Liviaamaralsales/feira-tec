<?php
require_once '../back/connect.php';
require_once '../back/classes/logout.php';

$verif = new logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>

  <body
    style="
      background-image: url('../img/bg-amarelo.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;">
    <header>
      <img src="../img/mcm-logo.png" alt="logo" />
      <!-- Adicione o caminho correto para o logotipo -->
      <h1>Entrar</h1>
      <img src="../img/cps-logo.png" alt="logo" />
      <!-- Adicione o caminho correto para o logotipo -->
    </header>
    <main>
      <a href="tela_home.php" class="voltar">Voltar</a>
      <div class="lg-holder">
        <div class="entrar">
          <h2>Entrar</h2>
        </div>
        <div class="lg-container">
          <form action="../back/login.php" method="post" class="fm-holder">
            <div>
              <h2>E-Mail</h2>
              <input type="email" name="emailuser" required>
            </div>
            <div>
              <h2>Senha</h2>
              <input type="password" name="passuser" required>
            </div>
            <div class="ct-et-holder">
              <a href="tela_cadastro.php" style="background-color: var(--purple-first-color)">
                <div class="dots-lg" style="background-color: var(--purple-second-color)"></div>
                <p style="color: white">Cadastrar</p>
              </a>
              <button
                type="submit" style="background-color: var(--yellow-first-color)">
                <p style="color: black">Entrar</p>
                <div class="dots-lg" style="background-color: var(--yellow-second-color)"></div>
              </button>
            </div>
          </form>
          <div class="g_id_signin" data-type="standard"></div>
        </div>
      </div>
      <!--API DO GOOGLE-->
      <!--Codado por Guilherme Solon e Miguel Luiz Sommerfeld (Turma B) - 3°F-->

      <script src="https://accounts.google.com/gsi/client" async defer></script>

      <div id="g_id_onload"
          data-client_id="471307138333-njh18r1rajueo4auooa4mtutban1p6dt.apps.googleusercontent.com"
          data-auto_prompt="false"
          data-callback="handleCredentialResponse">
      </div>

      <script>
      let name = "";
      let email = "";

      google.accounts.id.disableAutoSelect();
      localStorage.clear();

      function handleCredentialResponse(response){
          console.log("ID Token:", response.credential);

          const data = parseJwt(response.credential);
          email = data.email;
          name = data.name;

          fetch("../back/login_api.php", {
            method: "POST",
            headers: { "Content-Type":"application/json" },
            body: JSON.stringify({
              emailGoogle: email,
              nomeGoogle: name,
            })
          })
          .then(response => response.json())
          .then(data => {
            if(data.error){
              alert(data.error);
            }else if(data.success){
              window.location.href = 'tela_home.php';
            }
          });
      }

      // Deslogar o login do google (propria API)
      function signOut(){
          google.accounts.id.disableAutoSelect();
          localStorage.clear();
          alert("Você saiu da conta.");
          window.location.href = 'tela_login.php';
      }

      // funcao pra decodificar e puxar os parametros do token, decodifica com o jWT e permite trazer parametros para o JS
      function parseJwt(token){
          const base64Url = token.split('.')[1];
          const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          return JSON.parse(atob(base64));
      }
      </script>
    </main>
  </body>
</html>
