
$(document).ready(function(){

  togleElements();

  $(document).on('click','.contactStatus',statusContactPagination);

  $(document).on('click', '.brisanjeKontakt', deleteContact);
  

  paginationNumber("Contact");
  paginationNumber("User");

  $("#paginationContact").on('click','.pagContact',pagination);
  $("#paginationUser").on('click','.pagUser',pagination);
  

  $(document).on('click', '.brisanjeKorisnika', deleteUser);

  $(document).on('click','#addUserAdminButton',addUser);

  $(document).on('click','#editAuthorButton',editAuthor);

  $(document).on('click','.sendMessageAdmin',changeIdMessage);
  
  $(document).on('click','#sendMessageAdminButton',sendMessage);
  
  $(document).on('keyup','.validateAddUser', addUserValidation);
  $(document).on('change','.selectFieldValidationAddUser', addUserValidation);
 
  $("html,body").addClass('adminModeratorBg');




  });

function addUser(){
  var name=$("#nameAddUserAdmin").val();
  var lastName=$("#lastNameAddUserAdmin").val();
  var email=$("#emailAddUserAdmin").val();
  var city=$("#cityAddUserAdmin").val();
  var zip=$("#zipAddUserAdmin").val();
  var contry=$("#contryAddUserAdmin").val();
  var address=$("#addressAddUserAdmin").val();
  var password=$("#passwordAddUserAdmin").val();
  var role=$("#roleAddUserAdmin").val();
  $.ajax({
    url:"models/admin/user/addUser.php",
    method:"POST",
    data:{
      name:name,
      lastName:lastName,
      email:email,
      password:password,
      role:role,
      city:city,
      zip:zip,
      address:address,
      contry:contry
    },
    success:function(){
      successData();
      var name="User";
      paginationNumber(name);
      updatePagination(name);
    },
    error:prikaziGreskeAjax
  })
}

function deleteUser(){
  let idUser = $(this).data('iduser');

  $.ajax({
      url: 'models/admin/user/deleteUser.php',
      method: 'POST',
      data: {
        idUser: idUser
      },
      success: function(data){
        var name="User";
        paginationNumber(name);
        updatePagination(name);
      }, 
      error: prikaziGreskeAjax
  })
}
function getUsers(){
  $.ajax({
      url: 'models/admin/user/getUsers.php',
      method: 'GET',
      dataType: 'json',
      success: function(data){
        Users(data);
      }, 
      error: prikaziGreskeAjax
  })
}

