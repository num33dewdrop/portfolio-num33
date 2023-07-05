<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

//====================================================
//タイトル表示
//====================================================
add_theme_support( 'title-tag' );

//====================================================
//jsファイル読み込み
//====================================================
function my_scripts_method() {
	wp_enqueue_script(
		'custom_script',
		get_template_directory_uri() . '/dist/js/bundle.js'
	);
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

//====================================================
//カスタムメニュー使用
//====================================================
register_nav_menu('mainmenu', 'メインメニュー');

//====================================================
//管理画面用CSS（ウィジェット）
//====================================================
function add_custom_styles() {
	if ( defined( 'IFRAME_REQUEST' ) && IFRAME_REQUEST ) {
		?>
        <style>
            img {
                width: 150px !important;
            }
            .c-card__container {
                display: flex;
            }
            .c-card__head {
                margin-right: 15px;
            }
        </style>
		<?php
	}
}
add_action( 'wp_head', 'add_custom_styles' );

//====================================================
// 投稿抜粋末尾の文字列を[…]から変更する
//====================================================
function my_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');

//====================================================
//カスタムフィールド
//====================================================
/*投稿ページへ表示するカスタムボックスを定義する*/
add_action('admin_menu', 'add_custom_input');
/*追加した表示項目のデータ更新 保存のためのアクションフック データベースへ*/
add_action('save_post', 'save_custom_post');

/*入力項目がどの投稿タイプのページに表示されるのかの設定*/
function add_custom_input(){
	//第一引数：編集画面のhtmlに挿入されるid属性名
	//第二引数：管理画面に表示されるカスタムフィールド名
	//第三引数：メタボックスの中に出力される関数名
	//第四引数：管理画面に表示するカスタムフィールドの場所（postなら投稿、pageなら固定ページ）
	//第五引数：配置される順序
	add_meta_box('top_banner_id', 'TOP-BANNER画像URL入力欄','custom_area1','page','normal');
	add_meta_box('about_id', 'ABOUT入力欄', 'custom_area2', 'page', 'normal');
	add_meta_box('works_img_id', '画像URL入力欄', 'custom_area3', 'post', 'normal');
}

/*管理画面に表示される内容*/
function custom_area1() {
	global $post;
	echo 'トップバナーURL　　：<input type="text" name="top_banner" value="'.get_post_meta($post->ID,'top_banner',true).'"><br>';
}
function custom_area2(){
	global $post;
    echo '名前　　　　　　　　：<input type="text" name="about_name" value="'.get_post_meta($post->ID,'about_name',true).'"><br>';
    echo '<br>';
	echo 'コメント　　　　　　：<textarea cols="50" rows="5" name="about_msg">'.get_post_meta($post->ID,'about_msg',true).'</textarea><br>';
	echo '<br>';
	echo 'プロフィール画像URL：<input type="text" name="about_img" value="'.get_post_meta($post->ID,'about_img',true).'"><br>';
}

function custom_area3() {
	global $post;
	echo '画像URL　：<input type="text" name="works_img" value="'.get_post_meta($post->ID,'works_img',true).'"><br>';
	echo 'サイトURL：<input type="text" name="works_url" value="'.get_post_meta($post->ID,'works_url',true).'"><br>';
}

//保存用処理関数
function save_process( $post_id, $key ) {
	//カスタムフィールドに入力された情報を取り出す
	$data = '';
    if(isset($_POST[$key])) $data = $_POST[$key];
	//内容が変わっていた場合、保存していた情報を更新する
	if($data != get_post_meta($post_id, $key, true)){
		update_post_meta($post_id, $key, $data);
	}elseif($data == ''){
		delete_post_meta($post_id, $key, get_post_meta($post_id, $key, true));
	}
}

/*投稿ボタンを押した際のデータ更新と保存*/
function save_custom_post($post_id){
	//TOP-BANNER
	save_process($post_id, 'top_banner');
    //ABOUT NAME
	save_process($post_id, 'about_name');
	//ABOUT MSG
	save_process($post_id, 'about_msg');
	//ABOUT IMG
	save_process($post_id, 'about_img');
	//WORKS IMG
	save_process($post_id, 'works_img');
	//WORKS URL
	save_process($post_id, 'works_url');
}
/*==========================
カスタムウィジェット
==========================*/
//ウィジェットエリアを作成する関数がどれなのかを登録する
add_action( 'widgets_init', 'my_widgets_area1');
//ウィジェット自体の作成するクラスがどれなのかを登録する
add_action( 'widgets_init', function(){ register_widget('skills_widgets'); });

function my_widgets_area1() {
	//dynamic_sidebarに渡すときはnameかid
	register_sidebar( [
		'name'          => 'SKILLS-AREA',
		'id'            => 'widget_skill',
		'before_widget' => '<li class="c-card__item">',
		'after_widget'  => '</li>',
		'before_title'  => '<p class="c-card__title">',
		'after_title'   => '</p>',
	] );
}

class skills_widgets extends WP_Widget {
	//初期化（管理画面で表示するウィジェットの名前を設定する
	public function __construct() {
		parent::__construct(
			'Skills_widgets', // Base ID
			__( 'SKILLS-WIDGET', 'text_domain' ), // Name
			[ 'description' => __( 'SKILLSのウィジェットです。', 'text_domain' ), ] // Args
		);
	}

	//ウィジェットの入力項目を作成する処理
	/**
	 * バックエンドのウィジェットフォーム
	 *
	 * @param array $instance データベースからの前回保存された値
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		//入力された情報をサニタイズして変数へ格納
		$title = (isset( $instance['title'] ))? $instance['title'] : __( '新しいタイトル', 'text_domain' );
		$supplement = (isset( $instance['supplement'] ))? $instance['supplement'] : __( '新しい説明', 'text_domain' );
		$img_url = (isset( $instance['img_url'] )) ? $instance['img_url'] : __( '新しい画像URL', 'text_domain');
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'タイトル:' ); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'supplement' ); ?>">
				<?php _e('内容：'); ?>
            </label>
            <textarea class="widefat" name="<?php echo $this->get_field_name( 'supplement' ); ?>"
                      id="<?php echo $this->get_field_id( 'supplement' ); ?>" cols="20"
                      rows="16"><?php echo esc_attr($supplement); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'img_url' ); ?>"><?php _e( '画像URL：' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" value="<?php echo esc_attr( $img_url ); ?>">
        </p>
		<?php
	}

	//ウィジェットに入力された情報を保存する処理
	/**
	 * ウィジェットフォームの値を保存用にサニタイズ
	 *
	 * @param array $new_instance 保存用に送信された値
	 * @param array $old_instance データベースからの以前保存された値
	 *
	 * @return array 保存される更新された安全な値
	 *@see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : ''; //サニタイズ html,phpタグを取り除く
		$instance['supplement'] = ( !empty( $new_instance['supplement'] ) ) ? trim( $new_instance['supplement'] ) : ''; //サニタイズ html,phpタグを取り除く
		$instance['img_url'] = ( !empty( $new_instance['img_url'] ) ) ? strip_tags( $new_instance['img_url'] ) : '';
		return $instance;
	}

	//管理画面から入力されたウィジェットを画面に表示する処理
	/**
	 * ウィジェットのフロントエンド表示
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     ウィジェットの引数
	 * @param array $instance データベースの保存値
	 */
	public function widget( $args, $instance ) {
		//配列を変数に展開
		extract( $args );//key名が変数名に変わる
		//ウィジェットから入力された情報を取得
		$title = apply_filters( 'widget_title', $instance['title'] );
		$supplement  = apply_filters( 'widget_supplement', $instance['supplement'] );
		$img_url  = apply_filters( 'widget_img_url', $instance['img_url'] );
		if ( !empty( $title ) ) {
			echo $before_widget;
			?>
            <div class="c-card__container c-card__container--noHover">
                <div class="c-card__head">
                    <img class="c-card__img c-card__img--skill" src="<?php echo $img_url ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="c-card__body c-card__body--big">
					<?php echo $before_title.$title.$after_title; ?>
                    <p><?php echo $supplement ?></p>
                </div>
            </div>
			<?php
			echo $after_widget;
		}
	}
}
