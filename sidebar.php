<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package ultrabootstrap
 */
?>
<div class="sidebar col-md-4">
<div class="widget clearfix">
 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar')): endif; ?>  
 </div>
</div>