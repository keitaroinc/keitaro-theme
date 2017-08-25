<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <?php if ( !is_author() && !is_single() ) : ?>
            <div class="col-md-2 avatar-wrapper">
                <?php keitaro_author_avatar( get_the_author_meta( 'ID' ) ); ?>
            </div>
        <?php endif; ?>
        <div class="col-md-8">

            <?php

            get_template_part( SNIPPETS_DIR . '/header/entry-header' );

            if ( '' !== get_the_post_thumbnail() && is_single() ) :
                get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
            endif;

            if ( is_archive() || is_home() || is_search() ) :
                get_template_part( SNIPPETS_DIR . '/entry-excerpt' );
            else :
                get_template_part( SNIPPETS_DIR . '/entry-content' );
            endif;

            comments_template();

            if ( is_single() ) :

                get_template_part( SNIPPETS_DIR . '/content/content-read-next' );

            endif;

            ?>
        </div> 
        <?php if ( is_single() ) : ?>
            <div class="col-md-4">
                <?php

                if ( !is_search() ) :
                    keitaro_child_pages_list( get_the_ID() );

                    foreach ( get_children( get_ancestors( get_the_ID() ) ) as $page ) :
                        get_template_part( SNIPPETS_DIR . '/sidebars/icon-blocks' );
                    endforeach;
                endif;

                get_template_part( SNIPPETS_DIR . '/entry-footer' );

                ?>
            </div>
        <?php endif; ?>
    </div>

</article>
