<?php

$BlockAlignment = "d-flex ";
    
switch ($AlignmentChoice) {
    case "Tablet":

        $DesktopAlignment = get_field($FieldPreface . '_desktop_alignment');
        $TabletAlignment = get_field($FieldPreface . '_tablet_alignment');

        $DesktopAlignmentClass = "justify-content-md-" . $DesktopAlignment;

        $TabletAlignmentClass = "justify-content-" . $TabletAlignment . " justify-content-sm-" . $TabletAlignment;

        $BlockAlignment .= $TabletAlignmentClass . " " . $DesktopAlignmentClass;

        break;
        
    case "Mobile":
        $DesktopAlignment = get_field($FieldPreface . '_desktop_alignment');
        $MobileAlignment = get_field($FieldPreface . '_mobile_alignment');

        $DesktopAlignmentClass = "justify-content-sm-" . $DesktopAlignment;

        $MobileAlignmentClass = "justify-content-" . $MobileAlignment;
        
        $BlockAlignment .= $MobileAlignmentClass . " " . $DesktopAlignmentClass;

        break;

    case "Tablet & Mobile":
        $DesktopAlignment = get_field($FieldPreface . '_desktop_alignment');
        $TabletAlignment = get_field($FieldPreface . '_tablet_alignment');
        $MobileAlignment = get_field($FieldPreface . '_mobile_alignment');

        $DesktopAlignmentClass = "justify-content-md-" . $DesktopAlignment;
        $TabletAlignmentClass = "justify-content-sm-" . $TabletAlignment;
        $MobileAlignmentClass = "justify-content-" . $MobileAlignment;
        $BlockAlignment .= $MobileAlignmentClass . " " . $TabletAlignmentClass . " " . $DesktopAlignmentClass;

        break;

    default:
        $DesktopAlignment = get_field($FieldPreface . '_desktop_alignment');
        $DesktopAlignmentClass = "justify-content-" . $DesktopAlignment;
        $BlockAlignment .= $DesktopAlignmentClass;

        break;
}