async function loadPornJson() {
  await fetch('/storage/buzz_porn.json')
    .then(result => result.json())
    .then((output) => {
      videos = output;
    });
};

function siteName(key) {
  let name = '';
  if (key.match(/porn_hub/)) {
    name = 'PornHub';
  }
  return name;
}

function buildCard(video, key) {
  let col = document.createElement('div');
  col.className = 'col s12 m6';

  let card = document.createElement('div');
  card.className = 'card background porn-box';

  let cardImage = document.createElement('div');
  cardImage.className = 'card-image';
  let img = document.createElement('img');
  img.src = video['img'];
  img.alt = video['title'];
  let title = document.createElement('span');
  title.className = 'card-title';
  let site = siteName(key);
  title.innerHTML = site;
  if ('PornHub' === site) {
    title.className = 'porn-hub-color';
  }

  let action = document.createElement('div');
  action.className = 'card-action';
  let link = document.createElement("a");
  link.href = video['url'];
  let linkTitle = video['title'];
  if (80 < linkTitle.length) {
    linkTitle = linkTitle.slice(0, 61) + '…';
  }
  link.innerHTML = linkTitle;
  action.appendChild(link);

  col.appendChild(card);
  card.appendChild(cardImage);
  cardImage.appendChild(img);
  cardImage.appendChild(title);
  card.appendChild(action);

  return col;
}

let videos = [];
var today = new Date();
var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
yesterday = yesterday
  .toLocaleDateString("ja-JP", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  }).split("/").join("-");

document.addEventListener('DOMContentLoaded', async function () {
  await loadPornJson();
  let todayVideos = videos[yesterday];
  let keys = _.shuffle(Object.keys(todayVideos));

  keys.forEach(function (key) {
    let video = todayVideos[key];
    document.getElementById('card-area').appendChild(buildCard(video, key));
  });
});
