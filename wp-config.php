<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'blog_shortcut');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'guideguide');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'QeHk#nCBXtGM');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2t+V041BK7(I`12t>BJ67|BF@9W7(q2b87b}0`Q9TnpfVjmjuW<jOfAAYCtzCzNp');
define('SECURE_AUTH_KEY',  'ysnk&EOT:0o4?R4D]mcN+`r1u]01#PhB@9ucW+7G8{!i!NNWT)5e(|!BTUqYy{6Q');
define('LOGGED_IN_KEY',    'P38|{K%qL(22Xa rLW];fAlg:PeJmA]-X.2(NH(WxMHyPt,-olIZs9567RWAB&+t');
define('NONCE_KEY',        '|4X,Y6AHo,+*!:D+!|R3Dyj7:B@9VN3e0V 4AKoOM$bimjwmF^Xv~OFJh1;o0P,}');
define('AUTH_SALT',        '^ovp]cL7+:Sn_mf*o3c/_+Ukda{y3V;bbq0*}R_/1+5@fmX8O 0w~v-C$4CH;$gU');
define('SECURE_AUTH_SALT', 'IZa2d74Xo/>RcqdPb7{~x{nFOr[D+xCAxnCh+Fxvu5(S9_rJvLj^m[{Fx)-7cfL(');
define('LOGGED_IN_SALT',   'm=uuMWpP67|=!^Xl3U#*5Ju={Ouus9onr4EX:?gT|2nVfY5YVHmw1p)Y96QO>/;I');
define('NONCE_SALT',       '9:6tYTy.-jlOr{Wt2vB]D>t{@k^H>(EL+H}P-ThAF`&v C|lkD%nY&0nAix4|BiD');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'bc_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */

define ('WPLANG', 'ja');
define('WP_DEBUG', true);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
