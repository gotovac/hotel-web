$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "load-oglase.php",
        async: false,
        success: function (podaci) {

            for (var i = 0; i < podaci.length; i++) {

                var oglas_id = [];
                var veza = [];
                var slika = [];
                var sirina = [];
                var visina = [];
                var lokacija = [];

                $.each(podaci, function (row, rowdata) {
                    $.each(rowdata, function (k, vr) {
                        if (k === 'oglas_id') {
                            oglas_id.push(vr);
                        }
                        if (k === 'url') {
                            veza.push(vr);
                        }
                        if (k === 'slika_url') {
                            slika.push(vr);
                        }
                        if (k === 'Sirina') {
                            sirina.push(vr);
                        }
                        if (k === 'Visina') {
                            visina.push(vr);
                        }
                        if (k === 'Lokacija') {
                            lokacija.push(vr);
                        }
                    });

                });

                if (lokacija[i] == 7) {
                    $('#oglas7').append("<div onClick='klikanje(" + oglas_id[i] + ")' id='" + oglas_id[i] + "'><a href='" + veza[i] + "' target='_blank'><img src='" + slika[i] + "' width='" + sirina[i] + "' height='" + visina[i] + "'></a></div>");
                }
                
                if($("#oglas7 > div").length < 1){
                    if(oglas_id[i] == 7){
                        $('#kupiOglas7').html("Kupite oglas po cijeni: " + cijena[i] + "");
                    }
                }
            }
        }
    });

    // Izmjena

    if ($("#oglas7 > div").length > 1) {
        $("#oglas7 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas7 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas7');
        }, 5000);
    }


});
