<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Projectworlds Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p style="font-size: 20px">Вие излезнахте успешно от профила си. <a href="login.php">Влезте отново</a> или отидете в <a href="index.php">началната страница</a>.</p>
                                <meta http-equiv="refresh" content="3;url=index.php" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
