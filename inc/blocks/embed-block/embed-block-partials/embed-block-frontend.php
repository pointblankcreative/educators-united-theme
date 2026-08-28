<?php 

    wp_enqueue_style("embed");
    wp_enqueue_style("video_hover_animations");

        $Embed = get_field($FieldPreface . '_link_to_embed');

        $VideoThumbnailBool = get_field($FieldPreface . '_video_thumbnail');
        
        if($VideoThumbnailBool){

            wp_enqueue_script('load_video');  

            $VideoLink = get_field($FieldPreface . '_link_to_embed', false, false);
            $iFrameMarkup = get_field($FieldPreface . '_link_to_embed');

            $ZoomAnimation = get_field($FieldPreface . '_hover_zoom_animation');

            $SelectedMiddleType = get_field($FieldPreface . '_video_thumbnail_decoration');

            switch ($SelectedMiddleType) {
                case "arrow":
                    $MiddleImageURL = get_template_directory_uri() . "/images/video/PlayButton.png";
                    $MiddleMarkup = "<img alt='Play Button' src='" . $MiddleImageURL . "' />";
                    break;
                case "text":
                    $MiddleTitle = get_field($FieldPreface . "_video_thumbnail_decoration_text");
                    $MiddleMarkup = "<h3>" . $MiddleTitle . "</h3>";
                    break;
                default:
                    $MiddleImageURL = get_template_directory_uri() . "/images/video/PlayButton.png";
                    $MiddleMarkup = "<img alt='Play Button' src='" . $MiddleImageURL . "' />";
            }

            $MiddleMarkup = htmlentities($MiddleMarkup);


            if($iFrameMarkup == ""){

                $Embed = "https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg";

                //Iframe Markup
                $iFrameMarkup = htmlentities('<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?feature=oembed&controls=1&hd=1&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');

                $VideoBool = false;
                $RandomID = get_random_id(4);
            }
            //find out if link is youtube video
            else if (strpos($iFrameMarkup, 'youtube') > 0) 
            {

                //get id for thumbnail
                preg_match('/src="(.+?)"/', $iFrameMarkup, $matches_url );
                $src = $matches_url[1];	
    
                preg_match('/embed(.*?)?feature/', $src, $matches_id );
                $id = $matches_id[1];
                $id = str_replace( str_split( '?/' ), '', $id ); 
    
                //create link for youtube thumbnail and place into object
                $Embed = "https://img.youtube.com/vi/" . $id . "/maxresdefault.jpg";

                //Iframe Markup
                $iFrameMarkup = htmlentities(str_replace( '?feature=oembed', '?feature=oembed&controls=1&hd=1&autoplay=1', $iFrameMarkup));
                        
                $VideoBool = false;
                $RandomID = get_random_id(4);
                
            } 
            //find out if link is vimeo video
            elseif (strpos($iFrameMarkup, 'vimeo') > 0) 
            {       

                //create json array to get thumbnailurl
                $data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $VideoLink . "&width=640&height=auto") );
                
                //Iframe Markup

                $iFrameMarkup = htmlentities(str_replace('app_id=122963', 'app_id=122963&autoplay=1', $iFrameMarkup));

                //place vimeo thumbnail link into object
                $Embed = $data->thumbnail_url;
    
                $VideoBool = false;
                $RandomID = get_random_id(4);
    
            } 
            //if video is not from vimeo or youtube, do nothing.
            else {
                $Embed = $VideoiFrame;
            } 
        }
        else{
            if($Embed == ""){
                $VideoEmbedClass = "ratio ratio-16x9";
                $Embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
            //if youtube or vimeo, add these classes
            else if (strpos($Embed, 'youtube') > 0) {
                $VideoEmbedClass = "ratio ratio-16x9";
            }
            elseif (strpos($Embed, 'vimeo') > 0) 
            {  
                $VideoEmbedClass = "ratio ratio-16x9";
            }
            else{
                //do nothing
            }
        }
    ?>
<div class="CustomEmbedBlock <?php echo $BlockAlignment; ?> <?php echo $classes; ?>">
    <?php if($VideoThumbnailBool): ?>
        <?php if($VideoBool): ?>
        <div class="CustomEmbedBlock <?php echo $BlockAlignment; ?>">
            <div style="<?php echo $EmbedMaxWidth; ?>">
                <?php echo $Embed; ?>
            </div>
        </div>
        <?php else: ?>
        <div style="<?php echo $EmbedMaxWidth; ?>"  id="VideoID<?php echo $RandomID; ?>" class="LoadVideo CustomEmbedBlock <?php echo $BlockAlignment; ?>" data-video="<?php echo $iFrameMarkup; ?>" data-target-id="<?php echo $RandomID; ?>" data-thumbnail="<?php echo $Embed; ?>" data-zoom-animation="<?php echo $ZoomAnimation; ?>" data-width="<?php echo $EmbedWidth; ?> " data-title="<?php echo $PlayButton; ?>" data-middle-markup="<?php echo $MiddleMarkup; ?>">
            <div class="middle-section <?php echo $ZoomAnimation; ?>" style="width: 100%;">
                <button title="Open Video" class="load-video-button" >
                    <img class="img-fluid video-thumbnail" style="<?php echo $EmbedWidth; ?>"  src="<?php echo $Embed; ?>" alt="Video Thumbnail"> 
                    <span>
                        <?php echo html_entity_decode($MiddleMarkup); ?>
                    </span>
                </button>
            </div>
        </div>
        <?php endif; ?>
    <?php else: ?>
    <div class="<?php echo $VideoEmbedClass; ?>" style="<?php echo $EmbedMaxWidth; ?>">
        <?php echo $Embed; ?>
    </div>
    <?php endif; ?>
</div>
