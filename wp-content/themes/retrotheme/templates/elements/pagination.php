<!-- start:pagination -->
<div class="pagination text-center">

    <?php
    $big = 999999999;

    echo paginate_links(

        array(
            'base'      =>  str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'format'    =>  '?paged=%#%',
            'current'   =>  max( 1, get_query_var('paged') ),
            'total'     =>  $queryData->max_num_pages,
            'prev_text' => '<< Prethodni',
            'next_text' => 'Sljedeći >>',
        )

    );
    ?>

</div>
<!-- end:pagination -->