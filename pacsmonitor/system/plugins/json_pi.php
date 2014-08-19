<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function JSON(){
	require_once( 'json/JSON.php' );
	$FC = new Services_JSON();
	return $FC;
}
?>
