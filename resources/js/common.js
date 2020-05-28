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
    $('#aaTime').text(tdId);
});

const flatpickr = require('flatpickr');
const japan = require('flatpickr/dist/l10n/ja.js').default.ja;
console.log(japan);
flatpickr('.selector', {
    dateFormat: 'Y/m/d',
    locale: japan,
});

