<?php
function client_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "oauth_clients";
    $id = $_GET["client_id"];
   // $name = $_POST["client_name"];
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('client_name' => $name), //data
                array('client_id' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE client_id = %s", $id));
    } else {//selecting value to update	
      
        $Clients = $wpdb->get_results($wpdb->prepare("SELECT client_id,client_secret,client_name from 
            $table_name where client_id=%s", $id));
       
        foreach ($Clients as $s) {
            $name = $s->client_name;
            $client_id=$s->client_id;
            $client_secret=$s->client_secret;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-Clients/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Clients</h2>

        <?php if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>Client deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=client_list') ?>">&laquo; Back to Clients list</a>

        <?php } else if (isset($_POST['update'])) { ?>
            <div class="updated"><p>Client updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=client_list') ?>">&laquo; Back to Clients list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table cellpadding="10" cellspacing="0" width="500" style="border :1px solid #3c6c9c"
                "> 
               
                    <tr>
                        <td>Name :</td>
                        <td>
                            <input type="text" name="name" value="<?php echo $name; ?>"/>
                        </td>
                    </tr>
                    <tr>
                       <td>Client ID :</td>
                        <td>
                            <input type="text" name="name" size="35" value="<?php echo $client_id; ?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td>Client Secret :</td>
                        <td>
                            <input type="text" name="name" size="35" value="<?php echo $client_secret; ?>" readonly/>
                        </td>
                    </tr>

                </table>
                <table>
                    <tr>                       
                        <td>
                            <input type='submit' name="update" value='Save' class='button'>
                        </td>
                        <td>
                            <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('&iquest;Est&aacute;s seguro de borrar este elemento?')">
                        </td>
                    </tr>
                </table>
            </form>
        <?php } ?>

    </div>
    <?php
}