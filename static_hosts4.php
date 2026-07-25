<h2>Reservations IPv4</h2>
<?php

/** @var array $subnets4 */
foreach ($subnets4 as $subnet4) {

    $hosts4_res = send_kea_command('reservation-get-all', ['dhcp4'], ['subnet-id' => $subnet4['id']]);

    $hosts4 = $hosts4_res['arguments']['hosts'] ?? [];


?>

    <h4>Subnet ID <?= $subnet4['id'] ?></h4>
    <table>
        <tr>
            <th>HW-Address</th>
            <th>IP-Address</th>
            <th>Hostname</th>
            <th>Option-Data @TODO</th>
            <th>Action</th>

        </tr>


        <?php foreach ($hosts4 as $host4) {

        ?>

            <tr>
                <td><?= $host4['hw-address'] ?></td>
                <td><?= $host4['ip-address'] ?></td>
                <td><?= $host4['hostname'] ?></td>
                <td><?= implode('<br>', array_column($host4['option-data'], '@TODO')) ?></td>
                <td>
                    <form action="index.php?page=static_host4_edit" method="POST">
                        <input type="hidden" name="subnet-id" value="<?= $subnet4['id'] ?>" />
                        <input type="hidden" name="identifier-type" value="hw-address" />
                        <input type="hidden" name="hw-address" value="<?= $host4['hw-address'] ?>" />
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
<?php

    // echo pre($hosts4);




    // echo pre($config_res);
}
