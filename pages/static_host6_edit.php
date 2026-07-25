<?php

if (
    isset($_POST['subnet-id']) &&
    isset($_POST['identifier-type']) &&
    isset($_POST['duid'])
) {

    // static edit
    if (!isset($_POST['from-lease'])) {

        $host6_res = send_kea_command("reservation-get", ["dhcp6"], [
            "subnet-id" => (int)$_POST['subnet-id'],
            "identifier-type" => $_POST['identifier-type'], // "duid"
            "identifier" => $_POST['duid'],
        ]);

        //    echo pre($host6_res);

        // will be 3 if host not found so safe to use 0
        if ($host6_res['result'] == 0) {

            $host6 = $host6_res['arguments'];
        }
    }

    // from lease edit
    else {

        $host6['subnet-id'] = $_POST['subnet-id'];
        $host6['duid'] = $_POST['duid'];
        $host6['ip-addresses'] = [$_POST['ip-address']];

        $raw_hostname = rtrim($_POST['hostname'] ?? '', '.');
        $host6['hostname'] = explode('.', $raw_hostname)[0];
    }

    // echo pre($host6);

    if ($host6) {

?>

        <h3>Edit Reservation v6</h3>

        <form action="index.php" method="POST">

            <input type="hidden" name="original-subnet-id" value="<?= $host6['subnet-id'] ?>" />
            <input type="hidden" name="original-duid" value="<?= $host6['duid'] ?>" />
            <input type="hidden" name="original-hostname" value="<?= $host6['hostname'] ?>" />


            <table>

                <tr>
                    <th>subnet-id</th>
                    <td><input type="text" name="subnet-id" value="<?= $host6['subnet-id'] ?>" /></td>
                </tr>
                <tr>
                    <th>duid</th>
                    <td><input type="text" name="duid" value="<?= $host6['duid'] ?>" size=40 /></td>
                </tr>
                <tbody id="ipv6-list">
                    <?php foreach ($host6['ip-addresses'] as $ip_address): ?>
                        <tr>
                            <th>IPv6 Address</th>
                            <td>
                                <input type="text" name="ip-addresses[]" value="<?= htmlspecialchars($ip_address) ?>" />
                                <button type="button" onclick="this.closest('tr').remove()">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tr>
                    <th></th>
                    <td>
                        <!-- Button to add new row -->
                        <button type="button" onclick="addIpRow()">+ Add IPv6 Address</button>
                    </td>
                </tr>
                <tr>
                    <th>hostname</th>
                    <td><input type="text" name="hostname" value="<?= $host6['hostname'] ?>" /></td>
                </tr>


            </table>

            <?php if (!isset($_POST['from-lease'])) { ?>

                <button type="submit" name="action" value="host6_save">Save IP-Addresses</button>
                <button type="submit" name="action" value="host6_add">Save Reservation as new</button>
                <button type="submit" name="action" value="host6_del" onclick="return confirm('Really delete this host reservation?');">Delete</button>


            <?php } else { ?>

                <button type="submit" name="action" value="host6_add">Save Lease as Reservation</button>

            <?php } ?>

        </form>


        <script>
            function addIpRow() {
                const tbody = document.getElementById('ipv6-list');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <th>IPv6 Address</th>
                    <td>
                        <input type="text" name="ip-addresses[]" value="<?= substr($_POST['subnet-placeholder'], 0, strpos($_POST['subnet-placeholder'], '/'))  ?>" placeholder="<?= $_POST['subnet-placeholder']  ?>" />
                        <button type="button" onclick="this.closest('tr').remove()">Remove</button>
                    </td>
                `;

                tbody.appendChild(newRow);
            }
        </script>

<?php
    }
}
