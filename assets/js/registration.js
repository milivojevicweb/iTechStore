/* eslint-disable no-unused-vars */

$(document).ready(function() {
    $(document).on('click','#registrationButton',registrationTest);
    $(document).on('keyup','input:text, input:password',checkParam);
});
function registrationTest(){

    var ime=$("#fname").val();
    var prezime=$("#lname").val();
    var email=$("#regEmail").val();
    var sifra=$("#regPassword").val();
    var address=$("#regAddress").val();regZipCode
    var regZipCode=$("#regZipCode").val();
    var city=$("#regCity").val();
    var country=$("#regContry").val();
    var repeat=$("#regRepeatPassword").val();
    var reLozinka = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
    var reIme=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/;
    var rePrezime=/^[A-Z][a-z]+$/;
    var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
    var reAddress=/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/;
    var reCity=/^([\w]+\D|[\w]+\s[\w]+\D)$/;
    var reZip=/^[\d]{5}$/;
    var podaci = [];
    var validno=true;
            if(ime == "") {
                validno = false;
                error("#fname");
                
            } else if(!reIme.test(ime)) {
                validno = false;
                error("#fname");
            } else {
                success("#fname");
            }

            if(prezime == "") {
                error("#lname");
                validno = false;  
            } else if(!rePrezime.test(prezime)) {
                error("#lname");
                validno = false;
            } else {
                success("#lname");
            }

            if(sifra == "") {
                validno = false; 
                error("#regPassword");
            } else if(!reLozinka.test(sifra)) {
                validno = false;
                error("#regPassword");
            } else {
                success("#regPassword");
            }

            if(email == "") {
                validno = false; 
                error("#regEmail");
            } else if(!reEmail.test(email)) {
                validno = false;
                error("#regEmail");
            } else {
                success("#regEmail");
            }

            if(address == "") {
                validno = false; 
                error("#regAddress");
            } else if(!reAddress.test(address)) {
                validno = false;
                error("#regAddress");
            } else {
                success("#regAddress");
            }

            if(city == "") {
                validno = false; 
                error("#regCity");
            } else if(!reCity.test(city)) {
                validno = false;
                error("#regCity");
            } else {
                success("#regCity");
            }

            if(regZipCode == "") {
                validno = false;
                error("#regZipCode");
                
            } else if(!reZip.test(regZipCode)) {
                validno = false;
                error("#regZipCode");
            } else {
                success("#regZipCode");
            }

            if(repeat == "" || repeat!=sifra) {
                validno = false; 
                error("#regRepeatPassword");
            } else if(!reLozinka.test(repeat) || repeat!=sifra) {
                validno = false;
                error("#regRepeatPassword");
            } else if(reLozinka.test(repeat) && repeat==sifra){
                success("#regRepeatPassword");
            }

            if(country==0){
                validno=false;
                error("#regContry");
            }else{
                success("#regContry");
            }
                var re=$("#recaptcha").val()
                if(validno==true){
                    $.ajax({
                        url:'models/authentication/registration.php',
                        method:"POST",
                        data:{
                            imeReg:ime,
                            prezimeReg:prezime,
                            emailReg:email,
                            passwordReg:sifra,
                            addressReg:address,
                            zipCode:regZipCode,
                            cityReg:city,
                            countryReg:country,
                            registration:true,
                            re:re
                        },
                        success:function(data, status, xhr){
                            if(xhr.status === 200){
                                window.location.href='index.php?page=user';
                            }
                    
                        },
                        error:function(error,f,g){
                            console.log(error);
                            console.log(f);
                            console.log(g);
                            
                            
                            
                        }
                        })
                }
        
}

function error(name){
    $(name).addClass("errorReg");
    $(name).removeClass("successReg");
}

function success(name){
    $(name).removeClass("errorReg");
    $(name).addClass("successReg");
}


function prikaziGreskeAjax(greska, status, statusText){
    console.error('GRESKA AJAX: ');
    console.log(status);
    console.log(statusText);
    if(greska.status == 500){
        console.log(greska.parseJSON);
        alert(greska.parseJSON.poruka);
    }
    else if(greska.status == 400){
        alert('Niste poslali ispravno parametre!')
    } 
    }

function checkParam(){
var ime=$("#fname").val();
var prezime=$("#lname").val();
var email=$("#regEmail").val();
var sifra=$("#regPassword").val();
var address=$("#regAddress").val();regZipCode
var regZipCode=$("#regZipCode").val();
var city=$("#regCity").val();
var country=$("#regContry").val();
var repeat=$("#regRepeatPassword").val();
var reLozinka = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
var reIme=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/;
var rePrezime=/^[A-Z][a-z]+$/;
var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
var reAddress=/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/;
var reCity=/^([\w]+\D|[\w]+\s[\w]+\D)$/;
var reZip=/^[\d]{5}$/;
var podaci = [];
var validno=true;
        if(ime == "") {
            validno = false;
            error("#fname");
            
        } else if(!reIme.test(ime)) {
            validno = false;
            error("#fname");
        } else {
            success("#fname");
        }

        if(prezime == "") {
            error("#lname");
            validno = false;  
        } else if(!rePrezime.test(prezime)) {
            error("#lname");
            validno = false;
        } else {
            success("#lname");
        }

        if(sifra == "") {
            validno = false; 
            error("#regPassword");
        } else if(!reLozinka.test(sifra)) {
            validno = false;
            error("#regPassword");
        } else {
            success("#regPassword");
        }

        if(email == "") {
            validno = false; 
            error("#regEmail");
        } else if(!reEmail.test(email)) {
            validno = false;
            error("#regEmail");
        } else {
            success("#regEmail");
        }

        if(address == "") {
            validno = false; 
            error("#regAddress");
        } else if(!reAddress.test(address)) {
            validno = false;
            error("#regAddress");
        } else {
            success("#regAddress");
        }

        if(city == "") {
            validno = false; 
            error("#regCity");
        } else if(!reCity.test(city)) {
            validno = false;
            error("#regCity");
        } else {
            success("#regCity");
        }

        if(regZipCode == "") {
            validno = false;
            error("#regZipCode");
            
        } else if(!reZip.test(regZipCode)) {
            validno = false;
            error("#regZipCode");
        } else {
            success("#regZipCode");
        }

        if(repeat == "" || repeat!=sifra) {
            validno = false; 
            error("#regRepeatPassword");
        } else if(!reLozinka.test(repeat) || repeat!=sifra) {
            validno = false;
            error("#regRepeatPassword");
        } else if(reLozinka.test(repeat) && repeat==sifra){
            success("#regRepeatPassword");
        }

        if(country==0){
            validno=false;
            error("#regContry");
        }else{
            success("#regContry");
        }
}