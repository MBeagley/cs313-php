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
    var button = 'button' + idOn.toSting();
    var select = document.getElementById(button);
    if (select.value == "Unselect") {
        select.value = "Select";        
    } else {
        for (var i = 0; i < count; i++) {
            var offButton = 'button' + i.toSting();
            var unselect = document.getElementById(offButton);
            unselect.value = "Select";

            var submit = 'submit' + i.toSting();
            var off = document.getElementById(submit);
            if (off.style.display === "block") {
                off.style.display = "none";
            }
        }
        select.value = "Unselect";
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