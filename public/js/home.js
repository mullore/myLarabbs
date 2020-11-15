

function  checkTime(i) {
    if (i<10){
        i  = '0' + i;
    }
    return i;
}

function nowTime() {
    var d = new Date();
    // var t = d.toLocaleString('chinese', { hour12: false });
    var h = checkTime(d.getHours());
    var m = checkTime(d.getMinutes());
    var s = checkTime(d.getSeconds());
    var time  = h + ':' + m + ':' + s;
    document.getElementById('myTime').innerHTML = time ;
}
let  myTime = setInterval(function () {
    nowTime()
},1000)

export default  myTime;
