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

$('#target-table td').on('click', function () {
    // 時間ID取得
    // const tdId = $(this)[0].id;
    const day = $(this).data('day');
    const time = $(this).data('time');
    $('#day').val(day);
    $('#time').val(time);
});

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

const aaa = document.getElementById('reservation_form');
console.log("aaaaaaaaaa");
console.log(aaa);
console.log("aaaaaaaaaa");

$('#reservation_form').on('submit', function (e) {
    console.log(this);
    alert('aaaa');
});


