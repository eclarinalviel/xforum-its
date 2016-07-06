<?php get_header(); ?>

<?php
/*Custom CSS*/
wp_enqueue_style( 'xforum-edit', URL_XFORUM . 'css/its/forum-edit.css' );

if ( in('post_ID') ) {
    forum()->setCategoryByPostID( in('post_ID') );
    $post = post( in('post_ID') );
}
else {
    $post = post();
}

?>

    <div class="title-text">
        <?php echo in('slug') ?> EDIT PAGE
    </div>

    <div class="post-edit-box">

        <form action="?">
            <input type="hidden" name="forum" value="edit_submit">
            <input type="hidden" name="response" value="view">
            <?php if ( in('slug') ) { ?>
                <input type="hidden" name="slug" value="<?php echo in('slug')?>">
            <?php } else { ?>
                <input type="hidden" name="post_ID" value="<?php echo in('post_ID')?>">
            <?php } ?>
            <input type="hidden" name="on_error" value="alert_and_go_back">
            <input type="hidden" name="return_url" value="<?php forum()->urlList()?>">

            <div class="col-lg-8">
                <fieldset class="form-group">
                    <label for="post-title">Title</label>
                    <input type="text" class="form-control" id="post-title" name="title" placeholder="Post Title" value="<?php echo esc_html( $post->title() )?>">
                    <small class="text-muted">Please, input post title.</small>
                </fieldset>
            </div>

            <div class="col-lg-8">
                <fieldset class="form-group">
                    <label for="post-content">Content</label>
                    <?php
                    if ( $post ) {
                        $content = esc_html($post->content());
                    }
                    else {
                        $content = '';
                    }
                    $editor_id = 'new-content';
                    $settings = array(
                        'textarea_name' => 'content',
                        'media_buttons' => false,
                        'textarea_rows' => 5,
                        'quicktags' => false
                    );
                    wp_editor( $content, $editor_id, $settings );

                    ?>
                </fieldset>
            </div>

            <div class="col-lg-6">
                <div class="buttons">
                    <input type="submit" class="btn btn-danger">
                </div>
            </div>

        </form>

        <div class="col-lg-6">
            <?php file_upload()?>
        </div>

    </div>

<?php get_footer(); ?>