<?php
/*
Template Name: Car Search
*/

$brands = get_terms([
    'taxonomy'      => 'brands',
    'hide_empty'    => false,
]);

$is_search = count($_GET);
?>

<?php get_header(); ?>

<div class="page-wrap">
    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo home_url('car-search'); ?>">
                    <div class="form-group my-3">
                        <input type="text" name="keyword" placeholder="Type A Keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword']; ?>" class="form-control">
                    </div>
                    <div class="form-group my-3">
                        <select name="brand" class="form-select">
                            <option value="">None</option>
                            <?php
                                foreach($brands as $brand){?>
                                    <option <?php if(isset($_GET['brand']) && $_GET['brand'] == $brand->slug) echo ' selected ' ?> value="<?php echo $brand->slug ?>"><?php echo $brand->name; ?></option>
                                <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <select name="price_above" class="form-select">
                                    <?php
                                        for($i = 0;$i < 50000 ; $i+=2000){?>
                                            <option value="<?php echo $i ?>" <?php if(isset($_GET['price_above']) && !empty($_GET['price_above']) && $_GET['price_above'] == $i){ echo ' selected '; } ?>>$<?php echo number_format($i) ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="price_below" class="form-select">
                                    <?php
                                        for($i = 2000;$i <= 50000 ; $i+=2000){?>
                                            <option value="<?php echo $i ?>" <?php if(isset($_GET['price_below']) && !empty($_GET['price_below']) && $_GET['price_below'] == $i){ echo ' selected '; } ?>>$<?php echo number_format($i) ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Search</button>
                        </div>
                    </div>
                    <a href="<?php echo home_url('/car-search') ?>" class="text-capitalize">reset search</a>
                </form>
            </div>
        </div>
        <?php 
            if($is_search){
                $query = search_query();
                if($query->have_posts()){?>

                    <div class="row my-3">
                    <?php 
                    while($query->have_posts()){
                        $query->the_post();?>
                        <div class="col-lg-6 col-xxl-4">
                        <div class="main-post p-3 rounded mb-3">
                            <h3 class="post-title m-0 mb-2 text-secondary">
                                <a href="<?php the_permalink() ?>" reel="bookmark" title="Link to <?php the_title_attribute() ?>" class="text-capitalize">
                                    <?php the_title() ?>
                                </a>
                            </h3>
                            <div class="mb-2">
                                <span class="post-author">
                                    <i class="fa-regular fa-user"></i>
                                    <?php the_author_posts_link() ?>
                                </span>
                                <span class="post-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?php the_time('j F,Y') ?>
                                </span>
                                <span class="post-comment">
                                    <i class="fa-regular fa-comments"></i>
                                    <?php comments_popup_link(); ?>
                                </span>
                            </div>
                            <div class="post-image">
                                <?php the_post_thumbnail('',['class' => 'img-responsive img-thumbnail']) ?>
                            </div>
                            <div class="post-content my-2 text-dark">
                                <?php the_excerpt() ?>
                            </div>
                            <div class="post-categories">
                                <span class="fw-bold"><i class="fa-solid fa-layer-group"></i> Cats:</span> <?php the_category(' | ') ?>
                            </div>
                            <div class="post-tags my-2">
                                <?php if(has_tag()){
                                    the_tags('<h6 class="text-uppercase"><i class="fa-solid fa-tags"></i> <span class="text-capitalize">tags</span>: ',' | ','</h6>');
                                }else{
                                    echo '<h6><i class="fa-solid fa-tags"></i>Tags : _</h6>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }?>
                    </div>
                    <?php
                    wp_reset_postdata();
                }else{?>
                    <div class="alert alert-warning">
                        There are no result
                    </div>
                <?php }
            }
        ?>
    </div>
</div>

<?php get_footer(); ?>