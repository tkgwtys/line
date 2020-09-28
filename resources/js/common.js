$('.spinner-border').css('display', 'none');
//$('#target-table td').on('click', function () {
$('.reservationButton').on('click', function () {
    $('.alert').css('display', 'none');
    // 予約日
    const day = $(this).data('day');
    // 予約時間
    const time = $(this).data('time');
    // トレーナーID
    const playerId = $(this).data('player_id');
    // ユーザーID
    //const user_id = $(this).children('div').data('user_id');
    const user_id = $(this).data('user_id');
    // コースID
    //const course_id = $(this).children('div').data('course_id');
    const course_id = $(this).data('course_id');
    // 予約ID
    // const reservation_id = $(this).children('div').data('reservation_id');
    const reservation_id = $(this).data('reservation_id');
    // 店舗ID
    // const store_id = $(this).children('div').data('store_id');
    const store_id = $(this).data('store_id');
    // 姓
    const sei = $(this).data('sei');
    // 名
    const mei = $(this).data('mei');
    // ステータス
    const status = $(this).data('status');
    // 予約フォームラベル
    $('#reservation_label').text('予約フォーム');
    if (typeof reservation_id === "undefined") {
        $('#reservation_delete_button').css('display', 'none');//.text('選択してください');
        $('#reservation_label').html('<span class="badge badge-primary">新規予約</span>');
    } else if (status === 10) {
        $('#reservation_delete_button').css('display', 'block');//.text('選択してください');
        $('#reservation_label').html('<span class="badge badge-warning">予約申請</span>');
    } else if (status === 30) {
        $('#reservation_delete_button').css('display', 'block');//.text('選択してください');
        $('#reservation_label').html('<span class="badge badge-success">予約確定</span>');
    }
    // トレーナのデフォルト値
    $('#player').val(playerId);
    // 予約した人のデフォルト値
    $('#user').val(user_id);
    $('.selector').val(day);
    $('#selected_date').val(day);
    $('#selected_time').val(time);
    $('#course').val(course_id);
    $('#store').val(store_id);
    $('#sei').val(sei);
    $('#mei').val(mei);
    $('#reservation_id').val(reservation_id);
    // 削除用
    $('#reservation_id_delete').val(reservation_id);
});

/**
 * 直接予約フォームに来た場合
 */
$(window).on('load', function () {
    $('#reservationDirectly').modal('show');
});

/**
 * ユーザー側でキャンセル処理
 */
$('#user_reservation_list').on('click', 'button', function () {
    // 確認
    if (!confirm('予約をキャンセルしますか？')) {
        return false;
    }
    // 予約番号
    const reservation_id = $(this).data('reservation_id');
    if (!reservation_id) {
        alert('予約番号が取得できませんでした');
        return;
    }
    // トークン取得
    const _token = $('meta[name="csrf-token"]').attr('content');
    if (!_token) {
        alert('トークンが取得できませんでした');
        return;
    }
    // ボタンを無効
    $('button').attr('disabled', true);
    // 削除対象
    const removeTr = $(this).closest('tr');
    $.ajax({
        type: 'DELETE',
        url: `/reservation/${reservation_id}`,
        data: {
            _token,
            reservation_id,
        },
    }).done(function (data) {
        console.log(data);
        $('button').attr('disabled', false);
        if (data.result) {
            removeTr.remove();
            $('#alert_message').html('<div class="alert alert-success" role="alert">' + data.message + '</div>');
        }
    }).fail(function (data) {
        $('#alert_message').html('<div class="alert alert-danger" role="alert">' + data.message + '</div>');
        $('button').attr('disabled', false);
        $('.spinner-border').css('display', 'none');
    }).always(function (data) {
    });
});

/**
 * 予約削除処理
 */
