<?php
/////////////////////////////////////////////
// 管理画面
/////////////////////////////////////////////
/**
 * トップ
 * /admin/home
 */
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('ホーム', url('/admin/home'));
});

/**
 * フレンド一覧
 * /admin/user
 */
Breadcrumbs::for('adminUsers', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('フレンド管理', url('/admin/user'));
});

/**
 * フレンド詳細
 * /admin/user/U7fb49ca09c50b7d869f4c667eb3dcdc3
 */
Breadcrumbs::for('showUser', function ($trail, $user) {
    $trail->parent('adminUsers');
    $trail->push($user->display_name, url('/admin/user' . $user->id));
});

/**
 * トレーナ一覧
 * /admin/player
 */
Breadcrumbs::for('adminPlayers', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('トレーナ管理', url('/admin/player'));
});

/**
 * トレーナ詳細
 * /admin/player/U7fb49ca09c50b7d869f4c667eb3dcdc3
 */
Breadcrumbs::for('adminPlayer', function ($trail, $player) {
    $trail->parent('adminPlayers');
    $trail->push($player->display_name, url('/admin/user' . $player->id));
});

Breadcrumbs::for('admin.player.create', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('トレーナ管理', url('/admin/player'));
    $trail->push('トレーナ登録', url('/admin/player/create'));
});
