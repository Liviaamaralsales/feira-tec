<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once 'connect.php';
require_once 'classes/verificar_campos.php';

$verif = new verificarCampos($mysqli);
$email = $_POST['emailuser'];
$senha = $_POST['passuser'];

$verif->verificarEmail($email);
$verif->verificarSenha($senha);

$consulta = "SELECT id_cadastro, nome, senha FROM cadastro WHERE email = ?";
$stmt = $mysqli->prepare($consulta);
$stmt->bind_param("s", $email);
$stmt->execute();
//store_result armazena os dados da consulta anterior no banco.
$stmt->store_result();

//se o valor de linhas retornadas for igual a 1
if($stmt->num_rows == 1){
    //Vincula a senha criptografada e o id do usuário que está dentro do banco, com a variável $hash e $user_id.
    $stmt->bind_result($id_user, $nome_user, $hash);
    //fetch() é necessário para que o valor vinculado seja atribuído, sem ele, o valor nunca será atribuído, pois a execução nunca será realizada.
    $stmt->fetch();

    //a função password_verify verifica se a senha digitada pelo usuário é a mesma senha criptografada do banco de dados.
    if(password_verify($senha, $hash)){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['id'] = $id_user;
        $_SESSION['nome'] = $nome_user;

        echo "<script>alert('Logado com sucesso!')</script>";
        header('Location: ../views/tela_home.php');
        exit();
    }else{
        echo "<script>alert('Usuário ou senha incorretos.')</script>";
        echo "<script>window.history.back();</script>";
        exit();
    };
}else{
    echo "<script>alert('Usuário ou senha incorretos.')</script>";
    echo "<script>window.history.back();</script>";
    exit();
};

?>