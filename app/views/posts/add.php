<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URL_ROOT ?>/posts" class="btn btn-outline-dark mt-2">
    <i class="fa fa-arrow-left"></i> Back
</a>
<div class="row">
    <div class="col">
        <div class="card-body bg-light mt-2 rounded-3">
            <h2>Add Post</h2>
            <p>Create a post with this form</p>
            <form action="<?php echo URL_ROOT; ?>/posts/add" method="POST">
                <div class="form-group">
                    <label for="title">Title:<sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-md <?php echo (!empty($data['title_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['title']; ?>" placeholder="<?php echo $data['title_error']; ?>">
                </div>
                <div class="form-group">
                    <label for="body">Body:<sup>*</sup></label>
                    <textarea name="body" class="form-control form-control-md <?php echo (!empty($data['body_error'])) ? 'is-invalid' : '';  ?>" value="<?php echo $data['body']; ?>" placeholder="<?php echo $data['body_error']; ?>"></textarea>
                </div>
                <input type="submit" value="Submit" class="btn btn-success mt-1">
            </form>
        </div>
    </div>
</div>


<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>