var rowCsv = null;
var rows = [];
var avgValue = 0;
var avgDifferenc = 0

// CSV データ中の表示項目と列番号
const tableIndex = {
  "協会コード": 0,
  "ファンド名": 1,
  "基準価額(円)": 16,
  "前日比(円)": 17,
  "前日比率": 18,
}

const kindType = {
  "commodity": "コモディティ",
  "etc": "その他",
  "balance": "バランス",
  "bull_bear": "ブル・ベア",
  "hedge_fund": "ヘッジファンド",
  "world_reit": "国際REIT",
  "world_stock": "国際株式",
  "world_bond": "国際債券",
  "jp_reit": "国内REIT",
  "jp_stock": "国内株式",
  "jp_bond": "国内債券",
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
  var typeStr = location.search.replace(/\?.+=/g, '');
  document.getElementById(`${typeStr}_button`).classList.remove('submit');

  var yeaterday = new Date();
  yeaterday.setDate(yeaterday.getDate() - 1);
  await loadCsv(yeaterday);
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var day = yeaterday.getDate().toString().padStart(2, '0')
  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} 23:00`;
  this.getElementById('title').textContent = `投資信託一覧（${kindType[typeStr]}）`;

  // CSV を解析
  const originalRows = rowCsv.replace(/"/g, '').split(/\n/);
  originalRows.forEach(function (originalRow, index) {
    var splitrow = originalRow.split(',');
    if (index <= 4 || splitrow[0] === '') { return; }
    if (kindType[typeStr] === splitrow[13]) {
      rows.push(splitrow);
      avgValue = avgValue + Number(splitrow[16]);
      avgDifferenc = avgDifferenc + Number(splitrow[17]);
    }
  });
  avgValue = Math.floor(avgValue / rows.length);
  avgDifferenc = Math.floor(avgDifferenc / rows.length);

  this.getElementById('avg_value').textContent = Number(avgValue).toLocaleString();
  this.getElementById('avg_differenc').textContent = avgDifferenc;

  // table に CSV データから自動生成
  var table = document.getElementById('data-table-body');
  rows.forEach(function (row) {
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
        value = Number(value).toLocaleString();
      }
      td.innerHTML = value;
      tr.appendChild(td);
    }

    table.appendChild(tr);
  });

  $('#data-table').DataTable({
    "displayLength": 100,
    "order": [[2, "desc"]]
  });

  var loading = document.getElementById('loading');
  loading.style.setProperty('display', 'none');

  var tableArea = document.getElementById('table-area')
  tableArea.style.removeProperty('visibility');
  tableArea.style.removeProperty('position');

  // datatable と materialize  とぶつかって崩れるので js で制御する
  document.getElementById('data-table_length').style.setProperty('display', 'none');
  $('input')[0].style.setProperty('height', '100%');
  $('label')[1].style.setProperty('display', 'flex');
});

