<?php require_once APP_ROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URL_ROOT ?>/posts" class="btn btn-outline-dark mt-2">
    <i class="fa fa-arrow-left"></i> Back
</a>
<div class="row mt-3 mx-auto" id="show">
    <div class="autor-bg text-white p-2 ps-3 mb-0 rounded-top">
        Written by <?php echo $data['user']->name ?> on <?php echo $data['post']->created_at; ?>
    </div>
    <div class="col bg-white p-3 rounded-bottom">
        <h1><?php echo $data['post']->title; ?></h1>
        <p><?php echo nl2br($data['post']->body); ?></p>
        <?php //Show button edit in he/her post 
        ?>
        <?php if ( $data['post']->user_id == $_SESSION['user_id'] ) : ?>
            <hr>
            <a href="<?php echo URL_ROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-outline-dark">Edit</a>
            <form class="float-end" action="<?php echo URL_ROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
                <input type="submit" value="Delete" class="btn btn-outline-danger">
            </form>
        <?php elseif ( $data['post']->user_id != $_SESSION['user_id'] ) : ?>
            <hr>
            <div class="d-flex bd-highlight align-items-center">
                <div class="flex-grow-1 bd-highlight p-1">
                    <a href="<?php echo URL_ROOT; ?>/posts/reply/<?php echo $data['post']->id; ?>" class="btn btn-outline-dark">Reply</a>
                </div>
                <div class="bd-highlight">
                    <ul class="d-flex mb-0 justify-content-end show-social">
                        <?php if ( isset( $data['score_post']->users_id ) && ( $data['score_post']->users_id == $_SESSION['user_id'] && $data['score_post']->like == 1 ) ) : ?>
                            <li>
                                <span class="like-value"><?php echo $data['post']->likes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end is-liked"><i class="like fas fa-thumbs-up  fa-2x"></i></a>
                            </li>
                            <li>
                                <span class="dislike-value"><?php echo $data['post']->dislikes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end"><i class="dislike far fa-thumbs-down fa-2x secondary"></i></a>
                            </li>
                        <?php elseif ( isset( $data['score_post']->users_id ) && ( $data['score_post']->users_id == $_SESSION['user_id'] && $data['score_post']->dislike == 1 ) ) : ?>
                            <li>
                                <span class="like-value"><?php echo $data['post']->likes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end"><i class="like far fa-thumbs-up  fa-2x"></i></a>
                            </li>
                            <li>
                                <span class="dislike-value"><?php echo $data['post']->dislikes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end is-disliked"><i class="dislike fas fa-thumbs-down fa-2x secondary"></i></a>
                            </li>                                
                        <?php else : ?>
                            <li>
                                <span class="like-value"><?php echo $data['post']->likes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end"><i class="like far fa-thumbs-up  fa-2x"></i></a>
                            </li>
                            <li>
                                <span class="dislike-value"><?php echo $data['post']->dislikes; ?></span><a href="<?php //echo URL_ROOT; ?><?php echo '#' ?>" class="float-end"><i class="dislike far fa-thumbs-down fa-2x secondary"></i></a>
                            </li>                        
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php require_once APP_ROOT . '/views/inc/footer.php'; ?>