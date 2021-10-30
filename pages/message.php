<?php
    if(!isset($_SESSION['login']))
    {
        $hidden = true;
    }
?>

<form action="index.php?page=1" method="post">
        <header>
            <h1>Добро пожаловать!</h1>
        </header>
        <section>
           <input type="textarea" name="message">
        </section> 
        <footer>
            <a href="index.php?page=2">
                Авторизоваться
            </a>
            <div class="buttons">
            <button type="submit" name="send" <?=($hidden == true) ? 'disabled' : ''?>>
                Отправить
            </button>
            <button type="reset">
                Отмена
            </button>
            </div>
        </footer>
    </form>
<?
    $query = "SELECT DISTINCT date, CONCAT(`user`.`name`, `user`.`surname`) as fio, message
FROM `user` 
JOIN `usermessage` ON `user`.`id` = `usermessage`.`id_user` 
JOIN `messages` ON `messages`.`id` = `usermessage`.`id_message`";
$result = mysqli_query($connection, $query);
echo "<table>
<tr>
            <th>Сообщение</th>
            <th>Пользователь</th>
            <th>Дата</th>

        </tr>";
while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>";
    echo "<td>".$row['message']."</td>";
    echo "<td>".$row['fio']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "</tr>";
}
echo "</table>";
?>

