<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "parkingi");
    $password = base64_encode($_POST['pwd']);
    $sql = "select * from uzytkownicy where email='$_POST[email]' and haslo='$password'";
    $query = $conn->query($sql);
    if($query->num_rows != 0) {
        $_SESSION['logged'] = TRUE;
        $result = $query->fetch_assoc();
        $_SESSION['user_id'] = $result['id_uzytkownika'];
        $_SESSION['firstname'] = $result['imie'];
        $_SESSION['lastname'] = $result['nazwisko'];
        $_SESSION['email'] = $result['email'];
        header("Location: index.html");
    }
    else {
        echo "<script type='text/javascript'>alert('Niepoprawny e-mail lub hasło!');</script>";
        echo "<script type='text/javascript'>window.location.href = 'konto.php';</script>";
        exit();
    }