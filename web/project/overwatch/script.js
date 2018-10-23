function toggleHidden(idOn, idOff) {
    var on = document.getElementById(idOn);
    var off = document.getElementById(idOff);
    if (on.style.display === "none") {
        on.style.display = "block";
    } else {
        on.style.display = "none";
    }

    if (off.style.display === "block") {
        off.style.display = "none";
    }
}

function displayIcon(picId, charId) {
    var newSrc = "images/" + charId + ".png"
    document.getElementById(picId).src == newSrc;
}