$(document).ready(function() {

    // var basePath = 'http://localhost:8000/classroom'
    
    let basePath = 'http://eschool225.herokuapp.com/classroom'

    // function to show data from database
    function show(delay=1000) {

        $.get(basePath, function (response) {
            $('tbody').empty();

            for (var i in response) {
                var tr = "<tr>   <td> <div class='form-group form-check'> <input type='checkbox' class='form-check-input' value=" + response[i].id + "> <label class='form-check-label'>" + response[i].id + "</label> </div></td> <td>" + response[i].room_id + "</td> <td>" + response[i].code + "</td>  <td>" + response[i].libel + "</td>  </tr>";

                $('tbody').append(tr).hide()
            }

            $('tbody').fadeIn(delay)
        });
    }

    //Ajax request for register and update data
    function ajaxRequest(event, method, url) {

        event.preventDefault()
        $('#delete-form').remove()

        $.ajax({
            method: method,
            data: $('form').serialize(),
            url: url,
            success: (response) => {
                // window.location.assign(window.location.pathname)
                alert('Enregistrement réussi')
                show(500)
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
                    alert('Veuillez saisir un code de classe existant')
                }

            }
        })

    }

    // submit formulaire TO REGISTER a new student
    $('.btn-outline-success').click(function (e) {

        ajaxRequest(e, 'post', basePath)

    })

    // submit formulaire TO UPDATE a student
    $('.btn-outline-warning').click(function (e) {

        ajaxRequest(e, 'patch', (basePath + '/' + ($('#code').val() ? $('#code').val() : 'error')))

    })

    // submit formulaire TO DELETE student(s)
    $('#delete-form').submit(function (e) {
        e.preventDefault()

        let id = ""
        $(':input.form-check-input:checked').each((el) => {
            id += $(":input.form-check-input:checked")[el].value + ','
        })

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'delete',
            url: basePath + '/drop/' + id,
            sync: true,
            success: (response) => {
                show(500)
                alert(response)
            },
            error: (err) => {
                console.log(err)
            }
        })

    })

    //autocompletion by register field
    $('#code').autocomplete({

        source: function (request, cb) {
            $.ajax({
                url: basePath + '/get-classroom/' + request.term, //request.term : elt recherche pour la completion
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

                $('#sroom_id').val(d.sroom_id);
                $('#code').val(d.code);
                $('#libel').val(d.libel);
            }
        },
    })

    //Display table with list of students
    $('.btn-outline-info').click((e) => {
        e.preventDefault()

        $(".col-sm-7:not('.input')").toggleClass("d-none")
        $('.btn-outline-info').text() === 'Lister' ? $('.btn-outline-info').text('Cacher') : $('.btn-outline-info').text('Lister')
        $("div#container").toggleClass("col-sm-8 container col-sm-5")
    })

    //delete student by get their id
    $('.btn-outline-danger').click((e) => {
        e.preventDefault()

        if ($(':input.form-check-input:checked').length) {

            if (confirm(" Etes vous sûrs de vouloir retirer " + ($(':input.form-check-input:checked').length > 1 ? 'ces classes' : 'cette classe') + " ? ")) {

                $('#delete-form').submit()

            } else {
                alert('Suppression annulée')
            }

        } else {
            alert('Veuillez au préalable sélectionner au moins une classe !')
        }

    })

    $(':input').change(() => {
        $('ul.list-group').empty()
    })

    //show data from database
    show(500);
})
