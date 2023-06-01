<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizállás</title>
</head>
<body>
    <h1>Vizállás bejelentő</h1>

    <h2>Add meg az adatokat</h2>

    <form action="" method="post">
        <h3>Minimum vizállás</h3> <input type="text" name="min" id="">
        <h3>Maximum vizállás</h3> <input type="text" name="max" id="">
        <br><br><input type="submit" value="Bevitel">

    </form>

    <?php
        if (!empty($_POST['min']) and !empty($_POST['max'])) {
            print("Adatbevitel rendben!");
            $min=$_POST['min'];
            $max=$_POST['max'];
            $kapcsolat = new mysqli("localhost", "root", "", "vizallas",);
            print($kapcsolat -> connect_errno);

            $resultadatbe=$kapcsolat -> query("INSERT INTO adatok (minimum, maximum) VALUES ('$min', '$max')");
            $resultkiir=$kapcsolat->query("SELECT* FROM adatok");
            $tabla=$resultkiir->fetch_all();

    ?>
            <table>
                <tr>
                    <th>Sorszám</th>
                    <th>Minimum vizállás</th>
                    <th>Maximum vizállás</th>
                </tr>
    <?php
            foreach ($tabla as $ertekek) {
                print("<tr>");
                foreach ($ertekek as $ertek) {
                    print("<td>");
                    print($ertek." ");
                    print("</td>");
                }
                print("</tr>");
            }
            print("</table>");
            print("<h2> Statisztika </h2>");
            $osszeg=0;
            foreach ($tabla as $ertekek) {
                $kul=$ertekek[2] - $ertekek[1];
                $osszeg=$osszeg + $kul;
            }
            print("átlag: ".($osszeg/mysqli_num_rows($resultkiir)));
        }else {
            print("Add meg helyesen az adatokat!");
        }

        
    ?>
</body>
</html>