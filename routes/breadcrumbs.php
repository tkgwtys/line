<?php
/////////////////////////////////////////////
// 管理画面
/////////////////////////////////////////////

/**
 * トップ
 * /admin/home
 */

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('ホーム', url('/admin/home'));
});

/**
 * フレンド一覧
 * /admin/useshowUserr
 */
Breadcrumbs::for('adminUsers', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('フレンド管理', url('/admin/user'));
});

/**
 * フレンド詳細
 * /admin/user/U7fb49ca09c50b7d869f4c667eb3dcdc3
 */
Breadcrumbs::for('adminUser', function ($trail, $user) {
    $trail->parent('adminUsers');
    $trail->push('ユーザー詳細', url('/admin/user/' . $user->id));
});

/**
 * ユーザー編集
 * /admin/user/$user->id/edit
 */
Breadcrumbs::for('adminUser.edit', function ($trail, $user) {
    $trail->parent('adminUser', $user);
    $trail->push('ユーザー編集', url('/admin/user/' . $user->id . '/edit'));
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

/**
 * コース一覧
 * /admin/course
 */
Breadcrumbs::for('adminCourses', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('コース管理', url('/admin/course'));
});

/**
 * コース詳細
 * /admin/course/{course}
 */
Breadcrumbs::for('adminCourse', function ($trail, $course) {
    $trail->parent('adminCourses');
    $trail->push('コース詳細', url('/admin/course/' . $course->id));
});

/**
 * コース編集
 * /admin/user/{course}/edit
 */
Breadcrumbs::for('adminCourse.edit', function ($trail, $course) {
    $trail->parent('adminCourse', $course);
    $trail->push('コース編集', url('/admin/course/' . $course->id . '/edit'));
});

/**
 * コース作成
 * /admin/course/create
 */
Breadcrumbs::for('admin.course.create', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('コース管理', url('/admin/course'));
    $trail->push('コース登録', url('/admin/course/create'));
});

/**
 * ストア一覧
 * /admin/store
 */
Breadcrumbs::for('adminStores', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('ストア管理', url('/admin/store'));
});

/**
 * ストア詳細
 * /admin/store/{store}
 */
Breadcrumbs::for('adminStore', function ($trail, $store) {
    $trail->parent('adminStores');
    $trail->push('ストア詳細', url('/admin/store/' . $store->id));
});

/**
 * コース編集
 * /admin/store/{store}/edit
 */
Breadcrumbs::for('adminStore.edit', function ($trail, $store) {
    $trail->parent('adminStore', $store);
    $trail->push('ストア編集', url('/admin/store/' . $store->id . '/edit'));
});

/**
 * コース作成
 * /admin/store/create
 */
Breadcrumbs::for('admin.store.create', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('ストア管理', url('/admin/store'));
    $trail->push('ストア登録', url('/admin/store/create'));
});

/////////////////////////////////////////////////////////////////////////
///
/// ユーザ側
///
/////////////////////////////////////////////////////////////////////////
// ホーム
Breadcrumbs::for('userHome', function ($trail) {
    $trail->push('ホーム', url('/home'));
});
/**
 * 予約一覧
 */
Breadcrumbs::for('userReservation', function ($trail) {
    $trail->parent('userHome');
    $trail->push('予約一覧', url('/reservation/'));
});
/**
 * 予約編集
 */
Breadcrumbs::for('userReservationEdit', function ($trail, $reservation) {
    $trail->parent('userHome');
    $trail->push('予約一覧', url('/reservation/' . $reservation->reservation_id . '/edit'));
});
