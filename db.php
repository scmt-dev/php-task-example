<?php

$db = new mysqli('localhost', 'root', 'root', 'task');

if ($db->connect_error) {
    echo $db->connect_error;
}