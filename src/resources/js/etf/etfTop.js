var rowCsv = null;
var rows = [];

// CSV データ中の表示項目と列番号
var tableIndex = {
  "コード": 1,
  "市場": 3,
  "銘柄名": 22,
  "基準価額": 20,
  "分配金利回り": 19,
  "経費率": 5,
  "投資地域": 7,
}

async function loadCsv() {
  var yeaterday = new Date();
  if (yeaterday.getHours() <= 4) {
    yeaterday.setDate(yeaterday.getDate() - 1)
  }
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var fileName = `${year}${month}${yeaterday.getDate().toString().padStart(2, '0')}`.replace(/\n|\r/g, '');
  await fetch('/storage/rakuten_etf/' + year + '/' + month + '/' + fileName + '.csv', { cache: "no-store" })
    .then(result => result.text())
    .then((output) => {
      rowCsv = output;
    });
};

document.addEventListener('DOMContentLoaded', async function () {
  var tableArea = document.getElementById('table-area');
  tableArea.style.setProperty('visibility', 'hidden');
  tableArea.style.setProperty('position', 'absolute');

  await loadCsv();

  var yeaterday = new Date();
  var hour = yeaterday.getHours();
  hour = 4 * Math.floor(hour / 4.0);
  if (yeaterday.getHours() <= 4) {
    yeaterday.setDate(yeaterday.getDate() - 1);
    hour = 20;
  }
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var day = yeaterday.getDate().toString().padStart(2, '0');

  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} ${hour}:00`;

  // CSV を解析
  const originalRows = rowCsv.replace(/"/g, '').split(/\n/);
  originalRows.forEach(function (originalRow) {
    rows.push(originalRow.split(','));
  });

  // table に CSV データから自動生成
  var table = document.getElementById('data-table-body');
  rows.forEach(function (row, index) {
    if (row[1] === '' || row[2] === '' || row[1] === undefined) { return; }

    var tr = document.createElement('tr');
    for (let key in tableIndex) {
      var td = document.createElement('td');
      let value = row[tableIndex[key]];
      td.innerHTML = value;
      tr.appendChild(td);
    }

    table.appendChild(tr);
  });

  $('#data-table').DataTable({
    "displayLength": 50
  });

  var loading = document.getElementById('loading');
  loading.style.setProperty('display', 'none');

  // datatable と materialize  とぶつかって崩れるので js で制御する
  document.getElementById('data-table_length').style.setProperty('display', 'none');
  $('input')[0].style.setProperty('height', '100%');
  $('label')[1].style.setProperty('display', 'flex');
});

window.addEventListener('load', function () {
  function submitClick() {
    document.getElementById('disclaimer').style.setProperty('display', 'none');
    var tableArea = document.getElementById('table-area')
    tableArea.style.removeProperty('visibility');
    tableArea.style.removeProperty('position');
  }

  var button = document.getElementById('submit');
  button.onclick = submitClick;
})

