async function loadYoutubeJson() {
  await fetch('/storage/buzz_tube.json', { cache: "no-store" })
    .then(result => result.json())
    .then((output) => {
      youtubeVideos = output;
    });
};
async function loadNiconicoJson() {
  await fetch('/storage/buzz_niconico.json', { cache: "no-store" })
    .then(result => result.json())
    .then((output) => {
      niconicoVideos = output;
    });
};


var niconicoVideos = [];
var today = new Date();
var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
yesterday = yesterday
  .toLocaleDateString("ja-JP", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  }).split("/").join("-");

document.addEventListener('DOMContentLoaded', async function () {
  // Youtube動画情報読み込み
  var youtubeCard = document.getElementById("yesterday_youtube");
  youtubeCard.style.setProperty('display', 'none');
  await loadYoutubeJson();
  youtubeCard.src = "https://img.youtube.com/vi/" + youtubeVideos[yesterday]['videoId'] + "/mqdefault.jpg";
  youtubeCard.style.removeProperty('display');
  document.getElementById("load_youtube").style.setProperty('display', 'none');

  // ニコニコ動画情報読み込み
  var niconicoCard = document.getElementById("yesterday_niconico");
  niconicoCard.style.setProperty('display', 'none');
  await loadNiconicoJson();
  niconicoCard.src = niconicoVideos[yesterday]['image'];
  niconicoCard.style.removeProperty('display');
  document.getElementById("load_niconico").style.setProperty('display', 'none');
});
