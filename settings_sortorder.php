<?php

$settings_sortorder = $_COOKIE['sortorder'] ?? 'ip-address';

?>

<form action="index.php" method="POST">
    <?= csrf_hidden() ?>

    <table>
        <tr>
            <td>Sort Order:</td>
            <td><select name="sortorder">

                    <?php foreach (['ip-address', 'hostname', 'identifier'] as $sortorder) {

                        echo "<option value='$sortorder'";

                        if ($settings_sortorder == $sortorder) {

                            echo " selected";
                        }

                        echo ">$sortorder</option>";
                    }      ?>
                </select>
                <button type="submit" name="action" value="settings_change_sortorder">save</button>
            </td>
        </tr>
    </table>

</form>