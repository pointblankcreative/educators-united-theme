<?php

    $FormTitle = get_field($PageFieldPreface . "_form_title");

?>
<?php if($FormTitle != ""): ?>
<div>
    <h2>
        <?php echo $FormTitle; ?>
    </h2>
</div>
<?php endif; ?>
<?php if($FormType == "shortcode"): ?>
    <?php
        $FormShortcode = get_field($PageFieldPreface . "_form_shortcode");
    ?>
    <div>
        <?php echo do_shortcode($FormShortcode); ?>
    </div>
<?php endif; ?>
<?php if($FormType == "embed"): ?>
    <?php
        $FormEmbed = get_field($PageFieldPreface . "_form_embed");
        if($FormEmbed != ""){
                    
            //This removed Action Networks styling in case the user adds it.
            $pattern = '/<link\s+[^>]*href=[\'"][^\'"]+\.css[\'"][^>]*>/i';
        
            // Use preg_replace to remove the <link> element
            $FormEmbed = preg_replace($pattern, '', $FormEmbed);
            
        }
    ?>
    <div>
        <?php echo $FormEmbed; ?>
    </div>
<?php endif; ?>