<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" style="width:400px;" >
    <!-- <input type="hidden" name="cat" value="6"/> -->
    <div class="row align-items-center">
        <div class="col-9">
            <input type="text" name="s" id="search" class="form-control" placeholder="Search Here ..." value="<?php the_search_query() ?>" required/>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-outline-warning text-capitalize my-3 bg-white">search</button>
        </div>
    </div> 
</form>