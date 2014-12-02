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

function updateMaxFigures(){
  var emotions = ["happy", "sad", "angry", "fear"];

  $.getJSON("/EmotionLifeLog/emotions/getHappyFace", {},
    function(result){  
       for(var i=0; i<result.length; i++){
          var obj = result[i];
          console.log(obj.Emotion.my_emotion);
          console.log(obj.Emotion.img_file.length);
          $("#max-" + obj.Emotion.my_emotion).attr("src", obj.Emotion.img_file);
       }
  })
}

var capture = function(){  
  var canvas = document.getElementById("captured");
  var context = canvas.getContext("2d");
  context.drawImage(myVideo, 0, 0, 160, 120);
  return canvas.toDataURL("image/png");
};

// カメラ画像が使えるか判定
if (!navigator.getUserMedia && !navigator.webkitGetUserMedia) {
  alert('webkit系ブラウザでないか、もしくはgetUserMediaがサポートされていません');
} else {
  startVideo();
}

updateMaxFigures();

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
                title: '自己評価の感情（割合）',
                colors: ['red', 'green', 'orange', 'blue']
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
    // var jsonData = 
    // [ {"Emotion": {"record_date":"2014-12-02 07:31:23",
    //                "my_emotion":"fear","my_emotion_val":"50"}},
    //   {"Emotion": {"record_date":"2014-12-02 07:31:31",
    //                "my_emotion":"angry","my_emotion_val":"66"}},
    //   {"Emotion": {"record_date":"2014-12-02 07:31:43",
    //                "my_emotion":"sad","my_emotion_val":"27"}},
    //   {"Emotion": {"record_date":"2014-12-02 07:31:53",
    //                "my_emotion":"happy","my_emotion_val":"85"}},
    //   {"Emotion": {"record_date":"2014-12-02 07:32:04",
    //                "my_emotion":"happy","my_emotion_val":"58"}}]
    $.getJSON("/EmotionLifeLog/emotions/getHistorical", {},
        function(jsonData) {
            var data = createLineSelfData(jsonData);
            console.log(data);
            var chart = new google.visualization.LineChart(document.getElementById('line-self'));
            var options = {
                title: "自己評価の時系列 (割合)",
                colors: ['red', 'green', 'orange', 'blue'];
            }

            chart.draw(data, options);
    });

    var options = {
        title: '自己評価の感情（時系列）'
    };
}


function createLineSelfData(jsonData) {
    var data = new google.visualization.DataTable();
    data.addRows(jsonData.length);
    data.addColumn("string", "Date");
    data.addColumn("number", "happy");
    data.addColumn("number", "angry");
    data.addColumn("number", "sad");
    data.addColumn("number", "fear");
    $.each(jsonData, function(i, v) {
        data.setValue(i, 0, v.Emotion.record_date);
        switch(v.Emotion.my_emotion) {
          case "happy":
              data.setValue(i, 1, v.Emotion.my_emotion_val);
              break;
          case "angry":
              data.setValue(i, 2, v.Emotion.my_emotion_val);
              break;
          case "sad":
              data.setValue(i, 3, v.Emotion.my_emotion_val);
              break;
          case "fear":
              data.setValue(i, 4, v.Emotion.my_emotion_val);
              break;
        }
    });
    return data;
}
function showValue() {
    document.getElementById("show-range").innerHTML = document.getElementById("range").value;
}
