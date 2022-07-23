<?php require_once APP_ROOT . '/views/inc/header.php'; ?>

<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="row g-0 container-fluid justify-content-center">
        <div class="col-md-4 px-0 me-0 img-container">
            <img class="img-fluid align-self-end shadow img-0" src="<?php echo URL_ROOT; ?>/img/login/background-login-0.jpg" alt="" srcset="">
            <img class="img-fluid align-self-end shadow img-1" src="<?php echo URL_ROOT; ?>/img/login/background-login-1.jpg" alt="" srcset="">
            <img class="img-fluid align-self-end shadow img-2" src="<?php echo URL_ROOT; ?>/img/login/background-login-2.jpg" alt="" srcset="">
            <img class="img-fluid align-self-end shadow img-3" src="<?php echo URL_ROOT; ?>/img/login/background-login-3.jpg" alt="" srcset="">
        </div>
        <div class="col-md-3 ps-0">

            <div class="login card card-body bg-light p-3 shadow-lg">
                <h2 class="text-center text-primary fira">Login</h2>
                <p class="fw-bold fira">Please fill in your credentials to log in</p>
                <form action="<?php echo URL_ROOT; ?>/users/login" method="POST">

                    <div class="form-group">
                        <label for="email">Email:<sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-md <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['email']; ?>" placeholder="<?php echo $data['email_error']; ?>">
                    </div>
                    <!-- <span class="invalid-feedback d-block"><?php echo $data['email_error']; ?></span> -->

                    <div class="form-group">
                        <label for="password">Password:<sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-md <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['password']; ?>" placeholder="<?php echo $data['password_error']; ?>">
                    </div>
                    <!--<span class=" invalid-feedback d-block"><?php echo $data['password_error']; ?></span>-->

                    <div class="d-grid gap-3 col-12 mx-auto mt-4">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                        <a href="<?php echo URL_ROOT; ?>/users/register" class="btn btn-outline-secondary btn-block float-end">No account? Register</a>
                        <a href="#!" class="forgot-password-link text-center">Forgot password?</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<?php flash('register_success'); ?>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>