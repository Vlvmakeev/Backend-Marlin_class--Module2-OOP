
<?php
    
    include __DIR__ . '/../functions.php';
    
    $routes = [
        "/" => "functions/homepage.php",
        "/about" => "functions/about.php"
    ];

    $route = $_SERVER['REQUEST_URI'];

    if( array_key_exists($route, $routes) ){
        include __DIR__ . '/../' . $routes[$route]; exit;
    } else {
        dd(404);
    }
/*
Options +FollowSymLinks -Indexes
RewriteEngine On
 
RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
 
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
*/