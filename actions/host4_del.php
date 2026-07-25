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

    $host4_del_res = send_kea_command('reservation-del', ['dhcp4'], [
        'subnet-id' => (int)$_POST['subnet-id'],
        'identifier-type' => 'hw-address',
        'identifier' => $_POST['hw-address'],
        // 'hostname' => $_POST['hostname'],


    ]);

    // You can also use the ip-address 

    // $host4_del_res = send_kea_command('reservation-del', ['dhcp4'], [
    //     'subnet-id' => (int)$_POST['subnet-id'],
    //     'ip-address' => $_POST['ip-address'],
    //     // 'hostname' => $_POST['hostname'],
    // ]);



    echo pre($host4_del_res);
}
