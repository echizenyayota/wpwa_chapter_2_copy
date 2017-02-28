<?php
/*
  Plugin Name: WPWA User Manager
  Plugin URI:
  Description: User management module for the portfolio management application.
  Author: Rakhitha Nimesh
  Version: 1.0
  Author URI: http://www.innovativephp.com/
*/

class WPWA User_Manager {
  public function __construct() {
    // 初期化コード
    register_activation_hook( __FILE__ , array( $this, 'add_application_user_roles' ) );
  }

  // フォロワー、開発者、メンバー 3種類のユーザーロール
  public function add_application_user_roles() {
      add_role( 'follower', 'Follower', array( 'read' => true ) );
      add_role( 'developer', 'Developer', array( 'read' => true ) );
      add_role( 'member', 'Member', array( 'read' => true ) );
  }
  
}

$user_manage = new WPWA_User_Manager();
