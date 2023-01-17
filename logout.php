<?php
session_start();
session_destroy();
header("Location: indextest.php");
?>