function Users(podaci){
  let html = "", rb = 1;
  for(let item of podaci){
      html += printUsers(item,rb);
      rb++;
  }
  $("#ispisKorisnici").html(html);
}
function printUsers(item,rb){
  return `<tr>
  <td data-label="Id User">${item.idUser}</td>
  <td data-label="Frist Name">${item.name}</td>
  <td data-label="Last Name">${item.lastName}</td>
  <td data-label="Email">${item.email}</td>
  <td data-label="Role">${item.roleName}</td>
  <td data-label="Edit"><a class="plava" href="index.php?page=userEdit&idUser=${item.idUser}"><i class="fa fa-cog"></i></a></td>
  <td data-label="Delete"><button type="button" class="f brisanjeKorisnika"  data-iduser="${item.idUser}">X</button></td>
  </tr>`;
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



function deleteContact(){
  
  let id = $(this).data('id');

  $.ajax({
      url: 'models/admin/contact/deleteContact.php',
      method: 'POST',
      data: {
        id: id
      },
      success: function(data){

        var name="Contact";
        paginationNumber(name);
        updatePagination(name);
        contactNumber();
        
      }, 
      error: prikaziGreskeAjax
  })
}

function getContact(){
$.ajax({
    url: 'models/admin/contact/getContact.php',
    method: 'GET',
    dataType: 'json',
    success: function(data){
      contact(data);
      console.log(data);
    }, 
    error: prikaziGreskeAjax
})
}

function contact(data){
  var html="";
  for(var item of data){
    html +=`<tr>
    <td  data-label="Name">${item.name}</td>
    <td data-label="Email">${item.email }</td>
    <td  data-label="Phone">${item.phone }</td>
    <td data-label="Text">${item.text }</td>
    <td data-label="Status">`;
    if(item.status==1){
      html+=`<i class="fa fa-check success"></i>`;
    }else{
      html+=`<i class="fa fa-close error" ></i>`;
    } 
    html+=`</td>
    <td data-label="Send Message"><button class="sendMessageAdmin adminModeratorButton plava" data-idcontact="${item.idContact}" onclick="document.getElementById('sendMessageBox').style.display='block'"><i class="fa fa-send"></i></button></td>
    <td data-label="Delete"><button type="button" class="f brisanjeKontakt adminModeratorButton" data-id="${item.idContact}"><i class="fa fa-close"></i></button></td>
    </tr>`
    
  }
  $("#teloTablele").html(html);
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


function editAuthor(){
  var id=$(this).data('idauthor');
  var name=$("#editAuthorName").val();
  var text=$("#editAuthorText").val();
  $.ajax({
    url:"models/admin/author/editAuthor.php",
    method:"POST",
    data:{
        name:name,
        text:text,
        id:id
    },
    success:function(){
      successData();
    },error:prikaziGreskeAjax
  })
}

function paginationNumber(name){
  var contactStatus=$("#contactStatusInput").val();
  $.ajax({
    url:"models/admin/pagination/pagNumber.php",
    dataType:"JSON",
    method:"GET",
    data:{
      name:name,
      contactStatus:contactStatus
    },
    success:function(data){
      printPagination(data,name);
      checkDarkMode();
    }})
}



function printPagination(data,name){
  var limit=6;
  var active=document.querySelector("#pagFilter"+name).value
  var total=Math.ceil(data.number/limit);
  
  var html="<div class='paginationAdmin"+name+"'>";
  for(var i=1;i<=total;i++){
      if(active==i){
        html+=`<a href='javascript:void(0)' value=${i} data-name=${name} data-id=${i} class="darkEmptyTextWhite onePag active${name} pag${name}" >${i}</a>`;
      }else{
        html+=`<a href='javascript:void(0)' value=${i} data-name=${name} data-id=${i} class="darkEmptyTextWhite onePag pag${name}" >${i}</a>`;
      }
  }
  $("#pagination"+name).html(html);

  paginationActive(name);
  
}

function paginationActive(name){
  var header = document.querySelector(".paginationAdmin"+name);
  var btns = header.getElementsByClassName("onePag");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active"+name);
    current[0].className = current[0].className.replace(" active"+name, "");
    this.className += " active"+name;
    });
  }

}



function pagination(){
  var contactStatus=$("#contactStatusInput").val();
  var name=$(this).data('name');
  var idpag=$(this).data('id');
  document.querySelector("#pagFilter"+name).value=idpag;

  $.ajax({
      url:"models/admin/pagination/pagination.php",
      dataType:"json",
      method:"post",
      data:{
        idpag:idpag,
        send:true,
        name:name,
        contactStatus:contactStatus
      },
      success:function(data){
        if(name=="Contact"){
          contact(data);
        }else if(name=="User"){
          Users(data);
        }
        checkDarkMode();
      
      },
      error:function(xhr,status,error){
          console.log(xhr,status,error)
      }
    })
}



function updatePagination(name){
  var contactStatus=$("#contactStatusInput").val();
  var name=name;
  var idpag=$("#pagFilter"+name).val();
  $.ajax({
      url:"models/admin/pagination/pagination.php",
      dataType:"json",
      method:"post",
      data:{
        idpag:idpag,
        send:true,
        name:name,
        contactStatus:contactStatus
      },
      success:function(data){
        if(name=="Contact"){
          contact(data);
        }else if(name=="User"){
          Users(data);
        }
      
      },
      error:function(xhr,status,error){
          console.log(xhr,status,error)
      }
    })
}
  

function contactNumber(){
  $.ajax({
    url:"models/admin/contact/getContactNumber.php",
    method:"GET",
    dataType:"JSON",
    success:function(data){
      $(".badge").html(data)
    },error:function(){

    }
  })
}

function changeIdMessage(){
  var id=$(this).data('idcontact');
  $("#sendMessageId").val(id);
}

function sendMessage(){

  var text=$("#sendMessageTextarea").val();
  var id=$("#sendMessageId").val();
  $.ajax({
    url:"models/admin/contact/sendMessage.php",
    method:"POST",
    data:{
      text:text,
      id:id
    },success:function(){
      successData();
      var name="Contact";
      paginationNumber(name);
      updatePagination(name);
    },error:function(){

    }
  })
}
function togleElements(){
  $("#contactStatusSection").hide();
  $("#contactStatusButton").click(function(){
      $("#contactStatusSection").toggle("1000");
  });

  $(".userButton").hide();
  $("#adminUserButton").click(function(){
      $(".userButton").toggle("1000");
  });


  $("#adminModeratorHiddenNav").click(function(){
    $("#sidebar").toggle("1000");
  });
}

