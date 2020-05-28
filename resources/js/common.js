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
    const tdId = $(this)[0].id;
    console.log(tdId);
    // Modal Inputの id='aaTime' value=''に値送信
    document.getElementById('aaTime').value = tdId;
});

const flatpickr = require('flatpickr');
const japan = require('flatpickr/dist/l10n/ja.js').default.ja;
console.log(japan);
flatpickr('.selector', {
    enableTime: true, // タイムピッカーを有効
    enableSeconds: false, // '秒' を無効
    time_24hr: false, // 24時間表示
    defaultHour: 7, // 時
    defaultMinute: 0, // 分
    minTime: "07:00",
    maxTime: "23:45",
    dateFormat: 'Y年m月d日 H:i',
    locale: japan,
    minuteIncrement: 15,
});


