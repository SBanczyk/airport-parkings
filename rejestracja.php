<?php
    if($_POST['pwd'] != $_POST['r_pwd']) {
        echo "<script type='text/javascript'>alert('Hasła nie są identyczne!');</script>";
        echo "<script type='text/javascript'>window.location.href = 'rejestracja.html';</script>";
        exit();
    }
    else {
        $conn = new mysqli("localhost", "root", "", "parkingi");
        $sql = "select count(*) as 'ile' from uzytkownicy where email='$_POST[email]'";
        $query = $conn->query($sql);
        $result = $query->fetch_assoc();
        if($result['ile'] != 0) {
            echo "<script type='text/javascript'>alert('Użytkownik o podanym adresie e-mail już istnieje!');</script>";
            echo "<script type='text/javascript'>window.location.href = 'rejestracja.html';</script>";
            exit();
        }
        else {
            $password = base64_encode($_POST['pwd']);
            $sql = "insert into uzytkownicy(imie, nazwisko, email, haslo, nr_telefonu)
                    values('$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$password',
                    '$_POST[phone]')";
            $query = $conn->query($sql);
            if ($conn->affected_rows > 0) {
                header("Location: register_ok.html");
            }
            else {
                header("Location: register_bad.html");
            }
        }
    }