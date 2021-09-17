//ファイルの名前表示処理
  $('#file_upload').on('change', function () {
  var file = $(this).prop('files')[0];
  $('#file_n').text(file.name);
  });


// 送信ボタンを有効にする機能
    // window.addEventListener('DOMContentLoaded',function(){
    // document.getElementById('show_s').disabled = true;
    // document.getElementById('address').addEventListener('keyup',function(){
    // if (this.value.length < 1) {
    // document.getElementById('show_s').disabled = true;
    // } else {
    // document.getElementById('show_s').disabled = false;
    // }
    // },false);
    // document.getElementById('address').addEventListener('change',function(){
    // if (this.value.length < 1) {
    // document.getElementById('show_s').disabled = true;
    // }
    // },false);
    // },false);


var getMap = (function() {
      function codeAddress(address) {
        // google.maps.Geocoder()コンストラクタのインスタンスを生成
        var geocoder = new google.maps.Geocoder();
        // 地図表示に関するオプション
        var mapOptions = {
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles://Mapのデザイン変更
        [
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": "50"
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [
            {
                "lightness": "30"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "all",
        "stylers": [
            {
                "lightness": "40"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    }
]
        };

        // 地図を表示させるインスタンスを生成
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        //マーカー変数用意
        var marker;
        // geocoder.geocode()メソッドを実行
        geocoder.geocode( { 'address': address}, function(results, status) {

          // ジオコーディングが成功した場合
          if (status == google.maps.GeocoderStatus.OK) {
            
            // 変換した緯度・経度情報を地図の中心に表示
            map.setCenter(results[0].geometry.location);
            //☆表示している地図上の緯度経度
            document.getElementById('lat').value=results[0].geometry.location.lat();
            document.getElementById('lng').value=results[0].geometry.location.lng();

            // マーカー設定
            marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });

          // ジオコーディングが成功しなかった場合
          } else {
            console.log('Geocode was not successful for the following reason: ' + status);
          }

        });

        // マップをクリックで位置変更
        map.addListener('click', function(e) {
          getClickLatLng(e.latLng, map);
        });
        function getClickLatLng(lat_lng, map) {

          //☆表示している地図上の緯度経度
          document.getElementById('lat').value=lat_lng.lat();
          document.getElementById('lng').value=lat_lng.lng();
          

          // マーカーを設置
          marker.setMap(null);
          marker = new google.maps.Marker({
            position: lat_lng,
            map: map
          });

          // 座標の中心をずらす
          map.panTo(lat_lng);
        }

      }

      //inputのvalueで検索して地図を表示
      return {
        getAddress: function() {
          // ボタンに指定したid要素を取得
          var button = document.getElementById("map_button");
          // ボタンが押された時の処理
          button.onclick = function() {
            // フォームに入力された住所情報を取得
            var address = document.getElementById("address").value;
            // 取得した住所を引数に指定してcodeAddress()関数を実行
            codeAddress(address);
            document.getElementById('show_s').disabled = false;
          }

          //読み込まれたときに地図を表示
          window.onload = function(){
            // フォームに入力された住所情報を取得
            var address = document.getElementById("address").value;
            // 取得した住所を引数に指定してcodeAddress()関数を実行
            codeAddress(address);
              
          }
        }
        
        // getAddress:function ShowLength(str) {
        //   console.log(str);
        //   codeAddress(str);
        // }

      };

    })();
    getMap.getAddress();
    
      function ShowLength(ads) {
            
      
    }
    
    
   
//   //下記ドラッグアンドドラップの処理-----------------------
   
// let fileArea = document.getElementById('dragDropArea');
// let fileInput = document.getElementById('fileInput');
// // たされた時のクリックイベントの付与
// fileArea.addEventListener('dragover', function (evt) {
//   evt.preventDefault();
//   fileArea.classList.add('dragover');
// });
// //取り除いたときのクリックイベントの付与
// fileArea.addEventListener('dragleave', function (evt) {
//   evt.preventDefault();
//   fileArea.classList.remove('dragover');
// });
//   // ドロップ後の付与
// fileArea.addEventListener('drop', function (evt) {
//   evt.preventDefault();
//   fileArea.classList.remove('dragenter');
//   let files = evt.dataTransfer.files;
//   console.log("DRAG & DROP");
//   console.table(files);
//   fileInput.files = files;
//   photoPreview('onChenge', files[0]);
// });
  
//   // 写真の表示処理
// function photoPreview(event, f = null) {
//   let file = f;
//   if (file === null) {
//     file = event.target.files[0];
//   }
//   let reader = new FileReader();
//   let preview = document.getElementById("previewArea");
//   let previewImage = document.getElementById("previewImage");

//   if (previewImage != null) {
//     preview.removeChild(previewImage);
//   }
//   reader.onload = function (event) {
//     let img = document.createElement("img");
//     img.setAttribute("src", reader.result);
//     img.setAttribute("id", "previewImage");
//     preview.appendChild(img);
//   };

//   reader.readAsDataURL(file);
// }



// 下記マップ出現、ドロップ処理-------------------

// function show(){
//     console.log("show");
//     document.getElementById("map_button").onclick = function() {
//             console.log("動くよ");
//         document.getElementById("show_s").style.display ="block";
//     }
// }

// show();