$(() => {
    // const basePath = 'http://localhost:8000/course'
    
    let basePath = 'http://eschool225.herokuapp.com/course'

    $(".search-course").click((e) => {
        e.preventDefault()

        $.ajax({
            url: basePath + '/get-course',
            data: $("form").serialize(),
            method: 'GET',
            success: function (response) {
                $('tbody').empty();
                $('table').show()
                $('.no-found').remove();
                var tr = ''

                if (response.length) {

                    for (let i in response) {
                        tr += `<tr>
                                    <td> ${response[i].date}</td>
                                    <td> ${response[i].register}</td>
                                    <td> ${response[i].subject_code}</td>
                                    <td class='text-capitalize'> ${response[i].classroom_code}</td>
                                    <td> ${response[i].missing}</td>
                                    <td>
                                        <form action="${basePath}/${response[i].id}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                            <button class="btn btn-danger" type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>`;

                        $('tbody').append(tr).hide().fadeIn(200)
                    }
                } else {
                    tr = `<div class="alert alert-secondary m-5 text-center text-capitalize no-found">
                            Pas de données trouvées !
                        </div>`
                    $('table').hide()
                    $("table").after(tr);
                }

            }
        })
    })

})
