<?php

require_once __DIR__ . '/database.php';

$config = require 'config.php';
$dbConfig = $config['database'];
$db = new Database($dbConfig);
require 'route.php';

