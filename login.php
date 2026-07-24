<!-- login.php -->
<h2>Kea Admin Login</h2>

<?php if (!empty($login_error)): ?>
    <p style="color: red;"><strong>Error:</strong> <?php echo htmlspecialchars($login_error); ?></p>
<?php endif; ?>

<form action="index.php" method="POST">
    <input type="hidden" name="action" value="login">
    <table="0" cellpadding="5">
        <tr>
            <td><label for="user">Username:</label></td>
            <td><input type="text" id="user" name="user" required autofocus></td>
        </tr>
        <tr>
            <td><label for="pass">Password:</label></td>
            <td><input type="password" id="pass" name="pass" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Login</button></td>
        </tr>
        </table>
</form>