$('#reservation_delete_button').on('click', function () {
    if (!confirm('予約を削除しますか？')) {
        return false;
    }
    // 予約番号
    const reservation_id = $('#reservation_id_delete').val();
    if (!reservation_id) {
        alert('予約番号が取得できませんでした');
        return;
    }
    const _token = $('meta[name="csrf-token"]').attr('content');
    if (!_token) {
        alert('トークンが取得できませんでした');
        return;
    }
    // ボタンを無効
    $('button').attr('disabled', true);
    $.ajax({
        type: 'DELETE',
        url: `/admin/reservation/${reservation_id}`,
        data: {
            _token,
            reservation_id,
        },
    }).done(function (data) {
        if (data.result) {
            // 通信が成功したときの処理
            window.location.reload();
        }
    }).fail(function () {
        $('button').attr('disabled', false);
        $('.spinner-border').css('display', 'none');
        // 通信が失敗したときの処理
        console.log('ng');
    }).always(function (data) {
        // 通信が完了したとき
        console.log('通る');
    });
});

/**
 *
 * @type {any | flatpickr}
 */
const flatpickr = require('flatpickr');
const japan = require('flatpickr/dist/l10n/ja.js').default.ja;
flatpickr('.selector', {
    // enableTime: true, // タイムピッカーを有効
    // enableSeconds: true, // '秒' を無効
    // enableSeconds: false, // '秒' を無効
    time_24hr: false, // 24時間表示
    defaultHour: 7, // 時
    defaultMinute: 0, // 分
    minTime: "07:00",
    maxTime: "23:45",
    // dateFormat: 'Y年m月d日 H:i',
    dateFormat: 'Y-m-d',
    locale: japan,
    // minuteIncrement: 15,
    // カレンダーが変更されたら
    onChange(selectedDates) {
        $('#selected_date').val(`${selectedDates[0].getFullYear()}-${selectedDates[0].getMonth() + 1}-${selectedDates[0].getDate()}`);
    },
});

/**
 * 予約
 * @type {HTMLElement}
 */
$('#reservation_form').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    let errorFlgs = true;
    const formData = form.serializeArray();
    console.log(formData);
    // バリデーション
    for (let key in formData) {
        if (formData[key]['name'] === 'selected_date') {
            if (!formData[key]['value']) {
                $('#err_selected_date').css('display', 'block');//.text('選択してください');
                $('#err_selected_date').text('予約日を選択してください');
                errorFlgs = false;
            } else {
                $('#err_selected_date').css('display', 'none');//.text('選択してください');
                $('#err_selected_date').text('');
            }
        }
        if (formData[key]['name'] === 'selected_time') {
            if (!formData[key]['value']) {
                $('#err_selected_time').css('display', 'block');//.text('選択してください');
                $('#err_selected_time').text('予約時間を選択してください');
                errorFlgs = false;
            } else {
                $('#err_selected_time').css('display', 'none');//.text('選択してください');
                $('#err_selected_time').text('');
            }
        }
        if (formData[key]['name'] === 'player') {
            if (!formData[key]['value']) {
                $('#err_player').css('display', 'block');//.text('選択してください');
                $('#err_player').text('トレーナーを選択してください');
                errorFlgs = false;
            } else {
                $('#err_player').css('display', 'none');//.text('選択してください');
                $('#err_player').text('');
            }
        }
        if (formData[key]['name'] === 'course') {
            if (formData[key]['value'] == '') {
                $('#err_course').css('display', 'block');//.text('選択してください');
                $('#err_course').text('コースを選択してください');
                errorFlgs = false;
            } else {
                $('#err_course').css('display', 'none');//.text('選択してください');
                $('#err_course').text('');
            }
        }
        if (formData[key]['name'] === 'user') {
            if (!formData[key]['value']) {
                $('#err_user').css('display', 'block');//.text('選択してください');
                $('#err_user').text('お名前を選択してください');
                errorFlgs = false;
            } else {
                $('#err_user').css('display', 'none');//.text('選択してください');
                $('#err_user').text('');
            }
        }
        //////////////////////////
        // 店舗
        if (formData[key]['name'] === 'store') {
            if (formData[key]['value'] == '') {
                $('#err_store').css('display', 'block');//.text('選択してください');
                $('#err_store').text('店舗を選択してください');
                errorFlgs = false;
            } else {
                $('#err_store').css('display', 'none');//.text('選択してください');
                $('#err_store').text('');
            }
        }
        if (formData[key]['name'] === 'sei') {
            if (!formData[key]['value']) {
                $('#err_sei').css('display', 'block');//.text('選択してください');
                $('#err_sei').text('姓を選択してください');
                errorFlgs = false;
            } else {
                $('#err_sei').css('display', 'none');//.text('選択してください');
                $('#err_sei').text('');
            }
        }
        if (formData[key]['name'] === 'mei') {
            if (!formData[key]['value']) {
                $('#err_mei').css('display', 'block');//.text('選択してください');
                $('#err_mei').text('名を選択してください');
                errorFlgs = false;
            } else {
                $('#err_mei').css('display', 'none');//.text('選択してください');
                $('#err_mei').text('');
            }
        }
    }
    if (errorFlgs) {
        // ボタンを無効
        $('button').attr('disabled', true);
        // スピナー表示
        $('.spinner-border').css('display', 'block');
        $.ajax({
            type: form.prop('method'),
            url: form.prop('action'),
            data: form.serialize(),
        }).done(function (data) {
            console.log(data);
            console.log(data.message);
            if (data.status) {
                $('#alert_message').html('<div class="alert alert-success" role="alert"><strong>' + data.message + '</strong></div>');
                $('#modalLarge').modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 700);
            } else {
                $('#alert_message').html('<div class="alert alert-warning" role="alert"><strong>' + data.message + '</strong></div>');
            }
            //window.location.reload();
        }).fail(function () {
            $('button').attr('disabled', false);
            $('.spinner-border').css('display', 'none');
            // 通信が失敗したときの処理
        }).always(function () {
            $("#course option[value='0']").prop('selected', true);
            $('button').attr('disabled', false);
            $('.spinner-border').css('display', 'none');
        });
    }
});

