<?php
session_start();

$_SESSION['name'] = 'John Doe';
$_SESSION['age'] = 30;

unset($_SESSION['name']);