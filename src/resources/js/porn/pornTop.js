async function loadPornJson() {
  await fetch('/storage/buzz_porn.json', { cache: "no-store" })
    .then(result => result.json())
    .then((output) => {
      videos = output;
    });
};

function siteName(key) {
  let name = '';
  if (key.match(/porn_hub/)) {
    name = 'PornHub';
  } else if (key.match(/tk_tube/)) {
    name = 'tbTube';
  } else if (key.match(/javmix/)) {
    name = 'Javmix.TV'
  }
  return name;
}

function buildCard(video, key) {
  let link = document.createElement("a");
  link.href = video['url'];
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
  let action = document.createElement('div');
  actionClass = 'card-action action-heigth';

  if ('PornHub' === site) {
    title.className = 'porn-hub-color';
    action.className = actionClass + ' porn-hub-color';
  } else if ('tbTube' === site) {
    title.className = 'tk-tube-color';
    action.className = actionClass + ' tk-tube-color';
  } else if ('Javmix.TV' === site) {
    title.className = 'javmix-color';
    action.className = actionClass + ' javmix-color';
  }

  let titleStr = video['title'];
  if (80 < titleStr.length) {
    titleStr = titleStr.slice(0, 61) + '…';
  }
  action.innerHTML = titleStr;

  col.appendChild(card);
  card.appendChild(cardImage);
  cardImage.appendChild(img);
  cardImage.appendChild(title);
  card.appendChild(action);
  link.appendChild(col);

  return link;
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
