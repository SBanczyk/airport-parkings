<!DOCTYPE html>
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
        <?php
            session_start();
            if(!array_key_exists('logged', $_SESSION) || !$_SESSION['logged']) {
                echo "<script type='text/javascript'>alert('Musisz być zalogowany by dokonać rezerwacji!');</script>";
                echo "<script type='text/javascript'>window.location.href = 'konto.php';</script>";
                exit();
            }
        ?>
        <form method="POST" action="rezerwuj.php">
            <select name="city" required>
                <option value="" disabled selected>Miasto</option>
                <option value="1">Warszawa - Chopina</option>
                <option value="2">Warszawa - Modlin</option>
                <option value="3">Gdańsk</option>
                <option value="4">Katowice</option>
                <option value="5">Kraków</option>
                <option value="6">Poznań</option>
                <option value="7">Rzeszów</option>
                <option value="8">Wrocław</option>
            </select>
            <label for="departure">Data wylotu</label>
            <input type="date" name="departure" id="departure" placeholder="Data wylotu" required>
            <label for="arrival">Data przylotu</label>
            <input type="date" name="arrival" id="arrival" placeholder="Data przylotu" required>
            <input type="text" name="plate" placeholder="Numer rejestracyjny pojazdu" required>
            <input type="text" name="firstname" placeholder="Imię" required pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ]{1,50}" title="Pole może tylko zawierać litery">
            <input type="text" name="lastname" placeholder="Nazwisko" required pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ]{1,50}" title="Pole może tylko zawierać litery">
            <input type="text" name="email" placeholder="Adres e-mail" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Pole może tylko zawierać poprawny adres email" <?php echo "value='$_SESSION[email]'" ?>>
            <input type="text" name="phone" placeholder="Numer telefonu" pattern="\d{7,12}" title="Pole może tylko zawierać od 7 do 12 cyfr">
            <input type="text" name="nip" placeholder="(Opcjonalnie) NIP" pattern="[0-9]{10}">
            <input type="submit" value="Przejdź do podsumowania">
        </form>
    </main>
    <footer>
        <p>© Szymon Bańczyk</p>
    </footer>
    <script src="script.js">
    </script>
</body>
</html>
