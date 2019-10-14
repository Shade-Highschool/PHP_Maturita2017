<?php
session_start();
if (!isset($_SESSION['id_uzivatele']))
{
        header('Location: loginAdministrace.php');
        exit();
}

if (isset($_GET['odhlasit']))
{
        session_destroy();
        header('Location: ../index.php');
        exit();
}
?>
<?php
require('pripojeniDB.php');
Db::connect('maturita_mysql_1', 'MaturitaDatabase', 'root', 'test123');

$clanek = array(
        'clanky_id' => '',
        'nadpis' => '',
        'datum' => '',
        'obsah' => '',
);

if(empty($clanek['datum']))
    {$clanek['datum'] = date("Y-m-d");}
    
if ($_POST)
{
        if (!$_POST['clanky_id'])
        {
                Db::query('
                        INSERT INTO clanky (nadpis, datum, obsah)
                        VALUES (?, ?, ?)
                ', $_POST['nadpis'], $_POST['datum'], $_POST['obsah']);
                header("Refresh:0");
        }
        else
        {
                Db::query('
                        UPDATE clanky
                        SET nadpis=?, datum=?, obsah=?
                        WHERE clanky_id=?
                ', $_POST['nadpis'], $_POST['datum'], $_POST['obsah'], $_POST['clanky_id']);
                header("Location: Administrace.php");
        }
    exit();
}
        
else if (isset($_GET['clanekID']))
{
    $querry = Db::queryOne('
             SELECT * FROM clanky
             WHERE clanky_id=?'
            ,$_GET['clanekID']);
    $clanek = $querry;
}
else if (isset($_GET['smazat']))
{
             Db::query('
             DELETE FROM clanky
             where clanky_id=?'
            ,$_GET['smazat']);
             header("Location: Administrace.php");
}
else if (isset($_GET['smazatKoment']))
{
             Db::query('
             DELETE FROM guestbook
             where ID=?'
            ,$_GET['smazatKoment']);
             header("Location: Administrace.php");
}
$clanky = Db::queryAll('
        SELECT *
        FROM clanky ORDER BY clanky_id DESC'
        );
$komenty = Db::queryAll('
        SELECT *
        FROM guestbook ORDER BY ID DESC'
        );
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Tvarové pálení - administrace</title>
<link rel="shortcut icon" href="administrace.ico" />
<link rel="stylesheet" type="text/css" href="administrace.css">
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <nav id="menu">
    <div class="logo">
    <a href="../index.html">
    <img src="../images/logo-vektor.gif"></a>
    </div>
    <div class="menu-items">
      <ul>
        <li class="clanky active"><a href="#">Editace článků</a></li>
        <li class="kniha"><a href="#">Návštěvní kniha</a></li>
        <li class="logout"><a href="Administrace.php?odhlasit">Log out</a></li>
      </ul>
    </div>
  </nav>
    
    <main>
        <div class="clanky active">
             <form method="post">
                 <div style='width: 100%;background:#cc3333;'>
                 <input type="hidden" name="clanky_id" value="<?= htmlspecialchars($clanek['clanky_id']) ?>">
                 <p style='color:white;padding:10px;'>Nadpis</p>
                 <input style="padding:10px" required='required' type="text" name="nadpis" value="<?= htmlspecialchars($clanek['nadpis']) ?>" />
                 <input style="float:right;padding:10px;" required='required' class="datum" type="text" name="datum" value="<?= htmlspecialchars($clanek['datum']) ?>" />
                 <p style='color:white;padding:10px;float:right' class="datum">Datum</p>
                 </div>
                  <textarea class="obsah" name="obsah"><?= htmlspecialchars($clanek['obsah']) ?></textarea>
                  <input class="submit" type="submit" value="Odeslat" />
             </form>
            <div class="seznamClanku">
                <?php 
                foreach($clanky as $clanek)
                {
                    echo('<table><tr>');
                    echo('<td><h2 style="margin:0px;color:#cc3333">' . htmlspecialchars($clanek['nadpis']) . '</h2>'
                            . '<p style="margin:0px;color:white;font-style:italic;">' . htmlspecialchars($clanek['datum']) . '</p></td>'
                            .'<td align="right" height="50px" width="50px"><a href="Administrace.php?clanekID='. $clanek['clanky_id'].'">'
                            . '<img src="../images/ikony/edit.png" height="100%" width="100%"></a></td>'
                            . '<td align="right" height="50px" width="50px"><a href="Administrace.php?smazat=' . $clanek['clanky_id'].'">'
                            . '<img src="../images/ikony/delete.ico" height="100%" width="100%"></a></td>');
                    echo ('</tr><tr>');
                   // echo('<td><p style="margin:0px;color:white;">Vydáno dne: ' . $clanek['datum'] . '</p></td>');
                    echo ('</tr><tr>');
                    echo ('<td>' . $clanek['obsah'] . '</td>');
                    echo ('</tr></table>');  
                }
                 ?>
            </div>
        </div>
        <div class="kniha">
            <div class='komenty'>
          <?php
                foreach($komenty as $koment)
                {
                    echo('<table><tr style="background:#333333">');
                    echo('<td><h2 style="margin:0px;">' . htmlspecialchars($koment['name']) . '</h2>'
                            . '<p style="margin:0px;color:white;font-style:italic;">' . htmlspecialchars($koment['email']) . '</p></td>'
                            . '<td align="right"><p>' . htmlspecialchars($koment['ip_address']) . '</p></td>'
                            . '<td align="right" height="50px" width="50px"><a href="Administrace.php?smazatKoment=' . $koment['ID'].'">'
                            . '<img src="../images/ikony/delete.ico" height="100%" width="100%"></a></td>');
                    echo ('</tr><tr>');
                   // echo('<td><p style="margin:0px;color:white;">Vydáno dne: ' . $clanek['datum'] . '</p></td>');
                    echo ('<td>' . htmlspecialchars($koment['content']) . '</td>');
                    echo ('</tr></table>');  
                }
                 ?>
            </div>
        </div>
    </main>
    
<script>
        $('.menu-items li').click(function(){
        var myClass = $(this).attr("class");
        $('.' + myClass).addClass('active').siblings().removeClass('active'); //Nastaví active classe na kterou je kliknuto
    });
 </script>
 
  <script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script type="text/javascript">
                tinymce.init({
                        height:"500px",
                        selector: "textarea[name=obsah]",
                        plugins: [
                                "advlist autolink lists link image charmap print preview anchor",
                                "searchreplace visualblocks fullscreen",
                                "insertdatetime media table contextmenu paste"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                        entities: "160,nbsp",
                        entity_encoding: "named",
                        entity_encoding: "raw"
                });
        </script>
</body>
</html>
