<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

////////////////////////////////////////////
//
// 管理
//
/////////////////////////////////////////////
Breadcrumbs::for('adminHome', function ($trail) {
    $trail->push('ホーム', url('/admin/home'));
});
Breadcrumbs::for('adminPlayer', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('トレーナ管理', url('/admin/player'));
});
Breadcrumbs::for('adminPlayerSchedule', function ($trail, $player) {
    $trail->parent('adminPlayer');
    $trail->push($player->display_name, url('/admin/user' . $player->id));
});
Breadcrumbs::for('adminSchedule', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('スケジュール管理（全体）', url('/admin/schedule'));
});
Breadcrumbs::for('adminUser', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('フレンド管理', url('/admin/user'));
});
Breadcrumbs::for('adminUserShow', function ($trail, $user) {
    $trail->parent('adminHome');
    $trail->push('フレンド管理', url('/admin/user'));
    $trail->push($user->display_name, url('/admin/user' . $user->id));
});
Breadcrumbs::for('adminUserEdit', function ($trail, $user) {
    $trail->parent('adminHome');
    $trail->push('フレンド管理', url('/admin/user'));
    $trail->push($user->display_name, url('/admin/user/' . $user->id));
    $trail->push('編集', url('/admin/user'));
});
Breadcrumbs::for('adminCourseIndex', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('コース管理', url('/admin/course'));
});
Breadcrumbs::for('adminCourseCreate', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('コース管理', url('/admin/course'));
    $trail->push('新規作成', url('/admin/course'));
});
Breadcrumbs::for('adminCourseShow', function ($trail, $course) {
    $trail->parent('adminHome');
    $trail->push('コース管理', url('/admin/course'));
    $trail->push($course->name, url('/admin/course/' . $course->id));
});
Breadcrumbs::for('adminCourseEdit', function ($trail, $course) {
    $trail->parent('adminHome');
    $trail->push('コース管理', url('/admin/course'));
    $trail->push($course->name, url('/admin/course/' . $course->id));
    $trail->push('編集', url('/admin/course'));
});
Breadcrumbs::for('adminStoreIndex', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('店舗管理', url('/admin/store'));
});
Breadcrumbs::for('adminStoreCreate', function ($trail) {
    $trail->parent('adminHome');
    $trail->push('店舗管理', url('/admin/store'));
    $trail->push('新規作成', url('/admin/store'));
});
Breadcrumbs::for('adminStoreShow', function ($trail, $store) {
    $trail->parent('adminHome');
    $trail->push('店舗管理', url('/admin/store'));
    $trail->push($store->name, url('/admin/store/' . $store->id));
});
Breadcrumbs::for('adminStoreEdit', function ($trail, $store) {
    $trail->parent('adminHome');
    $trail->push('店舗管理', url('/admin/store'));
    $trail->push($store->name, url('/admin/store/' . $store->id));
    $trail->push('編集', url('/admin/store'));
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
Breadcrumbs::for('userReservation', function ($trail) {
    $trail->parent('userHome');
    $trail->push('予約確認・キャンセル', url('/reservation/'));
});
Breadcrumbs::for('userReservationCreate', function ($trail) {
    $trail->parent('userHome');
    $trail->push('予約申請', url('/reservation/'));
});
Breadcrumbs::for('userReservationEnd', function ($trail) {
    $trail->parent('userHome');
    $trail->push('予約申請完了', url('/reservation/'));
});
Breadcrumbs::for('userUserEdit', function ($trail) {
    $trail->parent('userHome');
    $trail->push('カウント設定', url('/user/edit'));
});
///**
// * フレンド一覧
// * /admin/useshowUserr
// */
//Breadcrumbs::for('adminUser', function ($trail) {
//    $trail->parent('adminHome');
//    $trail->push('フレンド管理', url('/admin/user'));
//});
//
///**
// * フレンド詳細
// * /admin/user/U7fb49ca09c50b7d869f4c667eb3dcdc3
// */
//Breadcrumbs::for('adminUser', function ($trail, $user) {
//    $trail->parent('adminHome');
//    $trail->push('ユーザー詳細', url('/admin/user/' . $user->id));
//});
//
///**
// * ユーザー編集
// * /admin/user/$user->id/edit
// */
//Breadcrumbs::for('adminUserEdit', function ($trail, $user) {
//    $trail->parent('adminUser', $user);
//    $trail->push('ユーザー編集', url('/admin/user/' . $user->id . '/edit'));
//});
//
///**
// * ノート作成
// * /admin/note/{post}/post
// */
//Breadcrumbs::for('admin.note.post', function ($trail, $user) {
//    $trail->parent('adminUser', $user);
//    $trail->push('ノート作成(' . $user->sei . ')', url('/admin/note/' . $user->id . '/post'));
//});
//
///**
// * ノート編集
// * /admin/note/{post}/edit
// */
//Breadcrumbs::for('admin.note.edit', function ($trail, $user, $note) {
//    $trail->parent('adminUser', $user);
//    $trail->push('ノート編集', url('/admin/note/' . $note->id . '/edit'));
//});
//
///**
// * トレーナ一覧
// * /admin/player
// */
//Breadcrumbs::for('adminPlayers', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('トレーナ管理', url('/admin/player'));
//});
//
///**
// * トレーナ詳細
// * /admin/player/U7fb49ca09c50b7d869f4c667eb3dcdc3
// */
//Breadcrumbs::for('adminPlayer', function ($trail, $player) {
//    $trail->parent('adminPlayers');
//    $trail->push($player->display_name, url('/admin/user' . $player->id));
//});
//
//Breadcrumbs::for('admin.player.create', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('トレーナ管理', url('/admin/player'));
//    $trail->push('トレーナ登録', url('/admin/player/create'));
//});
//
///**
// * コース一覧
// * /admin/course
// */
//Breadcrumbs::for('adminCourses', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('コース管理', url('/admin/course'));
//});
//
///**
// * コース詳細
// * /admin/course/{course}
// */
//Breadcrumbs::for('adminCourse', function ($trail, $course) {
//    $trail->parent('adminCourses');
//    $trail->push('コース詳細', url('/admin/course/' . $course->id));
//});
//
///**
// * コース編集
// * /admin/user/{course}/edit
// */
//Breadcrumbs::for('adminCourse.edit', function ($trail, $course) {
//    $trail->parent('adminCourse', $course);
//    $trail->push('コース編集', url('/admin/course/' . $course->id . '/edit'));
//});
//
///**
// * コース作成
// * /admin/course/create
// */
//Breadcrumbs::for('admin.course.create', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('コース管理', url('/admin/course'));
//    $trail->push('コース登録', url('/admin/course/create'));
//});
//
///**
// * ストア一覧
// * /admin/store
// */
//Breadcrumbs::for('adminStores', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('ストア管理', url('/admin/store'));
//});
//
///**
// * ストア詳細
// * /admin/store/{store}
// */
//Breadcrumbs::for('adminStore', function ($trail, $store) {
//    $trail->parent('adminStores');
//    $trail->push('ストア詳細', url('/admin/store/' . $store->id));
//});
//
///**
// * コース編集
// * /admin/store/{store}/edit
// */
//Breadcrumbs::for('adminStore.edit', function ($trail, $store) {
//    $trail->parent('adminStore', $store);
//    $trail->push('ストア編集', url('/admin/store/' . $store->id . '/edit'));
//});
//
///**
// * コース作成
// * /admin/store/create
// */
//Breadcrumbs::for('admin.store.create', function ($trail) {
//    $trail->parent('admin.home');
//    $trail->push('ストア管理', url('/admin/store'));
//    $trail->push('ストア登録', url('/admin/store/create'));
//});

