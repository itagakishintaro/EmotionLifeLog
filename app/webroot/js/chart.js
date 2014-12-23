'use strict';

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
    $.getJSON("/EmotionLifeLog/emotions/getHistorical", {},
        function(jsonData) {
            var data = createLineSelfData(jsonData);
            var chart = new google.visualization.LineChart(document.getElementById('line-self'));
            var options = {
                title: "自己評価の時系列 (割合)",
                colors: ['red', 'green', 'orange', 'blue']
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

    // 感情ごとに列に追加。該当しない場合は Empty.
    $.each(jsonData, function(i, v) {
        // var date = v.Emotion.record_date.split(" ")[0];
        // var year = date.split("-")[0];
        // var month = date.split("-")[1] - 1;
        // var day = date.split("-")[2];
        // data.setValue(i, 0, new Date(year, month, day));
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
