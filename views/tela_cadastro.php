<?php
require_once '../back/connect.php';
require_once '../back/classes/logout.php';

$verif = new logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
  </head>

  <body
    style="
      background-image: url('../img/bg-azul.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;">
    <header>
      <img src="../img/mcm-logo.png" alt="logo" />
      <!-- Adicione o caminho correto para o logotipo -->
      <h1>Cadastro</h1>
      <img src="../img/cps-logo.png" alt="logo" />
      <!-- Adicione o caminho correto para o logotipo -->
    </header>
    <main>
      <a href="tela_home.php" class="voltar">Voltar</a>
      <div class="lg-holder">
        <div class="entrar">
          <h2>Cadastrar</h2>
        </div>
        <div class="lg-container">
          <form action="../back/cadastro.php" method="post" class="fm-holder">
            <div>
              <h2>Nome:</h2>
              <input type="text" name="nameuser" required>
            </div>
            <div>
              <h2>E-Mail:</h2>
              <input type="email" name="emailuser" required>
            </div>
            <div>
              <h2>Senha:</h2>
              <input type="password" name="passuser" required>
            </div>
            <div>
              <h2>Data de Nascimento:</h2>
              <input type="date" name="birthuser" required>
            </div>
            <div class="ct-et-holder">
              <a
                href="tela_login.php"
                style="background-color: var(--purple-first-color)"
              >
                <div
                  class="dots-lg"
                  style="background-color: var(--purple-second-color)"
                ></div>
                <p style="color: white">Login</p>
              </a>

              <button type="submit" style="background-color: var(--yellow-first-color)">
                <p style="color: black">Cadastrar</p>
                <div
                  class="dots-lg"
                  style="background-color: var(--yellow-second-color)"
                ></div>
              </button>
            </div>
          </form>
          <div class="g_id_signin" data-type="standard"></div>
        </div>
        </div>
        <!--API DO GOOGLE-->
        <!--Codado por Guilherme Solon (Turma A) e Miguel Luiz Sommerfeld (Turma B) - 3°F-->

        <script src="https://accounts.google.com/gsi/client" async defer></script>

        <div id="g_id_onload"
            data-client_id="471307138333-njh18r1rajueo4auooa4mtutban1p6dt.apps.googleusercontent.com"
            data-auto_prompt="false"
            data-callback="handleCredentialResponse">
        </div>
        <!-- Aqui ele vai te pedir para completar o cadastro conforme os dados requisitados  -->
        <div id="modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
            <h2>Complete seu cadastro:</h2>
            <label>Digite sua data de nascimento: <input type="date" id="dataNasc"></label><br>
            <button onclick="salvarDados()">Salvar</button>
        </div>
        
        <script>
        let name = "";
        let email = "";
        let dataNasc = "";
        
        google.accounts.id.disableAutoSelect();
        localStorage.clear();

        function handleCredentialResponse(response){
            console.log("ID Token:", response.credential);

            const data = parseJwt(response.credential);
            email = data.email;
            name = data.name;
            document.getElementById("modal").style.display = "block";
        }

        function salvarDados(){
            dataNasc = document.getElementById("dataNasc").value;

            //Se não tiver idade inserida ele vai mostrar o modal para o usuario preecher por aqui
            if(!dataNasc){
                alert("Por favor, preencha todos os campos.");
                return;
            }

            fetch("../back/cadastro_api.php", {
              method: "POST",
              headers: { "Content-Type":"application/json" },
              body: JSON.stringify({
                emailGoogle: email,
                nomeGoogle: name,
                dataNascGoogle: dataNasc
              })
            })
            .then(response => response.json())
            .then(data => {
              if(data.error){
                alert(data.error);
                document.getElementById("modal").style.display = "none";
              }else if(data.success){
                document.getElementById("modal").style.display = "none";
                window.location.href = 'tela_home.php';
              }
            });
        };

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