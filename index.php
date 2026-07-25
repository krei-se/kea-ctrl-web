<?php
// index.php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// dont do that when talking with the API
// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
// $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_SPECIAL_CHARS);

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

    // Settings

    case 'settings_change_sortorder':
        include 'actions/settings_change_sortorder.php';
        break;


    // Reservations v4
    case 'host4_save':
        include 'actions/host4_save.php';
        break;
    case 'host4_add':
        include 'actions/host4_add.php';
        break;
    case 'host4_del':
        include 'actions/host4_del.php';
        break;

    // Reservations v6
    case 'host6_save':
        include 'actions/host6_save.php';
        break;
    case 'host6_add':
        include 'actions/host6_add.php';
        break;
    case 'host6_del':
        include 'actions/host6_del.php';
        break;

    // Leases v4

    case 'lease4_del':
        include 'actions/lease4_del.php';
        break;

    // Leases v6

    case 'lease6_del':
        include 'actions/lease6_del.php';
        break;
}


$get_page = $_GET['page'] ?? '';

switch ($get_page) {

    case 'static_host4_edit':
        include 'pages/static_host4_edit.php';
        break;
    case 'static_host6_edit':
        include 'pages/static_host6_edit.php';
        break;
}



$is_logged_in = !empty($_COOKIE['kea_user']) && !empty($_SESSION['kea_pass']);

if (!$is_logged_in) {

    include 'login.php';
} else {

?>

    <body style="font-family: monospace; margin: 20px;">

        <h3>Logged in as <?= hsc($_COOKIE['kea_user']) ?></h3>
        <form action="index.php" method="POST" style="display:inline;">
            <?=  csrf_hidden() ?>
            <input type="hidden" name="action" value="logout">
            <button type="submit">Logout</button>
        </form>

        <br><br>

        <h1><a href="/">Kea Control Web</a></h1>



        <?php include 'settings_sortorder.php'; ?>

        <br><br>

        <?php include 'subnets4.php'; ?>
        <?php include 'subnets6.php'; ?>

        <?php include 'static_hosts4.php'; ?>
        <?php include 'leases4.php'; ?>

        <?php include 'static_hosts6.php'; ?>
        <?php include 'leases6.php'; ?>


        <?php // include 'debugcommands.php'; 
        ?>




    </body>

<?php }



include 'footer.php';
