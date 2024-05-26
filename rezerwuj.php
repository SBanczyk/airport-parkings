<?php
    $departure = strtotime($_POST['departure']);
    $arrival = strtotime($_POST['arrival']);
    $datediff = ($arrival - $departure)/86400;
    $price = 0;
    switch($datediff)
    {
        case 0:
            $price = 55;
            break;
        case 1:
            $price = 55;
            break;
        case 2:
            $price = 60;
            break;
        case 3:
            $price = 65;
            break;
        case 4:
            $price = 70;
            break;
        case 5:
            $price = 75;
            break;
        case 6:
            $price = 80;
            break;
        case 7:
            $price = 90;
            break;
        case 8:
            $price = 100;
            break;
        case 9:
            $price = 110;
            break;
        case 10:
            $price = 120;
            break;
        case 11:
            $price = 130;
            break;
        case 12:
            $price = 140;
            break;
        case 13:
            $price = 150;
            break;
        case 14:
            $price = 160;
            break;
    }
    $conn = new mysqli("localhost", "root", "", "parkingi");
    $sql =
    "select
    case
        when (select count(*) from rezerwacje where data_wylotu >= '$_POST[departure]' and data_przylotu <= '$_POST[arrival]' and parking=$_POST[city])
        >=
        (select pojemnosc from parkingi where id_parkingu = $_POST[city]) then false
        else true
    end as aval";
    $query = $conn->query($sql);
    $result = $query->fetch_assoc();
    $aval = $result['aval'];
    if($aval == 1){
        $availability = "Parking dostępny w wybranym terminie";
        $inert = true;
    }
    else {
        $availability = "Parking niedostępny w wybranym terminie";
        $insert = false;
    }

    if($_POST['city'] == 1) {
        $city = "Warszawa - Chopina";
    }
    else if($_POST['city'] == 2) {
        $city = "Warszawa - Modlin";
    }
    else {
        $sql = "select miasto
        from parkingi
        where id_parkingu = $_POST[city]";
        $query = $conn->query($sql);
        $result = $query->fetch_assoc();
        $city = $result['miasto'];
    }
    $plate = preg_replace('/\s+/', '', $_POST['plate']);
    echo '<!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Parking Fliger</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="title-container">
                    <a href="index.html">Parking Fliger</a>
                </div>
                <div class="logo-container">
                    <a href="index.html">
                        <img src="media/logo.png" alt="Parking Fliger" width="100" height="100" style="margin: 0px; padding: 0px;">
                    </a>
                </div>
                <ul class="menu">
                    <li><a href="parkingi.html">Parkingi</a></li>
                    <li><a href="cennik.html">Cennik</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>
                    <li><a href="kontakt.html">Kontakt</a></li>
                    <li><a href="konto.php">Konto</a></li>
                </ul>
            </nav>
        </header>    
        <main>
            <h1>Sprawdź poprawność danych przed dokonaniem rezerwacji</h1>
            <form method="POST" action="insert.php">
                <input type="text" name="cityname" value="'.$city.'" required readonly>
                <label for="departure">Data wylotu</label>
                <input type="date" name="departure" id="departure" placeholder="Data wylotu" required value='.$_POST['departure'].' readonly>
                <label for="arrival">Data przylotu</label>
                <input type="date" name="arrival" id="arrival" placeholder="Data przylotu" required value='.$_POST['arrival'].' readonly>
                <input type="text" name="plate" placeholder="Numer rejestracyjny pojazdu" required value="'.$plate.'" readonly>
                <input type="text" name="firstname" placeholder="Imię" required pattern="[A-Za-z]{1,50}" title="Pole może tylko zawierać litery" value="'.$_POST['firstname'].'" readonly>
                <input type="text" name="lastname" placeholder="Nazwisko" required pattern="[A-Za-z]{1,50}" title="Pole może tylko zawierać litery" value="'.$_POST['lastname'].'" readonly>
                <input type="text" name="email" placeholder="Adres e-mail" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Pole może tylko zawierać poprawny adres email" value='.$_POST['email'].' readonly>
                <input type="text" name="phone" placeholder="Numer telefonu" pattern="\d{7,12}" title="Pole może tylko zawierać od 7 do 12 cyfr" value='.$_POST['phone'].' readonly>
                <input type="text" name="nip" placeholder="(Opcjonalnie) NIP" pattern="[0-9]{10}" readonly value='.$_POST['nip'].'>
                <p style="font-size:24px;">Cena brutto: '.$price.' zł</p><br>
                <p style="font-size:24px;">Cena netto: '.round($price/1.23, 2).' zł</p><br>
                <input type="text" hidden name="city" value='.$_POST['city'].'>
                <input type="text" hidden name="price" value='.$price.'>
                <p>Klikając przycisk "Dokonaj rezerwacji" akceptujesz <a style="color: #007bff;" href="media/regulamin.pdf" target=_blank>regulamin parkingu</a>.</p>
                <p id="availability">'.$availability.'</p><br>';
                if ($aval == 1) {
                    echo '<input type="submit" value="Dokonaj rezerwacji">';
                }
            echo '</form>
        </main>
        <footer>
            <p>© Szymon Bańczyk</p>
        </footer>
        <script src="script.js">
        </script>
    </body>
    </html>';
