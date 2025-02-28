<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', '1');

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

if ($_SERVER['APP_DEBUG']) {
    header('Access-Control-Allow-Origin:' . rtrim($_SERVER['HTTP_REFERER'], '/'));
} else {
    header('Access-Control-Allow-Origin:yourdomain');
}
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Headers:X-Requested-With, Content-Type, withCredentials');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}
