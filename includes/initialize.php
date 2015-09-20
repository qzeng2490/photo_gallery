<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected
// load config file first
require_once('config.php');

// load basic functions next so that everything after can use them
require_once('functions.php');

// load core objects
require_once('session.php');
require_once('database.php');
require_once('database_object.php');
require_once('pagination.php');

// load database-related classes
require_once('user.php');
require_once('photograph.php');
require_once('comment.php');

?>