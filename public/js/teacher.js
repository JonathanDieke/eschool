$('a[href="#tabs-1"]').click(function () {
    $('#tabs-2 tbody').fadeOut(100);
    $('#tabs-1 tbody').fadeIn(500);
});

$('a[href="#tabs-2"]').click(function () {
    $('#tabs-1 tbody').fadeOut(100);
    $('#tabs-2 tbody').fadeIn(500);
});

$( () => {

    // let basePathTeacher = 'http://localhost:8000/teacher'
    // let basePathCategory = 'http://localhost:8000/category'
    
    let basePathTeacher = 'http://eschool225.herokuapp.com/teacher'
    let basePathCategory = 'http://eschool225.herokuapp.com/category'

    //Ajax request for register and update data
    function createOrUpdateAjaxRequest(event, method, url, formSelector, errorSelector) {

        event.preventDefault()

        $.ajax({
            method: method,
            data: $(formSelector).serialize(),
            url: url,
            success: (response) => {
                window.location.assign(window.location.pathname)
            },
            error: (err) => {
                if (!err.responseJSON.exception) {

                    let errors = err.responseJSON.errors
                    $(errorSelector).empty()

                    for (let i in errors) {
                        let li = "<li style='color:red; font-size:12px' class='list-group-item'>" + errors[i][0] + "</li>"
                        $(errorSelector).append(li)
                    }
                } else {
                    alert('Veuillez reé-essayr avec des entrées valides !')
                    setTimeout(() => {
                        window.location.assign(window.location.pathname)
                    }, 5000);
                }

            }
        })

    }

    // Ajax request for delete data
    function drop(selector, url) {
        let id = ""
        $(selector).each((el) => {
            id += $(selector)[el].value + ','
        })

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'delete',
            url: url + '/drop/' + id,
            sync: false,
            success: (response) => {
                showTeacher(500)
                showCategory(500)
                alert(response)
            },
            error: (err) => {
                console.log(err)
            }
        })

    }




    /* S C R I P T S      F O R      T E A C H E R           S C R I P T S      F O R      T E A C H E R                 S C R I P T S      F O R      T E A C H E R */


    function showTeacher(delay=1000) {

        $.get(basePathTeacher, function (response) {
            $('#tbodyTeacher').empty()
            let tr = ""

            for (var i in response) {
                tr += `<tr>
                            <td>
                                <div class='form-group form-check'>
                                    <input type='checkbox' class='form-check-input' value="${response[i].id}">
                                    <label class='form-check-label'>${response[i].id}</label>
                                </div>
                            </td>
                            <td class='text-uppercase'> <a href="${basePathTeacher}/${response[i].register}"> ${response[i].register} </a></td>
                            <td>${response[i].category_id}</td>
                            <td>${response[i].subject_id}</td>
                            <td>${response[i].fullname}</td>
                            <td>${response[i].email}</td>
                        </tr>`;
            }
            $('#tbodyTeacher').hide().append(tr).fadeIn(delay);
        });
    }

    // submit formulaire TO REGISTER data
    $('#btn-save-teacher').click(function (e) {

        createOrUpdateAjaxRequest(e, 'post', basePathTeacher, '#save-form-teacher', "#errors-teacher")

    })

    // submit formulaire TO UPDATE data
    $('#btn-edit-teacher').click(function (e) {

        createOrUpdateAjaxRequest(e, 'patch', (basePathTeacher + '/' + ($('#register').val() ? $('#register').val() : 'error')), '#save-form-teacher', '#errors-teacher')

    })

    //delete data by get their id
    $('#btn-delete-teacher').click((e) => {
        e.preventDefault()

        if ($('#tabs-1 input.form-check-input:checked').length) {

            if (confirm(" Etes vous sûrs de vouloir retirer " + ($('#tabs-1 input.form-check-input:checked').length > 1 ? 'ces professeurs' : 'ce professeur') + " ? "))
                drop('#tabs-1 input.form-check-input:checked', basePathTeacher)
            else
                alert('Suppression annulée')

        } else {
            alert('Veuillez au préalable sélectionner au moins un professeur !')
        }

    })

    //autocompletion by register field
    $('#register').autocomplete({
        source: function (request, cb) {
            $.ajax({
                url: basePathTeacher + '/get-teacher/' + request.term, //request.term : elt recherche pour la completion
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
                $('#register').val(d.register);
                $('#category_id').val(d.category_id);
                $('#subject_id').val(d.subject_id);
                $('#fullname').val(d.fullname);
                $('#email').val(d.email);
                $('#birthday').val(d.birthday);
                $('#birthplace').val(d.birthplace);
            }
        },
    })

    //Display table with list of data
    $('#btn-hide-teacher').click((e) => {
        e.preventDefault()

        $('#col-sm-7-teacher').toggleClass("d-none")
        $('#btn-hide-teacher').text() === 'Lister' ? $('#btn-hide-teacher').text('Cacher') : $('#btn-hide-teacher').text('Lister')
        $("div#container-teacher").toggleClass("col-sm-8 container col-sm-5")
    })

    //delete errors when input change
    $('#tabs-1 input').change(() => {
        $('#errors-teacher').empty()
    })

    // change subject select for match with category select
    $("#category_id").change( () => {

        $.get( (basePathCategory+ '/get-category/' +$("#category_id").val() ), function (response) {
            let option = ""

            for (var i in response) {
                option += "<option value=" +response[i].id+ ">" +response[i].libel+ "</option>"
            }
            $("#tabs-1 #subject_id").empty()
            $("#tabs-1 #subject_id").append(option)

        });
    })

    showTeacher(700);




    /* S C R I P T S      F O R      C A T E G O R Y            S C R I P T S      F O R      C A T E G O R Y           S C R I P T S      F O R      C A T E G O R Y */


    //function to display categories
    function showCategory(delay = 1000) {

        $.get(basePathCategory, function (response) {
            $('#tbodyCategory').empty()
            let tr = ""
            for (var i in response) {
                tr += "<tr>  <td> <div class='form-group form-check'> <input type='checkbox' class='form-check-input' value=" + response[i].id + "> <label class='form-check-label'>" + response[i].id + "</label> </div></td>  <td class='text-uppercase'>" + response[i].code + "</td> <td class='text-capitalize'>" + response[i].libel + "</td>   </tr>";
            }

            $('#tbodyCategory').hide().append(tr).fadeIn(delay);
        });
    }

    // submit formulaire TO REGISTER data
    $('.btn-outline-success:not(#btn-save-teacher)').click(function (e) {

        createOrUpdateAjaxRequest(e, 'post', basePathCategory, "#save-form", 'ul.list-group:not(#errors-teacher)')

    })

    // submit formulaire TO UPDATE data
    $('.btn-outline-warning:not(#btn-edit-teacher)').click(function (e) {

        createOrUpdateAjaxRequest(e, 'patch', (basePathCategory + '/' + ($('#code').val() ? $('#code').val() : 'error')), "#save-form", 'ul.list-group:not(#errors-teacher)')

    })

    //Display table with list of data
    $('.btn-outline-info:not(#btn-hide-teacher)').click((e) => {
        e.preventDefault()

        $(".col-sm-7:not('.input')").toggleClass("d-none")
        $('.btn-outline-info').text() === 'Lister' ? $('.btn-outline-info').text('Cacher') : $('.btn-outline-info').text('Lister')
        $("div#container").toggleClass("col-sm-8 container col-sm-5")
    })

    //delete data by get their id
    $('.btn-outline-danger:not(#btn-delete-teacher)').click((e) => {
        e.preventDefault()

        if ($('#tabs-2 input.form-check-input:checked').length) {

            if (confirm(" Etes vous sûrs de vouloir retirer " + ($('#tabs-2 input.form-check-input:checked').length > 1 ? 'ces catégories' : 'cette catégorie') + " ? "))
                drop('#tabs-2 input.form-check-input:checked', basePathCategory)
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
                url: basePathCategory + '/get-category/' + request.term, //request.term : elt recherche pour la completion
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
    $(".btn-outline-secondary:not(#btn-empty-teacher)").click(e => {
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
