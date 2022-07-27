<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<div class="bg-img mt-3 rounded-3">
    <div class="bg-linear-gradient shadow mx-0 p-5">
        <div class="container-fluid">
            <h1 class="display-3 text-white"><?php echo $data['title']; ?></h1>
            <p class="lead text-white"><?php echo $data['description']; ?></p>
        </div>
    </div>

</div>
<!-- <section class="main-content">
    <div class="container-lg">
        <div class="row <--justify-content-center--">
            <div class="col-sm-6 col-md-3 col-lg-4">
                <div class="p-5 m-2 bg-primary text-light">1</div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-4">
                <div class="p-5 m-2 bg-primary text-light">1</div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-4">
                <div class="p-5 m-2 bg-primary text-light">1</div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-4">
                <div class="p-5 m-2 bg-primary text-light">1</div>
            </div>
        </div>
    </div>
</section> -->
<section class="main-content">
    <div class="container-lg">
        <div class="card mt-5 p-2" style="max-width: 500px ;">
            <div class="row align-items-center gap-0">
                <div class="col-3 avatar justify-content-center">
                    <img src="https://i.pinimg.com/originals/bd/b0/40/bdb0409f08d0ffd8bc732f4110cc6ad9.jpg" class="img-fluid" alt="profile-avatar">
                </div>
                <div class="col">
                    <div class="body bg-light rounded p-3">
                        <div class="title d-flex justify-content-between">
                            <h5 class="fw-normal fs-5 text-primary">Lorena Herrera</h5>
                            <h5 class="fs-5 text-muted">10/11/2023</h5>
                        </div>
                        <p class="card-text text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta, dignissimos.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-end border-top-0 align-items-center"><span class="fs-5 fw-bold me-2">25</span><i class="fa-solid fa-thumbs-up fa-2x" style="color: #689fbd;"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>