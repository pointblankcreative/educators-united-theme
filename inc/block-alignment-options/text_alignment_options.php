<?php

$DesktopAlignment = get_field($FieldPreface . '_desktop_alignment');

$AlignmentChoice = get_field($FieldPreface . '_adjust_view_alignment');
    
switch ($AlignmentChoice) {
    case "Tablet":
        $DesktopAlignmentClass = "text-md-" . $DesktopAlignment;

        $TabletAlignment = get_field($FieldPreface . '_tablet_alignment');

        $TabletAlignmentClass = "text-" . $TabletAlignment . " text-sm-" . $TabletAlignment;

        $TextAlignmentClasses .= $TabletAlignmentClass . " " . $DesktopAlignmentClass;

        break;
        
    case "Mobile":
        $DesktopAlignmentClass = "text-sm-" . $DesktopAlignment;

        $MobileAlignment = get_field($FieldPreface . '_mobile_alignment');
        $MobileAlignmentClass = "text-" . $MobileAlignment;
        
        $TextAlignmentClasses .= $MobileAlignmentClass . " " . $DesktopAlignmentClass;

        break;

    case "Tablet & Mobile":
        $DesktopAlignmentClass = "text-md-" . $DesktopAlignment;
        $TabletAlignment = get_field($FieldPreface . '_tablet_alignment');
        $MobileAlignment = get_field($FieldPreface . '_mobile_alignment');

        $TabletAlignmentClass = "text-sm-" . $TabletAlignment;
        $MobileAlignmentClass = "text-" . $MobileAlignment;

        $TextAlignmentClasses .= $MobileAlignmentClass . " " . $TabletAlignmentClass . " " . $DesktopAlignmentClass;

        break;

    default:
        $DesktopAlignmentClass = "text-" . $DesktopAlignment;
        $TextAlignmentClasses .= $DesktopAlignmentClass;

        break;
}    