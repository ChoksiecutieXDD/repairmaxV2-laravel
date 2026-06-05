<?php
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
*/
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap Laravel
|--------------------------------------------------------------------------
*/
$app = require_once __DIR__.'/../bootstrap/app.php';

// Force session driver to 'array' just in case anything tries to initialize it
config(['session.driver' => 'array']);

// Resolve the Console Kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<html><head><title>Database Setup</title><style>body { font-family: monospace; background: #1a1a1a; color: #00ff00; padding: 20px; }</style></head><body>";
echo "<h2>Running Migrations...</h2>";

$output = new \Symfony\Component\Console\Output\BufferedOutput();
try {
    $status = $kernel->handle(
        new \Symfony\Component\Console\Input\StringInput('migrate --force'),
        $output
    );
    echo "<h3>Migration Result Code: " . $status . "</h3>";
    echo "<pre>" . htmlentities($output->fetch()) . "</pre>";
} catch (\Exception $e) {
    echo "<h3 style='color: red;'>Migration Failed!</h3>";
    echo "<pre style='color: red;'>" . htmlentities($e->getMessage()) . "\n" . htmlentities($e->getTraceAsString()) . "</pre>";
}

echo "<h2>Running Seeders...</h2>";
$output2 = new \Symfony\Component\Console\Output\BufferedOutput();
try {
    $status2 = $kernel->handle(
        new \Symfony\Component\Console\Input\StringInput('db:seed --force'),
        $output2
    );
    echo "<h3>Seeding Result Code: " . $status2 . "</h3>";
    echo "<pre>" . htmlentities($output2->fetch()) . "</pre>";
} catch (\Exception $e) {
    echo "<h3 style='color: red;'>Seeding Failed!</h3>";
    echo "<pre style='color: red;'>" . htmlentities($e->getMessage()) . "\n" . htmlentities($e->getTraceAsString()) . "</pre>";
}

echo "<h2>Setup Complete! You can now visit the homepage.</h2>";
echo "</body></html>";
