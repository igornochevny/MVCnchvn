<?php
require_once '../vendor/autoload.php';

$config = require('../config/db.php');

$application = new \app\Application($config);

$application->run();