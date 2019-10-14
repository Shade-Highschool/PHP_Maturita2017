<?php
session_start();
require('pripojeniDB.php');
Db::connect('maturita_mysql_1', 'MaturitaDatabase', 'root', 'test123');

if (isset($_SESSION['id_uzivatele']))
{
        header('Location: Administrace.php');
        exit();
}

if ($_POST)
{
    if(!empty($_POST['username']))
    {
        $uzivatel = Db::queryOne('
                SELECT id
                FROM login_admin
                WHERE user_name=? AND user_pass=SHA1(?)
        ', $_POST['username'], $_POST['password']);
        if (!$uzivatel)
        { $zprava = 'Neplatné uživatelské jméno nebo heslo';}
        else
        {
                $_SESSION['id_uzivatele'] = $uzivatel['id'];
                $_SESSION['uzivatel_jmeno'] = $_POST['username'];
                header('Location: Administrace.php');
                exit();
        }
    }
 else
     {$zprava = 'Nezadali jste žádné údaje'; }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Tvarové pálení - administrace</title>
<link rel="shortcut icon" href="administrace.ico" />
<link rel="stylesheet" type="text/css" href="loginAdministrace.css">
</head>
<body>
 
  <div class="login">
      <h2 class="login-header">Administrace</h2>
  <form class="login-container" method="post">
    <p><input name="username" class="username" type="text" placeholder="Username"></p>
    <p><input name="password" class="password" type="password" placeholder="Password"></p>
    <p><input class="submit" type="submit" value="Log in"></p>
    <?php
      if (isset($zprava))
      { echo('<p style="color:red;text-align:center;">' . $zprava . '</p>');} ?>
  </form>
  </div>

</body>
</html>