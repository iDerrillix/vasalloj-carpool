<?php 

    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $routes = [
        '/vasalloj-carpool/' => 'controller/index.php',
        '/vasalloj-carpool/login' => 'controller/login.php',
        '/vasalloj-carpool/sign-up' => 'controller/sign-up.php'
    ];
    if(!isset($_SESSION['uID']) && $uri == '/vasalloj-carpool/'){
        header("Location: /vasalloj-carpool/login?message=loginfirst");
    } else{
        if(array_key_exists($uri, $routes)){
            require $routes[$uri];
        } else{
            echo 'ERROR404: Page not found\n';
            echo $_SERVER['REQUEST_URI'];
        }
    }
    
?>