//course/edit.blade.php total_price表示
calculate = function () {
    var price = document.getElementById('price').value;
    var month_count = document.getElementById('month_count').value;
    var total_price = parseInt(price) * parseInt(month_count);
    if (isNaN(total_price)) {
        document.getElementById('total_price').value = 0;
    } else {
        document.getElementById('total_price').value = total_price;
    }
}
//数字のみ入力
$('#price').on('input', function () {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});
$('#month_count').on('input', function () {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});
$('#course_time').on('input', function () {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});

/**
 * ユーザー側の予約処理
 * 予約モーダル表示
 */
$('.reservationDateTap').on('click', function (e) {
    $('#alert_message').html('');
    const selectedDate = $(this).data('date');
    if (selectedDate) {
        // 選択された日付をセット
        $('#reservationDateView').text(selectedDate);
        $('#reservationDate').val(selectedDate);
        // モーダル
        $('#modalLarge').modal('show');
    }
});

/**
 * ユーザーからの予約
 */
$('#reservation_form_user').submit(function (e) {
    e.preventDefault();
    // スピナー表示
    $('.spinner-border').css('display', 'block');
    // ボタンを無効になる
    $('button').attr('disabled', true);
    $form = $(this)
    console.log($form.serialize());
    const $button = $form.find('button');
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType: 'json',
        timeout: 10000,
    }).done(function (data) {
        if (data.status) {
            $('#alert_message').html('<div class="alert alert-success" role="alert"><strong>' + data.message + '</strong></div>');
            // 選択された日時
            const playerId = $('#player_id').val() ? $('#player_id').val() : '';
            setTimeout(function () {
                location.href = `/reservation/end?player_id=${playerId}`;
            }, 500);
        } else {
            $('.spinner-border').css('display', 'none');
            $('button').attr('disabled', false);
            $('#alert_message').html('<div class="alert alert-danger" role="alert"><strong>' + data.message + '</strong></div>');
        }
    }).fail(function (e) {
        $('.spinner-border').css('display', 'none');
        $('button').attr('disabled', false);
    }).always(function () {
        console.log('結果');
    });
});
