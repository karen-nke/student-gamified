
<?php

session_start();

if (isset($_SESSION['last_acted_on']) && (time() - $_SESSION['last_acted_on'] > 0.5 * 60)) { //if user are inactive for 30minutes
    session_unset();
    session_destroy(); // destroy session data in storage

} else {
    session_regenerate_id(true);
    $_SESSION['last_acted_on'] = time();
}

?>
