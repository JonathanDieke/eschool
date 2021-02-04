$(document).ready(function () {

    // let basePath = 'http://localhost:8000/category'
    
    let basePath = 'http://eschool225.herokuapp.com/category'

    //Ajax request for register and update data
    function ajaxRequest(event, method, url) {

        console.log(url);


        event.preventDefault()
        $('#delete-form').remove()

        $.ajax({
            method: method,
            data: $('form').serialize(),
            url: url,
            success: (response) => {
                window.location.assign(window.location.pathname)
            },
            error: (err) => {
                if (!err.responseJSON.exception) {

                    let errors = err.responseJSON.errors
                    $('ul.list-group').empty()

                    for (let i in errors) {
                        let li = "<li style='color:red; font-size:12px' class='list-group-item'>" + errors[i][0] + "</li>"
                        $('ul.list-group').append(li)
                    }
                } else {
                    alert('Veuillez saisir un matricule existant')
                }

            }
        })

    }

     //function to display categories
    function showCategory(delay = 1000) {

        $.get(basePath, function (response) {
            $('tbody').empty()
            let tr = ""
            for (var i in response) {
                tr += "<tr>  <td> <div class='form-group form-check'> <input type='checkbox' class='form-check-input' value=" + response[i].id + "> <label class='form-check-label'>" + response[i].id + "</label> </div></td>  <td class='text-uppercase'>" + response[i].code + "</td> <td class='text-capitalize'>" + response[i].libel + "</td>   </tr>";
            }

            $('tbody').hide().append(tr).fadeIn(delay);
        });
    }

    // submit formulaire TO REGISTER data
    $('.btn-success').click(function (event) {

        ajaxRequest(event, 'post', basePath)

    })

    // submit formulaire TO UPDATE data
    $('.btn-warning:not(#btn-edit-teacher)').click(function (e) {

        ajaxRequest(event, 'patch', `${basepath}\${$("#code").val() ? $("#code").val() : "Error"}`)

    })

    //Display table with list of data
    $('.btn-info:not(#btn-hide-teacher)').click((e) => {
        e.preventDefault()

        $('.col-sm-7').toggleClass("d-none")
        $('.btn-info').text() === 'Lister' ? $('.btn-info').text('Cacher') : $('.btn-info').text('Lister')
        $("div#container").toggleClass("col-sm-8 container col-sm-5")
    })

    //delete data by get their id
    $('.btn-danger:not(#btn-delete-teacher)').click((e) => {
        e.preventDefault()

        if ($('#tabs-2 input.form-check-input:checked').length) {

            if (confirm(" Etes vous sûrs de vouloir retirer " + ($('#tabs-2 input.form-check-input:checked').length > 1 ? 'ces catégories' : 'cette catégorie') + " ? "))
                drop('#tabs-2 input.form-check-input:checked', basePath)
            else
                alert('Suppression annulée')

        } else {
            alert('Veuillez au préalable sélectionner au moins une catégorie !')
        }

    })

    //autocompletion by register field
    $('#code').autocomplete({
        source: function (request, cb) {
            $.ajax({
                url: basePath + '/get-category/' + request.term, //request.term : elt recherche pour la completion
                method: 'GET',
                dataType: 'json',
                success: function (res) { //res => resultat retouné par la requete ajax
                    let result = [{
                        label: 'Pas de correspondance trouvée avec ' + request.term,
                        value: ''
                    }];

                    if (res.length) {
                        result = $.map(res, function (object) {
                            return {
                                label: object.code,
                                value: object.code,
                                data: object
                            }
                        });
                    }

                    cb(result);
                }
            });
        },

        select: function (e, data) {
            if (data && data.item.data) {
                let d = data.item.data;

                $('#code').val(d.code);
                $('#libel').val(d.libel);
            }
        },
    })

    //empty all input into form
    $(".btn-secondary:not(#btn-empty-teacher)").click(e => {
        e.preventDefault()
        $("#tabs-2 input").val('')
        $('#tabs-2 input').change()
    })

    //delete errors when input change
    $('#tabs-2 input').change(() => {
        $('ul.list-group:not(#errors-teacher)').empty()
    })

    showCategory(700);
})
