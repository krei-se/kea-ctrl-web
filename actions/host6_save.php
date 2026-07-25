<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['duid']) &&
    isset($_POST['hostname']) &&

    isset($_POST['original-subnet-id']) &&
    isset($_POST['original-duid']) &&
    isset($_POST['original-hostname'])


) {

    $ip_addresses = $_POST['ip-addresses'] ?? [];

    $host6_save_res = send_kea_command('reservation-update', ['dhcp6'], [
        'reservation' => [
            'subnet-id' => (int)$_POST['original-subnet-id'],
            'duid' => $_POST['original-duid'],
            'ip-addresses' => $ip_addresses,
            'hostname' => $_POST['hostname'],

        ]

    ]);

    echo pre($host6_save_res);
}
