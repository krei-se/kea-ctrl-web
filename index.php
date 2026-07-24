<?php
// index.php
session_start();

ini_set('display_errors', true); // can stay on as i mak nmo errors

include 'base.php'; // format helpers pr() and pre()
include 'functions.php'; // only send_kea_command() to talk with the ctrl-agent

include 'settings.php';



include 'header.php'; // there are some stylesheets here, i promise MINIMAL

// form submit actions

$post_action = $_POST['action'] ?? '';

switch ($post_action) {

    case 'login':
        include 'actions/login.php';
        break;

    case 'logout':
        include 'actions/logout.php';
        break;
}

$is_logged_in = !empty($_COOKIE['kea_user']) && !empty($_COOKIE['kea_pass']);

if (!$is_logged_in) {

    include 'login.php';
} else {

?>

    <body style="font-family: monospace; margin: 20px;">

        <h3>Logged in as <?= $_COOKIE['kea_user'] ?></h3>
        <form action="index.php" method="POST" style="display:inline;">
            <input type="hidden" name="action" value="logout">
            <button type="submit">Logout</button>
        </form>


        <h1>Kea Control Web</h1>

        <?php include 'subnets4.php'; ?>
        <?php include 'subnets6.php'; ?>

        <?php include 'static_hosts4.php'; ?>
        <?php include 'leases4.php'; ?>

        <?php include 'static_hosts6.php'; ?>
        <?php include 'leases6.php'; ?>


        <?php include 'debugcommands.php'; ?>




    </body>

<?php }



include 'footer.php';
