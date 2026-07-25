<?php

if (
    isset($_POST['ip-address'])

) {

    $lease4_del_res = send_kea_command('lease4-del', ['dhcp4'], [
        'ip-address' => $_POST['ip-address'],

    ]);

    echo pre($lease4_del_res);
}
