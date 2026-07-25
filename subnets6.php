<?php

$config_res = send_kea_command('config-get', ['dhcp6']);

$subnets6 = [];

if (!empty($config_res['arguments']['Dhcp6']['subnet6'])) {

    foreach ($config_res['arguments']['Dhcp6']['subnet6'] as $subnet6_res) {

        $subnets6[$subnet6_res['id']] = $subnet6_res;
    }
}

?>

<h2>Subnets V6</h2>

<table>

    <tr>
        <th>Subnet 6 ID</th>
        <th>Subnet</th>
        <th>Pools</th>
    </tr>
    <?php foreach ($subnets6 as $subnet6) {

    ?>

        <tr>
            <td><?= hsc($subnet6['id']) ?></td>
            <td><?= hsc($subnet6['subnet']) ?></td>
            <td><?= implode('<br>', array_map('hsc', array_column($subnet6['pools'], 'pool'))) ?></td>
        </tr>
    <?php
    }
    ?>

</table>
<?php
// echo pre($subnets6);


// echo pre($config_res);
