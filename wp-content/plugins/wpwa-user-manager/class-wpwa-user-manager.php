<?php
/*
  Plugin Name: WPWA User Manager
  Plugin URI:
  Description: User management module for the portfolio management application.
  Author: Rakhitha Nimesh
  Version: 1.0
  Author URI: http://www.innovativephp.com/
*/

class WPWA_User_Manager {
  public function __construct() {
    // 初期化コード
    register_activation_hook( __FILE__ , array( $this, 'add_application_user_roles' ) );
    register_activation_hook( __FILE__, array( $this, 'remove_application_user_roles' ) );
    register_activation_hook( __FILE__, array( $this, 'add_application_user_capabilities' ) );
    register_activation_hook( __FILE__, array( $this, 'flush_application_rewrite_rules' ) );

    add_action( 'init', array( $this, 'manage_user_routes' ) );

    add_filter( 'query_vars', array( $this, 'manage_user_routes_query_vars' ) );
  }

  // フォロワー、開発者、メンバー 3種類のユーザーロール
  public function add_application_user_roles() {
      add_role( 'follower', 'Follower', array( 'read' => true ) );
      add_role( 'developer', 'Developer', array( 'read' => true ) );
      add_role( 'member', 'Member', array( 'read' => true ) );
  }

  // 既存のユーザーロールを削除する
  public function remove_application_user_roles() {
      remove_role( 'author' );
      remove_role( 'editor' );
      remove_role( 'contributor' );
      remove_role( 'subscriber' );
  }


  // 最初の権限を与える
  public function add_application_user_capabilities() {
      $role = get_role( 'follower' );
      $role->add_cap( 'follow_developer_activities' );
  }

  // ルーティングルールを作る
  public function manage_user_routes() {
      add_rewrite_rule( '^user/([^/]+)/?', 'index.php?control_action=$matches[1]', 'top' );
  }

  // リライトルールをフラッシュする
  public function flush_application_rewrite_rules() {
      $this->manage_user_routes();
      flush_rewrite_rules();
  }

  // カスタムクエリ変数の追加
  public function manage_user_routes_query_vars( $query_vars ) {
      $query_vars[] = 'control_action';
      return $query_vars;
  }
}

$user_manage = new WPWA_User_Manager();
