<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['duid']) &&
    isset($_POST['hostname']) &&

    isset($_POST['original-subnet-id']) &&
    isset($_POST['original-duid']) &&
    isset($_POST['original-hostname'])


) {

    $host6_add_res = send_kea_command('reservation-add', ['dhcp6'], [
        'reservation' => [
            'subnet-id' => (int)$_POST['subnet-id'],
            'duid' => $_POST['duid'],
            'ip-addresses' => $_POST['ip-addresses'],
            'hostname' => $_POST['hostname'],
        ]

    ]);

    echo pre($host6_add_res);
}
