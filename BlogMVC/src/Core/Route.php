<?php 
namespace Cannelle\BlogMvc\Core;

    class Route {
        private $path;
        private $callable;


        function __construct($path, $callable) {
            $this->path = trim($path , '/');
            $this->callable = $callable;
        }

    }
?>