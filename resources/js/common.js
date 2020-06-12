$('#target-table td').on('click', function () {
    const day = $(this).data('day');
    const time = $(this).data('time');
    $('.selector').val(day);
    $('#selected_date').val(day);
    $('#selected_time').val(time);
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
    const form = $(this);
    console.log(form.serializeArray());
    console.log(form.prop('action'));
    console.log(form.prop('method'));

    $.ajax({
        type: form.prop('method'),
        url: form.prop('action'),
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

//course/edit.blade.php total_price表示
$(".price,.month_count").on('keyup',function(){
    var $_t = $(this).parent().parent();
    console.log($_t);
    var priceVal = $_t.find('.price');
    var num01 = isNaN(priceVal.val()) ? 0 : priceVal.val();
    var m_countVal = $_t.find('.month_count');
    var num02 = isNaN(m_countVal.val()) ? 0 : m_countVal.val();
    var sum = num01 * num02;
    $_t.find('.total_price').html(sum);
});
