'use strict';

var URL = 'https://api.tokyometroapp.jp/api/v2/datapoints';
var TOKEN = '22b4f2f8dd953bb676f7145b0777fb20e7d288e5f3662dd3837ccb6854eefadd';
// 仮設定。本当はユーザーの入力からとる。
var destination = 'odpt.StationFacility:TokyoMetro.KokkaiGijidomae';
var railway = 'odpt.Railway:TokyoMetro.Marunouchi';
var railDirection = 'odpt.RailDirection:TokyoMetro.Ikebukuro';

$(function() {
    $("#search").click(function() {
      $.ajax({
        url: URL,
        data: {
          'acl:consumerKey': TOKEN,
          'rdf:type': 'odpt:StationFacility',
          'owl:sameAs': destination
        }
      }).done(function(facility) {
        var platformInformation = facility[0]['odpt:platformInformation'];
        var carComposition = Number( platformInformation[0]['odpt:carComposition'] );
        var cars = new Array(carComposition + 1);
        for(var i = 1; i <= carComposition; i++){
          cars[i] = 0;
        }

        platformInformation.forEach(function(info){
          // 路線と進行方向が指定どおりで、バリアフリー施設がある場合のみ処理する
          if( info['odpt:railway'] === railway
            && info['odpt:railDirection'] === railDirection
            && info['odpt:barrierfreeFacility'] ){

            info['odpt:barrierfreeFacility'].forEach(function(bff){
              // エレベーターかエスカレーターのどちらかがある場合
              if( bff.search(/Escalator/) > 0 || bff.search(/Elevator/) > 0 ){
                cars[Number(info['odpt:carNumber'])] += 1;
              }
            });

          }
        });

        // バリアフリー施設があるときは白とないときは黒で図を表示
        $('#result .car').remove();
        for(var i = 1; i <= carComposition; i++){
          if( cars[i] === 0 ){
            $('#result').append('<div class="car black">' + i + '</div>');
          } else {
            $('#result').append('<div class="car white">' + i + '</div>');
          } 
        }
        
    });
  });
});