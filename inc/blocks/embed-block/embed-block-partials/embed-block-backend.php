<?php 

$VideoLink = get_field($FieldPreface  . '_link_to_embed', false, false);
$VideoiFrame = get_field($FieldPreface  . '_link_to_embed');
$VideoThumbnailBool = get_field($FieldPreface . '_video_thumbnail');

if($VideoThumbnailBool){

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
}

if($VideoLink == ""){
    $Embed = "https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg";
    $VideoBool = false;
}
//find out if link is youtube video
else if (strpos($VideoiFrame, 'youtube') > 0) 
{
    //get id for thumbnail
    preg_match('/src="(.+?)"/', $VideoiFrame, $matches_url );
    $src = $matches_url[1];	

    preg_match('/embed(.*?)?feature/', $src, $matches_id );
    $id = $matches_id[1];
    $id = str_replace( str_split( '?/' ), '', $id ); 

    //create link for youtube thumbnail and place into object
    $Embed = "https://img.youtube.com/vi/" . $id . "/maxresdefault.jpg";
    
    $VideoBool = false;
    
} 
//find out if link is vimeo video
elseif (strpos($VideoiFrame, 'vimeo') > 0) 
{                        
    //create json array to get thumbnailurl
    $data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $VideoLink . "&width=640&height=auto") );
    
    //place vimeo thumbnail link into object
    $Embed = $data->thumbnail_url;

    $VideoBool = false;

} 
//if video is not from vimeo or youtube, do nothing.
else {
    $Embed = $VideoiFrame;
} 
?>
<?php if($VideoBool): ?>
<div class="CustomEmbedBlock <?php echo $BlockAlignment; ?> <?php echo $classes; ?>">
    <div style="<?php echo $EmbedWidth; ?>">
        <?php echo $Embed; ?>
    </div>
</div>
<?php else: ?>

<div class="LoadVideo CustomEmbedBlock <?php echo $BlockAlignment; ?>" >
    <div class="middle-section" style="<?php echo $EmbedWidth; ?>" >
        <button title="Open Video" class="load-video-button">
            <img class="img-fluid video-thumbnail" style="<?php echo $EmbedWidth; ?>"  src="<?php echo $Embed; ?>" />
            <?php if($VideoThumbnailBool): ?>
            <span>
                <?php echo $MiddleMarkup; ?>
            </span>
            <?php endif; ?>
        </button>
    </div>
</div>

<?php endif; ?>