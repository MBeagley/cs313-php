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

function toggleSelected(idOn, count) {
    var button = 'button' + idOn;
    var select = document.getElementById(button);
    if (select.innerHTML == "Unselect") {
        select.innerHTML = "Select";        
    } else {
        for (var i = 0; i < count; i++) {
            var offButton = 'button' + i;
            var unselect = document.getElementById(offButton);
            unselect.innerHTML = "Select";

            var submit = 'submit' + i;
            var off = document.getElementById(submit);
            if (off.style.display === "block") {
                off.style.display = "none";
            }
        }
        select.innerHTML = "Unselect";
    }



    var submit = 'submit' + idOn.toSting();
    var on = document.getElementById(submit);
    if (on.style.display === "none") {
        on.style.display = "block";
    } else {
        on.style.display = "none";
    }
}

function displayIcon(picId, selectId) {
    var charId = document.getElementById(selectId).value;
    var newSrc = "images/" + charId + ".png"
    document.getElementById(picId).src = newSrc;
}