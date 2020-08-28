function setLocation(pos){

    // 緯度・経度を取得
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    console.log(lat);
    console.log(lng);

    // welcomeの中からlat_idのidを見つけて、そのvalueに、定数latを代入
    document.getElementById("lat_id").value = lat;
    // welcomeの中からlng_idのidを見つけて、そのvalueに、定数lngを代入
    document.getElementById("lng_id").value = lng;

}

// エラー時に呼び出される関数
function showErr(err){
    switch(err.code){
        case 1 : alert("位置情報の利用が許可されていません"); break;
        case 2 : alert("デバイスの位置が判定できません"); break;
        case 3 : alert("タイムアウトしました"); break;
        default : alert(err.message);
    }
}

// geolocation に対応しているか否かを確認
if("geolocation" in navigator){
    var opt = {
        "enableHighAccuracy": true,
        "timeout": 10000,
        "maximumAge": 0,
    };
    navigator.geolocation.getCurrentPosition(setLocation, showErr, opt);
}else{
    alert("ブラウザが位置情報取得に対応していません");
}
