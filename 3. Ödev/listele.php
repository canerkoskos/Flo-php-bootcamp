<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <table style="width:100%">
        <tr>
            <th style='text-align:left;'>Adı Soyadı</th>
            <th>Telefon Numarası</th>
            <th>İşlem</th>
        </tr>
        <?php 

        $baglan = new PDO("mysql:host=localhost;dbname=odev3;charset=utf8","root","");
        $baglan->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sorgu = $baglan->query("SELECT * FROM rehber", PDO::FETCH_ASSOC);
        foreach($sorgu as $row){

            echo "
                <tr>".
                    "<td>".$row['name']."</td>".
                    "<td style='text-align:center;'>".$row['phone']."</td>".
                    "<td style='text-align:center;'><a href='sil.php?silinecek=$row[id]'>Sil</a></td>
                </tr>
                         
            ";
        }
        echo "<tr>
                <td style='text-align:center;'colspan='3'> Sistemde Toplam -".$sorgu->rowCount()."- Kayıt Var.</td>
            </tr>";
        

        ?>
    </table>
    <br><br><br><button style="margin-left: 710px;background-color:powderblue"onclick="document.location='index.php'">Yeni Kayıt</button>
</body>
</html>
