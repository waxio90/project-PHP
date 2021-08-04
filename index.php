<?php

declare(strict_types=1);

spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'App/'], ['/', ''], $classNamespace);
    $path = "src/$path.php";
    require_once($path);
});

use App\Controller\Controller;
use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;

require_once("src/Utils/debug.php");


$configuration = require_once("config/config.php");
$request = new Request($_GET, $_POST);


// try {
    Controller::initConfiguration($configuration);
    (new Controller($request))->run();
    
// } catch (ConfigurationException $e) {
//     echo '<h1>Wystąpił błąd w aplikacji</h1>';
//     echo 'Problem z konfiguracją';
// } catch (AppException $e) {
//     echo '<h1>Wystąpił błąd w aplikacji</h1>';
//     echo '<h3>' . $e->getMessage() . '</h3>';
// } catch (\Throwable $e) {
//     echo '<h1>Wystąpił błąd w aplikacji</h1>';
// }


