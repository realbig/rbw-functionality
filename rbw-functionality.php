<?php
/*
Plugin Name: RBW Functionality
Description: Basic functions designed to customize and enhance the RBW experience.
Author: Kyle Maurer
Version: 1.0
Author URI: http://realbigmarketing.com
*/

/*-------------------------------
Login CSS
-------------------------------*/
function rbw_admin_css() { ?>
	<style type="text/css">
#login {
width: 650px;
}
.message {
display: none;
}
.login form {
width: 250px;
float: right;
border-radius: 25px;
}
.login h1 a {
width: 340px;
float: left;
padding-bottom: 110px;
}
.login #nav a, .login #backtoblog a {
font-weight: bold;
background: #064374;
text-shadow: rgba(0, 0, 0, 0.3) 0 -1px 0;
padding: 7px;
border-radius: 12px;
text-decoration: none;
color: white;
}
.login #backtoblog a {
color: white;
}
.login #nav a:hover, .login #backtoblog a:hover {
color: #B32A2A!important;
}
.login .button-primary {
font-size: 20px!important;
line-height: 24px;
padding: 7px 10px;
float: right;
width: 230px;
margin: 5px 0 0 0;
background: #064374;
}
body.login {
background: #302F2F;
}
body.login div#login h1 a {
    background-image: url(http://realbigmarketing.com/files/2013/04/Blue-Green-Logo.png);
    background-size: 59%;
    padding-bottom: 30px;
}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'rbw_admin_css' );
/*-------------------------------
Change footer text
-------------------------------*/
function rbw_footer_admin () {
echo 'Powered by <a href="http://www.wordpress.org">WordPress</a> | Designed and managed by <a href="http://realbigmarketing.com/?utm_source=RBWadmin-footer&utm_medium=footer-link&utm_campaign=RBWdashboard">Real Big Marketing</a></p>';
}
add_filter('admin_footer_text', 'rbw_footer_admin');
?>