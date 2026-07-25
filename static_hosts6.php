<h2>Reservations IPv6</h2>
<?php

/** @var array $subnets6 */
foreach ($subnets6 as $subnet6) {

    $hosts6_res = send_kea_command('reservation-get-all', ['dhcp6'], ['subnet-id' => $subnet6['id']]);

    $hosts6 = sort_kea_items($hosts6_res['arguments']['hosts'] ?? []);


?>
    <h4>Subnet ID <?= hsc($subnet6['id']) ?></h4>
    <form action="index.php?page=static_host6_edit" method="POST">
        <?= csrf_hidden() ?>

        <input type="hidden" name="dont-query" value="1" />
        <input type="hidden" name="subnet-id" value="<?= hsc($subnet6['id']) ?>" />
        <input type="hidden" name="subnet-placeholder" value="<?= hsc($subnet6['subnet']) ?>" />

        <button type="submit">New</button>

    </form>
    <table>

        <tr>
            <th>DUID</th>
            <th>IP-Addresses</th>
            <th>Hostname</th>
            <th>Option-Data @TODO</th>
            <th>Action</th>


        </tr>


        <?php foreach ($hosts6 as $host6) {

        ?>

            <tr>
                <td><?= hsc($host6['duid']) ?></td>
                <td><?= implode('<br>', array_map('hsc', $host6['ip-addresses'])) ?></td>

                <td><?= hsc($host6['hostname']) ?></td>
                <td><?= implode('<br>', array_map('hsc', array_column($host6['option-data'], '@TODO'))) ?></td>
                <td>
                    <form action="index.php?page=static_host6_edit" method="POST">
                        <?= csrf_hidden() ?>

                        <input type="hidden" name="subnet-id" value="<?= hsc($subnet6['id']) ?>" />
                        <input type="hidden" name="identifier-type" value="duid" />
                        <input type="hidden" name="duid" value="<?= hsc($host6['duid']) ?>" />
                        <input type="hidden" name="subnet-placeholder" value="<?= hsc($subnet6['subnet']) ?>" />

                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
<?php

    // echo pre($hosts6);




    // echo pre($config_res);
}
