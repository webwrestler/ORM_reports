
<?
include_once 'rest.php';
$product_page = 1;
$products_on_page = 5;
$total_products_count = $reports->count();

$reports = $reports->findList($products_on_page, ($product_page - 1) * $products_on_page);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Простая реализация ORM</title>
    <script>
        function validateForm() {
            var host = document.forms["myForm"]["host"].value;
            var code = document.forms["myForm"]["code"].value;
            var message = document.forms["myForm"]["message"].value;

            if (host == "" || code == "" ||  message == "") {
                alert("Name, code and message must be filled out");
                return false;
            }
        }
    </script>
</head>
<body>
<p>Общее количество добавленых хостингов: <?=$total_products_count;?></p>
<table style="border:1px solid black;">
    <tr>
        <th>Хостинг</th>
        <th>Код</th>
        <th>Описание</th>
    </tr>
    <? if ($reports !== false && count($reports) > 0) { ?>
        <? foreach ($reports as $report) {  ?>
            <tr>
                <td><a href="report.php?method=get&id=<?=$report->getId(); ?>"> <?=$report->getHost(); ?></a></td>
                <td><?=$report->getCode(); ?></td>
                <td><?=$report->getMessage(); ?></td>
                <td>
                    <form action="update.php" method="POST">
                        <button type="submit" name="id" value="<?=$report->getId();?>">Редактировать</button>
                    </form>
                    <br>
                    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                        <input type="hidden" name="method" value="delete" />
                        <button type="submit" name="id" value="<?=$report->getId();?>">Удалить</button>
                    </form>
                </td>
            </tr>
        <? } ?>
    <? } else { ?>
        <tr>
            <td colspan="4">Список продуктов пуст</td>
        </tr>
    <? } ?>
</table>

<form name="myForm" action="index.php" onsubmit="return validateForm()" method="POST">
    <input type="hidden" name="method" value="post" /><br/>
    Host: <br><input type="text" name="host" id="host" /><br/>
    Code: <br><input type="text" name="code" id="code" /><br/>
    Описание: <br><input type="text" name="message" id="message" /><br/><br/>
    <button type="submit">Добавить</button>
</form>
</body>
</html>