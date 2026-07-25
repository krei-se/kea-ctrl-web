<h2>Leases IPv4</h2>
<?php

/** @var array $subnets4 */
foreach ($subnets4 as $subnet4) {

    $leases4_res = send_kea_command('lease4-get-all', ['dhcp4'], ['subnets' => [$subnet4['id']]]);

    $leases4 = $leases4_res['arguments']['leases'] ?? [];


    foreach ($leases4_res['arguments']['leases'] as $lease4_index => $lease4) {

        $leases4[$lease4_index] = $lease4;
    }

?>

    <h4>Subnet ID <?= $subnet4['id'] ?></h4>
    <table>
        <tr>
            <th>HW-Address</th>
            <th>IP-Address</th>
            <th>Hostname</th>
            <th>Action</th>

        </tr>


        <?php

        foreach ($leases4 as $lease4) {
        ?>

            <tr>
                <td><?= $lease4['hw-address'] ?></td>
                <td><?= $lease4['ip-address'] ?></td>
                <td><?= $lease4['hostname'] ?></td>
                <td>
                    <form action="index.php?page=static_host4_edit" method="POST">

                        <input type="hidden" name="from-lease" value="1" />

                        <input type="hidden" name="subnet-id" value="<?= $subnet4['id'] ?>" />
                        <input type="hidden" name="identifier-type" value="hw-address" />
                        <input type="hidden" name="hw-address" value="<?= $lease4['hw-address'] ?>" />
                        <input type="hidden" name="ip-address" value="<?= $lease4['ip-address'] ?>" />
                        <input type="hidden" name="hostname" value="<?= $lease4['hostname'] ?>" />
                        <button type="submit">Edit as static</button>
                    </form>
                </td>
                <td>
                    <form action="index.php" method="POST">

                        <input type="hidden" name="ip-address" value="<?= $lease4['ip-address'] ?>" />
                        <button type="submit" name="action" value="lease4_del" onclick="return confirm('Really delete this lease?');">Delete</button>

                    </form>
                </td>

            </tr>
        <?php
        }

        ?>

    </table>
<?php

    // echo pre($leases4);




    // echo pre($leases4_res);
}
