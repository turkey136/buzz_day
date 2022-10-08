var rowCsv = null;
var rows = [];
var avgValue = 0;
var avgDifferenc = 0

// CSV データ中の表示項目と列番号
const tableIndex = {
  "ファンド名": 1,
  "基準価額(円)": 16,
  "前日比(円)": 17,
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
  var typeStr = location.search.replace(/\?.+=/g, '');
  var defData = [];

  var yeaterday = new Date();
  yeaterday.setDate(yeaterday.getDate() - 1);
  await loadCsv(yeaterday);
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var day = yeaterday.getDate().toString().padStart(2, '0')
  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} 23:00`;
  if ('all' !== typeStr) {
    this.getElementById('title').textContent = `投資信託（${kindType[typeStr]}）`;
    this.getElementById('back').setAttribute('href', `/investment_trust_statistics?kind_type=${typeStr}`);
  }

  // CSV を解析
  const originalRows = rowCsv.replace(/"/g, '').split(/\n/);
  originalRows.forEach(function (originalRow, index) {
    var splitrow = originalRow.split(',');
    if (index <= 4 || splitrow[0] === '') { return; }
    if (kindType[typeStr] === splitrow[13]) {
      rows.push(splitrow);
      defData.push(
        {
          "名前": splitrow[1],
          "評価額": Number(splitrow[16]),
          "前日比": Number(splitrow[17]),
        }
      )
      avgValue = avgValue + Number(splitrow[16]);
      avgDifferenc = avgDifferenc + Number(splitrow[17]);
    } else if ('all' === typeStr) {
      defData.push(
        {
          "名前": splitrow[1],
          "評価額": Number(splitrow[16]),
          "前日比": Number(splitrow[17]),
          "種別": splitrow[13],
        }
      )
    }
  });
  avgValue = Math.floor(avgValue / rows.length);
  avgDifferenc = Math.floor(avgDifferenc / rows.length);

  var loading = document.getElementById('loading');
  loading.style.setProperty('display', 'none');


  var chart = null;
  if ('all' === typeStr) {
    chart = new Taucharts.Chart({
      data: defData,
      type: 'scatterplot',
      color: '種別',
      x: '評価額',
      y: '前日比',
      plugins: [Taucharts.api.plugins.get('tooltip')(), Taucharts.api.plugins.get('legend')()],
    });
  } else {
    chart = new Taucharts.Chart({
      data: defData,
      type: 'scatterplot',
      x: '評価額',
      y: '前日比',
      plugins: [Taucharts.api.plugins.get('tooltip')(), Taucharts.api.plugins.get('legend')()],
    });
  }

  chart.renderTo('#scatter');
});

