<?php

    //defaults and empty variables
    $BackgroundStyle = "";
    $BorderColour = "";
    $BorderWidth = "";
    $BorderStyle = "";
    $ButtonHREF = "";
    $ButtonTarget = "";

    $ButtonColumns = "col-12";
    $ButtonAlignment = "d-flex justify-content-center";

    $BackgroundColour = get_field($PageFieldPreface . "_sticky_alert_background_colour");
    $BackgroundColour = validateColourString($BackgroundColour);
    if($BackgroundColour == ""){
        $BackgroundColour = "background-color: #FFFFFF;";
    }else{
        $BackgroundColour = "background-color: " . $BackgroundColour  . ";";
    }

    $BackgroundStyle = $BackgroundColour;

    $ParagraphText = get_field($PageFieldPreface . "_sticky_alert_text");
    if($ParagraphText != ""){
        $ButtonColumns = "col-12 col-md-3";
        $ButtonAlignment = "d-flex justify-content-center justify-content-md-start";
    }

    $ButtonText = get_field($PageFieldPreface . "_sticky_alert_button_text");
        
    $ButtonColourSelection = get_field($PageFieldPreface . "_sticky_alert_button_colour");
    if($ButtonColourSelection == ""){
        $ButtonColourSelection = "primary";
    }

?>
<div id="CTAStickyButtonAlert" class="CTAStickyButtonAlert" style="<?php echo $BackgroundStyle; ?>">
    <div class="container p-4">
        <div class="row">
            <?php if(is_admin()):?>
            <div>
                <p> 
                    <span class='badge bg-success'>
                        CTA Sticky Alert Block
                    </span> 
                </p>
            </div>
            <?php endif; ?>
            <?php if($ParagraphText != ""): ?>
            <div class="col-12 col-md-9">
                <div class="text-center text-md-start">
                    <?php echo $ParagraphText; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="<?php echo $ButtonColumns; ?>">
                <div class="ThemeButtonWrapper <?php echo $ButtonAlignment; ?>">
                    <a id="StickyAlertButton" class="ThemeButton background <?php echo $ButtonColourSelection; ?>">
                        <?php echo $ButtonText; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>