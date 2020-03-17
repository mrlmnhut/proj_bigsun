<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'wp_bigsun');

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define('DB_PASSWORD', '');

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '<9V?Gf{mq~l5a%[]=V<:+J613]le}073EWeE4 8Hj66,r/iq._8ki_~T!OoM`B:`');
define('SECURE_AUTH_KEY', '|9%+LI7fi^Y@K`/Frzy,O_%$1IcqZ:@)t|^|t (QyHzyiM4$bE+2~FSl+i0mKjw9');
define('LOGGED_IN_KEY', '(Z`$i~x@pO+c -2^ch:&BYA:fR/1eSig%mU#@e:,h4J`#,&2ackZfqo}l&p962k)');
define('NONCE_KEY', 'JfEc$NSa7hmtA~ KxMFTI4SSoyXIeT;<EvMk^YoE%I@+r_V,l*3;|O<=4CPu)A$N');
define('AUTH_SALT', 'ggH]hmS&qr[:.;,oO%[Hv.bXrUPODoJhM8A6+_9NpteK~w(+`xRK=BIdXV7~4VW7');
define('SECURE_AUTH_SALT', 'm6KFTbjG|tU3z/;d;:MzjS~g0Au4;PU?-6yeApfM-7h!o3xxgKnC$=|CyhVv}xik');
define('LOGGED_IN_SALT', '+p3lY(F[v4WF2nUJ3ln2r9nhy&N OjdL+@1mqVfWW=HA tYC>i7*XkKH-1;#z(=x');
define('NONCE_SALT', 'K(cu74KPSjZp6dbj.N2<MhS%#ZJB6JK{>j_Y&?3q/I%CBwSmPb:zYEs%S! Ja(.e');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', TRUE);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
