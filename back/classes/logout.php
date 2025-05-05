<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
class logout{

    public function logout(){
        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();
    }

    public function logoutDirecionado(){
        if(!isset($_SESSION)){
            session_start();
        };

        session_destroy();
        header('Location: ./index.php');
    }
}
?>