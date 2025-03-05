<?php

require_once __DIR__ . '/Database.php';

$config = require 'config.php';
$dbConfig = $config['database'];
$db = new Database($dbConfig);
require 'route.php';

<?php
echo "<pre>";
print_r(scandir(__DIR__));
echo "</pre>";
