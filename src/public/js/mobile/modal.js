function closeModal(hamburguer) {
    var element = document.getElementById("modal");
    element.style.width = 0;
    hamburguer.style.width = "2em";
}

function openModal(hamburguer) {
    document.getElementById("modal").style.width = "80vw";
    hamburguer.style.width = 0;
}

var close_btn = document.getElementById("close-btn");
var hamburguer = document.getElementById("modal-open");
close_btn.addEventListener("click", () => closeModal(hamburguer));
hamburguer.addEventListener("click", () => openModal(hamburguer));
