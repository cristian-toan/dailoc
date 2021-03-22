<?php

	namespace app\Helper;
	
	/* Khai bao cau hinh oauth dung de login */
	define('OAUTH_APP', [
		'facebook' => [
			'client_id'     => '1167770880010136',
			'client_secret' => '6831af6d33509831df1fbb5542052bfa',
			'redirect'      => home_url('/?ta=social-callback&driver=facebook'),
		],
		'google'   => [
			'client_id'     => '8201813553-mstug3rm0nse1vg90vbpt4aur5vb5kd8.apps.googleusercontent.com',
			'client_secret' => 'ZgGpGkojoWjl2RD3biv22mFe',
			'redirect'      => home_url('/?ta=social-callback&driver=google'),
		],
	]);
	
	/**
	 * Class SocialLogin
	 *
	 * @package app\Helper
	 */
	class SocialLogin {
		
		public function __construct() {
			
			/* Tao custom route de chuyen huong den social login */
			$router = new \NetRivet\WordPress\Router('ta');
			/* Route goi ham Oauth login */
			$router->get('social-login', function() {
				//        dd(home_url('/?ta=social-callback&driver=facebook'));
				$driver    = $_GET['driver'];
				$socialite = new \Overtrue\Socialite\SocialiteManager(OAUTH_APP);
				$response  = $socialite->driver($driver)->redirect();
				$response->send();
			});
			
			/* Route callback sau khi thuc hien xong Oauth login */
			$router->get('social-callback', function() {
				$driver             = $_GET['driver'];
				$redirectAfterLogin = "<script>window.opener.location.reload(); window.close();</script>";
				$socialite          = new \Overtrue\Socialite\SocialiteManager(OAUTH_APP);
				$oath               = $socialite->driver($driver)->user();
				$userParams         = [];
				switch($driver) {
					case 'facebook':
						$userParams = [
							'user_login'   => $oath->email,
							'user_email'   => $oath->email,
							'user_pass'    => $oath->email,  // When creating an user, `user_pass` is expected.
							'display_name' => $oath->name,
							'first_name'   => $oath->first_name,
							'last_name'    => $oath->last_name,
						];
						break;
					case 'google':
						$userParams = [
							'user_login'   => $oath->email,
							'user_email'   => $oath->email,
							'user_pass'    => $oath->email,  // When creating an user, `user_pass` is expected.
							'display_name' => $oath->displayName,
							'first_name'   => $oath->givenName,
							'last_name'    => $oath->familyName,
						];
						break;
					default:
						echo $redirectAfterLogin;
						die();
						break;
				}
				
				$db = DB::table('users')->where('user_email', $userParams['user_email']);
				if($db->count() > 0) {
					$user = $db->first();
					wp_clear_auth_cookie();
					wp_set_current_user($user->ID);
					wp_set_auth_cookie($user->ID);
					echo $redirectAfterLogin;
					exit();
				} else {
					$idUser = wp_insert_user($userParams);
					/* neu insert thanh cong user */
					if(!is_wp_error($idUser)) {
						$user = $db->first();
						wp_clear_auth_cookie();
						wp_set_current_user($idUser);
						wp_set_auth_cookie($idUser);
						echo $redirectAfterLogin;
						exit();
					}
				}
			});
			
			/* Route nhan binh luan va insert vao DB */
			$router->post('post-comment', function() {
				$user      = _wp_get_current_user();
				$data      = [
					'comment_post_ID'      => $_POST['idPost'],
					'comment_author'       => $user->display_name,
					'comment_author_email' => $user->user_email,
					'comment_content'      => $_POST['noiDung'],
					'comment_type'         => '',
					'comment_parent'       => 0,
					'user_id'              => $user->ID,
					'comment_author_IP'    => '127.0.0.1',
					'comment_agent'        => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
					'comment_date'         => current_time('mysql'),
					'comment_approved'     => 1,
				];
				$commentId = wp_insert_comment($data);
				if(is_wp_error($commentId)) {
					die('false');
				} else {
					die(json_encode($data));
				}
			});
			
			$router->listen();
			
			/* Cau hinh redirect sau khi login */
			//	if ((isset($_GET['action']) && $_GET['action'] != 'logout') || (isset($_POST['login_location']) && !empty($_POST['login_location']))) {
			//		add_filter('login_redirect', 'my_login_redirect', 10, 3);
			//		function my_login_redirect() {
			//			updateUserMeta(get_current_user_id(), 'last_login', time());
			//			wp_safe_redirect('/');
			//			exit();
			//		}
			//	}
			//
			//	add_action('init', function(){
			//		$login_page  = home_url('/dang-nhap/');
			//		$page_viewed = basename($_SERVER['REQUEST_URI']);
			//		if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
			//			wp_redirect($login_page);
			//			exit;
			//		}
			//	});
			
			/* Kiểm tra lỗi đăng nhập */
			//	add_action('wp_login_failed', function(){
			//		$login_page = home_url('/dang-nhap/');
			//		wp_redirect($login_page . '?login=failed');
			//		exit;
			//	});
			
			
		}
		
	}