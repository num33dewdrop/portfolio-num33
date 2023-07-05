<?php
/*
Template Name: HOME 〜トップページ〜
*/
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
?>
    <!-- ヘッダー -->
<?php get_header(); ?>
    <!-- メニュー -->
<?php get_template_part( 'content', 'menu' ); ?>
    <main class="l-main">
        <section class="p-hero c-container c-container--full">
            <p class="p-hero__name js-slideIn"><?php echo get_post_meta( $post->ID, 'about_name', true ); ?></p>
            <div class="p-hero__textContainer">
                <h2 class="p-hero__title js-slideIn"><?php bloginfo( 'name' ); ?></h2>
                <p class="p-hero__description js-slideIn"><?php bloginfo( 'description' ); ?></p>
            </div>
            <div class="p-hero__banner js-fadeIn">
                <img class="p-hero__img js-moveImg" src="<?php echo get_post_meta( $post->ID, 'top_banner', true ); ?>"
                     alt="hero-banner">
            </div>
        </section>
        <section id="works" class="c-container u-shadow js-showFullContainer">
            <h2 class="c-subTitle js-slideIn js-subTitlePos">WORKS</h2>
            <ul class="c-card js-fadeDelay">
				<?php
				$work_args  = array( 'posts_per_page' => - 1 );//全件表示
				$work_query = new WP_Query( $work_args );
				if ( $work_query->have_posts() ):
					while ( $work_query->have_posts() ):$work_query->the_post(); ?>
                        <li class="c-card__item js-showFullTarget">
                            <a class="c-card__container" href="<?php the_permalink(); ?>">
                                <div class="c-card__head">
									<?php if ( ! empty( get_post_meta( $post->ID, 'works_img', true ) ) ) : ?>
                                        <img class="c-card__img"
                                             src="<?php echo get_post_meta( $post->ID, 'works_img', true ) ?>"
                                             alt="works-image">
									<?php else: ?>
                                        <img class="c-card__img"
                                             src="<?php echo get_template_directory_uri(); ?>/src/img/noimage.jpg"
                                             alt="no-image">
									<?php endif; ?>
                                </div>
                                <div class="c-card__body">
                                    <h3 class="c-card__title"><?php the_title(); ?></h3>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </a>
                        </li>
					<?php endwhile; ?>
				<?php else: //投稿がなかった場合?>
                    <div id="noItem">
                        <h3>記事が見つかりませんでした。</h3>
                    </div>
				<?php
				endif;
				wp_reset_postdata();
				?>
            </ul>
            <button class="c-btn js-showFullBtn">More</button>
        </section>
        <section id="about" class="p-about c-container">
            <h2 class="c-subTitle js-slideIn">ABOUT</h2>
            <div class="p-about__main js-fadeIn">
                <div class="p-about__imgContainer">
                    <img class="p-about__img" src="<?php echo get_post_meta( $post->ID, 'about_img', true ); ?>"
                         alt="<?php echo get_post_meta( $post->ID, 'about_name', true ); ?>">
                </div>
                <div class="p-about__text">
                    <h3 class="p-about__name js-fadeIn"><?php echo get_post_meta( $post->ID, 'about_name', true ); ?></h3>
                    <p><?php echo get_post_meta( $post->ID, 'about_msg', true ); ?></p>
                </div>
            </div>
            <button class="c-btn c-btn--spShow js-spSkillShow">Show Skill</button>
            <button class="p-spShowSkill js-spSkillHide">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </section>
        <section id="skill" class="p-skill c-container u-shadow js-spSkillTarget">
            <h2 class="c-subTitle js-slideIn ">SKILL</h2>
            <div class="p-skill__main">
                <ul class="c-card js-fadeDelay js-spSkillTarget">
					<?php dynamic_sidebar( 'SKILLS-AREA' ); ?>
                </ul>
            </div>
        </section>
        <section id="contact" class="p-contact">
            <div class="p-contact__bg js-fadeIn">
                <h2 class="p-contact__title"><a href="<?php echo get_template_directory_uri(); ?>/contact">CONTACT</a>
                </h2>
                <span class="p-contact__circle"></span>
                <span class="p-contact__circle"></span>
                <span class="p-contact__circle"></span>
            </div>
        </section>
        <ul class="c-bg__squares">
			<?php for ( $i = 1; $i <= 10; $i ++ ) {
				echo '<li></li>';
			} ?>
        </ul>
    </main>
<?php get_footer(); ?>