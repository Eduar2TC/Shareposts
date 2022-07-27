<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<!--
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
-->
<section class="about">
    <div class="container-lg my-3">
        <div class="row g-0 vh-100 overflow-auto rounded-3">
            <div class="col-md-4 bg-primary d-flex justify-content-center align-items-center flex-column about-me p-3">
            </div>
            <div class="col-md-8 bg-light p-3 d-flex justify-content-around flex-column">
                <h2 class="w-bold text-uppercase text-center text-md-start">Share your posts!</h2>
                <p class="display-5 text-center text-center text-md-start">Share your life with all world people!</p>
                <div class="align-items-center h-60 d-flex justify-content-center align-items-center flex-column">
                    <div class="lead text-center text-md-end fs-4">
                        Share your ideas with people from all over the world. Write any idea you have in mind with everyone!
                    </div>
                    <div class="gifs-container d-flex g-2">
                        <div class="col"><img src="https://c.tenor.com/rS9y2nDW8HoAAAAM/its-bbq.gif" alt="thanks"></div>
                        <div class="col"><img src="<?php echo URL_ROOT ?>/public/img/about/crazy-cat.gif" alt="crazy cat"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>