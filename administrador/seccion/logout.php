<?php
session_start();
session_destroy();
include("funciones.php");
$url = "http://" . $_SERVER['HTTP_HOST'] . "/holy%20sensations%20spa";
header("location:" . $url . "/index.php");
?>
