<?php

?>
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

