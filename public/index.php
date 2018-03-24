<?php
require 'vendor/autoload.php';

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$urlPath = $parsedUrl['path'];


$body = 'UNKNOWN';
$title = 'Unknown';

$homeController = function() {
    return [
        'body' => 'HOME',
        'title' => 'home',
    ];
};

$productController = function() {
    return [
        'body' => 'PRODUCT 123456',
        'title' =>  'Product 123456'
    ];
};

$noMatchController = function () {
    return [
        'body' => 'UNKNOWN',
        'title' =>  'Unknown'
    ];

};

$controller = $noMatchController;

$routings = [
    [new \Router\StaticRoute('/'), $homeController],
    [new \Router\RegexRoute('#/product/\d+$#'), $productController]
];

foreach ($routings as $routing) {
    $route = $routing[0];
    $match = $route->match($urlPath);
    if ($match->isMatch()) {
        $controller = $routing[1];
        break;
    }
}

$params = $controller();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $params['title'] ?>$</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <div class="content">
        <main class="container">
            <?php echo $params['body'] ?>
        </main>
    </div>
</body>
</html>
