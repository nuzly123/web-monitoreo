<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".content").fadeOut(1500);
            }, 3000);
        });
    </script>
</head>

<body>
    <div class="content">Hola, voy a desaparecer en 3 segundos!</div>
    <div class="content2" style="display:none;">Hola, soy un nuevo div!</div>
</body>

</html>