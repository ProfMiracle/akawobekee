<?php
if (!function_exists("random_color"))
{
    function random_color()
    {
        $colors = ["border-left-primary", "border-left-secondary", "border-left-success", "border-left-error", "border-left-info", "border-left-warning", "border-left-dark", "border-left-danger"];
        shuffle($colors);
        return $colors[0];
    }
}
