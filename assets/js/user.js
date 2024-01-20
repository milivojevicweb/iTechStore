$(document).ready(function() {
    paginationNumber();
    $("#userOrderPagination").on('click','.pagUser',paginationUserOrder);
    $(document).on("click","#updeteUserInfoButton",updateUserInformation);
    $(document).on("click","#updatePasswordUserButton",updateUserPassword);
    $(document).on('keyup','.userValidation', userValidation);
    $(document).on('change','#countryUpdateUser', userValidation);
    $(document).on('keyup','#userRepeatPassword,#userPassword', passwordValidation);
    $(document).on("click",".orderUserButton",getOrderId);
    
    togleElements();
});

function paginationUserOrder(){
    var idpag=$(this).data('id');
    var idUser=$("#idUser").val();
    document.querySelector("#pagUser").value=idpag;
    $.ajax({
        url:"models/user/pagination.php",
        dataType:"json",
        method:"post",
        data:{
          idpag:idpag,
          idUser:idUser
        },
        success:function(data){
          userOrder(data);
        
        },
        error:errorAjax
    })
}

function paginationNumber(){
    var idUser=$("#idUser").val();
    $.ajax({
      url:"models/user/pagNumber.php",
      dataType:"JSON",
      method:"GET",
      data:{
        idUser:idUser
      },
      success:function(data){
        printPagination(data)
    },error:errorAjax
  
  })
}
  

function userOrder(data){
    var html="";
    for(var item of data){
        html+=`
        <tr>
            <td  data-label="Order Id">${item.idOrders}</td>
            <td  data-label="Price">${item.total}</td>
            <td  data-label="Date">${item.dateOrders}</td>
            <td  data-label="User name">${item.name} ${item.lastName}</td>
            <td  data-label="Status">`;
                if(item.idOrderStatus==1){
                    html+=`Wait <span class='wait'><i class='fa fa-circle'></i></span>`;
                }else if(item.idOrderStatus==2){
                    html+=`Sell <span class='sell'>  <i class='fa fa-circle'></i></span>`;
                }else{
                    html+=`Error <span class='error'><i class='fa fa-circle'></i></span>`;
                }
            html+=`</td>
            <td  data-label="Info" class="details"><button class="plava orderUserButton" data-idorder=${item.idOrders} onclick="document.getElementById('userOrderModal').style.display='block'">Details</button></td>
        </tr>
        `;
    }
    $("#orderProducts").html(html)
    console.log(html);
}


function printPagination(data){
    var limit=6;
    var active=document.querySelector("#pagUser").value
    var total=Math.ceil(data.number/limit);
    
    var html="<div class='paginationUser'>";
    for(var i=1;i<=total;i++){
        if(active==i){
          html+=`<a href='javascript:void(0)' value=${i}  data-id=${i} class="onePag activeUser pagUser" >${i}</a>`;
        }else{
          html+=`<a href='javascript:void(0)' value=${i}  data-id=${i} class="onePag pagUser" >${i}</a>`;
        }
    }
    $("#userOrderPagination").html(html);
  
    paginationActive();
    
}
  
function paginationActive(){
  var header = document.querySelector(".paginationUser");
  var btns = header.getElementsByClassName("pagUser");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("activeUser");
    current[0].className = current[0].className.replace(" activeUser", "");
    this.className += " activeUser";
    });
  }

}

