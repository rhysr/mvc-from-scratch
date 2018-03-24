<?php
require 'vendor/autoload.php';

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$urlPath = $parsedUrl['path'];


$view = function(array $params): string {
    ob_start();
    require 'templates/default.phtml';
    $html = \ob_get_contents();
    ob_end_clean();
    return $html;
};

$homeController = function() use ($view) {
    $viewParams = [
        'body' => 'HOME',
        'title' => 'Home',
    ];
    return $view($viewParams);
};

$productController = function() use ($view) {
    $viewParams = [
        'body' => 'PRODUCT 123456',
        'title' =>  'Product 123456'
    ];
    return $view($viewParams);
};

$noMatchController = function () use ($view) {
    $viewParams = [
        'body' => 'UNKNOWN',
        'title' =>  'Unknown'
    ];
    return $view($viewParams);
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

echo $controller($match->getParams());
