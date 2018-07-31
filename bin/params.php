<?php

require "../public/index.php";

$params_mongodb_uri = $app->getContainer()->get('mongodb_uri');
$params_timeout = $app->getContainer()->get('default_timeout');
