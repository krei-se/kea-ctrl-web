<h2>Reservations IPv6</h3>
    <?php

    /** @var array $subnets6 */
    foreach ($subnets6 as $subnet6) {

        $hosts6_res = send_kea_command('reservation-get-all', ['dhcp6'], ['subnet-id' => $subnet6['id']]);

        $hosts6 = sort_kea_items($hosts6_res['arguments']['hosts'] ?? []);


    ?>
        <h4>Subnet ID <?= $subnet6['id'] ?></h4>
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
                    <td><?= $host6['duid'] ?></td>
                    <td><?= implode('<br>', $host6['ip-addresses']) ?></td>

                    <td><?= $host6['hostname'] ?></td>
                    <td><?= implode('<br>', array_column($host6['option-data'], '@TODO')) ?></td>
                    <td>
                        <form action="index.php?page=static_host6_edit" method="POST">
                            <input type="hidden" name="subnet-id" value="<?= $subnet6['id'] ?>" />
                            <input type="hidden" name="identifier-type" value="duid" />
                            <input type="hidden" name="duid" value="<?= $host6['duid'] ?>" />
                            <input type="hidden" name="subnet-placeholder" value="<?= $subnet6['subnet'] ?>" />

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
