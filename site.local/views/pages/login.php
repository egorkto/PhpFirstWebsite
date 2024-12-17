<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>

<?php $view->component('start') ?>
<h1>Login</h1>

<form action="/login" method="post">
    <?php if ($session->has('email')) { ?>
        <p style="color:red;"> </p>
        <ul>
            <?php foreach ($session->getFlash('email') as $error) { ?>
                <li style="color: red;"><?php echo $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <p>email</p>
    <input type="text", name="email">
    <p>password</p>
    <input type="password" name="password">
    <button>Login</button>
</form>
<?php $view->component('end') ?>