<?php
if (is_404()) {
	get_header();
	get_template_part( 'content', 'menu' );
	?>
    <main class="l-main" style="height: calc(100vh - 45px);">
        <section id="err-404" class="c-container">
            <h2 class="c-subTitle">ERROR：404</h2>
            <div style="text-align: center">
                <p>申し訳ありませんが、要求されたページが見つかりませんでした。</p>
            </div>
        </section>
    </main>
	<?php
	get_footer();
	exit;
}
?>
<?php get_header(); ?>
<!-- ヘッダー -->
<?php get_header(); ?>
<!-- メニュー -->
<?php get_template_part('content','menu'); ?>
<main class="l-main">
    <section class="p-hero c-container">
        <h2 class="p-hero__title">PORTFOLIO</h2>
        <div class="p-hero__banner">
            <img class="p-hero__img" src="./src/img/rain.jpg" alt="hero-banner">
        </div>
    </section>
    <section id="works" class="p-works c-container">
        <h2 class="c-subTitle">WORKS</h2>
        <ul class="p-works__list">
            <li class="p-works__item">
                <h3 class="p-works__title">架空フリマサイト</h3>
                <div class="p-works__info">
                    <a class="p-works__link" href="#">
                        <img src="./src/img/freemarket.png" alt="">
                    </a>
                    <p>フルスクラッチ制作</p>
                </div>
            </li>
            <li class="p-works__item">
                <h3 class="p-works__title">TODOアプリ</h3>
                <div class="p-works__info">
                    <a class="p-works__link" href="#">
                        <img src="./src/img/todo.png" alt="">
                    </a>
                    <p>Vue.jsでのTODOアプリ</p>
                </div>
            </li>
            <li class="p-works__item">
                <h3 class="p-works__title">架空WPテーマ</h3>
                <div class="p-works__info">
                    <a class="p-works__link" href="#">
                        <img src="./src/img/wp.png" alt="">
                    </a>
                    <p>自作WPテーマの架空運用サイト</p>
                </div>
            </li>
        </ul>
    </section>
    <section id="about" class="p-about">
        <h2 class="c-subTitle">ABOUT</h2>
        <div class="p-about__mainContainer">
            <h3 class="p-about__name">TAKUYA INATSUGI</h3>
            <div class="p-about__main">
                <div class="p-about__career">
                    <div class="p-about__img">
                        <img src="./src/img/me.jpeg" alt="">
                    </div>
                    <p>
                        1991年、福岡県生まれ。<br>
                        <br>
                        工業校を卒業し、工場にて10年勤務。<br>
                        業務内容は品質管理。
                        現場での小グループでのマネジメント経験あり。<br>
                        心機一転、2022年5月からWEBプログラミングを勉強。<br>
                        <br>
                    </p>
                </div>
                <div class="p-about__description">
                    <ul class="p-skill">
                        <li class="p-skill__item">
                            <p class="p-skill__title">HTML/CSS</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/html5-css3.png" alt="">
                                </div>
                                <p>レスポンシブデザイン、sass記法での記述が可能。CSS設計はBEM、FLOCSSを用いて保守性の高い記述が可能。</p>
                            </div>
                        </li>
                        <li class="p-skill__item">
                            <p class="p-skill__title">javaScript/jQuery</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/javascript-jquery.png" alt="">
                                </div>
                                <p>基本的なアニメーションや、Ajaxでの非同期通信が可能。</p>
                            </div>
                        </li>
                        <li class="p-skill__item">
                            <p class="p-skill__title">PHP</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/php.png" alt="">
                                </div>
                                <p>フルスクラッチでDBへ接続、データの入出力、ログイン認証等の機能を有した動的なWEBサイトが制作可能。</p>
                            </div>
                        </li>
                        <li class="p-skill__item">
                            <p class="p-skill__title">Vue.js</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/vue.png" alt="">
                                </div>
                                <p>TODOアプリが作れる程度。</p>
                            </div>
                        </li>
                        <li class="p-skill__item">
                            <p class="p-skill__title">React.js</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/react.png" alt="">
                                </div>
                                <p>TODOアプリが作れる程度。</p>
                            </div>
                        </li>
                        <li class="p-skill__item">
                            <p class="p-skill__title">Wordpress</p>
                            <div class="p-skill__info">
                                <div class="p-skill__logo">
                                    <img src="./src/img/wordpress.png" alt="">
                                </div>
                                <p>サイトのWP化、簡単なテーマが作成可能。</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="p-contact">
        <div class="p-contact__bg">
            <h2 class="p-contact__title">CONTACT</h2>
            <span class="p-contact__circle"></span>
            <span class="p-contact__circle"></span>
            <span class="p-contact__circle"></span>
        </div>
    </section>
    <ul class="c-bg__squares">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</main>
<?php get_footer(); ?>