<?php
session_start();
session_reset();
header("refresh:3; url=index.php");
print "You are logged out, redirecting you in 3 seconds.";