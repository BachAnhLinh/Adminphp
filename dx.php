<?php
session_start();
session_destroy();
header ('location:dn.php');
?>