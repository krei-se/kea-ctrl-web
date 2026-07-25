<?php

csrf_check();

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

    $host4_save_res = send_kea_command('reservation-update', ['dhcp4'], [
        'reservation' => [
            'subnet-id' => (int)$_POST['original-subnet-id'],
            'hw-address' => $_POST['original-hw-address'],
            'ip-address' => $_POST['ip-address'],
            'hostname' => $_POST['hostname'],

        ]

    ]);

    echo pre($host4_save_res);
}
