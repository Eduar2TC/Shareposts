<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="row g-0 container-fluid justify-content-center">
        <div class="col-md-4 d-flex px-0 me-0 img-container">
            <img class="img-fluid align-self-end shadow" src="<?php echo URL_ROOT; ?>/img/backgrond-register.jpg" alt="" srcset="">
        </div>
        <div class="col-md-3 ps-0">

            <div class="card card-body bg-light p-3 shadow-lg">
                <h2 class="text-center text-primary fira">Create an Accont</h2>
                <p class="fw-bold fira">Please fill out this form to register to Website</p>
                <form class="formulary" action="<?php echo URL_ROOT; ?>/users/register" method="POST">

                    <div class="form-group">
                        <label for="name">Name:<sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-md <?php echo (!empty($data['name_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['name']; ?>" placeholder="<?php echo $data['name_error']; ?>">
                    </div>
                    <!-- <span class="invalid-feedback d-block"><?php echo $data['name_error']; ?></span> -->

                    <div class="form-group">
                        <label for="email">Email:<sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-md <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['email']; ?>" placeholder="<?php echo $data['email_error']; ?>">
                    </div>
                    <!-- <span class="invalid-feedback d-block"><?php echo $data['email_error']; ?></span> -->

                    <div class="form-group">
                        <label for="password">Password:<sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-md <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['password']; ?>" placeholder="<?php echo $data['password_error']; ?>">
                    </div>
                    <!-- <span class="invalid-feedback d-block"><?php echo $data['password_error']; ?></span> -->


                    <div class="form-group">
                        <label for="confirm_password">Comfirm:<sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control form-control-md <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['confirm_password']; ?>" placeholder="<?php echo $data['confirm_password_error']; ?>">
                    </div>
                    <!-- <span class="invalid-feedback d-block"><?php echo $data['confirm_password_error']; ?></span> -->

                    <div class="d-grid gap-2 col-12 mx-auto mt-4">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                        <a href="<?php echo URL_ROOT; ?>/users/login" class="btn btn-outline-secondary btn-block float-end">Have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>