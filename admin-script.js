
$(document).ready(function(){
    let edit = false;
    fetchCenas()
    fetchDarbi()
    fetchPieteikumi()
    fetchVacancies()
    fetchCVs()


    $(document).on('click', '#newDarbi', (e) => {
        $(".modal").css('display','flex')
    })

    $(document).on('click', '.close_modal', (e) => {
        $(".modal").hide()
        edit = false
        $("#jaunaKursaForma").trigger('reset')
    })


    // Function to fetch cenas data
// Function to fetch all cenas from the database
function fetchCenas() {
    $.ajax({
        url: 'crud/cenas-list.php',
        type: 'GET',
        success: function(response) {
            const cenas = JSON.parse(response);
            let template = '';
            cenas.forEach(cena => {
                template += `
                    <tr cenasID="${cena.id}">
                        <td>${cena.id}</td>
                        <td>${cena.darbs}</td>
                        <td>${cena.apraksts}</td>
                        <td>${cena.cena1}</td>
                        <td>${cena.cena2}</td>
                        <td>${cena.statuss}</td>
                        <td>
                            <a href="#" class="pieteikums-item btn-edit"><i class="fa fa-edit"></i></a> 
                            <a href="#" class="pieteikums-delete btn-delete"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                `;
            });
            $('#cenas').html(template); // Display fetched data in the table
        }
    });
}

// Event handler for editing a cena item
$(document).on('click', '.pieteikums-item', function(e) {
    e.preventDefault();
    $('.modal').css('display', 'flex'); // Show the modal

    const element = $(this).closest('tr');
    const id = $(element).attr('cenasID'); // Fetching cenasID attribute from the clicked row

    $.post('crud/cenas-single.php', { id }, function(response) {
        const cena = JSON.parse(response);
        $('#pieteikumaForma').attr('data-id', id); // Store the id in the form
        $('#darbs').val(cena.darbs); // Assuming darbs is the id of the selected work from veicdarbi
        $('#apraksts').val(cena.apraksts);
        $('#afCena').val(cena.cena1);
        $('#komercCena').val(cena.cena2);
        $('#statuss').val(cena.statuss);
    });
});

// Event handler for submitting the vacancy form
$('#pieteikumaForma').submit(function(e) {
    e.preventDefault();

    const id = $('#pieteikumaForma').attr('data-id'); // Fetching the id from the form
    const postData = {
        id: id,
        nosaukums: $('#darbs').val(),
        apraksts: $('#apraksts').val(),
        cena1: $('#afCena').val(),
        cena2: $('#komercCena').val(),
        statuss: $('#statuss').val()
    };

    const url = id ? 'crud/cenas-edit.php' : 'crud/cenas-add.php'; // Decide URL based on existence of id
    $.post(url, postData, function(response) {
        console.log(response); // Log response for debugging
        fetchCenas(); // Refresh data after successful submission
        $('.modal').css('display', 'none'); // Hide the modal
    });
});

// Event handler for deleting a cena item
$(document).on('click', '.pieteikums-delete', function(e) {
    e.preventDefault();

    if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
        const element = $(this).closest('tr');
        const id = $(element).attr('cenasID');

        $.post('crud/cenas-delete.php', { id }, function(response) {
            console.log(response); // Log response for debugging
            fetchCenas(); // Refresh data after successful deletion
        });
    }
});

// Event handler for adding a new cena item
$('#new').click(function() {
    $('.modal').css('display', 'flex'); // Show the modal
    $('#pieteikumaForma').removeAttr('data-id'); // Clear any existing data-id
    $('#pieteikumaForma')[0].reset(); // Reset the form fields
});

// Event handler for closing the modal
$(document).on('click', '.close_modal', function() {
    $('.modal').css('display', 'none'); // Hide the modal
});

$(document).ready(function() {
    fetchCenas(); // Fetch and display cenas when the document is ready
});

function fetchDarbi() {
    $.ajax({
        url: 'crud/darbi-list.php',
        type: 'GET',
        success: function(response) {
            const darbi = JSON.parse(response);
            let template = '';
            darbi.forEach(darbs => {
                template += `
                    <tr darbaID="${darbs.id}">
                        <td>${darbs.id}</td>
                        <td>${darbs.darbs}</td>
                        <td>${darbs.apraksts}</td>
                        <td>${darbs.attels}</td>
                        <td>${darbs.statuss}</td>
                        <td>${darbs.tips}</td>
                        <td>
                            <a href="#" class="darbi-item btn-edit"><i class="fa fa-edit"></i></a> 
                            <a href="#" class="darbi-delete btn-delete"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                `;
            });

            $('#darbi').html(template);
        }
    });
}

$(document).ready(function() {
    let edit = false; // Flag to track if it's edit or add mode

    // Fetch darbi data when the page loads
    fetchDarbi();

    // Event handler for editing a darbs item
    $(document).on('click', '.darbi-item', function(e) {
        e.preventDefault();
        $('.modal').css('display', 'flex'); // Show the modal

        const element = $(this).closest('tr');
        const id = $(element).attr('darbaID'); // Fetching darbaID attribute from the clicked row

        $.post('crud/darbi-single.php', { id }, function(response) {
            const darbs = JSON.parse(response);
            $('#darbs1').val(darbs.nosaukums);
            $('#apraksts').val(darbs.apraksts);
            $('#attels').val(darbs.attels);
            $('#statuss').val(darbs.statuss);
            $('#tips').val(darbs.tips);
            $('#darbiID').val(darbs.id);
            edit = true; // Set edit mode to true
        });
    });

    // Event handler for submitting the form to add or edit a darbs item
    $('#darbuForma').submit(function(e) {
        e.preventDefault();

        const postData = {
            nosaukums: $('#darbs1').val(),
            apraksts: $('#apraksts').val(),
            attels: $('#attels').val(),
            statuss: $('#statuss').val(),
            tips: $('#tips').val(),
            id: $('#darbiID').val()
        };

        const url = edit === false ? 'crud/darbi-add.php' : 'crud/darbi-edit.php';
        console.log(postData, url);

        $.post(url, postData, function(response) {
            console.log(response); // Log response for debugging
            fetchDarbi(); // Refresh data after successful submission
            $('#darbuForma').trigger('reset'); // Reset form after submission
            $('.modal').hide(); // Hide the modal
            edit = false; // Reset edit mode to false
        });
    });

    // Event handler for deleting a darbs item
    $(document).on('click', '.darbi-delete', function(e) {
        e.preventDefault();

        if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
            const element = $(this).closest('tr');
            const id = $(element).attr('darbaID');

            $.post('crud/darbi-delete.php', { id }, function(response) {
                console.log(response); // Log response for debugging
                fetchDarbi(); // Refresh data after successful deletion
            });
        }
    });

    // Event handler for closing the modal
    $('.close_modal').click(function() {
        $('.modal').hide(); // Hide the modal
        edit = false; // Reset edit mode to false
    });
});



    
        // Function to fetch pieteikumi data
        function fetchPieteikumi() {
            $.ajax({
                url: 'crud/pieteikumi-list.php',
                type: 'GET',
                success: function(response) {
                    const pieteikumi = JSON.parse(response);
                    let template = '';
                    pieteikumi.forEach(pieteikums => {
                        let bildesHTML = '';
                        if (pieteikums.bildes.trim() !== '') {
                            const imagePath = `c:/xampp/img/${pieteikums.bildes}`;
                            bildesHTML = `<img src="${imagePath}" alt="Bilde" style="max-width: 200px; max-height: 200px;">`;
                        }
    
                        template += `
                            <tr pieteikumiID="${pieteikums.id}">
                                <td>${pieteikums.id}</td>
                                <td>${pieteikums.vards}</td>
                                <td>${pieteikums.uzvards}</td>
                                <td>${pieteikums.epasts}</td>
                                <td>${pieteikums.talrunis}</td>
                                <td>${pieteikums.komentari}</td>
                                <td>${pieteikums.auto_tiriba}</td>
                                <td>${bildesHTML}</td>
                                <td>${pieteikums.tags}</td>
                                <td>${pieteikums.datums}</td>
                                <td>${pieteikums.laiks}</td>
                                <td>
                                    <a href="#" class="pieteikumi-item btn-edit"><i class="fa fa-edit"></i></a> 
                                    <a href="#" class="pieteikumi-delete btn-delete"><i class="fa fa-trash"></i></a> 
                                    <a href="#" class="pieteikumi-bill btn-bill" pieteikumiID="${pieteikums.id}"><i class="fa fa-check"></i></a> 
                                </td>
                            </tr>
                        `;
                    });
    
                    $('#pieteikumi').html(template);
                }
            });
        }
    
        // Event listener for btn-bill click
        $(document).on('click', '.pieteikumi-bill', function(e) {
            e.preventDefault();
            const pieteikumiID = $(this).closest('tr').attr('pieteikumiID');
            
            // Prompt for price
            const price = prompt('Ievadi cenu:');
            if (price !== null && price.trim() !== '') {
                generateBill(pieteikumiID, price);
            } else {
                alert('Jānorāda cena.');
            }
        
    
        $(document).ready(function() {
            // Function to generate and send bill
            function generateBill(pieteikumiID, price) {
                $.post('crud/generate-bill.php', { pieteikumiID, price }, function(response) {
                    // Assuming the server sends back a file path or success message
                    if (response.startsWith('Error')) {
                        alert(response);
                    } else {
                        sendEmail(response, pieteikumiID); // Call function to send email with the generated file path and pieteikumiID
                    }
                });
            }});
        
            // Function to send email with the generated bill
            function sendEmail(filePath, pieteikumiID) {
                $.ajax({
                    url: 'crud/send-email.php',
                    type: 'POST',
                    data: { filePath, pieteikumiID },
                    success: function(response) {
                        alert(response); // Display success message or handle errors
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending email:', error);
                        alert('Error sending email. Please try again.');
                    }
                });
            }
        });
        
    
    $(document).on('click', '.pieteikumi-item', function(e) {
        $(".modal").css('display', 'flex');
        const element = $(e.currentTarget).closest('tr');
        const id = $(element).attr('pieteikumiID');
        $.post('crud/pieteikumi-single.php', { id }, (response) => {
            const pieteikums = JSON.parse(response);
            $('#vards').val(pieteikums.vards);
            $('#uzvards').val(pieteikums.uzvards);
            $('#epasts').val(pieteikums.epasts);
            $('#talrunis').val(pieteikums.talrunis);
            $('#komentari').val(pieteikums.komentari);
            $('#auto_tiriba').val(pieteikums.auto_tiriba);
            $('#tags').val(pieteikums.tags.split(', '));
            $('#datums').val(pieteikums.datums);
            $('#laiks').val(pieteikums.laiks);
            $('#bildes').val(pieteikums.bildes);
            $('#pieteikumiID').val(pieteikums.id);
            edit = true;
        });
        e.preventDefault();
    });
    
    $('#pieteikumiForma').submit(e => {
        e.preventDefault();
        const postData = {
            vards: $('#vards').val(),
            uzvards: $('#uzvards').val(),
            epasts: $('#epasts').val(),
            talrunis: $('#talrunis').val(),
            komentari: $('#komentari').val(),
            auto_tiriba: $('#auto_tiriba').val(),
            tags: $('#tags').val().join(', '),
            datums: $('#datums').val(),
            laiks: $('#laiks').val(),
            id: $('#pieteikumiID').val()
        };
        const url = edit === false ? 'crud/pieteikumi-add.php' : 'crud/pieteikumi-edit.php';
        console.log(postData, url);
        $.post(url, postData, (response) => {
            $("#pieteikumiForma").trigger('reset');
            fetchPieteikumi();
            $(".modal").hide();
            edit = false;
        });
    });
    
    $(document).on('click', '.pieteikumi-delete', function(e) {
        if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
            const element = $(e.currentTarget).closest('tr');
            const id = $(element).attr('pieteikumiID');
            $.post('crud/pieteikumi-delete.php', { id }, (response) => {
                fetchPieteikumi();
            });
        }
    });
    
    $(document).ready(function() {
        fetchPieteikumi();
    });

