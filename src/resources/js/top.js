async function loadYoutubeJson() {
  await fetch('storage/buzz_tube.json')
    .then(result => result.json())
    .then((output) => {
      videos = output;
    });
};
var videos = [];
var today = new Date();
var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
yesterday = yesterday
  .toLocaleDateString("ja-JP", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  }).split("/").join("-");

document.addEventListener('DOMContentLoaded', async function () {
  var youtubeCard = document.getElementById("yesterday_youtube");
  youtubeCard.style.setProperty('display', 'none');
  await loadYoutubeJson();
  youtubeCard.src = "https://img.youtube.com/vi/" + videos[yesterday]['videoId'] + "/mqdefault.jpg";
  youtubeCard.style.removeProperty('display');
  document.getElementById("load_youtube").style.setProperty('display', 'none');
});
