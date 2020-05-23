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

    $('#aaTime').text(tdId);
    console.log('--------------');
    console.log(tdId);
    console.log('--------------');
})
