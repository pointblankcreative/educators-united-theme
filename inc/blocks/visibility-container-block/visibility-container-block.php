<?php
        //Field Preface
        $FieldPreface = "";

        // Create class attribute allowing for custom "className" and "align" values.
        $classes = '';
        if( !empty($block['className']) && !is_admin() ) {
            $classes .= sprintf( ' %s', $block['className'] );
        }

        //empty variables
        $VisibilityClasses = "";


        //default values on variables
        $DesktopVisibilityClass = "d-md-none";
        $TabletVisibilityClass = "d-sm-none";
        $MobileVisibilityClass = "d-none";

        if(!is_admin()){
            $VisibilityChoices = get_field('visibility_container_block-_visibility');
            if( $VisibilityChoices ){
                foreach( $VisibilityChoices as $VisibilityChoice ){
                    switch ($VisibilityChoice) {
                        case "Desktop":

                            $DesktopVisibilityClass = "d-md-block";
                    
                            break;

                        case "Tablet":
                    
                            $TabletVisibilityClass = "d-sm-block";
                    
                            break;
                            
                        case "Mobile":

                            $MobileVisibilityClass = "d-block";
                    
                            break;
                    
                    }
                }
            }
            $VisibilityClasses = $DesktopVisibilityClass . " " . $TabletVisibilityClass . " " . $MobileVisibilityClass;
        }

?>
<div class="VisibilityContainerBlock <?php echo $classes; ?>">
    <?php if(is_admin()):?>
        <span class="badge bg-primary">
            Visibility Container Block
        </span>
    <?php endif; ?>
    <div class="<?php echo $VisibilityClasses; ?>">
        <InnerBlocks  />
    </div>
</div>