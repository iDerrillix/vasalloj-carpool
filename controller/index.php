<?php
    dd($_SERVER['REQUEST_URI']);
require 'core/Database.php';
include 'view/partial/header.php';
require('view/index.view.php');
?>