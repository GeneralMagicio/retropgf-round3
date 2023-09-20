<?php $optionsSocials = get_option('wedevs_socials'); ?>
<?php if( isset($optionsSocials) && sizeof($optionsSocials) > 0 ): ?>
    <div class="socials">
        <?php if (isset($optionsSocials['facebook_url']) && $optionsSocials['facebook_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['facebook_url']; ?>" class="facebook" target="_blank"><?php echo $optionsSocials['facebook_url']; ?></a>
        <?php endif; ?>

        <?php if (isset($optionsSocials['linkedin_url']) && $optionsSocials['linkedin_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['linkedin_url']; ?>" class="linkedin" target="_blank"><?php echo $optionsSocials['linkedin_url']; ?></a>
        <?php endif; ?>

        <?php if (isset($optionsSocials['youtube_url']) && $optionsSocials['youtube_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['youtube_url']; ?>" class="youtube" target="_blank"><?php echo $optionsSocials['youtube_url']; ?></a>
        <?php endif; ?>
    </div>
<?php endif; ?>