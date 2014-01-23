<?php

include 'core/init.php';
protect_page();
session_start();
session_destroy();
header('Location: index.php')
?>
