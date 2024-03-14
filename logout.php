<?php
session_start();
session_reset();
session_destroy();
session_abort();
    header("refresh:3; url=index.php");
    print "You are logged out, redirecting you in 3 seconds.";