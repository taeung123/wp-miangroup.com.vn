<?php 
 
/*
Plugin Name:  Data Career
Plugin URI:   
Description:  Data Career
Version:      1.0
Author:       Purpleasia Teams
Author URI:   
License:      GPL2
License URI:  
Text Domain:  
Domain Path:  
*/


add_action('admin_menu','datacareer_modifymenu');
function datacareer_modifymenu() {
    
    add_menu_page('Data Career', /*page title*/
    'Data Career', /*menu title*/
    'manage_options', /*capabilities*/
    'datacareer', /*menu slug*/
    'datacareer', /*function*/
    'dashicons-feedback' /*icon_url*/
    );
}

function datacareer(){
    global $wpdb;
    $table_name = $wpdb->prefix . "career";
   
    $rows =  $wpdb->get_results( 
        "SELECT * FROM {$table_name} order by created DESC"
    );
?>
    <style>
        .qtranxs-lang-switch-wrap {display: none !important}
    </style>
    <h1>Data Career</h1>
    <table class='wp-list-table widefat fixed striped posts' style="margin-top: 20px">
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Applying to</th>
                <th>Working location</th>
                <th>Message</th>
                <th>CV</th>
                <th>Date</th>
            </tr>
            <?php
             foreach ($rows as $key => $row) :
            ?>
                <tr>
                    <td><?php echo $row->fullname ?></td>
                    <td><?php echo $row->youremail ?></td>
                    <td><?php echo $row->applyto ?></td>
                    <td><?php echo $row->wlocation ?></td>
                    <td><?php echo nl2br( str_replace("\'", "'", $row->yourmess)  ) ?></td>
                    <td><a href="<?php echo $row->filecv ?>"><?php echo $row->filecv ?></a></td>
                    <td><?php echo $row->created ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
<?php }

