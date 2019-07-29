function get_cities() {
    var options = document
        .getElementById("estadoSelect")
        .getElementsByTagName("option");
    for (i = 0; i < options.length; i++) {
        if (options[i].selected) {
            id = parseInt(options[i].value);
            break;
        }
    }
    if (id == NaN) {
        alert("invalid city value");
        return;
    }

    if (id == 0) {
        x = document.getElementById("cidadeSelect");
        x.innerHTML = "";
        x.disabled = true;
        return;
    }
    token = document.getElementById("_token").getAttribute("content") + "asdas";
    console.log(token);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.status == 200) {
            x = document.getElementById("cidadeSelect");
            x.innerHTML = this.responseText;
            x.disabled = false;
        }
    };
    ajax.open("GET", "/cidades/" + id);
    ajax.setRequestHeader("X-CSRF-TOKEN", token);
    ajax.send();
}

function apply_filters() {
    // estado
    var options = document
        .getElementById("estadoSelect")
        .getElementsByTagName("option");
    for (i = 0; i < options.length; i++) {
        if (options[i].selected) {
            estado_id = parseInt(options[i].value);
            break;
        }
    }
    // cidade id
    var cidade = document.getElementById("cidadeSelect");
    if (!cidade.disabled) {
        var options = document
            .getElementById("cidadeSelect")
            .getElementsByTagName("option");
        for (i = 0; i < options.length; i++) {
            if (options[i].selected) {
                estado_id = parseInt(options[i].value);
                break;
            }
        }
    }
}
