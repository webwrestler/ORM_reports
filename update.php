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
<?php
?>

<h1>UPDATE DATA </h1>
<form name="myForm" action="index.php" onsubmit="return validateForm()" method="POST">
    <input type="hidden" name="method" value="put" /><br/>
    <input type="hidden" name="id" value="<?=$_POST['id'];?>" />
    Host: <br><input type="text" name="host" id ="host" /><br/>
    Code: <br><input type="text" name="code" id ="code" /><br/>
    Описание: <br><input type="text" name="message" id="message" /><br/><br/>
    <button type="submit">Зменить</button>
</form>
</body>