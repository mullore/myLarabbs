var myTime =setInterval(function () {
    nowTime()
},1000)

function nowTime() {
    var d = new Date();
    var t = d.toLocaleTimeString('chinese', { hour12: false });

    document.getElementById('myTime').innerHTML = t ;
}
