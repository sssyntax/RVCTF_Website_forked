function empty() {
    var lstofinputs = document.getElementsByClassName("notempty");
    for (let i = 0;i<lstofinputs.length;i++){
        var value = lstofinputs[i].value
        if (value == ""){
            alert(`Please do not leave the inputs blank`);
            return false;
        }
    };
}
nospace = document.getElementsByClassName("nospace")
for (let i of nospace){
    i.onkeypress(function (evt) {
        var keycode = evt.charCode || evt.keyCode;
        if (keycode  == 32) { 
        return false;
        }
    });
}

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const errors = JSON.parse(urlParams.get('error'))
if (errors != null){
for (let i of errors){
    const ele = document.getElementById(i)
    ele.style.display = "initial"
}}