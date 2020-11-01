<?php
/**
 * Comment HTML
 */

$GLOBALS['comment'] = $comment;
?>

<li <?php echo comment_class('', null, null, false ); ?> id="comment-<?php echo get_comment_ID(); ?>">

    <div class="comment__body" id="div-comment-<?php echo get_comment_ID(); ?>">

        <div class="comment__author vcard">

            <div class="comment__author-avatar">
                <?php echo get_avatar( $comment, 100 ); ?>
            </div>

            <div class="comment__author-details">

                <cite class="comment__author-name"><?php echo get_comment_author_link(); ?></cite>

                <div class="comment__meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo sprintf('%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></a>
                    <?php if( $edit_link = get_edit_comment_link() ) : ?>
                        <a class="comment-edit-link" href="<?php echo $edit_link; ?>">Edit</a>
                    <?php endif; ?>
                </div><!-- .comment__meta -->

            </div><!-- .comment__author-details -->

        </div><!-- .comment__author -->



        <div class="comment__bottom">

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment__awaiting-moderation">Your comment is awaiting moderation.</p>
            <?php endif; ?>

            <?php echo apply_filters( 'comment_text', get_comment_text( $comment ), $comment ); ?>

            <div class="comment__interactions">

               <?php
                    comment_reply_link( array_merge( $args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<div class="reply"><i data-feather="message-square"></i>',
                        'after'     => '</div>'
                    ) ) );
                ?>


                <?php if ( is_user_logged_in() ) : ?>
                    <?php
                    $user_id = get_current_user_id();
                    $likes =  get_user_meta( $user_id, 'comment_likes', true );
                    $comment_id = get_comment_ID();

                    $user_has_likes = is_array($likes);
                    ?>

                    <?php if ( $user_has_likes ) : ?>

                        <?php if ( ! in_array( $comment_id, $likes) ) : ?>
                            <div class="like like--like is-active" data-interaction="like" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-up"></i>
                                </div>
                                <div class="count">Like</div>
                            </div>
                            <div class="like like--unlike" data-interaction="unlike" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-down"></i>
                                </div>
                                <div class="count">Unlike</div>
                            </div>
                        <?php else : ?>
                            <div class="like like--like" data-interaction="like" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-up"></i>
                                </div>
                                <div class="count">Like</div>
                            </div>
                            <div class="like like--unlike is-active" data-interaction="unlike" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-down"></i>
                                </div>
                                <div class="count">Unlike</div>
                            </div>
                        <?php endif; ?>

                    <?php else : ?>
                            <div class="like like--like is-active" data-interaction="like" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-up"></i>
                                </div>
                                <div class="count">Like</div>
                            </div>
                            <div class="like like--unlike" data-interaction="unlike" data-nonce="<?php echo wp_create_nonce('comment-like'); ?>" data-comment-id="<?php echo get_comment_ID(); ?>">
                                <div class="icon">
                                    <i data-feather="thumbs-down"></i>
                                </div>
                                <div class="count">Unlike</div>
                            </div>
                    <?php endif; ?>


                    <div class="likes" data-comment-id="<?php echo get_comment_ID(); ?>">
                        <?php
                        $current_likes = get_comment_meta( get_comment_ID(), 'likes', true );
                        $current_likes = ( ! empty( $current_likes ) ) ? $current_likes : 0;
                        ?>
                        <div class="count">Likes: <?php echo $current_likes; ?></div>
                        <div class="icon">
                            <i data-feather="thumbs-up"></i>
                        </div>
                    </div>

                <?php endif; ?>

            </div><!-- .comment__interactions -->

        </div><!-- .comment__bottom -->

    </div><!-- .comment__body -->