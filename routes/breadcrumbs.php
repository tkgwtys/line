<?php

Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push('ホーム', url('/admin/home'));
});

Breadcrumbs::for('admin.player', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('トレーナ管理', url('/admin/player'));
});

