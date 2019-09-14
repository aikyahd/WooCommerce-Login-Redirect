<?php
// start global session for saving the referer url
function start_session() {
    if(!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session', 1);

// get  referer url and save it 
function redirect_url() {
    if( strpos( $_SERVER['HTTP_REFERER'], 'my-account') === false ){
        // only if the url does not contain 'my-account'
        $_SESSION['referer_url'] = $_SERVER['HTTP_REFERER'];
    }
}
add_action( 'template_redirect', 'redirect_url' );

function login_redirect() {
    if (isset($_SESSION['referer_url'])) {
        return $_SESSION['referer_url'];
    }
}
add_filter('woocommerce_login_redirect', 'login_redirect', 10, 2);
?>
