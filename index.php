<?php

namespace library;

error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
session_start();
try {
    spl_autoload_register(function (string $className) {
        $parts = explode('\\', $className);
        $filename = str_replace('-', '', ucwords(array_pop($parts), '-')) . '.php';
        array_shift($parts);
        $path = 'app/' . implode('/', $parts) . '/';
        if (file_exists($path . $filename)) {
            require_once $path . $filename;
        } else {
            throw new \Exception("Unable to load class $path$filename $className.");
        }
    });
    Router::route(filter_input(INPUT_SERVER, 'REQUEST_URI'));
} catch (\Exception $e) {
    die($e->getMessage());
}