function errorAjax(greska, status, statusText){
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

function updateUserInformation(){
  var name=$("#fname").val();
  var lastName=$("#lname").val();
  var email=$("#emailUpdateUser").val();
  var address=$("#addressUpdateUser").val();
  var city=$("#cityUpdateUser").val();
  var zip=$("#zipCodeUpdateUser").val();
  var country=$("#countryUpdateUser").val();
  $.ajax({
    url:"models/user/updateUserInformation.php",
    method:"POST",
    data:{
      name:name,
      lastname:lastName,
      email:email,
      address:address,
      city:city,
      zip:zip,
      country:country,
      submitInfo:true

    },
    success:function(){
      successData();

    },error:function(){

    }
  })
}

function updateUserPassword(){
  var password=$("#userPassword").val();
  var rePassword=$("#userRepeatPassword").val();
  $.ajax({
    url:"models/user/updatePassword.php",
    method:"POST",
    data:{
      password:password,
      rePassword:rePassword,
      submitPassword:true
    },
    success:function(){
      successData();

    },error:function(){

    }
  })
}

function userValidation(){
  var name=$("#fname");
  var lastName=$("#lname");
  var email=$("#emailUpdateUser");
  var city=$("#cityUpdateUser");
  var zip=$("#zipCodeUpdateUser");
  var contry=$("#countryUpdateUser");
  var address=$("#addressUpdateUser");

  var rePassword = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
  var reName=/^[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{1,14})*$/;
  var reLastName=/^[A-Z][a-z]+$/;
  var reEmail=/^\w+([.-]?[\w\d]+)*@\w+([.-]?[\w]+)*(\.\w{2,4})+$/;
  var reAddress=/^[a-zA-Z0-9šŠđĐžŽčČćĆ\s \/\-\.]+$/;
  var reCity=/^([\w]+\D|[\w]+\s[\w]+\D)$/;
  var reZip=/^[\d]{5}$/;
  var data = [];
  var status=true;
  var statusText=false;
  var statusSelect=false;
  var button=$("#updeteUserInfoButton");

  data=[{"id":name,"regEx":reName},{"id":lastName,"regEx":reLastName},{"id":email,"regEx":reEmail},{"id":address,"regEx":reAddress},{"id":zip,"regEx":reZip},{"id":city,"regEx":reCity}];
  for(var item of data){
    statusText=validationInputField(item.id,item.regEx);
    if(statusText==false){
      status=statusText;
    }
  }

  statusSelect=validationSelectField(contry);



  if(statusText==false ||status==false){
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
  console.log(status);
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
  console.log(status);
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

function passwordValidation(){
  var rePassword = /^(?=.*\d)(?=.*[A-zČĆŽŠĐčćžšđ])(?=.*[~!@#$%^&*<>?]).{6,}$/;
  var password=$("#userPassword");
  var repeatPassword=$("#userRepeatPassword");
  var button=$("#updatePasswordUserButton");
  var status=true;


  if(password.val()==""){
    status=false;
    error(password);
  }else if(!rePassword.test(password.val())){
    status=false;
    error(password);
  }else{
    status=true;
    success(password);
  }

  if(repeatPassword.val()==""){
    status=false;
    error(repeatPassword);
  }if(repeatPassword.val()!=password.val()){
    status=false;
    error(repeatPassword);
  }else if(!rePassword.test(repeatPassword.val())){
    status=false;
    error(repeatPassword);
  }else{
    status=true;
    success(repeatPassword);
  }


  if(status==false){
    $(button).prop( "disabled", true );
    $(button).addClass("buttonDisable");
  }else{
      $(button).prop( "disabled", false );
      $(button).removeClass("buttonDisable");
  }
}

function getOrderId(){
  var id=$(this).data('idorder');
  $.ajax({
    url:"models/user/userOrder.php",
    method:"GET",
    dataType:"JSON",
    data:{
      id:id
    },success:function(data){
      getOrderProduct(id)
      printOrder(data)

    },error:function(){

    }
  })
}

function printOrder(data){
  var html="";
  html=`
    <li>Name: ${data.name} ${data.lastName}</li>
    <li>Payment method: ${data.payment}</li>
    <li>Address: ${data.address}</li>
    <li>Zip: ${data.zip}</li>
    <li>City: ${data.city}</>
    <li>Contry: ${data.country}</li>
    <li>Email: ${data.email}</li>
    <li>Date: ${data.date}</li>
    <li id="orderProduct"></li>
    <li>Total Price: ${data.total}</li>
  `;
  $("#userOrderD").html(html);
}

function getOrderProduct(id){
  var id=id;
  $.ajax({
    url:"models/user/userOrderProduct.php",
    method:"GET",
    dataType:"JSON",
    data:{
      id:id
    },success:function(data){
      printOrderProduct(data)

    },error:function(){

    }
  })
}

function printOrderProduct(data){
  var html="";

  for(var item of data){
    html+=`
      Name: ${item.name} Price: ${item.newPrice} Quantity: ${item.quantity}, 
    `;
  }
  $("#orderProduct").html(html)

}

function togleElements(){
  $("#adminModeratorHiddenNav").click(function(){
    $("#sidebar").toggle("1000");
  });
}

function successData(){
  $("#info").html("<div id='notification' class='notificationColorGreen'>Successfully!</div>");
  setTimeout(function() {
      $("#notification").hide(500);
  }, 3000);
}