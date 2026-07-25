<?php

$config_res = send_kea_command('config-get', ['dhcp4']);

$subnets4 = [];

if (!empty($config_res['arguments']['Dhcp4']['subnet4'])) {

    foreach ($config_res['arguments']['Dhcp4']['subnet4'] as $subnet4_res) {

        $subnets4[$subnet4_res['id']] = $subnet4_res;
    }
}

?>

<h2>Subnets V4</h2>

<table>

    <tr>
        <th>Subnet 4 ID</th>
        <th>Subnet</th>
        <th>Pools</th>
    </tr>
    <?php foreach ($subnets4 as $subnet4) {

    ?>

        <tr>
            <td><?= $subnet4['id'] ?></td>
            <td><?= $subnet4['subnet'] ?></td>
            <td><?= implode('<br>', array_column($subnet4['pools'], 'pool')) ?></td>
        </tr>
    <?php
    }
    ?>

</table>
<?php
// echo pre($subnets4);



// echo pre($config_res);