<?
session_start();

function db_to_array()
{
    $db_name = "db.txt";

    $a = file($db_name);
    foreach ($a as $kk => $vv) {
        $c = explode(";", $vv);

        $d['l'] = $c[0];
        $d['p'] = $c[1];
        $d['f'] = $c[2];
        $d['i'] = $c[3];
        $d['e'] = $c[4];
        $d['age'] = $c[5];
        $b[] = $d;

    }
    return $b;
}

function db_store($l, $p, $f, $i, $e, $age)
{
    $db_name = "db.txt";
    $ff = fopen($db_name, "a+");
    $str = $l . ";" . $p . ";" . $f . ";" . $i . ";" . $e . ";" . $age . ";" . "\n";
    fwrite($ff, $str);
    fclose($ff);
}


function db_reg($b, $login)
{
    if ($b === null) {
        db_store($_POST['l'], $_POST['p'], $_POST['f'], $_POST['i'], $_POST['e'], $_POST['age']);
        $_SESSION["message"] = "Пользователь '$login' успешно зарегестрирован.";
        die();
    }
    foreach ($b as $kk => $vv) {
        $userName = $vv["l"];

        if ($userName === $login) {
            $_SESSION["message"] = "Пользователь '$login' уже существует.";
            $check = false;
            return $check;
        }
    }
    if ($check = true && $b !== null) {
        db_store($_POST['l'], $_POST['p'], $_POST['f'], $_POST['i'], $_POST['e'], $_POST['age']);
        $_SESSION["message"] = "Пользователь '$login' успешно зарегестрирован.";
    }
}


if ($_POST['tp'] == "register") {
    $b = db_to_array();
    $login = $_POST['l'];
    header("Location: " . $_SERVER["REQUEST_URI"]);
    db_reg($b, $login);
    exit();

}


function db_log($b, $login, $password)
{
    if ($b === null) {
        db_store($_POST['l'], $_POST['p'], $_POST['f'], $_POST['i'], $_POST['e'], $_POST['age']);
        echo "Пользователь '$login' не существует.";
        die();
    }
    $loggedUser = false;
    foreach ($b as $kk => $vv) {
        $userName = $vv["l"];
        $userPassword = $vv["p"];

        if ($userName === $login) {
            if ($userPassword === $password) {
                $_SESSION['login'] = $userName;
                $_SESSION['pass'] = $userPassword;
                $_SESSION["message"] = "Пользователь $userName успешно авторизован.";
                return $loggedUser;
            } else {
                $_SESSION["message"] = "Пользователь с этим логином/паролем не найден.";
                return $loggedUser;
            }
        }
    }
    return $loggedUser;
}

if ($_POST['tp'] == "login") {
    $b = db_to_array();
    $login = $_POST['l'];
    $password = $_POST['p'];
    header("Location: " . $_SERVER["REQUEST_URI"]);
    db_log($b, $login, $password);
    exit();

}

if ($_POST['tp'] == "exit") {
    unset($_SESSION['login']);
    unset($_SESSION['pass']);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $_SERVER["REQUEST_URI"]);
}