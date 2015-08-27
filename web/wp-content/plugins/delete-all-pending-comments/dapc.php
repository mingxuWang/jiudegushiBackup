<?php
/*
Plugin Name: Delete All Pending Comments
Plugin URI: N/A
Description: A small plugin to delete all your pending comments.
Version: 1.0
Author: Grávuj Miklós Henrich
Author URI: http://www.henrich.ro
*/

define( 'DAPC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FORM_ACTION', str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ) );

function dapc() {
	global $wpdb;
	$pending_query = $wpdb->query( "SELECT comment_ID FROM $wpdb->comments WHERE comment_approved = '0'" );
	$_POST = array_map( 'sanitize_text_field', $_POST );
	if ( $pending_query > 0 ) {
		$pq_num = ' <em class="small_dapc">('.$pending_query.' pending)</em>';
	} else {
		$pq_num = '';
	}
	$msg = array(
		'title'		=> 'Delete All Pending Comments',
		'note'		=> '<strong>Note:</strong> After checking the box below and click on delete button, all pending comments will be deleted.',
		'request'	=> 'Please check the checkbox below, if you would like to delete all the pending comments.',
		'success'	=> 'All pending comments have now been deleted.',
		'error'		=> 'There was an error deleting all pending comments, please try again.',
		'good'		=> 'You have no pending comments to delete.',
		'form'		=> '<form name="dapc_form" method="post" action="'.FORM_ACTION.'">
							<input type="hidden" name="dapc" value="Y">
							'.wp_nonce_field('dapc-nonce').'
							<input type="checkbox" name="delete" value="Y" class="button-checkbox" /> Delete all pending comments?
							<input type="submit" value="Delete" class="button-primary" />
						</form>'
	);
	?>
    <div class="wrap">
    	<?php
		$nonce = $_REQUEST['_wpnonce'];
		if ( $_POST['dapc'] == 'Y' && $_POST['delete'] == 'Y' && wp_verify_nonce( $nonce, 'dapc-nonce' ) ) {
			echo '<h2>'.$msg['title'].'</h2>';
			if ( $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_approved = '0'" ) != FALSE ) {
				echo '<div class="updated"><p>'.$msg['success'].'</p></div>';
			} else {
				echo '<div class="error"><p>'.$msg['error'].'</p></div>';
				echo $msg['form'];
			}
		} elseif ( $_POST['dapc'] == 'Y' && $_POST['delete'] != 'Y' && wp_verify_nonce( $nonce, 'dapc-nonce' ) ) {
			echo '<h2>'.$msg['title'].$pq_num.'</h2>';
			echo '<div class="updated"><p>'.$msg['note'].'</p></div>';
			echo '<div class="error"><p>'.$msg['request'].'</p></div>';
			echo $msg['form'];
		} else {
			echo '<h2>'.$msg['title'].$pq_num.'</h2>';
			if( $pending_query > 0 ) {
				echo '<div class="updated"><p>'.$msg['note'].'</p></div>';
				echo $msg['form'];
			} else {
				echo '<div class="updated"><p>'.$msg['good'].'</p></div>';
			}
		}
		?>
    </div><!-- .wrap -->
<?php
}

function dapc_css() {
	wp_register_style( 'dapc.css', DAPC_PLUGIN_URL . 'dapc.css', array(), '1.0' );
	wp_enqueue_style( 'dapc.css' );
}

function register_dapc() {
	add_comments_page(
		'Pending Comments', 
		'Pending Comments', 
		'manage_options', 
		'delete-all-pending-comments', 
		'dapc_callback'
	);
}

function dapc_callback() {
	echo '<div class="icon32" id="icon-edit-comments"><br></div>';
	dapc();
}

add_action( 'admin_enqueue_scripts', 'dapc_css' );
add_action( 'admin_menu', 'register_dapc' );
?>