function displayHidden(idOn) {
    var on = document.getElementById(idOn);
    on.style.display = "block";
}

function displayIcon(picId, selectId) {
    var charId = document.getElementById(selectId).value;
    var newSrc = "images/" + charId + ".png"
    document.getElementById(picId).src = newSrc;
}