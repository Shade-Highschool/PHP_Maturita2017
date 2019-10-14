<?php
if(!isset($_COOKIE['stylesheet']) || ($_COOKIE['stylesheet'] !== "style.css" && $_COOKIE['stylesheet'] !=="mobile.css")) //Pokud je prázdnej, nastav defaultní
{
    setcookie("stylesheet", "style.css", time() + (86400 * 7), "/"); // 86400 = 1 day
    $_COOKIE['stylesheet'] = "style.css";
}
if(isset($_GET['stylesheet']))
{
    setcookie("stylesheet", $_GET['stylesheet'], time() + (86400 * 7), "/"); // 86400 = 1 day
    header("Location:index.php");
}
?>
<?php
require('administrace/pripojeniDB.php');
Db::connect('maturita_mysql_1', 'MaturitaDatabase', 'root', 'test123');
$clanky = Db::queryAll('
        SELECT *
        FROM clanky ORDER BY clanky_id DESC'
        );
$komenty = Db::queryAll('
        SELECT *
        FROM guestbook ORDER BY ID DESC'
        );

if ($_POST)
{
        if (isset($_POST['robot']))
        {
            if (!empty($_POST['obsah']))
            {
                Db::query('
                        INSERT INTO guestbook (name, email, content,ip_address)
                        VALUES (?, ?, ?, ?)
                ', $_POST['name'], $_POST['email'], $_POST['obsah'], $_SERVER['REMOTE_ADDR']);
                header("Refresh:0");
            }
            else
            {
                $zprava = 'Nezadal jste žádnou zprávu';
            }
        }
        else
        {
                $zprava = 'Zaškrtněte políčko "nejsem robot"';
        }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow, snippet, archive" />
<meta name="author" content="Tomáš Vondra" />
<meta name="copyright" content="2013 &copy; Tvarové pálení, s.r.o.," />
<meta name="description" content="Tvarové dělení materiálu plamenem od 8 do 110 mm" />
<meta name="keywords" content="dělení,pálení,plazma,acetylen,řezání,výpalek,tryskání,tvarové" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Tvarové pálení</title>
<link rel="shortcut icon" href="logo-vektor.ico" />
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo(htmlspecialchars($_COOKIE['stylesheet'])) ?>">

</head>
<body>

<div id="wrapper">

  <nav id="menu">
    <div class="logo">
    <img src="images/logo-vektor.gif">
    </div>
<div class="administration">
      <a href="administrace/loginAdministrace.php"></a>
    </div>
    <div class="menu-items">
      <ul>
        <li class="home active"><a href="?home">Novinky</a></li>
        <li class="onas"><a href="?onas">O nás</a></li>
        <li class="technologie"><a href="?technologie">Technologie a výroba</a></li>
        <li class="kniha"><a href="?kniha">Návštěvní kniha</a></li>
        <li class="kontakt"><a href="?kontakt">Kontakt</a></li>
      </ul>
    </div>
  </nav>

  <main>

  <div class="content home active">
     <div class="seznamClanku">
                <?php
                foreach($clanky as $clanek)
                {
                    echo('<table><tr style="background:#333333">');
                    echo('<td><h2 style="margin:0px;">' . htmlspecialchars($clanek['nadpis']) . '</h2>'
                            . '<p style="margin:0px;color:white;font-style:italic;">' . htmlspecialchars($clanek['datum']) . '</p></td>');
                    echo ('</tr><tr>');
                   // echo('<td><p style="margin:0px;color:white;">Vydáno dne: ' . $clanek['datum'] . '</p></td>');
                    echo ('<td>' . $clanek['obsah'] . '</td>');
                    echo ('</tr></table>');  
                }
                 ?>
            </div>
  </div>

  <div class="content onas">
    <div class="wrap">
    <div class="tvarpaleni">
          <img src="images/logo-vektor.gif" width="300" height="200px" alt="Výroba" />
              <h1 style="margin: 0px">Tvarové pálení,s.r.o.</h1>
        <p style="margin: 0px;">Společnost Tvarové pálení s.r.o. byla založena 24. září 2002 a je vedená u Krajského soudu v Hradci Králové oddíl C, vložka 18249.<br> Po více než deseti letech na trhu je odborníkem v oblasti zpracování plechů&nbsp;o&nbsp;síle&nbsp;8&ndash;150&nbsp;mm.<br> Realizace zakázek na nových přesných NC palicích strojích. Pracovní rozměry strojů 1500&nbsp;&times;&nbsp;3000&nbsp;mm.<br> Možnost tryskání, rovnání, žíhání, svařování, obrábění výpalků, zámečnické práce.<br />V&nbsp;kooperaci zajistíme další potřebné operace po&nbsp;pálení.</p>
          </div>
          <hr>
      <div class="priprava">
            <img src="images/priprava.jpg" width="168" height="156" alt="Příprava výroby" />
        <h1>Příprava výroby</h1>
          <ul>
            <li>konzultace</li>
                        <li>bezplatné vytvoření programu</li>
            <li>program z vašeho dfx souboru</li>
                        <li>vzorky před začátkem sériové výroby</li>
          </ul>
          </div>
        <div class="vyroba">
            <img src="images/vyroba.jpg" width="168" height="156" alt="Výroba" />
        <h1>Výroba</h1>
          <ul>
            <li>přesné NC stroje vlastní výroby</li>
                        <li>pracovní rozměry strojů 1500 × 3000 mm</li>
                        <li>síla výpalků 0,2–300 mm</li>
                        <li>kombinace Acetylén – Plazma</li>
                        <li>tryskání</li>
                        <li>rovnání výpalků</li>
          </ul>
          </div>
        <div class="kvalita">
            <img src="images/kontrola.jpg" width="240" height="156" alt="Příprava výroby" />
        <h1>Kvalita</h1>
          <ul>
            <li>Certifikace dle ČSN EN ISO 9001:2009<br>
              <a href=http://www.certipedia.com/quality%5Fmarks/9105086988?locale%3Den>
              <img src=http://www.certipedia.com/quality%5Fmarks/9105086988/logo?locale%3Den></a>
            </li>
            <li>výrobky splňují požadavky ČSN ISO 9013</li>
                        <li>uvolnění dávky prvním kusem</li>
                        <li>statistická kontrola výpalků</li>
                        </ul>
          </div>
          
  </div>
  </div>

  <div class="content technologie">
    <div class="wrap">
          <div class="images">
          <br />
            <img style="margin-top:61px;" src="images/rezani.jpg" width="80%" height="200px" alt="Řezání plamenem" /><br /><br /><br />
                <img src="images/piskovani.jpg" width="80%" height="200px" alt="Tryskací kabina ITB v tlakovém provedení" /><br /><br /><br />
                <img src="images/dokonceni.jpg" width="80%" height="200px" alt="Výsledný produkt" /><br /><br /><br />
            </div>
       
        <div class="postup">
         <h1>Technologie a výroba</h1><br>
          <div class="postup01">
              <h2><span style="color:white;">01 | </span>Příprava výroby</h2>
        <span>Každá produkce začíná pečlivou přípravou, konzultacemi s klientem, technickou podporou a zajištěním potřebného materiálu. </span>             
          <ul>
            <li>konzultace</li>
                        <li>bezplatné vytvoření programu</li>
                        <li>program z vašeho dfx souboru</li>
                        <li>vzorky před začátkem sériové výroby</li>
          </ul>
            </div>
          <div class="postup02">
              <h2><span style="color:white;">02 | </span>Pálení</h2>
        <span>Vlastní výrobě věnujeme mimořádnou pozornost s důrazem na kvalitu a přesnost výpalku, kteréjsou zajištěny naším technologickým vybavením.</span>               
          <ul>
            <li>přesné NC stroje vlastní výroby</li>
            <li>pracovní rozměry strojů 1500 × 3000 mm</li>
            <li>síla výpalků 8 - 300 mm</li>
            <li>Médium Acetylen</li>
            <li>moderní strojní Acetylénový hořák BIR+</li>
          </ul>
          </div>
          <div class="postup03">
              <h2><span style="color:white;">03 | </span>Dokončování</h2>
        <span>K našim produktům nabízíme in-house dokončovací zpracování včetně označení výrobku tryskáním.</span>              
          <ul>
            <li>hrotování</li>
                        <li>tryskání  – tryskací kabina ITB<ul style="margin-left:51px;">
                        <li >   v tlakovém provedení</li>
                        <li >– pracovní rozměry 1200 × 1000 mm</li>
                        <li >– adapter pro tryskání tyčového materiálu</li>
            </ul></li>
                        <li >rovnání  – 2ks hydraulických lisů 45t</li>
          </ul>
           </div>
        <div class="postup04">
        <h2><span style="color:white;">04 | </span>Kontrola</h2>
        <span >Kontrola produkce je pro nás velmi důležitým článkem celého procesu výroby.</span>             
          <ul>
            <li>Certifikace ČSN EN ISO 9001:2009</li>
            <li>výrobky splňují požadavky ČSN ISO 9013</li>
                        <li>uvolnění dávky prvním kusem</li>
                        <li>statistická kontrola výpalků</li>
                        <li><a href="images/politika_kvality.jpg" style="cursor:pointer;pointer-events: auto; color:#cc3333;background-color: black;">Politika kvality</a></li>
          </ul>
          </div> 
      </div>
  </div>
  </div>

  <div class="content kniha">
    
      <form id="guestBookForm" method="post">
         <?php echo ('<h3 style="text-align:center;color:red">' . $zprava . '</h3>'); ?>
          <h3>
			Jméno:<input required="required" type="text" name="name" placeholder="Name"><br>
			Email: <input type="email" name="email" placeholder="Email adress">
          </h3>
			<textarea class="obsah" name="obsah" style="width:100%;height:100px;"></textarea>
                        
			<input class="submit" type="submit" name="submit" value="Pošli">
                        <div style="float:right;margin-right:20px;margin-top:24px;">
                        <input style="height:auto;width:auto;" type="checkbox" name="robot" value="robot">
                        Nejsem robot
                        </div>
		 </form>
      
      <div class='komenty'>
          <?php
                foreach($komenty as $koment)
                {
                    echo('<table><tr style="background:#333333">');
                    echo('<td><h2 style="margin:0px;">' . htmlspecialchars($koment['name']) . '</h2>'
                            . '<p style="margin:0px;color:white;font-style:italic;">' . htmlspecialchars($koment['email']) . '</p></td>');
                    echo ('</tr><tr>');
                   // echo('<td><p style="margin:0px;color:white;">Vydáno dne: ' . $clanek['datum'] . '</p></td>');
                    echo ('<td><p>' . htmlspecialchars($koment['content']) . '</p></td>');
                    echo ('</tr></table>');  
                }
                 ?>
            </div>
      </div>
      <div class="content kontakt">
  <div class="wrap">

  <div class="kontakty">
          <h1 style="color:#cc3333"><b>Kontaktní osoby</b></h1>
          <div class="kontakt1">
                <p style="color:#999999"><span style="font-weight: 900">Zdeněk Kratochvíl – jednatel společnosti</span></p>
                <hr>
                <p style="color:#999999">mobil: +420 607 190 960<br />
                e-mail: zdenek.kratochvil@tvarovepaleni.cz</p>
          </div>
        <div class="kontakt2">
                <p style="color:#999999"><span style="font-weight: 900">Ivan Birošík – jednatel společnosti</span></p>
                <hr>
                <p style="color:#999999">mobil: +420 603 317 594<br />e-mail: ivan.birosik@tvarovepaleni.cz</p>
          </div>
        </div>
    <div class="lokace">
    <div class="popisny">
              <h2 style="color:#cc3333;">Tvarové pálení, s.r.o</h2>
        <p>U Vápenky 513, 538 43  Třemošnice <br />IČ: 25974106, DIČ: 234-25974106<br />Zapsáno Krajským soudem v Hradci Králové oddíl C, vložka 18249</p>
</div>
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2571.266911017358!2d15.567670315560562!3d49.87501397940016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470c4c80ac3f271b%3A0x9db0458cf3532dee!2zVHZhcm92w6kgUMOhbGVuw60gcy5yLm8u!5e0!3m2!1scs!2scz!4v1488067325927" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
         
  </div>
  </div>
  </main>

  <footer>
  <div class="monitor <?php echo(($_COOKIE['stylesheet'] == "style.css" ? "active" : ""))?>">
  <a href="index.php?stylesheet=style.css"><img src="<?php echo(($_COOKIE['stylesheet'] == "style.css" ? "images/ikony/monitor_vybrany.gif" : "images/ikony/monitor.gif"))?>"></a>
  </div>
  <div class="mobile <?php echo(($_COOKIE['stylesheet'] == "mobile.css" ? "active" : ""))?>">
  <a href="index.php?stylesheet=mobile.css"><img src="<?php echo(($_COOKIE['stylesheet'] == "mobile.css" ? "images/ikony/mobil_vybrany.gif" : "images/ikony/mobil.gif"))?>"></a>
  </div>

  <div class="middleFooter">
  <p>Copyright 2017 © Tvarové pálení, s.r.o. | Designed by <a href="mailto:tomas.mail.vondra@seznam.cz" style="color:#cc3333;">Tomáš Vondra</a></p>
  </div>
  <div class="facebook">
  <a href="#"><img src="images/ikony/fb.gif" ></a>
  </div>
  </footer>
</div>
<script type="text/javascript">
$(document).ready(function () {
    if(window.location.href.indexOf("novinky") > -1) {
        $('.novinky').addClass('active').siblings().removeClass('active');
    }
    if(window.location.href.indexOf("onas") > -1) {
        $('.onas').addClass('active').siblings().removeClass('active');
    }
    if(window.location.href.indexOf("technologie") > -1) {
     
        $('.technologie').addClass('active').siblings().removeClass('active');
    }
    if(window.location.href.indexOf("kniha") > -1) {

        $('.kniha').addClass('active').siblings().removeClass('active');
    }
    if(window.location.href.indexOf("kontakt") > -1) {
        $('.kontakt').addClass('active').siblings().removeClass('active');
    }
});
</script>
  </body>

</html>
