<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Testing PHP...</h3>";

include 'db_connect.php';

echo "<p>✅ PHP is working, and the database connection loaded successfully.</p>";
