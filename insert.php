<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "parkingi");
    $plate = preg_replace('/\s+/', '', $_POST['plate']);
    if ($_POST['nip'] == "") {
        $sql = "INSERT INTO `rezerwacje` (`parking`, `data_rezerwacji`, `data_wylotu`, `data_przylotu`,
        `nr_rejestracyjny`, `imie`, `nazwisko`, `email`, `nr_telefonu`, `nip`, `koszt`, `id_uzytkownika`)
        VALUES ($_POST[city], NOW(), '$_POST[departure]', '$_POST[arrival]',
        '$plate', '$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$_POST[phone]', NULL, $_POST[price],
        $_SESSION[user_id])";
    } else {
        $sql = "INSERT INTO `rezerwacje` (`parking`, `data_rezerwacji`, `data_wylotu`, `data_przylotu`,
        `nr_rejestracyjny`, `imie`, `nazwisko`, `email`, `nr_telefonu`, `nip`, `koszt`, `id_uzytkownika`)
        VALUES ($_POST[city], NOW(), '$_POST[departure]', '$_POST[arrival]',
        '$plate', '$_POST[firstname]', '$_POST[lastname]', '$_POST[email]', '$_POST[phone]', '$_POST[nip]', $_POST[price],
        $_SESSION[user_id])";
    }
    $query = $conn->query($sql);
    if ($conn->affected_rows > 0) {
        header("Location: insert_ok.html");
    }
    else {
        header("Location: insert_bad.html");
    }