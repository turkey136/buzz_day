var rowCsv = null;
var rows = [];

// CSV データ中の表示項目と列番号
var tableIndex = {
  "協会コード": 0,
  "ファンド名": 1,
  "積立対象": 5,
  "NISA対象": 6,
  "つみたてNISA": 7,
  "インデックス対象": 10,
  "基準価額(円)": 16,
  "前日比(円)": 17,
  "前日比率": 18,
  "信託報酬": 30,
  "年間概算信託報酬": 990,
  "年間分配金累計(円)": 35,
  "分配金利回り": 991,
}

async function loadCsv(yeaterday) {
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var fileName = `${year}${month}${yeaterday.getDate().toString().padStart(2, '0')}`.replace(/\n|\r/g, '');
  await fetch('storage/sbi_investment_trust/' + year + '/' + month + '/' + fileName + '.csv')
    .then(result => result.text())
    .then((output) => {
      rowCsv = output;
    });
};

document.addEventListener('DOMContentLoaded', async function () {
  var tableArea = document.getElementById('table-area');
  tableArea.style.setProperty('visibility', 'hidden');
  tableArea.style.setProperty('position', 'absolute');

  var cookies = document.cookie.split(';');
  if (cookies.includes('consent=true')) {
    document.getElementById('disclaimer').style.setProperty('display', 'none');
    var tableArea = document.getElementById('table-area')
    tableArea.style.removeProperty('visibility');
    tableArea.style.removeProperty('position');
    document.getElementById('button-area').style.display = 'block';
  }

  var yeaterday = new Date();
  yeaterday.setDate(yeaterday.getDate() - 1);
  await loadCsv(yeaterday);
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var day = yeaterday.getDate().toString().padStart(2, '0')
  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} 23:00`;

  // CSV を解析
  const originalRows = rowCsv.replace(/"/g, '').split(/\n/);
  originalRows.forEach(function (originalRow) {
    rows.push(originalRow.split(','));
  });

  // table に CSV データから自動生成
  var table = document.getElementById('data-table-body');
  rows.forEach(function (row, index) {
    if (index <= 4 || row[0] === '') { return; }

    var tr = document.createElement('tr');
    for (let key in tableIndex) {
      var td = document.createElement('td');

      let value = row[tableIndex[key]];
      if (990 === tableIndex[key]) {
        value = Math.ceil(row[16] * row[30] / 100.0);
      } else if (991 === tableIndex[key]) {
        value = parseFloat(row[35] / row[16] * 100.0).toFixed(2);
      }

      if ([16, 17, 35].includes(tableIndex[key])) {
        value = Number(value).toLocaleString()
      }
      td.innerHTML = value;
      tr.appendChild(td);
    }

    table.appendChild(tr);
  });

  $('#data-table').DataTable({
    "displayLength": 100
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
    document.getElementById('button-area').style.display = 'block';

    document.cookie = "consent=true;max-age=3600";
  }

  var button = document.getElementById('submit');
  button.onclick = submitClick;
})

