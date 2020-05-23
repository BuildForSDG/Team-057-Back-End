<?php
    $user = new User();
    
    if (!$user->authed()) {
        redirect('/sign-in');
    }
    else {
    }
?>