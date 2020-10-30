<?php 
    $fileErrors = array(
        0 => "There is no error, the file uploaded with success",
        1 => "The uploaded file exceeds the upload_max_files in server settings",
        2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
        3 => "The uploaded file uploaded only partially",
        4 => "No file was uploaded",
        6 => "Missing a temporary folder",
        7 => "Failed to write file to disk",
        8 => "A PHP extension stoped file to upload" );
    $posted_data =  isset( $_POST ) ? $_POST : array();
    $file_data = isset( $_FILES ) ? $_FILES : array();
    $data = array_merge( $posted_data, $file_data );
    $response = array();
    $uploaded_file = wp_handle_upload( $data['ibenic_file_upload'], array( 'test_form' => false ) );
    if( $uploaded_file && ! isset( $uploaded_file['error'] ) ) {
        
        $response['response'] = "SUCCESS";
        $response['filename'] = basename( $uploaded_file['url'] );
        $response['url'] = $uploaded_file['url'];
        $response['type'] = $uploaded_file['type'];
        $response['filetomail']  = $uploaded_file['file'];
        
    } else {
        $response['response'] = "ERROR";
        $response['error'] = $uploaded_file['error'];
    }
    echo json_encode( $response );
    die();
?>