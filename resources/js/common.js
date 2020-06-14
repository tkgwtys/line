$('.spinner-border').css('display', 'none');
$('#target-table td').on('click', function () {
    $('.alert').css('display', 'none');
    // 予約日
    const day = $(this).data('day');
    // 予約時間
    const time = $(this).data('time');
    // トレーナーID
    const playerId = $(this).data('player_id');
    // ユーザーID
    const user_id = $(this).children('div').data('user_id');
    // コースID
    const course_id = $(this).children('div').data('course_id');
    // 予約ID
    const reservation_id = $(this).children('div').data('reservation_id');
    // 予約フォームラベル
    $('#reservation_label').text('予約フォーム');
    if (typeof reservation_id === "undefined") {
        $('#reservation_label').html('<span class="badge badge-primary">新規予約</span>');
    } else {
        $('#reservation_label').html('<span class="badge badge-warning">予約申請</span>');
    }
    console.log(reservation_id);
    // トレーナのデフォルト値
    $('#player').val(playerId);
    // 予約した人のデフォルト値
    $('#user').val(user_id);
    $('.selector').val(day);
    $('#selected_date').val(day);
    $('#selected_time').val(time);
    $('#course').val(course_id);
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
 *
 * @type {HTMLElement}
 */
$('#reservation_form').on('submit', function (e) {
    e.preventDefault();
    let errorFlg = true;
    const form = $(this);
    const formData = form.serializeArray();
    // バリデーション
    for (let key in formData) {
        if (formData[key]['name'] === 'selected_date') {
            if (!formData[key]['value']) {
                $('#err_selected_date').css('display', 'block');//.text('選択してください');
                $('#err_selected_date').text('予約日を選択してください');
                errorFlg = false;
            } else {
                $('#err_selected_date').css('display', 'none');//.text('選択してください');
                $('#err_selected_date').text('');
                errorFlg = true;
            }
        }
        if (formData[key]['name'] === 'selected_time') {
            if (!formData[key]['value']) {
                $('#err_selected_time').css('display', 'block');//.text('選択してください');
                $('#err_selected_time').text('予約時間を選択してください');
                errorFlg = false;
            } else {
                $('#err_selected_time').css('display', 'none');//.text('選択してください');
                $('#err_selected_time').text('');
                errorFlg = true;
            }
        }
        if (formData[key]['name'] === 'player') {
            if (!formData[key]['value']) {
                $('#err_player').css('display', 'block');//.text('選択してください');
                $('#err_player').text('トレーナーを選択してください');
                errorFlg = false;
            } else {
                $('#err_player').css('display', 'none');//.text('選択してください');
                $('#err_player').text('');
                errorFlg = true;
            }
        }
        if (formData[key]['name'] === 'course') {
            if (!formData[key]['value']) {
                $('#err_course').css('display', 'block');//.text('選択してください');
                $('#err_course').text('コースを選択してください');
                errorFlg = false;
            } else {
                $('#err_course').css('display', 'none');//.text('選択してください');
                $('#err_course').text('');
                errorFlg = true;
            }
        }
        if (formData[key]['name'] === 'user') {
            if (!formData[key]['value']) {
                $('#err_user').css('display', 'block');//.text('選択してください');
                $('#err_user').text('お名前を選択してください');
                errorFlg = false;
            } else {
                $('#err_user').css('display', 'none');//.text('選択してください');
                $('#err_user').text('');
                errorFlg = true;
            }
        }
    }
    if (errorFlg) {
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
            // 通信が成功したときの処理
            console.log('ok');
            window.location.reload();
        }).fail(function () {
            $('button').attr('disabled', false);
            $('.spinner-border').css('display', 'none');
            // 通信が失敗したときの処理
            console.log('ng');
        }).always(function (data) {
            // 通信が完了したとき
            console.log('通る');
        });
    }
});

//course/edit.blade.php total_price表示
calculate = function() {
    var price = document.getElementById('price').value;
    var month_count = document.getElementById('month_count').value;
    var total_price = parseInt(price)*parseInt(month_count);
    if(isNaN(total_price)) {
        document.getElementById('total_price').value = 0;
    }else{
        document.getElementById('total_price').value = total_price;
    }
}
//数字のみ入力
$('#price').on('input', function() {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});
$('#month_count').on('input', function() {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});
$('#course_time').on('input', function() {
    let value = $(this).val();
    $(this).val(value.replace(/[^0-9]+/g, ''));
});
