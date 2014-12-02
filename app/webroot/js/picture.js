'use strict';

var myVideo; // 画像保存

$('#emotion .btn').click(function() {
    var image_file = capture();
    var label = $(this).attr('id');
    $('#EmotionMyEmotion').val(label);
    $('#EmotionImgFile').val(image_file);// ここに画像データ入れる
    $('#EmotionMyEmotionVal').val($('#show-range').text());
    $('form#EmotionAddForm').submit();
});

function startVideo() {
    navigator.webkitGetUserMedia({
            video: true
        },
        function(localMediaStream) {
            myVideo = $("#myVideo")[0];
            myVideo.src = window.URL.createObjectURL(localMediaStream);
            myVideo.play();
        },
        function(err) {
            alert('カメラから映像を取得することができませんでした。');
            console.log(err);
        }
    );
}

function updateMaxFigures() {
    var emotions = ["happy", "sad", "angry", "fear"];

    $.getJSON("/EmotionLifeLog/emotions/getMaxEmotionFaces", {},
        function(result) {
            for (var i = 0; i < result.length; i++) {
                var obj = result[i];
                $("#max-" + obj.Emotion.my_emotion).attr("src", obj.Emotion.img_file);
            }
        })
}

var capture = function() {
    var canvas = $("#captured")[0];
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