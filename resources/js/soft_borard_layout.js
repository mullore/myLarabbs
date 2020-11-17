var inputs = document.querySelectorAll("input[type='text']")
var h = window.innerHeight;
for (let  i = 0; i< inputs.length; i++)
{
    (function (i) {
        inputs[i].addEventListener('focus',function () {
            document.body.style.height=h + 'px' ;
        },false)
    })(i)
}
