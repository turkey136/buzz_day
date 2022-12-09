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
  await fetch('/storage/sbi_investment_trust/' + year + '/' + month + '/' + fileName + '.csv', { cache: "no-store" })
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
          name: splitrow[1],
          x: Number(splitrow[16]),
          y: Number(splitrow[17]),
          z: 10,
        }
      )
      avgValue = avgValue + Number(splitrow[16]);
      avgDifferenc = avgDifferenc + Number(splitrow[17]);
    }
  });
  avgValue = Math.floor(avgValue / rows.length);
  avgDifferenc = Math.floor(avgDifferenc / rows.length);
  this.getElementById('avg_value').textContent = Number(avgValue).toLocaleString();
  this.getElementById('avg_differenc').textContent = avgDifferenc;

  var loading = document.getElementById('loading');
  loading.style.setProperty('display', 'none');

  Highcharts.chart('container', {
    chart: {
      type: 'bubble',
      plotBorderWidth: 1,
      zoomType: 'xy'
    },

    legend: {
      enabled: false,
      floating: true,
    },

    title: {
      text: ''
    },

    tooltip: {
      useHTML: true,
      headerFormat: '<table class="tooltip">',
      pointFormat: '<tr><th colspan="6">{point.name}</th></tr>' +
        '<tr><th>評価額:</th><td>{point.x}円</td></tr>' +
        '<tr><th>前日差:</th><td>{point.y}円</td></tr>',
      footerFormat: '</table>',
      followPointer: true
    },

    series: [{
      minSize: 10,
      maxSize: 10,
      data: defData
    }]
  })
});

