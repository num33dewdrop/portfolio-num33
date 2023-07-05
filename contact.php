<?php
/*
 * Template Name: CONTACT --お問い合わせ--
 * Template Post Type: page
 */

get_header(); // ヘッダーを読み込む
get_template_part('content','menu'); ?>
	<main class="l-main">
		<section id="contact" class="c-form js-fadeIn">
			<!-- 投稿、固定ページのタイトルを表示 -->
			<h2 class="c-subTitle js-slideIn"><?php echo get_the_title(); ?></h2>
			<?php
			if(have_posts()):
				while(have_posts()):the_post();
					?>
					<!-- ループ内容（本文） -->
					<!--
					「the_ID()」現在の投稿、固定ページの ID を表示。必ずループの中で使用
					管理画面で投稿する際にclass属性を付けることができる。
					「post_class()」で出力
					-->
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<!-- 投稿、固定ページの本文を出力 -->
						<?php the_content(); ?>
					</div>
				<?php
				endwhile;
			else://記事が見つからなかった場合の処理
				?>
				<div class="post">
					<h2>記事はありません</h2>
					<p>お探しの記事は見つかりませんでした。</p>
				</div>
			<?php
			endif;
			?>
		</section>
        <ul class="c-bg__squares">
			<?php for($i = 1; $i <= 10; $i++){
				echo '<li></li>';
			} ?>
        </ul>
	</main>
<?php get_footer(); ?>