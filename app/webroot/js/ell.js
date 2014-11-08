'use strict';

var myVideo; // 画像保存

function startVideo() {
  navigator.webkitGetUserMedia(
    {video: true},
    function(localMediaStream) {
      myVideo  = document.getElementById('myVideo');
      myVideo.src = window.URL.createObjectURL(localMediaStream);
      myVideo.play();
    },
    function(err) {
      alert('カメラから映像を取得することができませんでした。');  
      console.log(err);
    }
  );
}

var capture = function(){  
  var canvas = document.getElementById("captured");
  var context = canvas.getContext("2d");
  context.drawImage(myVideo, 0, 0, 160, 120);
  $("#captured").attr("href", canvas.toDataURL("image/png"));
  return canvas.toDataURL("image/png");
};

// カメラ画像が使えるか判定
if (!navigator.getUserMedia && !navigator.webkitGetUserMedia) {
  alert('webkit系ブラウザでないか、もしくはgetUserMediaがサポートされていません');
} else {
  startVideo();
}


google.load("visualization", "1", {
    packages: ["corechart"]
});
google.setOnLoadCallback(drawPiSelf);
google.setOnLoadCallback(drawLineSelf);

function drawPiSelf() {

    $.getJSON("/EmotionLifeLog/emotions/getMyEmotion", {},
        function(jsonData) {
            var chart = new google.visualization.PieChart(document.getElementById('pi-self'));
            var data = createPiSelfData(jsonData);
            var options = {
                title: '自己評価の感情（割合）'
            };
            chart.draw(data, options);
        }).fail(function() {});
}

function createPiSelfData(jsonData) {
    var data = new google.visualization.DataTable();
    data.addRows(jsonData.length);
    data.addColumn("string", "感情");
    data.addColumn("number", "度合い");
    $.each(jsonData, function(i, v) {
        data.setValue(i, 0, v.Emotion.my_emotion);
        data.setValue(i, 1, v.Emotion.sum);
    });
    return data;
}

function drawLineSelf() {
    var data = google.visualization.arrayToDataTable([
        ['Time', 'Happy', 'Sad'],
        ['2014-11-08 17:00:00', 1000, 400],
        ['2014-11-08 18:00:00', 1170, 460],
        ['2014-11-09 19:00:00', 660, 1120],
        ['2014-11-09 20:00:00', 1030, 540]
    ]);

    var options = {
        title: '自己評価の感情（時系列）'
    };

    var chart = new google.visualization.LineChart(document.getElementById('line-self'));

    chart.draw(data, options);
}

function showValue() {
    document.getElementById("show-range").innerHTML = document.getElementById("range").value;
}
