<?php
require 'vendor/autoload.php';

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$urlPath = $parsedUrl['path'];


$body = 'UNKNOWN';
$title = 'Unknown';

$homeRoute = new \Router\StaticRoute('/');
$productRoute = new \Router\RegexRoute('#/product/\d+$#');
if ($homeRoute->isMatch($urlPath)) {
    $body = 'HOME';
    $title = 'Home';
} elseif ($productRoute->isMatch($urlPath)) {
    // TODO: get product id from route
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
