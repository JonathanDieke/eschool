$(document).ready(function () {

    // let basePath = 'http://localhost:8000/student'
    let basePath = 'http://eschool225.herokuapp.com/student'

    //function to display students by their classroom
    function show(classroom_id, delay=1000) {
        $.get(basePath +'/show-students/'+ classroom_id, function (response) {
            $('tbody').empty();
            var tr =''
            
            for (var i in response) {
                tr += `<tr>
                            <td>
                                <div class='form-group form-check'>
                                    <input type='checkbox' class='form-check-input' value="${response[i].id}">
                                    <label class='form-check-label'>${response[i].id}</label>
                                </div>
                            </td>
                            <td class='text-uppercase'> <a href="${basePath}/${response[i].register}"> ${response[i].register} </a></td>
                            <td>${response[i].classroom_id}</td>
                            <td class='text-capitalize'>${response[i].fullname}</td>
                            <td class='text-capitalize'>${response[i].birthday}</td>
                        </tr>`
                ;
            }

            $('tbody').append(tr).hide().fadeIn(delay)

        })
    }

    //Ajax request for register and update data
    function ajaxRequest(event, method, url) {

        event.preventDefault()
        $('#delete-form').remove()

        $.ajax({
            method: method,
            data: $('form').serialize()+"&avatar="+$('#avatar').val(),
            url: url,
            success: (response) => {
                window.location.assign(window.location.pathname)
            },
            error: (err) => {

                if(err.abort){
                    alert('Jeton de session manquant. Veuillez actualiser la page !')
                }else if (!err.responseJSON.exception) {

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

    //autocompletion by register field
    $('#register').autocomplete({

        source: function (request, cb) {
            $.ajax({
                url: basePath +'/get-student/'+ request.term, //request.term : elt recherche pour la completion
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
                                label: object.register,
                                value: object.register,
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

                show(d.classroom_id, 800)

                $('#classroom_id').val(d.classroom_id);
                $('#fullname').val(d.fullname);
                $('#birthday').val(d.birthday);
                $('#birthplace').val(d.birthplace);
            }
        },
    })

    // submit formulaire TO UPDATE data
    $('.btn-outline-warning').click(function (e) {
        e.preventDefault()
        ajaxRequest(e, 'patch', (basePath + '/' + ($('#register').val() ? $('#register').val() : 'error')))

    })

    //Display table with list of data
    $('.btn-outline-info').click((e) => {
        e.preventDefault()

        $(".col-sm-7:not('.input')").toggleClass("d-none")
        $('.btn-outline-info').text() === 'Lister' ? $('.btn-outline-info').text('Cacher') : $('.btn-outline-info').text('Lister')
        $("div#container").toggleClass("col-sm-8 container col-sm-5")
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
            url: basePath + '/drop/' +id,
            sync: true,
            success: (response) => {
                show(1)
                alert(response)
            },
            error: (err) => {
                console.log(err)
            }
        })

    })

    //delete data by get their id
    $('.btn-outline-danger').click((e) => {
        e.preventDefault()

        if ($(':input.form-check-input:checked').length) {

            if (confirm(" Etes vous sûrs de vouloir retirer " + ($(':input.form-check-input:checked').length > 1 ? 'ces élèves' : 'cet élève') + " ? ")) {

                $('#delete-form').submit()

            } else {
                alert('Suppression annulée')
            }

        } else {
            alert('Veuillez au préalable sélectionner au moins un élève !')
        }

    })

    //empty all input into form
    $(".btn-outline-secondary").click(e => {
        e.preventDefault()
        $(":input:not(#classroom_id)").val('')
    })

    //delete errors when input change
    $(':input').change(() => {
        $('ul.list-group').empty()
    })

    $("#classroom_id").change(() => {
        show($("#classroom_id").val())
    })

    $("#print").click( (e) => {
        e.preventDefault()
    })

    show(1)
})
