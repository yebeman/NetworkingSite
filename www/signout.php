<?php
setcookie ("em", "", time() - 3600);
setcookie ("sub", "", time() - 3600);
header("Location: http://localhost/yc");
?>