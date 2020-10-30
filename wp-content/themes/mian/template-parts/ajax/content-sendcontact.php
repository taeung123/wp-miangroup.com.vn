<?php
parse_str($_POST['data'], $params);
$nonce = $params['field_csrf'] ;
if ( ! wp_verify_nonce( $nonce, 'sendcontact' ) ) {
    echo 0;

} else {
    if(empty($params['firstname']) ||  empty($params['lastname']) || empty( $params['youremail'])  || filter_var($params['youremail'], FILTER_VALIDATE_EMAIL) === false || empty($params['phonenumber'])) {
        echo 0; die();
    }
    $message = "First Name: " . $params['firstname'];
    $message .= "\r\nLast Name: " . $params['lastname'];
    $message .= "\r\nEmail: " . $params['youremail'];
    $message .= "\r\nPhone Number: " . $params['phonenumber'];
    $message .= "\r\nCompany: " . $params['company'];
    $yourmess = "";
    if(!empty($params['yourmess'])) {
        $message .= "\r\nMessage:\r\n" . $params['yourmess'];
        //$yourmess = $params['yourmess'];        
    }
    
    $headers[] = 'From: Mian Group Website <info@miangroup.com.vn>';
    /*
     $headers[] = 'Cc: copy_to_2@email.com';
     $tomail = "thaind@purpleasia.com";
    */
    $tomail = "info@miangroup.com.vn";
    /*Insert wp_statisticsdonate */
    /*$datastatisticsdonate = array(
         "yourfirstname" => $params['firstname'],
         "yourlastname" => $params['lastname'],
         "youremail" => $params['youremail'],
         "yourphone" => $params['yourphone'],
         "countpeople" => $params['company'],
         "yourmess" => $yourmess,
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
   $table_name = $wpdb->prefix . "contact";
   $wpdb->insert(
        $table_name,
        $datastatisticsdonate,
        $dataformat      
   );*/
   
    if(wp_mail( $tomail, "Mian Website Contact", $message, $headers ) )
    {
      echo 1;
    } else { echo 0; }
    
}
?>