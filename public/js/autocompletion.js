var basePath = 'http://localhost:8000/room/';

$('#code').autocomplete({
    source: function (request, cb) {
        $.ajax({
            url: basePath + request.term, //request.term : elt recherche pour la completion
            method: 'GET',
            dataType: 'json',
            success: function (res) { //res => resultat retouné par la requete ajax
                var result = [{
                    label: 'Pas de correspondance avec ' + request.term,
                    value: ''
                }];

                console.log(res);

                // if (res.length) {
                //     result = $.map(res, function (object) {
                //         return {
                //             label: object.id,
                //             value: object.id,
                //             data: object
                //         }
                //     });
                // }

                // cb(result);
            }
        });
    },
    select: function (e, data) {
        console.log(data)

        if (data && data.item.data) {
            var data = data.item.data;

            $('#id').val(data.id);
            $('#fullname').val(data.fullname);
            $('#prediction').val(data.prediction);
        }
    }
});
