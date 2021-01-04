# tikasu-harkka
Tampereen yliopiston Tietokantojen suunnittelu -kurssin harjoitustyö / syksy 2020

# Tehtävänanto
a) Tee tietokantaan tilit-relaatio: TILIT(tilinumero, omistaja, summa). Lisää tietokantaan
muutama tilin omistaja ja tilitiedot.

b) Tee tilinsiirtoa varten PHP-ohjelma, joka kysyy lomakkeen kautta
1. Siirrettävän summan,
2. Veloitettavan tilinumeron
3. Tilinumeron, jonne summa siirretään.

sekä tekee tilinsiirron tietokantaan. Tilinsiirto pitää määritellä tietokantatapahtumana. Jos
tilinsiirto epäonnistui, niin ohjelma antaa virheilmoituksen. Jos tilinsiirto onnistui, niin
ohjelma siirtyy toiselle sivulle ja antaa ilmoituksen: ”x on siirtänyt z euroa henkilölle y.” (x ja
y ovat tilien omistajia ja z on siirrettävä summa). Käytä tietojen siirtoon sessiomuuttujia.

# Käyttö
Lisää ensin sekä index.php- että tilit.php-tiedostoihin `$db`-muuttujaan tietokannan nimi, käyttäjätunnus sekä salasana. 
# Esimerkkitietokanta
| tilinumero | omistaja | summa |
| -- | -- | --|
| 1 | Testi A  | 99869 |
| 2 | Testi B  |   375 |
| 3 | Testi C  |     0 |
| 4 | Testi D  |     0 |

# TODO
En tiedä tuunko tätä ikinä tekemään eteenpäin, mutta jos joskus tulee inspiraatiota, niin:
- Tilien lisäys
- Ehkä joku nätimpi GUI? :D
- Suojaus tileihin?
