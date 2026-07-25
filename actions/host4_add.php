<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['hw-address']) &&
    isset($_POST['ip-address']) &&
    isset($_POST['hostname']) &&

    isset($_POST['original-subnet-id']) &&
    isset($_POST['original-hw-address']) &&
    isset($_POST['original-ip-address']) &&
    isset($_POST['original-hostname'])


) {

    $host4_add_res = send_kea_command('reservation-add', ['dhcp4'], [
        'reservation' => [
            'subnet-id' => (int)$_POST['subnet-id'],
            'hw-address' => $_POST['hw-address'],
            'ip-address' => $_POST['ip-address'],
            'hostname' => $_POST['hostname'],

        ]

    ]);

    echo pre($host4_add_res);
}
