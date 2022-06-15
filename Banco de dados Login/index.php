<?php
include('conexao.php');
if(isset($_POST["email"]) || isset($_POST["senha"])){

    if(strlen($_POST['email'])==0){
        echo 'preencha seu email.';
    }
    elseif(strlen($_POST['senha'])==0){
        echo 'preencha sua senha.';
    }//se algum dos campos estiverem vazios, exibirá uma mensagem para preencher tal campo
    else{
        $email =$mysqli->real_escape_string($_POST['email']);
        $senha =$mysqli ->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM usuarios WHERE email ='$email' AND senha ='$senha'";
        $sql_query = $mysqli ->query($sql_code) or die ("falha na execução ".$mysqli ->error);
        
        $quantidade = $sql_query->num_rows;
        if ($quantidade == 1){
            $usuario =$sql_query->fetch_assoc();

            if (!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
        
            header("Location: projeto_integrador_teste/main.php");
        } else {
            echo "Email ou senha incorretos";
        }
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela do login</title>
</head>
<body>
    <style>
        body{
            font-family: Verdana, Tahoma, sans-serif;
            background-image: linear-gradient(45deg, cyan, rgb(0, 153, 255))
        }
        div{
            background-color: rgb(10, 10, 10);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 50px;
            border-radius: 15px;
            color: white;
            
        }
        input{
            padding: 10px;
            border: none;
            margin-top: 10px;
            outline: none;
            font-size: 12px;
            border-radius: 12px;
        }
        button{
            background-color: rgb(38, 114, 214);
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover{
            background-color: rgb(81, 202, 250);
        }
        
    </style>
    <div>
        <form action="" method="POST">
        <h1>Login</h1>
            <input type="text" placeholder="email" name ="email">
            <br>
            <input type="password" placeholder="senha" name ="senha">
            <br>
            <button type ="submit">entrar</button>
    </div>
    </form>
</body>
</html>