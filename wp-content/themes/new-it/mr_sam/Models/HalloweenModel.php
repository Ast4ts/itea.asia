<?php

function createOrUpdateHalloweenTable() {
    global $wpdb;
    $table_name = 'reg_for_halloween';
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $sql = "CREATE TABLE {$table_name} (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                client_name            varchar(200) DEFAULT NULL,
                client_phone           varchar(800) DEFAULT NULL,
                client_email           varchar(800) DEFAULT NULL,
                selected_profession_IT varchar(800) DEFAULT NULL,
                date_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                options varchar(100) DEFAULT NULL,
                PRIMARY KEY (id)
        ) {$charset_collate};";

    dbDelta($sql);
}

function insertToHalloweenTable($client_name, $client_phone, $client_email, $selected_profession_IT, $options) {
    global $wpdb;
    $table_name = 'reg_for_halloween';

    $status = $wpdb->insert($table_name,
        array(
            'client_name'  => $client_name,
            'client_phone' => $client_phone,
            'client_email' => $client_email,
            'selected_profession_IT' => $selected_profession_IT,
            'options' => $options
        ),
        array( '%s', '%s', '%s', '%s', '%s' )
    );

    return $status;
}
