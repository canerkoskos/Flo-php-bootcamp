<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    .button{
        text-align:center;
    }
</style>
</head>
<body>
    <form action="kaydet.php" method="post" style="text-align:center;">

        <h1>Adınız Soyadınız:</h1>
        <input type="text" name="name" size="40">
        <h1>Telefon Numaranız:</h1>
        <input type="text" name="phone" size="40">
        <br><br>
        <button style="background-color:powderblue" type="submit">Bilgileri Kaydet</button>
    </form>
    <br><br><br>
    <div class="button">
        <button onclick="document.location='listele.php'">Kayıtları Listele</button>   
    </div>
    
</body>
</html>