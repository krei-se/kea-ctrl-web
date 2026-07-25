<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['identifier-type']) &&
    isset($_POST['hw-address'])
) {

    // static edit
    if (!isset($_POST['from-lease'])) {

        $host4_res = send_kea_command("reservation-get", ["dhcp4"], [
            "subnet-id" => (int)$_POST['subnet-id'],
            "identifier-type" => $_POST['identifier-type'], // "hw-address"
            "identifier" => $_POST['hw-address'],
        ]);

        //    echo pre($host4_res);

        // will be 3 if host not found so safe to use 0
        if ($host4_res['result'] == 0) {

            $host4 = $host4_res['arguments'];
        }
    }

    // from lease edit
    else {

        $host4['subnet-id'] = $_POST['subnet-id'];
        $host4['hw-address'] = $_POST['hw-address'];
        $host4['ip-address'] = $_POST['ip-address'];
        $host4['hostname'] = $_POST['hostname'];
    }

    // echo pre($host4);

    if ($host4) {


?>

        <h3>Edit Host v4</h3>

        <form action="index.php" method="POST">

            <input type="hidden" name="original-subnet-id" value="<?= $host4['subnet-id'] ?>" />
            <input type="hidden" name="original-hw-address" value="<?= $host4['hw-address'] ?>" />
            <input type="hidden" name="original-ip-address" value="<?= $host4['ip-address'] ?>" />
            <input type="hidden" name="original-hostname" value="<?= $host4['hostname'] ?>" />


            <table>

                <tr>
                    <th>subnet-id</th>
                    <td><input type="text" name="subnet-id" value="<?= $host4['subnet-id'] ?>" /></td>
                </tr>
                <tr>
                    <th>hw-address</th>
                    <td><input type="text" name="hw-address" value="<?= $host4['hw-address'] ?>" /></td>
                </tr>
                <tr>
                    <th>ip-address</th>
                    <td><input type="text" name="ip-address" value="<?= $host4['ip-address'] ?>" /></td>
                </tr>
                <tr>
                    <th>hostname</th>
                    <td><input type="text" name="hostname" value="<?= $host4['hostname'] ?>" /></td>
                </tr>


            </table>

            <?php if (!isset($_POST['from-lease'])) { ?>

                <button type="submit" name="action" value="host4_save">Save IP-Address</button>
                <button type="submit" name="action" value="host4_add">Save Host as new</button>
                <button type="submit" name="action" value="host4_del" onclick="return confirm('Really delete this host reservation?');">Delete</button>

            <?php } else { ?>

                <button type="submit" name="action" value="host4_add">Save Lease as Reservation</button>

            <?php } ?>

        </form>

<?php
    }
}