function fetchVacancies() {
    $.ajax({
        url: 'crud/vakances-list.php',
        type: 'GET',
        success: function(response) {
            const vacancies = JSON.parse(response);
            let template = '';
            vacancies.forEach(vacancy => {
                template += `
                    <tr vacancyID="${vacancy.id}">
                        <td>${vacancy.id}</td>
                        <td>${vacancy.title}</td>
                        <td>${vacancy.description}</td>
                        <td>${vacancy.wage}</td>
                        <td>${vacancy.wage2}</td>
                        <td>${vacancy.statuss}</td>
                        <td>
                            <a href="#" class="vacancy-item btn-edit"><i class="fa fa-edit"></i></a> 
                            <a href="#" class="vacancy-delete btn-delete"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                `;
            });

            $('#vacancies').html(template);
        }
    });
}

$(document).on('click', '.vacancy-item', function(e) {
    $(".modal").css('display', 'flex');
    const element = $(e.currentTarget).closest('tr');
    const id = $(element).attr('vacancyID');
    $.post('crud/vakances-single.php', { id }, (response) => {
        const vacancy = JSON.parse(response);
        $('#title').val(vacancy.title);
        $('#description').val(vacancy.description);
        $('#wage').val(vacancy.wage);
        $('#wage2').val(vacancy.wage2);
        $('#statuss').val(vacancy.statuss);
        $('#vacancyID').val(vacancy.id);
        edit = true;
    });
    e.preventDefault();
});

