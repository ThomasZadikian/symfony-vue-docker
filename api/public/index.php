<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '0');

use App\Kernel;

// CORS Headers
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Headers:X-Requested-With, Content-Type, withCredentials');

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

if ($_SERVER['APP_DEBUG']) {
    header('Access-Control-Allow-Origin:' . rtrim($_SERVER['HTTP_REFERER'], '/'));
} else {
    header('Access-Control-Allow-Origin:yourdomain');
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}
