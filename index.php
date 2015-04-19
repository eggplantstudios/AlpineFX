<?php
/**
 * Created by PhpStorm.
 * User: shawnwernig
 * Date: 15-04-19
 * Time: 11:09 AM
 */

include('AlpineFX.php');

ob_start();

if( isset( $_GET['resource'] ) )
{
    $resource = htmlentities( $_GET['resource'] );
    $ap = new AlpineFX( $resource );
    $ap->display();
}
else
{
    die('ERROR: Resource required.' );
}

$html = ob_get_clean();

header( "Content-Type: text/javascript" );
echo 'AlpineFXCallback(' . json_encode(array('html' => $html)) . ')';

exit();