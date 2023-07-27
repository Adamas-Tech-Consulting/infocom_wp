<?php
function create_client() {
    //$id = $_POST["id"];
    //$name = $_POST["client_name"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
       

        $new_client_id = oAuth_gen_key();
        $new_client_secret = oAuth_gen_key();
        //{$wpdb->prefix}
        $wpdb->insert("{$wpdb->prefix}oauth_clients",
        array(
            'client_id' => $new_client_id,
            'client_secret' => $new_client_secret,
            'redirect_uri' => '',
            'client_name' => empty($_REQUEST['client_name']) ? 'No Name' : $_REQUEST['client_name']
        ));
        $message="Client inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-Clients/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Client</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td>Client Name :</td>
                    <td>
                        <input type="text" name="client_name" class="ss-field-width" />
                    </td>
                </tr>
               <tr><td>&nbsp;</td></tr>
            </table>
            <table>
                <tr>
                    <td>
                        <input type='submit' name="insert" value='Save' class='button'>
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
    <?php
}

function oAuth_gen_key( $length = 40 ) {

    // Gather the settings
    $options = get_option("wo_options");
    //$user_defined_length = (int) $options["client_id_length"];
    $user_defined_length =40;
    // If user setting is larger than 0, then define it
    if ( $user_defined_length > 0 ) {
        $length = $user_defined_length;
    }

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}