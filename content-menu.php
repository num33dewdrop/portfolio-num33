<header class="l-header">
    <h1 class="l-header__title">
        <a class="l-header__link" href="<?php echo home_url(); ?>">
            T.I
        </a>
    </h1>
    <div class="l-header__menuTrigger js-toggleSpMenu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="l-header__nav js-targetSpMenu">
        <?php wp_nav_menu( [
            'theme_location' => 'mainmenu',
            'container'      => '',
            'menu_class'     => '',
            'items_wrap'     => '<ul class="l-header__menu js-hideSpMenu">%3$s</ul>'
        ] );
        ?>
    </nav>
</header>