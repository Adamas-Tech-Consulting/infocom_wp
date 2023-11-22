<?php
function client_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-Clients/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Clients</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=create_client'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "oauth_clients";
       

        $rows = $wpdb->get_results("SELECT client_id,client_secret,client_name from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">Clent Name</th>
                <th class="manage-column ss-list-width">Client ID</th>
                <th class="manage-column ss-list-width">Client Secret</th>
                <th class="manage-column ss-list-width">Action</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->client_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->client_id; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->client_secret; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=client_update&client_id='.$row->client_id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}