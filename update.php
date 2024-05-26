<?php
        session_start();
        $password = base64_encode($_POST['n_pwd']);
        $conn = new mysqli("localhost", "root", "", "parkingi");
        $sql = "update uzytkownicy set imie='$_POST[firstname]', nazwisko='$_POST[lastname]',
                email='$_POST[email]', haslo='$password'
                where id_uzytkownika=$_SESSION[user_id]";
        $conn->query($sql);
        echo $conn->affected_rows;
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['email'] = $_POST['email'];
        if($conn->affected_rows > 0) {
                echo "<script type='text/javascript'>alert('Zmieniono dane!');</script>";
                echo "<script type='text/javascript'>window.location.href = 'konto.php';</script>";
                exit();
        }
        else{
                echo "<script type='text/javascript'>alert('Podane dane są takie same jak dotychczas!');</script>";
                echo "<script type='text/javascript'>window.location.href = 'konto.php';</script>";
                exit();
        }
