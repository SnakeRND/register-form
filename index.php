<?
require_once("php/functions.php")
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Тестовая форма</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<div class="container">

<?
if (isset($_SESSION["message"])) {
    echo $_SESSION["message"];
    unset($_SESSION["message"]);
}

if (!isset($_SESSION['login']) && !isset($_SESSION['pass'])) {
echo '


    <header>
        <h1>Форма регистрации и входа</h1>
    </header>
        <section>
            <div id="container_demo" >
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form action="" autocomplete="on" method=POST>
                                <h1>Вход</h1>
                                <label for="log" class="uname" data-icon="u">
                                    Логин: <input id="log" type=text name=l placeholder="ваш логин" required>
                                </label>
                                <label for="pass" class="youpasswd" data-icon="p">
                                    Пароль: <input id="pass" type=password name=p placeholder="ваш пароль" required><br>
                                </label>
                                <label>
                                    <input type=hidden name=tp value="login">
                                </label>
                                <p class="login button">
                                <input type=submit value="Вход">
                                </p>
                                <p class="change_link">
                                    Не зарегистрированы еще ?
                                    <a href="#toregister" class="to_register">Регистрация</a>
                                </p>
                            </form>
                        </div>



                        <div id="register" class="animate form">
                            <form action="" autocomplete="on" method=POST>
                                <h1>Регистрация</h1>
                                <label for="l" class="uname" data-icon="u">
                                    Логин: <input id="l" type=text name=l placeholder="придумайте логин" required>
                                </label>
                                <label for="p" class="youpasswd" data-icon="p">
                                    Пароль: <input id="p" type=password name=p placeholder="придумайте пароль" required>
                                </label>
                                <label for="e" class="youmail" data-icon="e">
                                    Email: <input id="e" type=text name=e placeholder="введите email" required>
                                </label>
                                <label for="f">
                                    Фамилия: <input id="f" type=text name=f placeholder="введите свою фамилию" required>
                                </label>
                                <label for="i">
                                    Имя: <input id="i" type=text name=i placeholder="введите свое имя" required><br>
                                </label>
                                <label for="age">
                                    Возраст: <input id="age" type=number name=age placeholder="введите свой возраст" required>
                                </label>
                                <label for="salary">
                                    Зарплата: <input id="salary" type=number name=salary placeholder="придумайте свою зарплату" required>
                                </label>

                                <input type=hidden name=tp value="register">
                                <label for=""></label>
                                <p class="signin button">
                                <input type=submit value="Регистрация"><br>
                                </p>
                                <p class="change_link">
                                    Уже зарегистрированы ?
                                    <a href="#tologin" class="to_register">Вход</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

';
}
else
{
?>
            <div class="container">
                <?
                $b = db_to_array();
                $login = $_SESSION['login'];

                foreach ($b as $kk => $vv)
                {
                    $userName = $vv["l"];
                    if ($userName === $login)
                    {
                        if ($vv['age'] > 50)
                        {
                            echo "<br> Акция другая для всех старше 50 <br>";
                        }
                        if ($vv['age'] < 18)
                        {
                            echo "<br>Акция такая-то для всех моложе 18 <br>";
                        }
                        echo "<br>Профиль:<br><br>Логин: " . $vv['l'] . "<br>Пароль: " . $vv['p'] . "<br>Фамилия: " . $vv['f'] . "<br>Имя: " . $vv['i'] . "<br>Email: " . $vv['e'] . "<br>Возраст: " . $vv['age'] .  "<br>";

                    }
                }

            }
            ?>
        <br>
        <form action="" method=POST>
            <input type=hidden name=tp value="exit">
            <input type=submit value="Выход">
        </form>
    </div>
</body>
</html>