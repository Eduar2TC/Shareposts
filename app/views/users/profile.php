<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URL_ROOT ?>/posts" class="btn btn-outline-dark mt-2">
    <i class="fa fa-arrow-left"></i> Back
</a>
<div class="row">
    <div class="col md-12 p-3">
        <div class="card profile-details">
            <div class="row card-body">
                <div class="col col-md-auto p-2 d-flex justify-content-center">
                    <div class="img-profile-external-container">
                        <div class="img-profile-internal-container">
                            <img src=" <?php echo ( $_SESSION['user_img'] ) != '/app/views/users/img/' ? URL_ROOT . $_SESSION['user_img'] : URL_ROOT . '/app/views/users/img/' . $_SESSION['user_name'] . '.png'; ?> " alt="profile image">
                        </div>
                    </div>
                </div>
                <div class="col col-md-6 col-lg-6">
                    <h2 class="mb-0"><?php echo $_SESSION['user_name']; ?></h2>
                    <span class="job-title"><?php echo $data['data_user']->job; ?></span>
                    <p><?php echo $data['data_user']->about_me; ?></p>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['data_user']->user_id) : ?>
                        <a href="#" class="btn btn-success">Edit Profile</a>
                    <?php else : ?>
                        <a href="#" class="btn btn-success">View Profile</a>
                    <?php endif; ?>
                </div>
                <div class="col col-md-3 col-lg-3 bg-light d-flex justify-content-center">
                    <div class="d-grid gap-5">
                        <div class="profile-posts">
                            <span>Post make</span>
                            <h3><?php echo $data['data_user']->number_posts; ?></h3>
                            <span>Email</span>
                            <h5><?php echo $data['data_user']->email; ?></h5>
                        </div>
                        <div class="profile-social align-middle">
                            <ul>
                                <a href="#">
                                    <li class="linkedin"><i class="fab fa-linkedin-in"></i></li>
                                </a>
                                <a href="#">
                                    <li class="facebook"><i class="fab fa-facebook-f"></i></li>
                                </a>
                                <a href="#">
                                    <li class="twitter"><i class="fab fa-twitter"></i></li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>