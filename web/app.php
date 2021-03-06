<?php

require_once __DIR__.'/../app/autoload.php';

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
/*
$apcLoader = new ApcClassLoader('sf2', $loader);
$loader->unregister();
$apcLoader->register(true);
*/

require_once __DIR__.'/../app/AppKernel.php';

use Symfony\Component\Yaml\Yaml;

$maintenanceMode = file_exists(__DIR__.'/../app/config/.update');
$authorized = false;

if (file_exists($file = __DIR__.'/../app/config/ip_white_list.yml')) {
    $ips = Yaml::parse($file);
    $authorized = false;

    if (is_array($ips)) {
        foreach ($ips as $ip) {
            if ($ip === $_SERVER['REMOTE_ADDR']) {
                $authorized = true;
            }
        }
    }
}

if (!$maintenanceMode || $authorized) {
    $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $kernel = new AppKernel('prod', false);
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
} else {
    $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'/../maintenance.php';
    header("Location: {$url}");
}
