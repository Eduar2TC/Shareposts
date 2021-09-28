<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row posts mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6 align-self-center">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?php echo URL_ROOT; ?>/posts/add" class="btn btn-primary">
                <i class="fa fa-edit"></i>Add Post
            </a>
        </div>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3 rounded-3">
        <div class="pushpin"></div>
        <div class="tape"></div>
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3 rounded-3">
            <p class="mb-0 fst-italic">Write by</b> <b><img class="user-profile-img" src="<?php echo URL_ROOT . $post->userProfileImage . $post->name; ?>.png"> <?php echo $post->name; ?></b> on <?php echo $post->postCreated; ?></p>
        </div>
        <p class="card-text p-2 bg-light rounded rounded-2 fira"><?php echo nl2br($post->body); ?></p>
        <a href="<?php echo URL_ROOT ?>/posts/show/<?php echo $post->postId ?>" role="button" class="col-md-2 btn btn-outline-dark btn-sm">More info</a>
        
    </div>
<?php endforeach; ?>
<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>