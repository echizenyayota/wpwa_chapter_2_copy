<?php
/*
  Plugin Name: WPWA User Manager
  Plugin URI:
  Description: User management module for the portfolio management application.
  Author: Rakhitha Nimesh
  Version: 1.0
  Author URI: http://www.innovativephp.com/
*/

//クラス宣言　★追加注釈
class WPWA_User_Manager {
//コンストラクタ　クラス初期化時に実行されるコード群　★追加注釈
//以降の動作に初期値が必要なものはここで宣言しておくもの　★追加注釈
  public function __construct() {
    // 初期化コード
    register_activation_hook( __FILE__ , array( $this, 'add_application_user_roles' ) );
    register_activation_hook( __FILE__, array( $this, 'remove_application_user_roles' ) );
    register_activation_hook( __FILE__, array( $this, 'add_application_user_capabilities' ) );
  }

  // フォロワー、開発者、メンバー 3種類のユーザーロール
  public function add_application_user_roles() {
//add_role( '権限名（機械で処理するため半角ローマ字）', '権限表示名（日本語でおｋ）', array( 追加する権限機能 ) );★追加注釈
      // add_role( 'follower', 'Follower', array( 'read' => true ) );
      // add_role( 'follower', 'Follower', array( 'follow_developer_activities' => true ) );
      add_role( 'follower', 'Follower', array( 'read' => true, 'follow_developer_activities' => true ) );
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

  // フォロワーの最初の権限を与える
  public function add_application_user_capabilities() {
//フォロワーという権限を読み出す★追加注釈
      $role = get_role( 'follower' );
//読みだした権限に機能を付与する★追加注釈
//-------------ここで付与する権限機能がCodexページで見た中に存在していませんがどうなのでしょうか-----------★追加注釈
      $role->add_cap( 'follow_developer_activities' );
  }
}

$user_manage = new WPWA_User_Manager();
