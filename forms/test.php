<?php

foreach ($_GET as $i => $value) {
    print($i);
}

for ($i=1; isset($_GET[$i]); $i++) { 
    print "get answer data for question $i: ";
    print ($_GET[$i])."<br>";

}
