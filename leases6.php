<h2>Leases IPv6</h2>
<?php

/** @var array $subnets6 */
foreach ($subnets6 as $subnet6) {

    $leases6_res = send_kea_command('lease6-get-all', ['dhcp6'], ['subnets' => [$subnet6['id']]]);

    $leases6 = $leases6_res['arguments']['leases'] ?? [];



    foreach ($leases6_res['arguments']['leases'] as $lease6_index => $lease6) {

        $leases6[$lease6_index] = $lease6;
    }

?>

    <h4>Subnet ID <?= $subnet6['id'] ?></h4>
    <table>
        <tr>
            <th>DUID</th>
            <th>IP-Address</th>
            <th>Hostname</th>
            <th>Action</th>

        </tr>


        <?php

        foreach ($leases6 as $lease6) {
        ?>

            <tr>
                <td><?= $lease6['duid'] ?></td>
                <td><?= $lease6['ip-address'] ?></td>
                <td><?= $lease6['hostname'] ?></td>
                <td>
                    <form action="index.php?page=static_host6_edit" method="POST">

                        <input type="hidden" name="from-lease" value="1" />

                        <input type="hidden" name="subnet-id" value="<?= $subnet6['id'] ?>" />
                        <input type="hidden" name="identifier-type" value="duid" />
                        <input type="hidden" name="duid" value="<?= $lease6['duid'] ?>" />
                        <input type="hidden" name="ip-address" value="<?= $lease6['ip-address'] ?>" />
                        <input type="hidden" name="hostname" value="<?= $lease6['hostname'] ?>" />

                        <input type="hidden" name="subnet-placeholder" value="<?= $subnet6['subnet'] ?>" />

                        <button type="submit">Edit as static</button>
                    </form>
                </td>
                <td>
                    <form action="index.php" method="POST">

                        <input type="hidden" name="ip-address" value="<?= $lease6['ip-address'] ?>" />
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
