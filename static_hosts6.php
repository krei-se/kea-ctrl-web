<?php

/** @var array $subnets6 */
foreach ($subnets6 as $subnet6) {

    $config_res = send_kea_command('reservation-get-all', ['dhcp6'], ['subnet-id' => $subnet6['id']]);

    $hosts6 = [];

    foreach ($config_res['arguments']['hosts'] as $host_index => $host6) {

        $hosts6[$host_index] = $host6;
    }

?>
    <table>

        <tr>
            <th>DUID</th>
            <th>IP-Addresses</th>
            <th>Hostname</th>
            <th>Option-Data @TODO</th>

        </tr>


        <?php foreach ($hosts6 as $host6) {

        ?>

            <tr>
                <td><?= $host6['duid'] ?></td>
                <td><?= implode('<br>', $host6['ip-addresses']) ?></td>

                <td><?= $host6['hostname'] ?></td>
                <td><?= implode('<br>', array_column($host6['option-data'], '@TODO')) ?></td>
            </tr>
        <?php
        }
        ?>

    </table>
<?php

    echo pre($hosts6);




    // echo pre($config_res);
}
