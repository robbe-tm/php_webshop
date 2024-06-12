<?php
session_start();
if (isset($_SESSION['user_id'])) {
    switch ($_SESSION['user_id']) {
        case ' "' . $_SESSION['user_id'] . '" ' == "":
            $user_id = 1;
            break;
        case ' "' . $_SESSION['user_id'] . '" ' != "":  //To display your username
            $user_id = $_SESSION['user_id'];
            break;
        default:
            $user_id = 0;
            break;
    }
}
