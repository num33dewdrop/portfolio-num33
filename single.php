<?php
get_header();
get_template_part( 'content', 'menu' ); ?>
<!-- 記事の詳細画面はsingle.phpの名前のファイルが自動的に読み込まれる -->
<main class="l-main">
    <!-- blog-->
    <section id="work" class="c-container">
		<?php
		if ( have_posts() )://投稿があるかの確認
			while ( have_posts() ):the_post();
				?>
                <h2 class="c-subTitle js-slideIn"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="p-article">
                    <a href="<?php echo get_post_meta( $post->ID, 'works_url', true ) ?>" class="p-article__head" target="_blank">
						<?php if ( ! empty( get_post_meta( $post->ID, 'works_img', true ) ) ) : ?>
                            <img class="p-article__img"
                                 src="<?php echo get_post_meta( $post->ID, 'works_img', true ) ?>" alt="works-image">
						<?php else: ?>
                            <img class="p-article__img"
                                 src="<?php echo get_template_directory_uri(); ?>/src/img/noimage.jpg" alt="no-image">
						<?php endif; ?>
                    </a>
                    <div class="p-article__body">
                        <div class="p-article__info">
                            <p>サイトURL：<a class="p-article__link" href="<?php echo get_post_meta( $post->ID, 'works_url', true ) ?>" target="_blank"><?php echo get_post_meta( $post->ID, 'works_url', true ) ?></a></p>
                        </div>
                        <div class="p-article__main">
                            <!-- 本文表示 -->
							<?php the_content(); ?>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
            <ul class="c-pagination">
                <li class="c-pagination__link c-pagination__link--prev"><?php previous_post_link( '%link', 'PREV' ); ?></li>
                <li class="c-pagination__link c-pagination__link--next"><?php next_post_link( '%link', 'NEXT' ); ?></li>
            </ul>
            <!--COMMENTS-->
			<?php //comments_template(); ?>
		<?php else: //投稿がなかった場合?>
            <h2 class="sec-title">記事が見つかりませんでした。</h2>
		<?php endif; ?>
    </section>
    <ul class="c-bg__squares">
		<?php for($i = 1; $i <= 10; $i++){
			echo '<li></li>';
		} ?>
    </ul>
</main>
<?php get_footer(); ?>
