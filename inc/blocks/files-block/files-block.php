<?php

    wp_enqueue_style("files_block");

    $FieldPreface = "files_block-";

    // Create class attribute allowing for custom "className" and "align" values.
    $classes = 'FilesBlock';
    if( !empty($block['className']) && !is_admin() ) {
        $classes .= sprintf( ' %s', $block['className'] );
    }

    //for resize class / script
    $length = 4;    
    $RandomID = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);

?>
<div class="<?php echo $classes; ?>">
<?php if( have_rows($FieldPreface . '_files') ): ?>
    <div class="row">
        <?php while( have_rows($FieldPreface . '_files') ) : the_row(); ?>
        <?php
            //default 
            $FileLink = '';
            $FileTitle = "";
            $FileDate = "";
            $FileDescription = "";

            $FileIcon = get_sub_field($FieldPreface . "_icon");
            switch ($FileIcon) {
                case 'pdf':
                    $FileIconClass = "far fa-file-pdf";
                    break;
                case 'link':
                    $FileIconClass = "fas fa-link";
                    break;
                case 'image':
                    $FileIconClass = "far fa-image";
                    break;
                default:
                    $FileIconClass = "far fa-file-pdf";
                    break;
            }

            $File = get_sub_field($FieldPreface . "_file");
            if($File != ""){
                $FileTitle = esc_attr($File['title']);
                if($FileTitle == ""){
                    $FileButtonText = "Please add a title.";
                }
                $FileDate = esc_attr($File['caption']);
                $FileDescription = esc_attr($File['description']);
                if(!is_admin()){
                    $FileLink = "href='" . esc_attr($File['url']) . "'";
                }
            }else{
                $FileButtonText = "Please add a title.";
            }

            
            

            $FileButtonText = get_sub_field($FieldPreface . '_button_text');
            if($FileButtonText == ""){
                $FileButtonText = "Download";
            }
            $FileButtonText = strip_tags($FileButtonText);

            $IconColour = get_sub_field($FieldPreface . "_icon_colour");
            $TitleColour = get_sub_field($FieldPreface . "_title_colour");
            $DateColour = get_sub_field($FieldPreface . "_date_colour");
            $TextColour = get_sub_field($FieldPreface . "_text_colour");
            $ButtonColour = get_sub_field($FieldPreface . "_button_colour");


        ?>
        <div class="col-12 col-sm-6">
            <div class="FilesBlockFile mb-3">
                <div class="d-flex">
                    <div class="FileIcon pe-4">
                        <i class="<?php echo $FileIconClass . " " . $IconColour; ?>"></i>
                    </div>
                    <div class="FilesBlockResize<?php echo $RandomID; ?>">
                        <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                            <div>
                                <div>
                                    <h3 class="mb-1 <?php echo $TitleColour; ?>">
                                        <?php echo $FileTitle; ?>
                                    </h3>
                                </div>
                                <?php if($FileDate != ""): ?>
                                <div>
                                    <p class="small fw-bold mb-1 <?php echo $DateColour; ?>">
                                        <?php echo $FileDate; ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                                <?php if($FileDescription != ""): ?>
                                <div>
                                    <p class="mb-1 <?php echo $TextColour; ?>">
                                        <?php echo $FileDescription; ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div class="ThemeButtonWrapper">
                                    <a class="ThemeButton mb-3 background <?php echo $ButtonColour; ?>" <?php echo $FileLink; ?> download>
                                        <?php echo $FileButtonText; ?>                
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
<div>
    <p>
        Please Add Files...
    </p>
</div>
<?php endif; ?>
</div>
<?php if(!is_admin()): ?>
<script>
    function adjustHeight<?php echo $RandomID; ?>(){

        var local = document.getElementsByClassName("FilesBlockResize<?php echo $RandomID; ?>");
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
    document.addEventListener("DOMContentLoaded", function() {
        adjustHeight<?php echo $RandomID; ?>();
    });

    var LocalResizeEventTimeout<?php echo $RandomID; ?>;
    window.onresize = function(){
        clearTimeout(LocalResizeEventTimeout<?php echo $RandomID; ?>);
        LocalResizeEventTimeout<?php echo $RandomID; ?> = setTimeout(adjustHeight<?php echo $RandomID; ?>, 300);
    };

</script>
<?php endif; ?>