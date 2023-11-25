//on doc ready with jQuery
$(document).ready(function() {
    $('.toggle-password').click(function () {
        const targetInput = $($(this).attr('target'));
        togglePasswordVisibility(targetInput, $(this));
    });
});
function togglePasswordVisibility(inputElement, toggleButton) {
    const inputType = inputElement.attr("type");
    const newType = inputType === "password" ? "text" : "password";
    inputElement.attr("type", newType);

    const iconClass = newType === "password" ? `<i class="bi bi-eye"></i>` : `<i class="bi bi-eye-slash"></i>`;
    toggleButton.html(iconClass);
}