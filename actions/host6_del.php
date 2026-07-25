<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['duid']) &&
    isset($_POST['hostname']) &&

    isset($_POST['original-subnet-id']) &&
    isset($_POST['original-duid'])


) {

    $host6_del_res = send_kea_command('reservation-del', ['dhcp6'], [
        'subnet-id' => (int)$_POST['subnet-id'],
        'identifier-type' => 'duid',
        'identifier' => $_POST['duid'],

    ]);


    echo pre($host6_del_res);
}
