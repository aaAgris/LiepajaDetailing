


$(document).on('click', '.close_modal', (e) => {
    $(".modal").hide()
    edit = false
    $("#pieteikumaForma").trigger('reset')
})

function filter(type) {
    const url = new URL(window.location.href);
    url.searchParams.set('filter', type);
    window.location.href = url.href;
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('application-form');
    const tagSelect = document.getElementById('tag-select');
    const selectedTagsContainer = document.getElementById('selected-tags-container');

    // Event listener for adding selected tags
    tagSelect.addEventListener('change', function(e) {
        const selectedOptions = Array.from(tagSelect.selectedOptions);
        selectedOptions.forEach(option => {
            const selectedTag = option.value;
            if (!isTagSelected(selectedTag)) {
                addSelectedTag(selectedTag);
            }
            option.disabled = true; // Disable the selected option
        });
        tagSelect.selectedIndex = -1; // Reset select to default
    });

    // Event listener for removing selected tags
    selectedTagsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-tag')) {
            const tagToRemove = e.target.parentElement.dataset.tag;
            removeSelectedTag(tagToRemove);
            const optionToEnable = tagSelect.querySelector(`option[value="${tagToRemove}"]`);
            if (optionToEnable) {
                optionToEnable.disabled = false;
            }
        }
    });

    // Function to check if a tag is already selected
    function isTagSelected(tag) {
        return selectedTagsContainer.querySelector(`span[data-tag="${tag}"]`) !== null;
    }

    // Function to add a selected tag to the container
    function addSelectedTag(tag) {
        const tagElement = document.createElement('span');
        tagElement.dataset.tag = tag;
        tagElement.textContent = tag;
        const removeIcon = document.createElement('i');
        removeIcon.classList.add('fas', 'fa-times', 'remove-tag');
        removeIcon.setAttribute('title', 'Remove');
        tagElement.appendChild(removeIcon);
        selectedTagsContainer.appendChild(tagElement);
        // Update hidden input for form submission
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags[]';
        hiddenInput.value = tag;
        form.appendChild(hiddenInput);
    }

    // Function to remove a selected tag from the container
    function removeSelectedTag(tag) {
        const tagElement = selectedTagsContainer.querySelector(`span[data-tag="${tag}"]`);
        if (tagElement) {
            tagElement.remove();
            // Remove hidden input associated with the tag
            const hiddenInput = form.querySelector(`input[name="tags[]"][value="${tag}"]`);
            if (hiddenInput) {
                hiddenInput.remove();
            }
        }
    }


    
});

$(document).ready(function() {
    // Initialize datepicker
    $("#datums").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0, // Allow only future dates
        beforeShowDay: function(date) {
            var day = date.getDay(); // 0 (Sunday) to 6 (Saturday)
            return [(day >= 1 && day <= 5)]; // Enable only Monday to Friday
        },
        onSelect: function(selectedDate) {
            // AJAX call to check availability for the selected date
            $.ajax({
                url: 'crud/check-availability.php',
                type: 'GET',
                data: { date: selectedDate },
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        console.error(response.error);
                        return;
                    }

                    // Disable booked times
                    var disabledTimes = response.map(function(time) {
                        return [time, time];
                    });
                    $('#laiks').timepicker('option', 'disableTimeRanges', disabledTimes);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        }
    });

    // Initialize timepicker
    $('#laiks').timepicker({
        'timeFormat': 'H:mm',
        'scrollDefault': 'now',
        'minTime': '09:00',
        'maxTime': '17:00',
        'step': 60, // 1 hour intervals
        'disableTextInput': true, // Prevent manual input
        'disableTimeRanges': [] // Initialize with no disabled times
    });

    // Submit form handling
    $('#application-form').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var formData = $(this).serialize(); // Serialize form data
        var submitUrl = $(this).attr('action'); // Form action URL

        $.ajax({
            type: 'POST',
            url: submitUrl,
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    // Show modal with error message and available times
                    var availableTimes = response.available_times.join(', ');
                    var modalContent = '<div class="modal-content">' +
                                            '<span class="close">&times;</span>' +
                                            '<p>' + response.error + '</p>' +
                                            '<p>Available times: ' + availableTimes + '</p>' +
                                       '</div>';

                    // Append modal to the body and show
                    $('body').append('<div id="myModal" class="modal">' + modalContent + '</div>');
                    $('#myModal').css('display', 'block');

                    // Close the modal when close button or outside modal area is clicked
                    $('.close').click(function() {
                        $('#myModal').remove();
                    });
                    $(window).click(function(event) {
                        if (event.target == $('#myModal')[0]) {
                            $('#myModal').remove();
                        }
                    });
                } else {
                    // Handle success scenario if needed
                    alert('Pieteikums veiksmīgi pievienots!');
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error: ' + error);
            }
        });
    });
});

$(document).ready(function(){
    $('.image-carousel').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });
});

// Initialize Google Map
function initMap() {
    var location = {lat: 56.504667, lng: 21.010833};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}

window.initMap = initMap;

