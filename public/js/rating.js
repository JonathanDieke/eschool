$( () => {
    let firstchange = false

    //autocompletion by register of teacher field
    $('#register').autocomplete({
        source: function (request, cb) {
            $.ajax({
                url: 'http://localhost:8000/teacher/get-teacher/' + request.term, //request.term : elt recherche pour la completion
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
                    } else {
                        result = null
                    }

                    cb(result);
                }
            });
        },

        select: function (e, data) {
            if (data && data.item.data) {
                let d = data.item.data;

                $('#register').val(d.register);
                $('.register').remove()
                $('#register').after(`<span class="text-muted register"><i>(${d.fullname})</i></span>`);
            }
        },
    })

    //autocompletion by subject_code field
    $('#subject_code').autocomplete({

        source: function (request, cb) {
            $.ajax({
                url: 'http://localhost:8000/subject/get-subject/' + request.term, //request.term : elt recherche pour la completion
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
                    } else {
                        result = null
                    }

                    cb(result);
                }
            });
        },

        select: function (e, data) {

            if (data && data.item.data) {
                let d = data.item.data;
                $('#subject_code').val(d.code);
                $('.subject').remove()
                $('#subject_code').after(`<span class="text-muted subject"><i>(${d.libel})</i></span>`);
            }
        },
    })
    //autocompletion by classroom_code field
    $('#classroom_code').autocomplete({

        source: function (request, cb) {
            $.ajax({
                url: 'http://localhost:8000/classroom/get-classroom/' + request.term, //request.term : elt recherche pour la completion
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
                    }else{
                        result = null
                    }


                    cb(result);
                }
            });
        },

        select: function (e, data) {

            if (data && data.item.data) {
                let d = data.item.data;

                $('#classroom_code').val(d.classroom_id);
                $('.classroom').remove()
                $('#classroom_code').after(`<span class="text-muted classroom"><i>(${d.libel})</i></span>`);
            }
        },
    })


    $('#btn-rating').click((e) => {
        e.preventDefault()
        if ($("#register").val() && $("#classroom_code").val() && $("#subject_code").val()){

            const url = `http://localhost:8000/rating/${$("#register").val()}/${$("#classroom_code").val()}/${$("#subject_code").val()}`

            window.location.assign(url)
        }else{
            alert("Veuillez à saisir des valeurs valides en vous aidant de l'auto-complétion")
        }
    })

    $(".close").click(() => {
        $(".alert:not(.no-found)").remove()
    })


})
