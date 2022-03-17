<?php

function createOrUpdateOAuthTable() {
    global $wpdb;
    $table_name = 'oauth_table';
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $sql = "CREATE TABLE {$table_name} (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                api_type         varchar(50) NOT NULL,
                login            varchar(255) NOT NULL,
                password         varchar(500) NOT NULL,
                access_token     varchar(800) DEFAULT NULL,
                access_lifetime  int(12)      DEFAULT NULL,
                refresh_token    varchar(800) DEFAULT NULL,
                refresh_lifetime int(12)      DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE  KEY api_type (api_type)
        ) {$charset_collate};";

    dbDelta($sql);
}



function getOAuth($apiType) {
    global $wpdb;
    $table_name = 'oauth_table';

    $result = $wpdb->get_row("SELECT * FROM {$table_name} WHERE api_type = '$apiType'", OBJECT);

    if (empty($result)) {
        switch ($apiType) {
            case 'crm_asp_net':
                $status = $wpdb->insert($table_name,
                    array( 'api_type' => $apiType, 'login' => 'Сайт', 'password' => 'Q#8J5Ko9m:k^' ),
                    array( '%s', '%s', '%s' )
                );
                if ($status)
                {
                    $result = getOAuth($apiType);
                }
                break;
            case 'crm_symfony':
                $status = $wpdb->insert($table_name,
                    array( 'api_type' => $apiType, 'login' => 'itea.site', 'password' => 'HeWwh7qMp@naxrdb' ),
                    array( '%s', '%s', '%s' )
                );
                if ($status)
                {
                    $result = getOAuth($apiType);
                }
                break;
            case 'crm_symfony_prod_demo':
                $status = $wpdb->insert($table_name,
                    array( 'api_type' => $apiType, 'login' => 'admin', 'password' => '123' ),
                    array( '%s', '%s', '%s' )
                );
                if ($status)
                {
                    $result = getOAuth($apiType);
                }
                break;
            case 'crm_symfony_dev':
                $status = $wpdb->insert($table_name,
                    array( 'api_type' => $apiType, 'login' => 'admin', 'password' => 'iteacrm-admin' ), //'123'
                    array( '%s', '%s', '%s' )
                );
                if ($status)
                {
                    $result = getOAuth($apiType);
                }
                break;
        }
    }

    return $result;
}



function updateOAuth($apiId, $accessToken, $accessLifetime, $refreshToken) {
    global $wpdb;
    $table_name = 'oauth_table';

    $status = $wpdb->update($table_name,
        array( 'access_token' => $accessToken, 'access_lifetime' => $accessLifetime, 'refresh_token' => $refreshToken ),
        array( 'id' => $apiId ),
        array( '%s', '%d', '%s' ),
        array( '%d' )
    );

    return $status === false ? false : true;
}