function statusContactPagination(){
  var status=$(this).data('idstatus');
  $("#contactStatusInput").val(status);
  var name="Contact";
  paginationNumber(name);
  updatePagination(name);
}


function addUserValidation(){
  var name=$("#nameAddUserAdmin");
  var lastName=$("#lastNameAddUserAdmin");
  var email=$("#emailAddUserAdmin");
  var city=$("#cityAddUserAdmin");
  var zip=$("#zipAddUserAdmin");
  var contry=$("#contryAddUserAdmin");
  var address=$("#addressAddUserAdmin");
  var password=$("#passwordAddUserAdmin");
  var role=$("#roleAddUserAdmin");
  var repeat=$("#repeatPasswordAddUserAdmin");
  var rePassword = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
  var reName=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/;
  var reLastName=/^[A-Z][a-z]+$/;
  var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
  var reAddress=/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/;
  var reCity=/^([\w]+\D|[\w]+\s[\w]+\D)$/;
  var reZip=/^[\d]{5}$/;
  var data = [];

  var button=$("#addUserAdminButton");

  var valid=true;


  if(name.val() == "") {
      valid = false;
      error(name);
    
  }else if(!reName.test(name.val())) {
      valid = false;
      error(name);
  }else {
      success(name);
  }

  if(lastName.val() == "") {
      valid = false;
      error(lastName);
  }else if(!reLastName.test(lastName.val())) {
      valid = false;
      error(lastName);
  }else {
      success(lastName);
  }

  
  if(email.val() == "") {
      valid = false;
      error(email);
  }else if(!reEmail.test(email.val())) {
      valid = false;
      error(email);
  }else {
      success(email);
  }


  if(city.val() == "") {
      valid = false;
      error(city);

  }else if(!reCity.test(city.val())) {
      valid = false;
      error(city);
  }else {
      success(city);
  }

  
  if(address.val() == "") {
      valid = false;
      error(address);

  }else if(!reAddress.test(address.val())) {
      valid = false;
      error(address.val());
  }else {
      success(address);
  }

  if(password.val() == "") {
    valid = false;
    error(password);

  }else if(!rePassword.test(password.val())) {
      valid = false;
      error(password.val());
  }else {
      success(password);
  }

  if(zip.val() == "") {
      valid = false;
      error(zip);

  }else if(!reZip.test(zip.val())) {
      valid = false;
      error(zip);
  }else {
      success(zip);
  }

  if(role.val()==0){
      valid = false;
      error(role);
  }else{
      success(role);
  }

  if(contry.val()==0){
      valid = false;
      error(contry);
  }else{
      success(contry);
  }


  if(repeat.val() == "" || repeat.val()!=password.val()) {
    valid = false; 
    error(repeat);
  }else if(!rePassword.test(repeat.val()) || repeat.val()!=password.val()) {
    valid = false;
    error(repeat);
  }else if(rePassword.test(repeat.val()) && repeat.val()==password.val()){
    success(repeat);
  }


  if(valid==false){
    $(button).prop( "disabled", true );
    $(button).addClass("buttonDisable");
  }else{
      $(button).prop( "disabled", false );
      $(button).removeClass("buttonDisable");
  }


}


function validationInputField(name,regEx){
  var name=$(name);
  var status=true;
  if(name.val() == "") {
    status = false; 
    error(name);
  }else if(!regEx.test(name.val())) {
    status = false;
    error(name);
  }else {
    status=true;
    success(name);
  } 
  return status;
}

function validationSelectField(name){
  var name=$(name);
  var status=true;
  if(name.val()==0){
    status=false;
    error(name);
  }else{
    status=true;
    success(name);
  }
  return status;
}

function error(name){
  $(name).addClass("errorReg");
  $(name).removeClass("successReg");
}

function success(name){
  $(name).removeClass("errorReg");
  $(name).addClass("successReg");
}

function selectTab(evt, name) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" activeAdmin", "");
  }

  document.getElementById(name).style.display = "block";
  evt.currentTarget.className += " activeAdmin";
}

function checkDarkMode(){
  if ($("#radio-b").is(':checked')) 
  {
    addDark();
      }
  else
  {
    removeDark();
  }
}

function addDark(){
  $('.darkEmptyTextWhite').addClass('darkTextWhite');
}

function removeDark(){
  $('.darkEmptyTextWhite').removeClass('darkTextWhite');
}

function successData(){
  $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
  setTimeout(function() {
      $("#notification").hide(500);
  }, 3000);
}