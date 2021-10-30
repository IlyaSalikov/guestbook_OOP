<form method="post" action="index.php?page=2">
    <label for="login">Логин: </label>
    <input id="login" type="text" name="login">
    <br>
    <label for="password">Пароль: </label>
    <input id="password" type="password" name="password">
    <button type="submit" name="btn-login">
        Авторизоваться
    </button>
</form>

<?php
    

    if( isset($_POST['login']) && isset($_POST['password']))
    {
        $password_hash = md5($_POST['password']);
        
        $connection = mysqli_connect("localhost", "root", "", "guestbook");
        $query = "SELECT * FROM `user` WHERE `login` LIKE '".$_POST['login']."' AND `password_hash` LIKE '".$password_hash."'";
        $result = mysqli_query($connection, $query);
        
        if( $row = mysqli_fetch_assoc($result) )
        {
            echo "Добро пожаловать, ".$row["surname"]." ".$row["name"]."!<br>";
            $_SESSION['login'] = $_POST['login'];
        }
        else {
            echo "Неверно указан логин или пароль пользователя!";
        }
    }


?>