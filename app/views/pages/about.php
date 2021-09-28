<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<div class="about-container d-flex align-items-center">
    <div class="about-img ">
        <img src="../public/img/doge.jpg" alt='profile'>
    </div>
    <div class="about-content">
        <h1><?php echo $data['title'] ?></h1>
        <h5><?php echo $data['description']; ?></h5>
        <P>App version <strong><?php echo APP_VERSION; ?></strong></P>
    </div>
    <div class="wave"></div>
</div>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>