</main>

<footer class="footer">
    <div class="footer__top bg-light">
        <div class="footer__container">
        
            <div class="footer__col footer__first-col ">
                <a class="logo" href="<?php echo _HOME_ ?>" title="<?php _e('Vai alla Homepage', 'flexyourbody.it'); ?>">
                    <img src="<?php echo _THEME_IMG_; ?>/spacer/spacer.png" data-src="<?php echo _THEME_IMG_ ?>/share/logo.svg" class="lazyload" alt="<?php echo _ALT_ ?>" width="200" height="19">
                </a>
                <?php echo get_field('footer','options'); ?>
            </div>

            
            <?php if (has_nav_menu('footer-menu')){ ?>
            <div class="footer__col footer__second-col">
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'footer-menu',
                    'container'         => 'ul',
                    'menu_class'        => 'menu-footer',
                    'menu_id'           => 'menu-footer',
                ));
                ?>
            </div>
            <?php } ?>
            

            
            <?php if (has_nav_menu('gdpr-menu')){ ?>
            <div class="footer__col footer__second-col">
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'gdpr-menu',
                    'container'         => 'ul',
                    'menu_class'        => '',
                    'menu_id'           => 'gdpr-menu',
                ));
                ?>
            </div>
            <?php } ?>

            <div class="footer__col footer__fourth-col">
                <?php if( !empty( get_field('social','options') ) ){ ?>
                <nav class="socials">
                    <ul>
                        <?php foreach( get_field('social','options') as $social ){ ?>
                            <li>
                                <a href="<?php echo $social['link']['url'];?>" title="<?php echo $social['canale_social'];?>" target="_blank" rel="noopener">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon">
                                        <use xlink:href="<?php echo _THEME_BUILD_;?>/spritemap.svg#ico_<?php echo $social['canale_social'];?>"></use>
                                    </svg>
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                </nav>
                <?php }?>
                <div class="credits">
                    
                </div>   
            </div>
        </div>
    </div>
    <div class="footer__bottom bg-secondary">
        <div class="footer__container">
            
            <?php if( !empty( get_field('creadits_footer','options') ) ){ ?>
                <p>©<?php echo date("Y"); ?> <?php echo get_field('creadits_footer','options'); ?></p>
            <?php } ?>
           
            <?php if( !empty( get_field('immagine_footer','options') ) ){ ?>
                <div class="footer__payments">
                    <img src="<?php echo get_field('immagine_footer','options')['url'] ?>"  width="100" height="30" alt="payments" class="">
                </div>
            <?php } ?>
         
            <button class="footer__btn-to-top btn-to-top">Scroll to top  &#8593;</button>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>