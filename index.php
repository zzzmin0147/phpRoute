<?php 
require_once('./vendor/altorouter/altorouter/AltoRouter.php') ;

// Create AltoRouter instance
$router = new AltoRouter();

// Define routes
$router->map('GET', '/', 'HomeController#index');
$router->map('GET', '/about', 'AboutController#index');
// Add more routes as needed

// Match the current request
$match = $router->match();

// Check if a matching route was found
if ($match) {
    // Extract controller and action
    list($controller, $action) = explode('#', $match['target']);

    // Include the controller file
    require_once "controllers/{$controller}.php";

    // Create controller instance and call the action
    $controllerInstance = new $controller();
    $controllerInstance->$action();
} else {
    // Handle 404 Not Found
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404 Not Found';
}
