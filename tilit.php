<?php
$db = "dbname=[DBNAME] user=[USER] password=[PASSWORD]";

if (!$connection = pg_connect($db))
    die("Yhteyttä ei voitu muodostaa.");

$tilit = pg_fetch_all(pg_query("SELECT * FROM tilit ORDER BY tilinumero"));
pg_close($connection);
?>

<html>
<head>
    <title>Vähä peehoopeetä vähä</title>
</head>
<body>
    <?php if (isset($tilit)) {
        echo '<table>
        <tr>
         <th>Tilinumero</th>
         <th>Omistaja</th>
         <th>Summa</th>
        </tr>';
        foreach($tilit as $array) {
            echo '<tr>
            <td>' . $array['tilinumero'] . '</td>
            <td>' . $array['omistaja'] . '</td>
            <td>' . $array['summa'] . '</td>
            </tr>';
        }
        echo '</tr>';
    }?>
</body>
</html>