<?php
    session_start();
    if($_SESSION['next'] < 2) {
        echo "Nie wykonałeś poprzedniego zadania.";
    } else {
        $_SESSION['cookieval'] = 2;
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misja trzecia</title>
    <link rel="stylesheet" href="misje.css">
</head>
<body>
    <div class="fade-in">
        Szkoła jest podłączona do systemu alarmowego. Aby wejść i podłączyć się do sieci lokalnej,
        musisz wpisać kod rozbrajający alarm. Cyfry składające się na kod alarmu są wynikiem
        zapytanie:
    </div>
    <div class="fade-in2">
        Policz średnią wypłaty pracowników z tabeli "pracownicy" o nazwisku zaczynającym się na "K" lub "P". Wynik zaokrąglij do liczby całkowitej.<br><br>
    </div>
    <form action="misja3.php" method="post">
        <textarea name="quest" required></textarea><br>
        <input type="submit" value="Wyślij"> 
    </form>';

    function sprobuj($qst) {
        if ($qst != 3) {
            throw new Exception("Lekka kraksa");
        }
    }
    
    $conn = mysqli_connect('localhost','root','','cukiernia');

    if(!$conn) {
        echo 'Wystąpił bląd podczas komunikacji z serwerem. Spróbuj ponownie później.';
    }

    @$quest = $_POST['quest'];

    try {
        if($quest) {
            $zapytanie = mysqli_query($conn,"$quest");
            if (!$zapytanie) {
                throw new Exception($zapytanie->error);
            } else {
                $qst = mysqli_fetch_array($zapytanie);
                sprobuj($qst[0]);
                echo 'Udało ci się! Przeszedłeś tę przeszkodę. Możesz przejść do następnego zadania.<br><br>';
                $_SESSION['next'] = 3;
                $_SESSION['cookieval'] = 3;
                echo '<a href="cookies.php">Dalej</a>';
            }
        }    
    }
    catch (Exception $error) {
        echo 'Wystąpił błąd, spróbuj ponownie';
    }

    mysqli_close($conn);
echo '</body>
</html>';
    }
?>