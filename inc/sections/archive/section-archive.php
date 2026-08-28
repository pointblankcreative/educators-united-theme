<?php

    //Empty Variables
    $CurrentPageNumber = "";
    $CurrentPageNumberGet = "";
    $Search = "";
    $AnimationDelay = 0;

    $PostsPerPage = get_option( 'posts_per_page' );
    $ShowPagination = true;

    $PostType = get_post_type();


    if(get_query_var('paged') != ""){
        $CurrentPageNumberGet = sanitize_text_field(get_query_var('paged'));

    }

    if($CurrentPageNumberGet == ""){
        $CurrentPageNumber = 1;
    }
    else{
        $CurrentPageNumber = stripslashes(filter_var($CurrentPageNumberGet, FILTER_SANITIZE_STRING));
    }

    $NextPageNumber = $CurrentPageNumber + 1;
    $PreviousPageNumber = $CurrentPageNumber - 1;
    
    global $wp;
    $CurrentURL = home_url( $wp->request );

    // Query the necessary posts
    $all_blog_posts = new WP_Query( array(
        'posts_per_page' => $PostsPerPage,
        'paged' => $CurrentPageNumber,
        'post_type' => $PostType,
        'post_status'=>'publish',
        'orderby'   => 'publish_date',
        'order' => 'DESC',
    ));

    $CountPosts = $all_blog_posts->found_posts;
    $HowManyPages = ceil($CountPosts / $PostsPerPage);

    //Button Colours
    $FieldPreface = "search_page_styles:";
    $ButtonStyleSelection = get_field($FieldPreface . '_view_button_style', 'options');
    $ButtonColourSelection = get_field($FieldPreface . '_view_button_colour', 'options');
    $SearchAndPaginationColourSelection = get_field($FieldPreface . '_search_and_pagination_colour', 'options');

    $row = 1;

?>

    <div style="padding: 0 0 40px 0"> 
    <?php if( $all_blog_posts->have_posts() ) : ?>
    
        <div id="PostsArchive" class="PostsArchive row"> 
        <?php while( $all_blog_posts->have_posts() ): ?>
            <?php 
                $all_blog_posts->the_post();

                //empty variables
                $SCLinkJS = "";
                $SCLinkHREF = "";
                $SCButtonClickJS = "";

                //create a unique ID
                $length = 4;    
                $RandomID = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),1,$length);

                $PostsThumbnailURL = get_the_post_thumbnail_url( null, 'large' );
                $PostsThumbnailAlt = "";

                //background image
                $PostsThumbnailURL = get_the_post_thumbnail_url( null, 'large' );

                $PostsTitle = get_the_title();

                if(empty($PostsThumbnailURL)){
                    global $PlaceholderImageURL;
                    global $PlaceholderImageAlt;
                    $PostsThumbnailURL = $PlaceholderImageURL;
                    $PostsThumbnailAlt = $PlaceholderImageAlt;
                }  
                else{
                    $PostID = get_post_thumbnail_id( $all_blog_posts->ID );
                    $PostsThumbnailAlt = get_post_meta($PostID, '_wp_attachment_image_alt', true);
                    if($PostsThumbnailAlt == ""){
                        $PostsThumbnailAlt = $PostsTitle . " Thumbnail";
                    }
                }

                //background image
                $SmallerCardBackground = "background-image: url(". $PostsThumbnailURL .");";

                $PostDate = get_the_date();

                $PostExcerpt = get_the_excerpt();
                $PostExcerptLength = strlen($PostExcerpt);
                if($PostExcerptLength > 120){
                    $PostExcerpt = substr($PostExcerpt, 0, 120) . "...";
                }

                //Card Link
                $SCLink = get_post_permalink();
                $SCLinkJS = "tabindex='0' onclick='SmallerCard". $RandomID . "()' onkeydown='javascript: if(event.keyCode == 13) SmallerCard" . $RandomID . "();' role='button' aria-pressed='false'";
                $SCButtonClickJS = "window.location.href = '". $SCLink ."';";      
        
            ?>
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="PostImage" style="<?php echo $SmallerCardBackground; ?>" <?php echo $SCLinkJS; ?> aria-label="<?php echo $PostsThumbnailAlt; ?>">
                </div>
                <div class="PostInfo py-2 px-3">
                    <div class="PostInfoInner">
                        <h3 class="PostTitle mt-0 mb-0">
                            <a href="<?php echo $SCLink; ?>">
                                <?php echo $PostsTitle; ?>
                            </a>
                        </h3>
                        <p class="Date mb-2">
                            <?php echo $PostDate; ?>
                        </p>
                        <p class="PostExcerpt pb-4">
                            <?php echo $PostExcerpt; ?>
                        </p>
                    </div>
                    <div class="pb-2">
                        <a class="ReadMore fw-bold" href="<?php echo $SCLink; ?>">
                            <span class="d-flex align-items-center">
                                Read More
                                <i class="ps-1 fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <script>
            function SmallerCard<?php echo $RandomID; ?>(){
                <?php echo $SCButtonClickJS; ?>
            }
            </script>

            <?php
                if($row < 4){
                    $AnimationDelay = $AnimationDelay + 200;
                    $row = $row + 1;
                }
                else{
                    $ScrollAnimationDelay =  0;
                    $row = 1;
                }
            ?>

        <?php endwhile; ?>
    
        <?php wp_reset_postdata(); ?>
            	

        <?php
            $pagination = paginate_links( array(
              'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $all_blog_posts->max_num_pages,
              'prev_text' => '<i title="Previous Page" class="fas fa-angle-double-left"></i>',
              'next_text' => '<i title="Next Page" class="fas fa-angle-double-right"></i>',
              'type' => 'array'
            ) );
        ?>
        <?php if ( ! empty( $pagination ) ) : ?>
          <nav class="d-flex justify-content-center" aria-label="page navigation">
            <ul class="pagination <?php echo $SearchAndPaginationColourSelection; ?>">
              <?php foreach ( $pagination as $key => $page_link ) : ?>
                <li class="page-item
                  <?php
                      $link = htmlspecialchars($page_link);
                      $link = str_replace( ' current', '', $link);
                      if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; }
                  ?>
                ">
                  <?php
                    if ( $link ) {
                      $link = str_replace( 'page-numbers', 'page-link', $link);
                    }
                    echo htmlspecialchars_decode($link);
                  ?>
                </li>
              <?php endforeach ?>
            </ul>
          </nav>
        <?php endif ?>

    <?php else: ?>
        <h2>
            No Results Found.
        </h2>
    <?php endif; ?>
    </div>
    </div>

<script>

function adjustHeight(){

    var local = document.getElementsByClassName("PostInfoInner");
    var localHeight = 0;

    for (var i = 0; i < local.length; i++) {
        local[i].removeAttribute("style");
        var localItemHeight = local[i].offsetHeight;
        if (localHeight < localItemHeight){
            localHeight = localItemHeight;
        }
    }

    for (var i = 0; i < local.length; i++) {
    local[i].style.height = localHeight + "px";
    }

}
document.addEventListener('DOMContentLoaded', function() {
    adjustHeight();
});

var LocalResizeEventTimeout;
window.addEventListener('resize', function() {
    clearTimeout(LocalResizeEventTimeout);
    LocalResizeEventTimeout = setTimeout(adjustHeight, 300);
});
</script>