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
            if(array_key_exists('logged', $_SESSION) && $_SESSION['logged']) {
                echo '<form action="update.php" method="POST">
                    <input type="text" name="firstname" placeholder="Imię" pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ]{1,50}" title="Pole może tylko zawierać litery" value='.$_SESSION['firstname'].'>
                    <input type="text" name="lastname" placeholder="Nazwisko" pattern="[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ]{1,50}" title="Pole może tylko zawierać litery" value='.$_SESSION['lastname'].'>
                    <input type="text" name="email" placeholder="Adres e-mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Pole może tylko zawierać poprawny adres email" value='.$_SESSION['email'].'>
                    <input type="password" name="n_pwd" placeholder="Nowe hasło">
                    <input type="submit" value="Zmień dane">
                    <a href="wylogowanie.php"><p>Wyloguj się</p></a>
                </form>';
            }
            else {
                echo '<form action="logowanie.php" method="POST">
                <input type="text" name="email" placeholder="E-mail" required>
                <input type="password" name="pwd" placeholder="Hasło" required>
                <input type="submit" value="Zaloguj się">
                <p>Jeśli nie masz konta <a href="rejestracja.html" style="color:#007bff;">zarejestruj się</a>.</p>
                </form>';
            }
        ?>
    </main>
    <footer>
        <p>© Szymon Bańczyk</p>
    </footer>
</body>
</html>
