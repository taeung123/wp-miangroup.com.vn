<div class="header-menu hascolor">
    <div class="container">
        <div class="header-large">
            <div class="logo"><a id="gohome" href="<?php echo get_home_url() ?>">
                    <div class="bg-logo"></div>
                </a></div>
            <div class="bar-menu">
                <?php
                $menu =  wp_nav_menu(array(
                    "menu" => "topmenu",
                    "container" => "",
                    'echo' => true
                ));
                ?>
            </div>
            <div class="range-language">
                <?php if (onlyLocale() == "vi") : ?>VN<?php else : ?>EN<?php endif; ?>
                <div class="triangle-down"></div>
                <div class="o-language" <?php if (onlyLocale() == "vi") : ?>onclick="switchLanguage('en')" <?php else : ?>onclick="switchLanguage('vi')" <?php endif; ?>>
                    <?php if (onlyLocale() == "en") : ?>VN<?php else : ?>EN<?php endif; ?>
                </div>
            </div>
            <div class="menu-mobile">
                <div class="container-menu" onclick="toggleMenu(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </div>
        </div>

    </div>
</div>