<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<div class="bg-img mt-3 rounded-3">
    <div class="bg-linear-gradient shadow mx-0 p-5">
        <div class="container-fluid">
            <h1 class="display-3 text-white"><?php echo $data['title']; ?></h1>
            <p class="lead text-white"><?php echo $data['description']; ?></p>
        </div>
    </div>

</div>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>