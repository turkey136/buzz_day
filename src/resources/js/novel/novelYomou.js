var novels = [];

async function loadJson() {
  await fetch('/storage/buzz_narou.json')
    .then(result => result.json())
    .then((output) => {
      novels = output;
    });
};

document.addEventListener('DOMContentLoaded', async function () {
  var yeaterday = new Date();
  yeaterday.setDate(yeaterday.getDate() - 1);
  var year = yeaterday.getFullYear();
  var month = (yeaterday.getMonth() + 1).toString().padStart(2, '0');
  var day = yeaterday.getDate().toString().padStart(2, '0')
  this.getElementById('synchronized-date').textContent = `更新日： ${year}-${month}-${day} 23:00`;

  await loadJson(yeaterday);

  var loading = document.getElementById('loading');
  loading.style.setProperty('display', 'none');

  var table = document.getElementById('table-body');
  novels[`${year}-${month}-${day}`].forEach(function (row) {
    var tr = document.createElement('tr');
    var td = document.createElement('td');
    td.innerHTML = row['category'];
    tr.appendChild(td);

    var td = document.createElement('td');
    td.innerHTML = `<a href="${row['url']}">${row['title']}</a>`;
    tr.appendChild(td);

    var td = document.createElement('td');
    td.innerHTML = `<a href="${row['owner_url']}">${row['owner']}</a>`;
    tr.appendChild(td);

    table.appendChild(tr);
  })

});


