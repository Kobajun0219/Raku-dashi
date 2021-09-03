// ★自分と投稿との距離を計算する calcDistance 関数
function calcDistance(box_latitude, box_longitude) {
    let count = 0;
    var distance = [];                              // 距離を入れる配列
    var myPos = new google.maps.LatLng(box_latitude, box_longitude);   // Googleマップの LatLng オブジェクトを作成
    for (var i = 0; i < toukou.length; i++) {      // 全ての投稿について
        var pos = new google.maps.LatLng(toukou[i].box_latitude, toukou[i].box_longitude);                 // 投稿の位置を設定
        distance[i] = google.maps.geometry.spherical.computeDistanceBetween(myPos, pos);    // 距離を求める
        // 取得の判定と取得した時のエフェクト
        if (distance[i] < 50 && captured[i] === false) {  // 距離が20m未満、かつ、まだ取得していないなら
            count++;
            let keydata = toukou[i];
            let imgDiv = document.createElement('img');
            imgDiv.width = 60;
            imgDiv.height = 60;
            imgDiv.setAttribute("id",count);
            imgDiv.src = "https://oki-mochi.herokuapp.com/image/0.png";
            document.getElementById('target').append(imgDiv);
            captured[i] = true;                                 // 取得済にする
        addEvent(count,toukou[i]);
        }
    }
}







 //DOM操作で近くに来た手紙を出現させる関数。
function addEvent(id,data) {
    document.getElementById(id).addEventListener('click',() => {
        document.getElementById('main').innerHTML = '';
        let targetDiv = document.createElement('div');
        targetDiv.innerHTML =  `
        <div class="note_wrap">
    <div class="note">
      <h5>${data['who']}へ</h5>
      <h5>題名　「${data['title']}」</h5>
      <p>${data['message']}</p>
      <h5 align="right">${data['u_name']}より</h5>
    </div>
     <div style="text-align: center;　margin-top: 50px;">
    <img src=/uploads/${data['pic_name']} alt="" style="width: 200px; height: 200px;">
    </div>
  </div>
        
        <div class="d-flex justify-content-center align-items-center">
        <a class="btn-stitch2 m-2" onclick="window.location.reload()";>戻る</a>
        <a href="https://oki-mochi.herokuapp.com/save/${data['id']}" class="btn-stitch m-2">お気に入りに追加</a>
        </div>
        `;
        document.getElementById('main').append(targetDiv);
    })
}
