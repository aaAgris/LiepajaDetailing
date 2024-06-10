
$(document).ready(function(){
    //console.log("jQuery strādā!")
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


    function fetchCenas(){
        $.ajax({
            url: 'crud/cenas-list.php',
            type: 'GET',
            success: function(response){
                const cenas = JSON.parse(response)
                let template = ''
                cenas.forEach(cenas =>{
                    template += `
                        <tr cenasID ="${cenas.id}">
                            <td>${cenas.id}</td>
                            <td>${cenas.darbs}</td>
                            <td>${cenas.apraksts}</td>
                            <td>${cenas.cena1}</td>
                            <td>${cenas.cena2}</td>
                            <td>${cenas.statuss}</td>
                            <td>
                                <a href="#" class="pieteikums-item btn-edit"><i class="fa fa-edit"></i></a> 
                                <a href="#" class="pieteikums-delete btn-delete"><i class="fa fa-trash"></i></a> 
                            </td>
                        </tr>
                    `
                })

                $('#cenas').html(template)
            }
        })
    }

    function fetchDarbi(){
        $.ajax({
            url: 'crud/darbi-list.php',
            type: 'GET',
            success: function(response){
                const darbi = JSON.parse(response)
                let template = ''
                darbi.forEach(darbi =>{
                    template += `
                        <tr darbaID ="${darbi.id}">
                            <td>${darbi.id}</td>
                            <td>${darbi.darbs}</td>
                            <td>${darbi.apraksts}</td>
                            <td>${darbi.attels}</td>
                            <td>${darbi.statuss}</td>
                            <td>${darbi.tips}</td>
                            <td>
                                <a href="#" class="darbi-item btn-edit"><i class="fa fa-edit"></i></a> 
                                <a href="#" class="darbi-delete btn-delete"><i class="fa fa-trash"></i></a> 
                            </td>
                        </tr>
                    `
                })

                $('#darbi').html(template)
            }
        })
    }

    $(document).on('click', '.darbi-item', (e) => {
        $(".modal").css('display','flex')
        const element = $(this)[0].activeElement.parentElement.parentElement
        console.log(element)
        const id = $(element).attr('darbaID')
        $.post('crud/darbi-single.php', {id}, (response) =>{
            const darbs = JSON.parse(response)
            $('#darbs1').val(darbs.nosaukums)
            $('#apraksts').val(darbs.apraksts)
            $('#attels').val(darbs.attels)
            $('#statuss').val(darbs.statuss)
            $('#tips').val(darbs.tips)
            $('#darbiID').val(darbs.id)
            edit = true
        })
        e.preventDefault()
    })

    $('#darbuForma').submit(e =>{
        e.preventDefault()
        const postData = {
            nosaukums: $('#darbs1').val(),
            apraksts: $('#apraksts').val(),
            attels: $('#attels').val(),
            statuss: $('#statuss').val(),
            tips: $('#tips').val(),
            id: $('#darbiID').val()
        }
        const url = edit === false ? 'crud/darbi-add.php' : 'crud/darbi-edit.php'
        console.log(postData, url)
        $.post(url, postData, (response) =>{
            $("#darbuForma").trigger('reset')
            console.log(response)
            fetchDarbi()
            $(".modal").hide()
            edit = false
        })
    })

    $(document).on('click', '.darbi-delete', (e) => {
        if(confirm('Vai tiešām vēlies dzēst šo ierakstu?')){
            const element = $(this)[0].activeElement.parentElement.parentElement
            //console.log(element)
            const id = $(element).attr('darbaID')
            console.log(id)
            $.post('crud/darbi-delete.php', {id}, (response) =>{
                console.log(response)
                fetchDarbi()
            })
        }
    })


    
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
            const price = prompt('Enter price:');
            if (price !== null && price.trim() !== '') {
                generateBill(pieteikumiID, price);
            } else {
                alert('Price must be provided.');
            }
        });
    
        // Function to generate and send bill
        function generateBill(pieteikumiID, price) {
            // Send data to server (assuming using AJAX to PHP)
            $.post('crud/generate-bill.php', { pieteikumiID, price }, function(response) {
                // Assuming the server sends back a file path or success message
                if (response.startsWith('Error')) {
                    alert(response);
                } else {
                    sendEmail(response); // Call function to send email with the generated file path
                }
            });
        }
    
        // Function to send email with the generated bill
        function sendEmail(filePath) {
            $.ajax({
                url: 'crud/send-email.php',
                type: 'POST',
                data: { filePath },
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
            $('#bildes').val(pieteikums.bildes); // This assumes bildes field can accept a value. Adjust if it's a file input.
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
                console.log(response);
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

            // Handle click on cv-bill button
            $('.cv-bill').click(function(e) {
                e.preventDefault();
                const cvID = $(this).attr('data-cv-id');
                $('#billModal').attr('data-cv-id', cvID);
                $('.modal').css('display', 'flex');
            });
        }
    });
}

    $(document).ready(function() {

    
        $('#newCV').click(function() {
            edit = false;
            $("#cvForma").trigger('reset');
            $(".modal").css('display', 'flex');
        });
    
        $(document).on('click', '.cv-item', function(e) {
            $(".modal").css('display', 'flex');
            const element = $(e.currentTarget).closest('tr');
            const id = $(element).attr('cvID');
            $.post('crud/cv-single.php', { id }, (response) => {
                const cv = JSON.parse(response);
                $('#vards').val(cv.vards);
                $('#uzvards').val(cv.uzvards);
                $('#epasts').val(cv.epasts);
                $('#talrunis').val(cv.talrunis);
                $('#datums').val(cv.datums);
                $('#statuss').val(cv.statuss); // Populate statuss field
                $('#cvID').val(cv.id);
                edit = true;
            });
            e.preventDefault();
        });
    
        $('#cvForma').submit(e => {
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
            const url = edit === false ? 'crud/cv-add.php' : 'crud/cv-edit.php';
            $.post(url, postData, (response) => {
                $("#cvForma").trigger('reset'); 
                fetchCVs();
                $(".modal").hide();
                edit = false;
            });
        });
    
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

    $(document).ready(function() {
        fetchCVs();
    
        // Handle click on "Bill" button
        $('.btn-bill').click(function() {
            const cvID = $(this).attr('data-cv-id');
            $('#billModal').attr('data-cv-id', cvID); // Set cvID in modal
    
            // Show modal
            $('.modal').show();
        });
    
        // Handle form submission
        $('#billForm').submit(function(e) {
            e.preventDefault();
            const cvID = $('#billModal').attr('data-cv-id');
            const action = $('#actionSelect').val();
    
            // Send data to server
            $.post('crud/cv-bill.php', { cvID, action }, function(response) {
                console.log(response); // Debugging purposes
                fetchCVs();
                $('.modal').hide();
            });
        });
    });
    
    