<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="//kodaktor.ru/css/formstyle1">
</head>
<body>
<?php
ini_set('display_errors', 1);
/*
$id = 1;
$sql = "SELECT `text` FROM `reviews` WHERE `id` = :id";
$result = $conn->prepare($sql);
$a = ['id' => &$id];
$result->execute($a);
echo '<p>' . $result->fetch(PDO::FETCH_OBJ)->text . '</p>';

$id = 2;
$result->execute($a);
echo '<p>' . $result->fetch(PDO::FETCH_OBJ)->text . '</p>';
/*
$r = ['Kate', 'kate@mailserver.com', 'Good site!'];
$sql = "INSERT INTO `reviews` (`name`, `email`, `text`) VALUES (?, ?, ?);";

*/

$conn = require_once('bd.php');
$conn->exec('SET CHARACTER SET utf8');
$f = '<h2>Форма для заполнения</h2>';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $r = array_map(function($x) { return htmlentities($x); },
        [
            $_POST['name'] ?? 'Unknown user',
            $_POST['email'] ?? 'E-mail не указан',
            $_POST['text'] ?? 'Пустое сообщение'
        ]
    );
    $sql = "INSERT INTO `reviews` (`name`, `email`, `text`) VALUES (?, ?, ?);";
    $result = $conn->prepare($sql);
    $result->execute($r);
    if ($result) {
        $f .= '<h2>Добавить ещё один отзыв...</h2>';
        $i = '<h3>Данные успешно добавлены.</h3>';
    } else {
        $i = '<h3>При добавлении данных произошла ошибка.</h3>';
    }
    echo $i;
}
echo $f;
echo "<form method=\"post\" action=\"//{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}\" >";
echo require_once('form.php');
echo "</form>";
echo require_once('table.php');
?>
</body>
</html>