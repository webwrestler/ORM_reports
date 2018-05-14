<?include_once 'rest.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Простая реализация ORM</title>
</head>
<body>
<table style="border:1px solid black;">
    <tr>
        <th>Хостинг</th>
        <th>Код</th>
        <th>Описание</th>
    </tr>
    <? if ($reports !== false && count($reports) > 0) { ?>
        <? foreach ($reports as $report) {  ?>
            <tr>
                <td><a href="report.php?method=get&id=<?=$report->getId(); ?>"><?=$report->getHost(); ?></a></td>
                <td><?=$report->getCode(); ?></td>
                <td><?=$report->getMessage(); ?></td>
                <td>
                    <form action="update.php" method="POST">
                        <button type="submit" name="id" value="<?=$report->getId();?>">Редактировать</button>
                    </form>
                    <br>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="method" value="delete" />
                        <button type="submit" name="id" value="<?=$report->getId();?>">Удалить</button>
                    </form>
                </td>
            </tr>
        <? } ?>
    <? } else { ?>
        <tr>
            <td colspan="4">Такого продукта тут нет!</td>
        </tr>
    <? } ?>
</table>
</body>
</html>