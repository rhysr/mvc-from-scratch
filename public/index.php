<?php
$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$urlPath = $parsedUrl['path'];


$body = 'UNKNOWN';
$title = 'Unknown';
if ('/' === $urlPath) {
    $body = 'HOME';
    $title = 'Home';
} elseif ('/product/123456' === $urlPath) {
    $body = 'PRODUCT 123456';
    $title = 'Product 123456';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $title ?>$</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <div class="content">
        <main class="container">
            <?php echo $body ?>
        </main>
    </div>
</body>
</html>
