<h2>Leases IPv6</h2>
<?php

/** @var array $subnets6 */
foreach ($subnets6 as $subnet6) {

    $leases6_res = send_kea_command('lease6-get-all', ['dhcp6'], ['subnets' => [$subnet6['id']]]);

    $leases6 = sort_kea_items($leases6_res['arguments']['leases'] ?? []);



?>

    <h4>Subnet ID <?= hsc($subnet6['id']) ?></h4>
    <table>
        <tr>
            <th>DUID</th>
            <th>IP-Address</th>
            <th>Hostname</th>
            <th colspan=2>Actions</th>

        </tr>


        <?php

        foreach ($leases6 as $lease6) {
        ?>

            <tr>
                <td><?= hsc($lease6['duid']) ?></td>
                <td><?= hsc($lease6['ip-address']) ?></td>
                <td><?= hsc($lease6['hostname']) ?></td>
                <td>
                    <form action="index.php?page=static_host6_edit" method="POST">
                        <?= csrf_hidden() ?>

                        <input type="hidden" name="dont-query" value="1" />

                        <input type="hidden" name="subnet-id" value="<?= hsc($subnet6['id']) ?>" />
                        <input type="hidden" name="identifier-type" value="duid" />
                        <input type="hidden" name="duid" value="<?= hsc($lease6['duid']) ?>" />
                        <input type="hidden" name="ip-address" value="<?= hsc($lease6['ip-address']) ?>" />
                        <input type="hidden" name="hostname" value="<?= hsc($lease6['hostname']) ?>" />

                        <input type="hidden" name="subnet-placeholder" value="<?= hsc($subnet6['subnet']) ?>" />

                        <button type="submit">Edit as static</button>
                    </form>
                </td>
                <td>
                    <form action="index.php" method="POST">
                        <?= csrf_hidden() ?>

                        <input type="hidden" name="ip-address" value="<?= hsc($lease6['ip-address']) ?>" />
                        <button type="submit" name="action" value="lease6_del" onclick="return confirm('Really delete this lease?');">Delete</button>

                    </form>
                </td>

            </tr>
        <?php
        }

        ?>

    </table>
<?php

    // echo pre($leases6);




    // echo pre($leases6_res);
}
