
$(document).ready(function(){
    //console.log("jQuery strādā!")
    let edit = false;
    fetchCenas()
    fetchDarbi()
    fetchPieteikumi()


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

    function fetchPieteikumi() {
        $.ajax({
            url: 'crud/pieteikumi-list.php',
            type: 'GET',
            success: function(response) {
                const pieteikumi = JSON.parse(response);
                let template = '';
                pieteikumi.forEach(pieteikums => {
                    template += `
                        <tr pieteikumiID="${pieteikums.id}">
                            <td>${pieteikums.id}</td>
                            <td>${pieteikums.vards}</td>
                            <td>${pieteikums.uzvards}</td>
                            <td>${pieteikums.epasts}</td>
                            <td>${pieteikums.talrunis}</td>
                            <td>${pieteikums.komentari}</td>
                            <td>${pieteikums.auto_tiriba}</td>
                            <td>${pieteikums.bildes}</td>
                            <td>${pieteikums.tags}</td>
                            <td>${pieteikums.datums}</td>
                            <td>${pieteikums.laiks}</td>
                            <td>
                                <a href="#" class="pieteikumi-item btn-edit"><i class="fa fa-edit"></i></a> 
                                <a href="#" class="pieteikumi-delete btn-delete"><i class="fa fa-trash"></i></a> 
                                <a href="#" class="pieteikumi-bill btn-bill"><i class="fa fa-check"></i></a> 
                            </td>
                        </tr>
                    `;
                });
    
                $('#pieteikumi').html(template);
            }
        });
    }
    
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

})


