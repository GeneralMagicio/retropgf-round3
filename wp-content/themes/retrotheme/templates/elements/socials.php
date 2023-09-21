<?php $optionsSocials = get_option('wedevs_socials'); ?>
<?php if( isset($optionsSocials) && sizeof($optionsSocials) > 0 ): ?>
    <div class="socials">
        <?php if (isset($optionsSocials['twitter_url']) && $optionsSocials['twitter_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['twitter_url']; ?>" class="twitter" target="_blank"><?php echo $optionsSocials['twitter_url']; ?></a>
        <?php endif; ?>

        <?php if (isset($optionsSocials['linkedin_url']) && $optionsSocials['linkedin_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['linkedin_url']; ?>" class="linkedin" target="_blank"><?php echo $optionsSocials['linkedin_url']; ?></a>
        <?php endif; ?>

        <?php if (isset($optionsSocials['github_url']) && $optionsSocials['github_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['github_url']; ?>" class="github" target="_blank"><?php echo $optionsSocials['github_url']; ?></a>
        <?php endif; ?>

        <?php if (isset($optionsSocials['discord_url']) && $optionsSocials['discord_url'] != ''): ?>
            <a href="<?php echo $optionsSocials['discord_url']; ?>" class="discord" target="_blank"><?php echo $optionsSocials['discord_url']; ?></a>
        <?php endif; ?>
    </div>
<?php endif; ?>