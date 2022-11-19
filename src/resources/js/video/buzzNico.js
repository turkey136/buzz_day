var videos = [];
var keywords = ['ニコニコ', 'ニコニコ動画', '24時間', '人気'];

async function loadJson() {
  await fetch('/storage/buzz_niconico.json', { cache: "no-store" })
    .then(result => result.json())
    .then((output) => {
      videos = output;
    });
};

document.addEventListener('DOMContentLoaded', async function () {
  var today = new Date();
  today = today
    .toLocaleDateString("ja-JP", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
    }).split("/").join("-");

  await loadJson();
  var events = [];
  for (let key in videos) {
    events.push({ start: key, textColor: '#000000', title: key });
  };

  // カレンダー設定
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      right: "dayGridMonth,dayGridDay",
    },
    locale: 'ja',
    events: events,
    eventColor: '#FFFFFF',
    contentHeight: 'auto',
    eventContent: function (info) {
      var data = videos[info.event.title]
      var video = `
                  <a href="https://www.nicovideo.jp/watch//${data['videoId']}"
                    target="_blank"
                    class="${today === info.event.title ? 'today' : ''}">

                    <img class="thumbnail" src="${data['image']}"/>
                  </a>
                  <p class="video_name ${today === info.event.title ? 'today' : ''}">
                    ${data['channelName']}
                  </>
                  <div class="dictionary ${today === info.event.title ? 'today' : ''}" ontouchstart="">
                    <img src="icon/dictionary.svg" alt="辞書アイコン" width="20" height="20">
                    <div class="tooltips">
                      ${data['title']}
                      <BR><BR>
                      ${50 < data['description'].length ? data['description'].slice(0, 49) + '…' : data['description']}
                    </div>
                  </div>
                `
      return { html: video }
    }
  });

  // Meta keyword の書きかえ
  for (let key in videos) {
    keywords.push(videos[key]['channelName'], videos[key]['channelName']);
  }
  var metaKeyword = document.head.children[3];
  metaKeyword.setAttribute('content', keywords.join(','));
  calendar.render();
});
