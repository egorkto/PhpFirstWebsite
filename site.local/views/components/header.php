<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 */
$user = $auth->user();
?>

<header>
        <h3>User: <?php echo $user['email'] ?></h3>
        <button>Logout</button>
        <hr>
</header>