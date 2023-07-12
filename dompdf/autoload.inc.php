<?php

// Set the isRemoteEnabled option to true
define("DOMPDF_ENABLE_REMOTE", true);

// Check if curl extension is enabled or allow_url_fopen is set to true
if (!extension_loaded('curl') && !ini_get('allow_url_fopen')) {
    throw new Exception("Both cURL extension and allow_url_fopen setting are not enabled. Please enable at least one of them.");
}

// Define the chroot path(s)
$chrootPaths = [
    '/assetsurat/posaja.png',
    '/assetsurat/posLogo.png',
    '/assetsurat/pospay.png',
    // Add more paths if needed
];

// Register the autoloader
spl_autoload_register(function ($class) use ($chrootPaths) {
    $class = ltrim($class, '\\');
    $class = str_replace('_', '/', $class);
    $class .= '.php';

    foreach ($chrootPaths as $chrootPath) {
        $file = $chrootPath . '/' . $class;

        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// Other customizations or configurations can be added here

?>
