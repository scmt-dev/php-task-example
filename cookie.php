<?php 

setcookie("name", "John Doe", time() + (86400 * 30), "/"); // 86400 seconds = 1 day
setcookie("age", "30", time() + (86400 * 30), "/");

// set expired time
setcookie("name", "", time() - 3600, "/");
setcookie("age", "", time() - 3600, "/");

