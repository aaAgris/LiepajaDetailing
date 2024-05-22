document.addEventListener("DOMContentLoaded", function() {
    const tagContainer = document.getElementById("tag-container");
    const tagSelect = document.getElementById("tag-select");
    const talrunisInput = document.getElementById("talrunis");

    // Event listener for adding tags
    tagSelect.addEventListener("change", function() {
        const selectedTag = tagSelect.value;
        if (selectedTag) {
            const tag = document.createElement("span");
            tag.classList.add("tag");
            tag.textContent = selectedTag;
            const closeButton = document.createElement("span");
            closeButton.classList.add("close");
            closeButton.textContent = "x";
            tag.appendChild(closeButton);
            tagContainer.appendChild(tag);
            closeButton.addEventListener("click", function() {
                tagContainer.removeChild(tag);
                enableOption(selectedTag);
            });
            disableOption(selectedTag);
        }
    });

    // Event listener for removing tags
    tagContainer.addEventListener("click", function(event) {
        if (event.target.classList.contains("close")) {
            const tagText = event.target.parentNode.textContent.trim();
            tagContainer.removeChild(event.target.parentNode);
            enableOption(tagText);
        }
    });

    // Function to disable option in the dropdown
    function disableOption(value) {
        const option = tagSelect.querySelector(`option[value="${value}"]`);
        if (option) {
            option.disabled = true;
        }
    }

    // Function to enable option in the dropdown
    function enableOption(value) {
        const option = tagSelect.querySelector(`option[value="${value}"]`);
        if (option) {
            option.disabled = false;
        }
    }
});


$(document).on('click', '.close_modal', (e) => {
    $(".modal").hide()
    edit = false
    $("#pieteikumaForma").trigger('reset')
})