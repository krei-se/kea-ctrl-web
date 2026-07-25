<h2>Reservations IPv4</h2>
<?php

/** @var array $subnets4 */
foreach ($subnets4 as $subnet4) {

    $hosts4_res = send_kea_command('reservation-get-all', ['dhcp4'], ['subnet-id' => $subnet4['id']]);

    $hosts4 = sort_kea_items($hosts4_res['arguments']['hosts'] ?? []);


?>

    <h4>Subnet ID <?= hsc($subnet4['id']) ?></h4>
    <form action="index.php?page=static_host4_edit" method="POST">
        <?= csrf_hidden() ?>

        <input type="hidden" name="dont-query" value="1" />
        <input type="hidden" name="subnet-id" value="<?= hsc($subnet4['id']) ?>" />
        <button type="submit">New</button>

    </form>

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
                <td><?= hsc($host4['hw-address']) ?></td>
                <td><?= hsc($host4['ip-address']) ?></td>
                <td><?= hsc($host4['hostname']) ?></td>
                <td><?= implode('<br>', array_map('hsc', array_column($host4['option-data'], '@TODO'))) ?></td>
                <td>
                    <form action="index.php?page=static_host4_edit" method="POST">
                        <?= csrf_hidden() ?>

                        <input type="hidden" name="subnet-id" value="<?= hsc($subnet4['id']) ?>" />
                        <input type="hidden" name="identifier-type" value="hw-address" />
                        <input type="hidden" name="hw-address" value="<?= hsc($host4['hw-address']) ?>" />
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
