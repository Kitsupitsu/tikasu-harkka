<?php
$db = "dbname=[DBNAME] user=[USER] password=[PASSWORD]";

/*
* Tekijä: Kiti Suupohja
* Kuvaus: Tämä tehtävä on toteutettu tikasu-kurssille pakollisena PHP-tehtävänä.
* Ohjelman tarkoituksena on siirtää rahaa tililtä toiselle ja päivittää rahatilanne possutietokantaan.
* Esimerkkiohjelma pyörii osoitteessa http://tie-tkannat.it.tuni.fi/~mgkisu/
* Esimerkkitietokannassa on neljä tiliä, joiden numerot ovat 1, 2, 3 ja 4.
* Tilien tilanteen voi tsekata osoitteesta http://tie-tkannat.it.tuni.fi/~mgkisu/tilit.php
*/

if (!$connection = pg_connect($db))
    die("Yhteyttä ei voitu muodostaa.");

if (isset($_POST['save'])) {
    $tililta = intval($_POST['tililta']);
    $tilille = intval($_POST['tilille']);
    $summa = intval($_POST['summa']);

    $table = 'tilit';

    pg_query('BEGIN')
        or die('Ei onnistuttu aloittamaan tapahtumaa:' . pg_last_error());

    $tulos = pg_query('UPDATE ' . $table . ' SET summa = summa - ' . $summa . ' WHERE tilinumero = ' . $tililta . 
                    ' AND summa >= ' . $summa)
        or die('Virhe ensimmäisessä päivityksessä: ' . pg_last_error());
    
    if (pg_affected_rows($tulos) != 1) {
        pg_query('ROLLBACK')
            or die('Ei onnistuttu perumaan tapahtumaa: ' . pg_last_error());
        $errormsg = 'Lähdetilin tilinumero on väärä tai saldoa ei ole tarpeeksi.';
    } else {
        $tulos2 = pg_query('UPDATE ' . $table . ' SET summa = summa + ' . $summa . ' WHERE tilinumero = ' . $tilille)
            or die('Virhe toisessa päivityksessä: ' . pg_last_error());
        if (pg_affected_rows($tulos2) != 1) {
        pg_query('ROLLBACK')
            or die('Ei onnistuttu perumaan tapahtumaa: ' . pg_last_error());
        $errormsg = 'Kohdetilin tilinumero on väärä.';
        } else {
            $from = pg_fetch_row(pg_query('SELECT omistaja FROM ' . $table . ' WHERE tilinumero = ' . $tililta))[0];
            $kohde = pg_fetch_row(pg_query('SELECT omistaja FROM ' . $table . ' WHERE tilinumero = ' . $tilille))[0];
            $success = $from . " on siirtänyt " . $summa . " euroa henkilölle " . $kohde; 
        }
    }
    pg_query('COMMIT')
        or die('Ei onnistuttu hyväksymään tapahtumaa: ' . pg_last_error());
}

pg_close($connection);
?>

<html>
<head>
    <title>Vähä peehoopeetä vähä</title>
</head>
<body>
    <?php if (isset($errormsg)) {echo '<p style="color:red">'.$errormsg.'</p>';} 
    else if (isset($success)) {echo '<p style="color:green">'.$success.'</p>';} ?>
    <a href="./tilit.php">Tsekkaa tilien saldo täältä</a>
    <td>
    <form action="" method="post">
        <tr>
        <p>Tililtä</p>
        <input type="number" name="tililta" value=""/>
        </tr>
        <tr>
        <p>Tilille</p>
        <input type="number" name="tilille" value=""/>
        </tr>
        <tr>
        <p>Summa</p>
        <input type="number" name="summa" value=""/>
        </tr>
        <tr>
        <input type="submit" name="save" value="Suorita tilisiirto" />
        </tr>
    </td>
    
</body>
</html>