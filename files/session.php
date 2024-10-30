<?php

	add_action('init', 'ldvStartSession', 1);
	add_action('wp_logout', 'ldvEndSession');
	add_action('wp_login', 'ldvEndSession');
	
function ldvStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function ldvEndSession() {
    session_destroy ();
}

?>