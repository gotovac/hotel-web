$(document).ready(function () {
    
    $.ajax({
        type: "GET",
        url: "load-oglase.php",
        async: false,
        success: function (podaci) {
            

            for (var index = 0; index < podaci.length; index++) {

                var oglas_id = [];
                var veza = [];
                var slika = [];
                var sirina = [];
                var visina = [];
                var lokacija = [];
                var cijena = [];

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
                        if (k == 'Cijena'){
                            cijena.push(vr);
                        }

                    });
                });

                if (lokacija[index] == 1) {
                    $('#oglas1').append("<div onClick='klikanje(" + oglas_id[index] + ")' id='" + oglas_id[index] + "'><a href='" + veza[index] + "' target='_blank'><img src='" + slika[index] + "' width='" + sirina[index] + "' height='" + visina[index] + "'></a></div>");
                    $('#kupiOglas1').hide();

                }

                if (lokacija[index] == 2) {
                    $('#oglas2').append("<div onClick='klikanje(" + oglas_id[index] + ")' id='" + oglas_id[index] + "'><a href='" + veza[index] + "' target='_blank'><img src='" + slika[index] + "' width='" + sirina[index] + "' height='" + visina[index] + "'></a></div>");
                    $('#kupiOglas2').hide();

                }

                if (lokacija[index] == 3) {
                    $('#oglas3').append("<div onClick='klikanje(" + oglas_id[index] + ")' id='" + oglas_id[index] + "'><a href='" + veza[index] + "' target='_blank'><img src='" + slika[index] + "' width='" + sirina[index] + "' height='" + visina[index] + "'></a></div>");
                    $('#kupiOglas3').hide();

                }
                
                if($("#oglas1 > div").length < 1){
                    if(oglas_id[index] == 1){
                        $('#kupiOglas1').html("Kupite oglas po cijeni: " + cijena[index] + "");
                    }
                }
                
                if($("#oglas2 > div").length < 1){
                    if(oglas_id[index] == 2){
                        $('#kupiOglas2').html("Kupite oglas po cijeni: " + cijena[index] + "");
                    }
                }
                
                if($("#oglas3 > div").length < 1){
                    if(oglas_id[index] == 3){
                        $('#kupiOglas3').html("Kupite oglas po cijeni: " + cijena[index] + "");
                    }
                }


            }
        }
    });
    
    if($("#oglas1 > div").length > 1){
        $("#oglas1 > div:gt(0)").hide();

        setInterval(function () {
            $('#oglas1 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas1');
        }, 5000);
    }

    if($("#oglas2 > div").length > 1){
        $("#oglas2 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas2 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas2');
        }, 7000);
    }

    if($("#oglas3 > div").length > 1){
        $("#oglas3 > div:gt(0)").hide();
        setInterval(function () {
            $('#oglas3 > div:first')
                .fadeOut(1)
                .next()
                .fadeIn(1)
                .end()
                .appendTo('#oglas3');
        }, 9000);
    }
});
