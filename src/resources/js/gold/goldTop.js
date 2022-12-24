var rowJson = null;
var rows = [];

async function loadJson() {
  await fetch('/storage/gold.json', { cache: "no-store" })
    .then(result => result.json())
    .then((output) => {
      rowJson = output;
    });
};

document.addEventListener('DOMContentLoaded', async function () {
  var tableArea = document.getElementById('table-area');
  tableArea.style.setProperty('visibility', 'hidden');
  tableArea.style.setProperty('position', 'absolute');

  await loadJson();

  var dataDate = new Date();
  if (dataDate.getHours() <= 10) {
    dataDate.setDate(dataDate.getDate() - 1);
  }
  var year = dataDate.getFullYear();
  var month = (dataDate.getMonth() + 1).toString().padStart(2, '0');
  var day = dataDate.getDate().toString().padStart(2, '0');

  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} 10:00`;

  // json を解析
  var date = new Date();
  date.setDate(date.getDate() - 100);
  while (date <= dataDate) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    var index = `${year}${month}${day}`;
    var gold = '';
    var silver = '';
    var platinum = '';

    if (undefined !== rowJson['gold'][index] && rowJson['gold'][index]['price']) {
      gold = rowJson['gold'][index]['price'];
    }
    if (undefined !== rowJson['silver'][index] && rowJson['silver'][index]['price']) {
      silver = rowJson['silver'][index]['price'];
    }
    if (undefined !== rowJson['platinum'][index] && rowJson['platinum'][index]['price']) {
      platinum = rowJson['platinum'][index]['price'];
    }
    if ('' !== gold || '' !== silver || '' !== platinum) {
      rows.push([`${year}/${month}/${day}`, gold, silver, platinum]);
    }

    date.setDate(date.getDate() + 1);
  }


  // table に CSV データから自動生成
  var table = document.getElementById('data-table-body');
  rows.forEach(function (row) {
    var tr = document.createElement('tr');

    var indexDate = document.createElement('td');
    indexDate.innerHTML = row[0];
    tr.appendChild(indexDate);

    var gold = document.createElement('td');
    gold.innerHTML = row[1].toLocaleString();
    tr.appendChild(gold);

    var silver = document.createElement('td');
    silver.innerHTML = row[2].toLocaleString();
    tr.appendChild(silver);

    var platinum = document.createElement('td');
    platinum.innerHTML = row[3].toLocaleString();
    tr.appendChild(platinum);

    table.appendChild(tr);
  });

  $('#data-table').DataTable({
    "displayLength": 300,
    'order': [[0, 'desc']],
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

