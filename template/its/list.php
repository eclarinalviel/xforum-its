
<?php
//$posts = "";
//if($_REQUEST['search'] || in('assigned_to_user')){
//    $posts = post()->issue_search();
////    var_dump(count($posts));
//}else{
//    $posts = post()->getPosts();
//}
//
get_header();

$category = forum()->getCategory();

$posts = get_posts(
    [
        'category' => $category->cat_ID,
    ]);
/*Custom CSS*/
wp_enqueue_style( 'xforum-list', URL_XFORUM . 'css/its/forum-list.css' );
?>
<div class="wrap">


    <div class="col-lg-12 pull-lg-right padding-bottom">
        <?php forum()->list_menu_user()?>
    </div>

    <form action="" method="POST">

        <div class="col-lg-2">
            <div class="dropdown open">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Search by Deadline
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button">Today</button>
                    <button class="dropdown-item" type="button">Within a Week</button>
                    <button class="dropdown-item" type="button">Within a Month</button>
                    <button class="dropdown-item" type="button">Overdue</button>
                    <button class="dropdown-item" type="button">Over a Week</button>
                    <button class="dropdown-item" type="button">Over a Month</button>
                </div>
            </div>
        </div>

        <div class="col-lg-6 input-group">
            <div class="input-group">
                <div class="input-group-btn">
                    <button tabindex="-1" class="btn btn-secondary" type="button">Search Filters</button>
                    <button tabindex="-1" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" type="button">
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"> <input type="checkbox" value="" name="filter[]">Search All</a>
                        <a class="dropdown-item" href="#"> <input type="checkbox" value="" name="filter[]">Members</a>
                        <a class="dropdown-item" href="#"> <input type="checkbox" value="" name="filter[]">Deadline</a>
                        <a class="dropdown-item" href="#"> <input type="checkbox" value="" name="filter[]">Issue Information</a>
                        <a class="dropdown-item" href="#"><input type="checkbox" value="" name="filter[]">Issue Status</a>
                        <a class="dropdown-item" href="#"><input type="checkbox" value="" name="filter[]">Date Posted</a>
                        <div class="dropdown-divider"></div>
                        <input type="submit" class="btn btn-secondary btn-block" value="Assigned to you" name="assigned_to_user">
                    </div>
                </div>
                <input type="text" class="form-control" name="search_field" placeholder="Search..">
            </div>
        </div>



        <div class="col-lg-2">
            <input type="submit" class="btn btn-danger" value="Search!" name="search">
        </div>
    </form>


    <div class="col-lg-9">
        <?php
         if ( $posts ) :
            foreach ($posts as $post) : setup_postdata($post); ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 padding-top">
                    <div class="card">
                        <div class="card-header">
                            <b>Work Started</b> <?php ?>
                        </div>
                        <div class="card-block">
                            <h5 class="card-title">
                                <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                <?php forum()->count_comments( get_the_ID() ) ?>
                            </h5>
                            <p class="card-text">
                                <b>Workers: </b> <?php  ?><br/>
                                <b>In-charge: </b> <?php the_author(); ?><br/>
                                <b>Deadline: </b> <?php  ?> <br/>
                                <small>Views: <?php echo post()->getNoOfView( get_the_ID() )?></small>

                            </p>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Posted on: <?php the_date(); ?></small><br/>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
    </div>

    <div class="col-lg-3">
        <div class="col-lg-12">
            <a class="btn btn-success btn-block" href="<?php forum()->urlWrite()?>">New Issue</a>
        </div>
        <div class="col-lg-12 padding-top">
            <b>Project Statistics</b><br/>
            Member 1 had finished  40%
            <progress class="progress progress-striped" value="40" max="100">40%</progress>
            Member 2 had finished  20%
            <progress class="progress progress-striped progress-danger" value="20" max="100">20%</progress>
        </div>
    </div>

</div>
<?php get_footer(); ?>


