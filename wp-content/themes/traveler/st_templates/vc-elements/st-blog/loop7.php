<?php
if (!$st_blog_style) {
    $st_blog_style = 4;
}
$st_blog_style = ((int) $st_blog_style <= 0) ? 1 : (int) $st_blog_style;
$col = 12 / $st_blog_style;
?>
    <div class="st-blog--bg has-matchHeight">
        <div class="st-blog--item item-content">
            <div class="thumb text-center">
                <a class="hover-img curved" href="<?php the_permalink() ?>">
                    <?php
                    $img = get_the_post_thumbnail(get_the_ID(), array(370, 208), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id())));
                    if (!empty($img)) {
                        echo balanceTags($img);
                    } else {
                        echo '<img width="370" height="208" alt="no-image" class="wp-post-image" src="' . ST_TRAVELER_URI . '/img/no-image.png">';
                    }
                    ?>
                </a>
            </div>
            <div class="thumb-caption ">   
                <?php
                $catName = '';
                $cats = get_the_category(get_the_ID());
                if ($cats) {
                    $color = get_term_meta($cats[0]->term_id, '_category_color', true);
                    $inline_css = ($color) ? 'style="color: #' . esc_attr( $color). '"' : '';
                    $catName = $cats[0]->name;
                }
                ?>
                <ul class="blog-date">
                    <li class="blog-location" <?php echo ($inline_css); ?>><?php echo esc_html($catName); ?> </li>
                    <li><?php the_time('d M, Y') ?></li>
                </ul>
                <p class="title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></p>
                <p class="sub-title"><?php
                    echo wp_trim_words(get_the_content(), 11, '...');
                    ?></p>
            </div>
        </div>
    </div>       


