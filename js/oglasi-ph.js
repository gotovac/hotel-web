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
                        if (k == 'Lokacija') {
                            lokacija.push(vr);
                        }
                    });

                });

                if (lokacija[i] == 4) {
                    $('#oglas4').append("<div onClick='klikanje(" + oglas_id[i] + ")' id='" + oglas_id[i] + "'><a href='" + veza[i] + "' target='_blank'><img src='" + slika[i] + "' width='" + sirina[i] + "' height='" + visina[i] + "'></a></div>");

                }

                if (lokacija[i] == 5) {
                    $('#oglas5').append("<div onClick='klikanje(" + oglas_id[i] + ")' id='" + oglas_id[i] + "'><a href='" + veza[i] + "' target='_blank'><img src='" + slika[i] + "' width='" + sirina[i] + "' height='" + visina[i] + "'></a></div>");

                }

                if (lokacija[i] == 6) {
                    $('#oglas6').append("<div onClick='klikanje(" + oglas_id[i] + ")' id='" + oglas_id[i] + "'><a href='" + veza[i] + "' target='_blank'><img src='" + slika[i] + "' width='" + sirina[i] + "' height='" + visina[i] + "'></a></div>");

                }
                
                if($("#oglas4 > div").length < 1){
                    if(oglas_id[i] == 4){
                        $('#kupiOglas4').html("Kupite oglas po cijeni: " + cijena[i] + "");
                    }
                }
                
                if($("#oglas5 > div").length < 1){
                    if(oglas_id[i] == 5){
                        $('#kupiOglas5').html("Kupite oglas po cijeni: " + cijena[i] + "");
                    }
                }
                
                if($("#oglas6 > div").length < 1){
                    if(oglas_id[i] == 6){
                        $('#kupiOglas6').html("Kupite oglas po cijeni: " + cijena[i] + "");
                    }
                }

            }
        }
    });

    if ($("#oglas4 > div").length > 1) {
        $("#oglas4 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas4 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas4');
        }, 5000);
    }

    if ($("#oglas5 > div").length > 1) {
        $("#oglas5 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas5 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas5');
        }, 7000);
    }

    if ($("#oglas6 > div").length > 1) {
        $("#oglas6 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas6 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas6');
        }, 9000);
    }
});
