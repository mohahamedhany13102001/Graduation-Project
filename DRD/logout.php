<?php
require_once ('functions.php');

unset($_SESSION['email']);
unset($_SESSION['password']);
session_destroy();

header("Location: index.php");