$('#vacancyForm').submit(e => {
    e.preventDefault();
    const postData = {
        title: $('#title').val(),
        description: $('#description').val(),
        wage: $('#wage').val(),
        wage2: $('#wage2').val(),
        statuss: $('#statuss').val(),
        id: $('#vacancyID').val()
    };
    const url = edit === false ? 'crud/vakances-add.php' : 'crud/vakances-edit.php';
    console.log(postData, url);
    $.post(url, postData, (response) => {
        $("#vacancyForm").trigger('reset');
        fetchVacancies();
        $(".modal").hide();
        edit = false;
    });
});

$(document).on('click', '.vacancy-delete', function(e) {
    if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
        const element = $(e.currentTarget).closest('tr');
        const id = $(element).attr('vacancyID');
        $.post('crud/vakances-delete.php', { id }, (response) => {
            console.log(response);
            fetchVacancies();
        });
    }
});

$(document).ready(function() {
    fetchVacancies();
});


$(document).ready(function() {
    fetchCVs();

    // Handle click on "Edit" button
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        const cvID = $(this).closest('tr').attr('cvID');
        $.post('crud/cv-single.php', { id: cvID }, (response) => {
            const cv = JSON.parse(response);
            $('#vards').val(cv.vards);
            $('#uzvards').val(cv.uzvards);
            $('#epasts').val(cv.epasts);
            $('#talrunis').val(cv.talrunis);
            $('#datums').val(cv.datums);
            $('#statuss').val(cv.statuss); // Populate statuss field
            $('#cvID').val(cv.id);
        });
        $('#editModal').show();
    });

    // Handle click on "Bill" button
    $(document).on('click', '.btn-bill', function(e) {
        e.preventDefault();
        const cvID = $(this).data('cv-id');
        $('#cvIDModal').val(cvID); // Set cvID in modal
        $('#billModal').show();
    });

    // Close modal when clicking the close icon
    $('.close_modal').click(function() {
        $(this).closest('.modal').hide();
    });

    // Handle form submission for edit modal
    $('#cvForma').submit(function(e) {
        e.preventDefault();
        const postData = {
            vards: $('#vards').val(),
            uzvards: $('#uzvards').val(),
            epasts: $('#epasts').val(),
            talrunis: $('#talrunis').val(),
            datums: $('#datums').val(),
            statuss: $('#statuss').val(), // Include statuss field
            id: $('#cvID').val()
        };
        const url = $('#cvID').val() ? 'crud/cv-edit.php' : 'crud/cv-add.php';
        $.post(url, postData, (response) => {
            $("#cvForma").trigger('reset'); 
            fetchCVs();
            $('#editModal').hide();
        });
    });

    // Handle form submission for bill modal
    $('#billForm').submit(function(e) {
        e.preventDefault();
        const cvID = $('#cvIDModal').val();
        const action = $('#actionSelect').val();
        $.post('crud/cv-bill.php', { cvID, action }, function(response) {
            console.log(response); // Debugging purposes
            fetchCVs();
            $('#billModal').hide();
        });
    });

    // Handle click on "Delete" button
    $(document).on('click', '.cv-delete', function(e) {
        if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
            const element = $(e.currentTarget).closest('tr');
            const id = $(element).attr('cvID');
            $.post('crud/cv-delete.php', { id }, (response) => {
                fetchCVs();
            });
        }
    });
});

