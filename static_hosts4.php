<?php

/** @var array $subnets4 */
foreach ($subnets4 as $subnet4) {

    $config_res = send_kea_command('reservation-get-all', ['dhcp4'], ['subnet-id' => $subnet4['id']]);

    $hosts4 = [];

    foreach ($config_res['arguments']['hosts'] as $host_index => $host4) {

        $hosts4[$host_index] = $host4;
    }

?>
    <table>

        <tr>
            <th>HW-Address</th>
            <th>IP-Address</th>
            <th>Hostname</th>
            <th>Option-Data @TODO</th>

        </tr>


        <?php foreach ($hosts4 as $host4) {

        ?>

            <tr>
                <td><?= $host4['hw-address'] ?></td>
                <td><?= $host4['ip-address'] ?></td>
                <td><?= $host4['hostname'] ?></td>
                <td><?= implode('<br>', array_column($host4['option-data'], '@TODO')) ?></td>
            </tr>
        <?php
        }
        ?>

    </table>
<?php

    // echo pre($hosts4);




    // echo pre($config_res);
}
