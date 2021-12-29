<?php
include("config.php");
include("Database.php");
include("User.php");
include("Auth.php");
include("Mosque.php");
include("Core.php");
include("Committee.php");
include("Admin.php");



// Classes object
$db = new classes\Database;
$user = new classes\User($db);
$auth = new classes\Auth($db);
$mosque = new classes\Mosque($db);
$core = new classes\Core($db);
$committee = new classes\Committee($db);
$admin = new classes\Admin($db);
