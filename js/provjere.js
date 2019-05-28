$(document).ready(function (){
    
    
    $('#rkorime').keyup(function(){
        var korisnik = $('#rkorime').val();
        var response = '';
        
        $.ajax({
            type: "GET",
            url: "provjera_korime.php",
            async: false,
            success: function (text) {
                response = text;
            }
        });
        
        if (response.indexOf(korisnik) >= 0) {
            $("#rsumbit").attr("disabled", true);
            $('#rkorime').css("outline", "none");
            $('#rkorime').css("borderColor", "#F37E6C");
            $('#rkorime').css("boxShadow", "0 0 5px #F37E6C");
            $('#errKorime').text('Korisnik sa tim korisničkim imenom već postoji!');
            console.log('Korisnik vec postoji!');
        }
        
        else if (korisnik.indexOf("!") >= 0 || korisnik.indexOf("@") >= 0 || korisnik.indexOf("#") >= 0 || korisnik.indexOf("$") >= 0 || korisnik.indexOf("%") >= 0 || korisnik.indexOf("&") >= 0){
            $('#rkorime').css("outline", "none");
            $('#rkorime').css("borderColor", "#F37E6C");
            $('#rkorime').css("boxShadow", "0 0 5px #F37E6C");   
            $('#errKorime').text("Korisnicko ime sadrzi nedozvoljeni znak!");
            $("#rsumbit").attr("disabled", true);
        }
        
        else {
            $("#rsumbit").attr("disabled", false);
            $('#rkorime').css("outline", "none");
            $('#rkorime').css("borderColor", "#6CF372");
            $('#rkorime').css("boxShadow", "0 0 5px #6CF372"); 
            $('#errKorime').text('Korisnicko ime je slobodno!');
            console.log('Korisnicko ime je slobodno!');
        }
            
    });
    
    
    $('#remail').keyup(function(){
        var mail = $('#remail').val();
        var regMail = new RegExp(/^[^\.][a-zA-Z0-9]{0,}[\.]{0,1}[a-zA-Z0-9]{0,}@[a-zA-Z0-9]{0,}[\.]{1}[a-zA-Z0-9]{2,}/);
        var mailValid = regMail.test(mail);
        
        if (!mailValid){
            $('#remail').css("outline", "none");
            $('#remail').css("borderColor", "#F37E6C");
            $('#remail').css("boxShadow", "0 0 5px #F37E6C"); 
            $('#errEmail').text("E-mail je nepravilno strukturiran!");
            $("#rsumbit").attr("disabled", true);
        }
        else {
            $('#remail').css("outline", "none");
            $('#remail').css("borderColor", "#6CF372");
            $('#remail').css("boxShadow", "0 0 5px #6CF372");
            $('#errEmail').text("");
            $("#rsumbit").attr("disabled", false);
        }
    });
    
    
    $('#rlozinka1').keyup(function(){
        var loz1 = $('#rlozinka1').val();
        if (loz1.length < 3 || loz1.length > 20){
            $('#rlozinka1').css("outline", "none");
            $('#rlozinka1').css("borderColor", "#F37E6C");
            $('#rlozinka1').css("boxShadow", "0 0 5px #F37E6C");   
            $('#errLozinka1').text("Lozinka mora sadrzavati vise od 2 i manje od 20 znakova!");
            $("#rsumbit").attr("disabled", true);
        }
        else {
            $('#rlozinka1').css("outline", "none");
            $('#rlozinka1').css("borderColor", "#6CF372");
            $('#rlozinka1').css("boxShadow", "0 0 5px #6CF372"); 
            $('#errLozinka1').text("");
            $("#rsumbit").attr("disabled", false);
        }
    });
    
    
    $('#rlozinka2').keyup(function(){
        var loz1 = $('#rlozinka1').val();
        var loz2 = $('#rlozinka2').val();
        if (loz2 !== loz1){
            $('#rlozinka2').css("outline", "none");
            $('#rlozinka2').css("borderColor", "#F37E6C");
            $('#rlozinka2').css("boxShadow", "0 0 5px #F37E6C");   
            $('#errLozinka2').text("Lozinka unesena u potvrdu lozinke nije jednaka orginalnoj lozinci!");
            $("#rsumbit").attr("disabled", true);
        }
        else {
            $('#rlozinka2').css("outline", "none");
            $('#rlozinka2').css("borderColor", "#6CF372");
            $('#rlozinka2').css("boxShadow", "0 0 5px #6CF372"); 
            $('#errLozinka2').text("");
            $("#rsumbit").attr("disabled", false);
        }
    });
    
    
    $('#rime').keyup(function() {
        var ime = $('#rime').val();
        if (ime === ""){
            $('#rime').css("outline", "none");
            $('#rime').css("borderColor", "#F37E6C");
            $('#rime').css("boxShadow", "0 0 5px #F37E6C");   
            $('#errIme').text("Niste unijeli ime!");
            $("#rsumbit").attr("disabled", true);
        }
        else {
            $('#rime').css("outline", "none");
            $('#rime').css("borderColor", "#6CF372");
            $('#rime').css("boxShadow", "0 0 5px #6CF372"); 
            $('#errIme').text("");
            $("#rsumbit").attr("disabled", false);
        }
    });
    
    
    $('#rprez').keyup(function() {
        var prez = $('#rprez').val();
        if (prez === ""){
            $('#rprez').css("outline", "none");
            $('#rprez').css("borderColor", "#F37E6C");
            $('#rprez').css("boxShadow", "0 0 5px #F37E6C");   
            $('#errPrezime').text("Niste unijeli prezime!");
            $("#rsumbit").attr("disabled", true);
        }
        else {
            $('#rprez').css("outline", "none");
            $('#rprez').css("borderColor", "#6CF372");
            $('#rprez').css("boxShadow", "0 0 5px #6CF372"); 
            $('#errPrezime').text("");
            $("#rsumbit").attr("disabled", false);
        }
    });
    
});