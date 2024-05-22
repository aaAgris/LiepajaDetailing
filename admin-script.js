$(document).ready(function(){
    //console.log("jQuery strādā!")
    let edit = false;
    fetchCenas()
    fetchDarbi()


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

})