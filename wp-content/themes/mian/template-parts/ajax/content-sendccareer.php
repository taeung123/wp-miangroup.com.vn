<?php
parse_str($_POST['data'], $params);
$nonce = $params['field_csrf'] ;
if ( ! wp_verify_nonce( $nonce, 'sendcontact' ) ) {
    echo 0;
} else {
    if(empty($params['fullname']) || empty( $params['youremail'])  || filter_var($params['youremail'], FILTER_VALIDATE_EMAIL) === false ) {
        echo 0; die();
    }
    $message = "Full Name: " . $params['fullname'];
    $message .= "\r\nEmail: " . $params['youremail'];
    $message .= "\r\nApplying to: " . $params['applyto'];
    $message .= "\r\nWorking location: " . $params['wlocation'];
    if(!empty($params['yourmess'])) {
        $message .= "\r\nMessage:\r\n" . $params['yourmess'];
    }
    
    
    
    
    $headers[] = 'From: Mian Group <info@miangroup.com.vn>';
    
    /*
     $headers[] = 'Cc: copy_to_2@email.com';
     $tomail = "thaind@purpleasia.com";
    */
    $tomail = "info@miangroup.com.vn";
    /*Insert wp_statisticsdonate */
    $datastatisticsdonate = array(
         "fullname" => $params['fullname'],
         "youremail" => $params['youremail'],
         "applyto" => $params['applyto'],
         "wlocation" => $params['wlocation'],
         "filecv" => $params['urlfile'],
         "yourmess" => $params['yourmess'],
         "created" => date("Y-m-d H:i:s", time())
    );
    
   $dataformat = array(
         "%s",
         "%s",
         "%s",
         "%s",
         "%s",
         "%s",
         "%s"
   );
   global $wpdb;
   $table_name = $wpdb->prefix . "career";
   $wpdb->insert(
        $table_name,
        $datastatisticsdonate,
        $dataformat      
   );
    $mail_attachment = $params['filetomail'];
    if(wp_mail( $tomail, "Mian Group Career", $message, $headers, $mail_attachment ) )
    {
      echo 1;
    } else { echo 0; }
    
}
?>