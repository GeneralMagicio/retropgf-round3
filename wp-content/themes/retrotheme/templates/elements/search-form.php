<div class="search-holder">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="search-holder-inner row justify-content-center">
            <label class="col-10">
                <span class="screen-reader-text"><?php echo esc_html_x('Pretraži:', 'label', 'your-theme-textdomain'); ?></span>
                <input type="search" class="search-field"
                       placeholder="<?php echo esc_attr_x('Pretraži...', 'placeholder', 'your-theme-textdomain'); ?>"
                       value="<?php echo get_search_query(); ?>" name="s"/>
            </label>
            <div class="col-2">
                <button type="submit"
                        class="search-submit"><?php echo esc_html_x('Search', 'submit button', 'your-theme-textdomain'); ?></button>
            </div>
        </div>
    </form>
</div>