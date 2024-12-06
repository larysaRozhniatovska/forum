<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title?></title>
        <script src="https://kit.fontawesome.com/d16cee9f8d.js"></script>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <?php include_once self::VIEWS_DIR . 'pages' . DIRECTORY_SEPARATOR . $page . '.php'?>
        <?php include_once self::VIEWS_DIR . 'common' . DIRECTORY_SEPARATOR . 'footer.php'?>
    </body>
    <script src="../js/script.js" ></script>
</html>
