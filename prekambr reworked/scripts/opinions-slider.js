var opinionContainer = document.getElementById('opinion');
var authorContainer = document.getElementById('author');
var placeContainer = document.getElementById('place');
var x = 0;

function setIntervalAndExecute(fn, t) {
    fn();
    return(setInterval(fn, t));
}

function renderSilder(){
    var request = new XMLHttpRequest();
    //ma byc elegancko opinions
request.open("GET","opinions.txt",true);
request.onload = function() {
    var receivedData = JSON.parse(request.responseText);
   addHTML(receivedData);
}
request.send();

};

function addHTML(data) {
    opinionContainer.textContent = "";
    authorContainer.textContent = "";
    placeContainer.textContent = "";
   var opinionString = '"' + data[x].opinion+ '"';
 opinionContainer.insertAdjacentHTML('beforeend', opinionString);
    var authorString = data[x].author +", "; 
 authorContainer.insertAdjacentHTML('afterbegin', authorString);
    var placeString = data[x].place; 
 placeContainer.insertAdjacentHTML('beforeend', placeString);
    x++;
    if (x === data.length){
        x=0;
    }
}

setIntervalAndExecute(renderSilder, 7000);