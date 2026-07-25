<?php

if (
    isset($_POST['ip-address'])

) {

    $lease6_del_res = send_kea_command('lease6-del', ['dhcp4'], [
        'ip-address' => $_POST['ip-address'],

    ]);

    echo pre($lease6_del_res);
}
