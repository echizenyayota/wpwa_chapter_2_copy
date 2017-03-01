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
}

$user_manage = new WPWA_User_Manager();
