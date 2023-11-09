<?php

session_start();

if ($_POST['form_login'] == "LOGIN") {


  include_once($_SERVER['DOCUMENT_ROOT']."/class/conexao.php");
  include_once($_SERVER['DOCUMENT_ROOT']."/class/enc.php");


  $form1 = addslashes($_POST['form_login']);
  $login = addslashes($_POST['username']);
  $pass1 = addslashes($_POST['password']);
  $pass = AESCrypt::encrypt($key, $pass1);
  $result_produtos = "SELECT * FROM usuario WHERE login='$login' && pass='$pass' LIMIT 1";
  $resultado_produtos = mysqli_query($conn, $result_produtos);
  while ($row_produto = mysqli_fetch_assoc($resultado_produtos)) {


    $login = $row_produto['login'];
    $_SESSION['painel']['login'] = $login;
    $loginerro = "ERRO";
    echo "<script>
window.location='./';
</script>";
    /*$_SESSION['message']='Logado com sucesso!';
header('location: ./');*/

  }

  if ($form1 != "") {

    if ($loginerro != "ERRO") {

      echo "<script>
alert('USUÁRIO OU SENHA INCORRETOS');
window.location='./';
</script>";
      /*$_SESSION['erro']='Credenciais invalidas!';
header('location: ./');*/
    }
  }


}
if ($_POST['form_login'] == "SAIR") {

  unset($_SESSION["newsession"]);
  unset($_SESSION['painel']['login']);

}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">p
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DTUNEL-GL - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      background-image: linear-gradient(225deg, #333038 0, #333038 16.67%, #333038 33.33%, #333038 50%, #333038 66.67%, #5A535C 83.33%, #5A535C 100%);      font-family: Arial, Helvetica, Sans-Serif;
      overflow: hidden;
      height: 100vh;
    }
    .login {
      width: 100%;
      height: 90vh;
      align-items: center;
      justify-content: center;
      display: flex;
    }
    .card {
      border-radius: 20px;
      margin: 50px;
      background-color: #717171;
      border: none;
    }
    .form-control {
      border-radius: 20px;
      background-color: #FFFFFF;
      border-color: #FFFFFF;
      margin-top: -10px;
    }
    .logo {
      animation: pulse 5s infinite;
      width: 120px;
      height: 120px;
      margin-bottom: -10px;
    }
    .login h3 {
      display: flex;
      justify-content: center;
      margin-bottom: -10px;
      color: #FFFFFF;
    }
    .btn {
      width: 100%;
      border-radius: 20px;
      color: #FFFFFF;
    }
    .card p {
      color: #FFFFFF;
      font-size: 12px;
      margin-bottom: -5px;
      margin-top: -2px;
    }
    }

  @keyframes pulse {
        0% {
        transform: scale(1);
        }
        50% {
        transform: scale(1.05);
        }
        100% {
       l     transform: scale(1);
    }
@media (min-width: 768px) {
      .card {
        border-radius: 20px;
        margin: 20px;
        background-color: #F6F6FE;
      }
    }
  </style>
</head>
<body>
  <div class="login">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="card">
            <div class="card-body">
              <center>
                <img class="logo" src="https://i.postimg.cc/9XxG38Q9/logo.png" alt="https://wa.me/message/NBN2FELCL2M5G1">
            <div class="card-body">
                <h3>Acesso Ao Painel</h3>
            </div>
              <form action="" method="POST">
                <input name="form_login" type="hidden" value="LOGIN">
                <div>
                  <div class="mb-3">
                    <input class="form-control" type="text" name="username" id="username" value="" placeholder="Usuário" required/>
                  </div>
                </div>
                <div>
                  <div class="mb-3">
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="Senha" required/>
                  </div>
                </div>
                <div>
                  <div class="mb-3">
                    <button class="btn btn-dark" name="submit" id="submit" type="submit">ENTRAR</button>
                  </div>
                  <hr>
                  <div class="">
                    <center>
                     <p>
                        Ainda não tem uma conta?<a href="https://wa.me/message/NBN2FELCL2M5G1"> Aperte aqui!</a>
                      </p>
                    </center>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>