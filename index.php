<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Junior PHP</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#tankSize").change(function () {
                $.ajax({
                    type: 'GET',
                    url: 'rest_service.php',
                    data: {tankSize: $(this).val()},
                    dataType: 'JSON',
                    success: function (data) {
                        $("#calc").off().click(function () {
                            $("p.count").append(data[0]);
                            for (var i = 1; i < data.length-1; i++) {
                                $("ol").append(data[i]);
                                $("ol").append("</br>");
                            };
                        });
                        $("#reset").click(function(){
                            $("ol").html("");
                            $("p.count").html("Всего способов: ");
                        });
                    }
                });
            });
        });
    </script>
</head>
<body>
<form action="rest_service.php" method="GET">
    <p>Введите объем бака:</p>
    <input type="text" value="" name="tank" id="tankSize">
    <input type="button" value="Рассчитать" id="calc">
    <input type="button" value="Сброс" id="reset">
</form>
<p class="count">Всего способов: </p>
<ul>
    <ol></ol>
</ul>
</body>
</html>
