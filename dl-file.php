<?php
require_once('wp-load.php');

list($basedir) = array_values(array_intersect_key(wp_upload_dir(), array('basedir' => 1)))+array(NULL);
$file =  rtrim($basedir,'/').'/'.str_replace('..', '', isset($_GET[ 'file' ])?$_GET[ 'file' ]:'');

if (!$basedir || !is_file($file)) {
status_header(404);
die('404 &#8212; File not found.');
}
$mime = wp_check_filetype($file);

if($mime['type'] =='application/pdf'){
    if(!is_user_logged_in()){
        auth_redirect();
    }

    $user = wp_get_current_user();
    //Get current user
    $user_id = $user->ID;
    $username = $user->user_login;
    $role = $user->roles;

    global $wp;

    $get_url_pdf = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];




    $pass = 0;

    $args = array( 'post_type' => 'member','posts_per_page' => -1);
    $members = new WP_Query( $args );

    if($members->have_posts()){
        while ( $members->have_posts() ) { $members->the_post();
            $current_id = get_the_ID();
            $pdfs = get_field('pdf',$current_id );
            foreach ($pdfs as $pdf){
                //echo '<pre>'; print_r($pdf); echo '</pre>';
                $pdf_upload = $pdf['file_upload'];
                $pdf_userid = $pdf['user']['ID'];

                if($pdf_userid==$user_id and $pdf_upload==$get_url_pdf){
                    $pass = 1;
                }
            }
        }

        if(!$pass){
            //auth_redirect();
            die('You can not download this file!');
        }
    }







}

if( false === $mime[ 'type' ] && function_exists( 'mime_content_type' ) )
    $mime[ 'type' ] = mime_content_type( $file );
if( $mime[ 'type' ] )
    $mimetype = $mime[ 'type' ];
else
    $mimetype = 'image/' . substr( $file, strrpos( $file, '.' ) + 1 );
header( 'Content-Type: ' . $mimetype ); // always send this
if ( false === strpos( $_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS' ) )
    header( 'Content-Length: ' . filesize( $file ) );
$last_modified = gmdate( 'D, d M Y H:i:s', filemtime( $file ) );
$etag = '"' . md5( $last_modified ) . '"';
header( "Last-Modified: $last_modified GMT" );
header( 'ETag: ' . $etag );
header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + 100000000 ) . ' GMT' );
// Support for Conditional GET
$client_etag = isset( $_SERVER['HTTP_IF_NONE_MATCH'] ) ? stripslashes( $_SERVER['HTTP_IF_NONE_MATCH'] ) : false;
if( ! isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) )
    $_SERVER['HTTP_IF_MODIFIED_SINCE'] = false;
$client_last_modified = trim( $_SERVER['HTTP_IF_MODIFIED_SINCE'] );
// If string is empty, return 0. If not, attempt to parse into a timestamp
$client_modified_timestamp = $client_last_modified ? strtotime( $client_last_modified ) : 0;
// Make a timestamp for our most recent modification...
$modified_timestamp = strtotime($last_modified);
if ( ( $client_last_modified && $client_etag )
    ? ( ( $client_modified_timestamp >= $modified_timestamp) && ( $client_etag == $etag ) )
    : ( ( $client_modified_timestamp >= $modified_timestamp) || ( $client_etag == $etag ) )
) {
    status_header( 304 );
    exit;
}
// If we made it this far, just serve the file
readfile( $file );

?>