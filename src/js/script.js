function alertModal() {
    const overlay = document.getElementById("overlay");
    const closeModal = document.getElementById("close-modal");
    const alertMessageModal = document.getElementById("alert-message-modal");
    const alertBody = document.getElementById("alert-body");
    const alertHeader = document.getElementById("alert-header");
    const alertHeaderTitle = document.getElementById("alert-header-title");

    alertHeader.classList.add("alert-header");
    alertHeaderTitle.classList.add("alert-header-title");
    alertMessageModal.classList.add("alert-message-modal", "active");
    alertBody.classList.add("alert-body");
    overlay.classList.add("overlay", "active");
    closeModal.classList.add("close-modal");

    closeModal.addEventListener("click", () => {
        alertMessageModal.classList.remove("active");
        overlay.classList.remove("active");
    });
}

function clearFormData() {
    document.querySelectorAll("input:not([type='submit'])").forEach((ele) => {
        ele.value = "";
    });
}

document.addEventListener("DOMContentLoaded", function () {
    var columns = document.querySelectorAll('#animatedRow > [class*="col-"]');

    columns.forEach(function (column, index) {
        column.classList.add("animate-column");
        column.style.animationDelay = index * 0.2 + "s";
    });
});
