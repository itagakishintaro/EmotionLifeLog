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

  var form = new FormData;
  form.append("file", new Blob([canvas.toDataURL("image/png")],
                               {"type": "image/png"}));
  $.ajax({
    url: "/upload", 
    data: form,
    processData: false,
    contentType: "multipart/form-data",
    type: "POST"
  });
  return  canvas.toDataURL("image/png");
};

// カメラ画像が使えるか判定
if (!navigator.getUserMedia && !navigator.webkitGetUserMedia) {
  alert('webkit系ブラウザでないか、もしくはgetUserMediaがサポートされていません');
} else {
  startVideo();
}