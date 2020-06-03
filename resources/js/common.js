// $('.chara').on('click', function () {
//     console.log(this);
//     // const hiddenVal = $(this).children('td')[0].innerText;
//     // const nameVal = $(this).children('td')[1].innerText;
//     // alert('No: ' + hiddenVal + ' name: ' + nameVal);
//     // const td = $(this).children('td')[0];
//     // const tr = $(this).closest('tr')[0];
//     // console.log('td:' + td.cellIndex);
//     // console.log('tr:' + tr.rowIndex);
//     // console.log($(this).text());
// });

/**
 *
 */
$('#target-table td').on('click', function () {
    const day = $(this).data('day');
    const time = $(this).data('time');
    $('#reservation_day').val(day);
    $('#reservation_time').val(time);
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
    dateFormat: 'Y年m月d日',
    locale: japan,
    // minuteIncrement: 15,
});

/**
 *
 * @type {HTMLElement}
 */
$('#reservation_form').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    console.log(form.serializeArray());
    console.log(form.prop('action'));
    console.log(form.prop('action'));


    $.ajax({
        type: form.prop('action'),
        url: '/admin/reservation',
        data: form.serialize(),
    }).done(function (data) {
        // 通信が成功したときの処理
        console.log('ok');
    }).fail(function () {
        // 通信が失敗したときの処理
        console.log('ng');
    }).always(function (data) {
        // 通信が完了したとき
    });
});


