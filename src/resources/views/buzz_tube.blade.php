<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>YouTube 昨日は何がバズった？</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.css' rel='stylesheet' />
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
                max-width: 90%;
                padding-left: 5%;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 60px;
            }
            .m-b-md {
                margin-bottom: 30px;
                margin-top: 100px
            }
            .thumbnail {
              width: 100%;
              aspect-ratio: 16 / 9;
              z-index: 2;
            }
            @media (max-width: 800px) {
              .tooltips {
                display: none;
                position: absolute;
                bottom: -7.5em;
                z-index: 1000;
                padding: 0.5em;
                color: #000000;
                background: #FFFFFF;
                border-radius: 0.5em;
                white-space: normal;
                width: auto;
                z-index: 9;
              }
            }
             @media (min-width: 801px) {
              .tooltips {
                display: none;
                position: static;
                bottom: -7.5em;
                z-index: 1000;
                padding: 0.5em;
                color: #000000;
                background: #FFFFFF;
                border-radius: 0.5em;
                white-space: normal;
                width: 300px;
                z-index: 9;
              }
            }
            .tooltips:after {
              width: 100%;
              content: "";
              display: block;
              position: static;
              left: 0.5em;
              top: -8px;
              border-top:8px solid transparent;
              border-left:8px solid #FFFFFF;
            }
            .dictionary:hover .tooltips {
              display: block;
            }
            .video_name {
              white-space: normal;
              margin: 0;
            }
            .calendar {
              padding-bottom: 100px
            }
            .today {
              background-color: rgba(255,220,40,.15)
            }
        </style>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.js'></script>
        <script>
          var videos = [];

          async function loadJson() {
            await fetch('storage/buzz_tube.json')
              .then(result => result.json())
              .then((output) => {
                videos = output;
            });
          };

          document.addEventListener('DOMContentLoaded', async function() {
            await loadJson();
            var events = [];
            for (let key in videos) {
              events.push({start: key, textColor: '#000000', title: key });
            };
            var today = new Date();
            today = today
              .toLocaleDateString("ja-JP", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
              }).split("/").join("-");

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              headerToolbar: {
                  left: "prev,next today",
                  right: "dayGridMonth,dayGridDay",
              },
              locale: 'ja',
              events:events,
              eventColor: '#FFFFFF',
              eventContent: function (info) {
                var data = videos[info.event.title]
                console.log('-------')
                var video = `
                  <a href="https://www.youtube.com/watch?v=${ data['videoId'] }"
                     target="_blank"
                     class="${ today === info.event.title ? 'today' : '' }">

                    <img class="thumbnail" src="https://img.youtube.com/vi/${  data['videoId'] }/mqdefault.jpg"/>
                  </a>
                  <p class="video_name ${ today === info.event.title ? 'today' : '' }">
                    ${ data['channelName'] }
                  </>
                  <div class="dictionary ${ today === info.event.title ? 'today' : '' }" ontouchstart="">
                    <img src="icon/dictionary.svg" alt="ロゴ" width="20" height="20">
                    <div class="tooltips">
                      ${ data['title'] }
                      <BR><BR>
                       ${ 50 < data['description'].length ? data['description'].slice(0, 49) + '…' : data['description'] }
                    </div>
                  </div>
                `
                return { html: video }
              }
            });
            calendar.render();
          });
        </script>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    BuzzTube 昨日は何がバズった？
                </div>
                <div id='calendar' class="calendar"></div>
            </div>
        </div>
    </body>
</html>
