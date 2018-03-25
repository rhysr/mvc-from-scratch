<?php
require 'vendor/autoload.php';

class HomeController implements \Controller\Controller
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke(array $params)
    {
        $viewParams = [
            'body' => 'HOME',
            'title' => 'Home',
        ];
        $body = $this->view->render($viewParams);
        return new \Http\Response(200, [], $body);
    }
}

class ProductController implements \Controller\Controller
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke(array $params)
    {
        $viewParams = [
            'body' => 'PRODUCT ' . $params['id'],
            'title' =>  'Product ' . $params['id'],
        ];
        $body = $this->view->render($viewParams);
        return new \Http\Response(200, [], $body);
    }
}

class UnknownController implements \Controller\Controller
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke(array $params)
    {
        $viewParams = [
            'body' => 'UNKNOWN',
            'title' =>  'Unknown'
        ];
        $body = $this->view->render($viewParams);
        return new \Http\Response(404, [], $body);
    }
}

class View
{
    public function render(array $params): string
    {
        // TODO: XSS vulnerable
        ob_start();
        require 'templates/default.phtml';
        $html = \ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

$view              = new View();
$noMatchController = new UnknownController($view);
$controller        = $noMatchController;
$routings          = [
    [new \Router\StaticRoute('/'), new HomeController($view)],
    [new \Router\RegexRoute('#/product/(?<id>\d+)$#'), new ProductController($view)]
];

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$urlPath   = $parsedUrl['path'];
foreach ($routings as $routing) {
    $route = $routing[0];
    $match = $route->match($urlPath);
    if ($match->isMatch()) {
        $controller = $routing[1];
        break;
    }
}

$response = $controller($match->getParams());

http_response_code($response->getResponseCode());
foreach ($response->getHeaderLines() as $header) {
    header($header);
}
echo $response->getBody();
