


function  checkTime(i) {
    if (i<10){
        i  = '0' + i;
    }
    return i;
}

function nowTime() {
    var d = new Date();
    // var t = d.toLocaleString('chinese', { hour12: false });
    let  h = checkTime(d.getHours());
    let m = checkTime(d.getMinutes());
    let s = checkTime(d.getSeconds());
    document.getElementById('myTime').innerHTML = h + ':' + m + ':' + s ;
}
 setInterval(function () {
    nowTime()
},1000)

// export default  myTime;


