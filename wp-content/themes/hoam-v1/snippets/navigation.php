<?php

?>

<div id="nav_toggle">
    <div class="toggle-icon" onclick="navToggle()"></div>
</div>
<div id="navigation">
    <?php wp_nav_menu( array( 'theme_location' => 'nav1' ) ); ?>
</div>