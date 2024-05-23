<?php
session_start();

// namespace Cannelle\BlogMvc;
use Cannelle\BlogMvc\Core\Router;
require '../vendor/autoload.php';

$router = new Router($_SERVER["REQUEST_URI"]);

?>