function fetchCVs() {
    $.ajax({
        url: 'crud/cv-list.php',
        type: 'GET',
        success: function(response) {
            const cvs = JSON.parse(response);
            let template = '';
            cvs.forEach(cv => {
                template += `
                    <tr cvID="${cv.id}">
                        <td>${cv.id}</td>
                        <td>${cv.vards}</td>
                        <td>${cv.uzvards}</td>
                        <td>${cv.epasts}</td>
                        <td>${cv.talrunis}</td>
                        <td>${cv.datums}</td>
                        <td>${cv.vacancy_name}</td>
                        <td>${cv.statuss}</td>
                        <td>
                            <a href="#" class="cv-item btn-edit"><i class="fa fa-edit"></i></a> 
                            <a href="#" class="cv-delete btn-delete"><i class="fa fa-trash"></i></a> 
                            <a href="#" class="cv-bill btn-bill" data-cv-id="${cv.id}"><i class="fa fa-check"></i></a> 
                        </td>
                    </tr>
                `;
            });
            $('#cvs').html(template);
        }
    });
}

$(document).ready(function() {
    let edit = false;

    // Fetch users
    fetchUsers();

    // Click event to open modal for new user
    $('#newUser').click(function() {
        edit = false;
        $("#userForm").trigger('reset');
        $("#userModal").css('display', 'flex');
    });

    // Close modal
    $('.close_modal').click(function() {
        $(this).closest('.modal').hide();
    });

    // Fetch users from server
    function fetchUsers() {
        $.ajax({
            url: 'crud/lietotaji-list.php',
            type: 'GET',
            success: function(response) {
                const users = JSON.parse(response);
                let template = '';
                users.forEach(user => {
                    template += `
                        <tr userID="${user.id}">
                            <td>${user.id}</td>
                            <td>${user.lietotajvards}</td>
                            <td>${user.vards}</td>
                            <td>${user.uzvards}</td>
                            <td>${user.epasts}</td>
                            <td>${user.loma}</td>
                            <td>${user.statuss}</td>
                            <td>
                                <a href="#" class="user-item btn-edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="user-delete btn-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `;
                });
                $('#users').html(template);
            }
        });
    }

    // Click event to open modal for editing user
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        const element = $(this).closest('tr');
        const id = $(element).attr('userID');
        $.post('crud/lietotaji-single.php', { id }, (response) => {
            const user = JSON.parse(response);
            $('#lietotajvards').val(user.lietotajvards);
            $('#vards').val(user.vards);
            $('#uzvards').val(user.uzvards);
            $('#epasts').val(user.epasts);
            $('#loma').val(user.loma);
            $('#statuss').val(user.statuss);
            $('#userID').val(user.id);
            edit = true;
            $("#userModal").css('display', 'flex');
        });
    });

    // Submit event to add or edit user
    $('#userForm').submit(e => {
        e.preventDefault();
        const postData = {
            lietotajvards: $('#lietotajvards').val(),
            vards: $('#vards').val(),
            uzvards: $('#uzvards').val(),
            epasts: $('#epasts').val(),
            parole: $('#parole').val(),
            loma: $('#loma').val(),
            statuss: $('#statuss').val(),
            id: $('#userID').val()
        };
        const url = edit === false ? 'crud/lietotaji-add.php' : 'crud/lietotaji-edit.php';
        $.post(url, postData, (response) => {
            $("#userForm").trigger('reset');
            fetchUsers();
            $("#userModal").hide();
            edit = false;
        });
    });

    // Click event to delete user
    $(document).on('click', '.btn-delete', function(e) {
        if (confirm('Vai tiešām vēlies dzēst šo ierakstu?')) {
            const element = $(this).closest('tr');
            const id = $(element).attr('userID');
            $.post('crud/lietotaji-delete.php', { id }, (response) => {
                fetchUsers();
            });
        }
    });

})});
