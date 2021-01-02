$( () => {
    $("#tabs").tabs()
    $(".h4").toggle(1000)

    $(".close").click(() => {
        $(".alert-dismissible").remove()
    })

    // show or hisde the password for login route
    $(".input-group-append").click(() => {
        $('input#password').attr("type") == 'password' ? $('input#password').attr("type", "text") : $('input#password').attr("type", "password")
        $('span#show-password').toggleClass("fa-eye-slash fa-eye")
    })

    // print all entities
    $('#print-all').click((event) =>{
        event.preventDefault()

        $("div#container").slideToggle("fast")

        setTimeout(() => {
            $("div#table").toggleClass("container col-sm-7 col-sm-10")
            $("div#table").prepend(
                `<div class="alert text-center print-title">
                    <h1><u>${$("div.titleCard").text()}</u></h1>
                </div>`
            )
            window.print()
            setTimeout(() => {
                $("div#table").toggleClass("container col-sm-7 col-sm-10")
                $("div#container").slideToggle("fast")
                $("div.print-title").remove()
            }, 250);
        }, 350);

    })

    $('#print-all-teacher').click( (event) =>{
        event.preventDefault()

        $("div#container-teacher").slideToggle("fast")

        setTimeout(() => {
            $("#col-sm-7-teacher").toggleClass("container col-sm-7 col-sm-10")
            $("#col-sm-7-teacher").prepend(
                `<div class="alert text-center print-title">
                    <h1><u>${$("#titleCardTeacher").text()}</u></h1>
                </div>`
            )
            window.print()
            setTimeout(() => {
                $("#col-sm-7-teacher").toggleClass("container col-sm-7 col-sm-10")
                $("div#container-teacher").slideToggle("fast")
                $("div.print-title").remove()
            }, 250);
        }, 350);
    })

    // print one entitie
    $('#print-one').click((event) =>{
        event.preventDefault()

        window.print()

    })

})

