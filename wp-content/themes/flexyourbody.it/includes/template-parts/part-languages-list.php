<?php 
    $data_accordion = uniqid('lang_switch_');
?>
<div class="im-accordion__toggle languages-list" data-accordion="<?php echo $data_accordion; ?>">
    <span class="title current-lang <?php echo strtolower($args['current_lang']); ?>"><?php echo $args['current_lang']; ?></span>
    <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" shape-rendering="geometricPrecision" class="icon">
            <use xlink:href="<?php echo _THEME_BUILD_ ?>/spritemap.svg#ico_godown"></use>
        </svg>
    </div>
</div>
<div class="im-accordion__content languages-items" data-accordion="<?php echo $data_accordion; ?>">
    <div data-wrapper-height>
        <ul class="langs-list">
            <?php foreach($args['languages'] as $l) : 
                $current = $l['active'] ? 'active' : '';
            ?>
            <?php if(!$l['active']){ ?>
            <li class="langs-list-item <?php echo $current.' '.strtolower($l['native_name']); ?>">
                <?php 
                    echo '<a href="' . $l['url'] . '" title="' . $l['native_name'] . '">';
                    echo icl_disp_language($l['native_name']); 
                    echo '</a>';
                ?>
            </li>
            <?php } ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>