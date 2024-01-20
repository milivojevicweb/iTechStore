$(document).ready(function() {
    $(document).on('click','.minus-one', minusOneProduct);
    $(document).on('click','.plus-one', plusOneProduct);

    deleteAll();
    alertNoLog();
    menu();
    noLoginButton();
    printCartCount()
    closeCardPaymant();

    if (!hasLS("products")) {
        showEmptyCart();
        total=0;
        $("#total").html(total);
        redirectBuyCartPage();

    } else {
        productsCart = getLS("products");
        productsCartIds = productsCart.map(bc => bc.id);

        getProductsFromAjax();

    }


});

let productsCart, productsAjax, productsAjaxCart;

let productsCartIds;


function getProductsFromAjax() {
    $.ajax({
        url: "models/products/getAllProducts.php",
        method: "GET",
        success: function(data) {
         
            productsAjax = [...data];
            setProductsAjaxCart();
            generateTable();
            generatePayment();
            $("#buttonBuy").on("click",buy);

            $("#buttonCardPay").on("click",buyCard);
           
        }, 
        error: function(xhr) {
            console.error(xhr);
        }
    });


}

function setProductsAjaxCart() {
    productsAjaxCart = productsAjax.filter(productA => {
        for (let productLS of productsCart) {
            if (productA.id == productLS.id) {
                productA.quantity = productLS.quantity;
                return true;
                
            }
        }
        return false;
    });
}

function generateTable() {
    let html = "";
    for (let productAjaxLS of productsAjaxCart) {
        html += generateTr(productAjaxLS);
    }
    $("#cartTable").html(html);
    $(".remove").on("click", removeProductFromCart);
    totalPrice();
    $("#remove-all").on("click", removeAllProductsFromCart);
    checkDarkMode();
}

function generateTr(product) {
    return `
        <tr>
            <td data-label="Name">${product.name}</td>
            <td data-label="Price">${product.newPrice}</td>
            <td data-label="Quantity">
                <button type="button" data-quantity="${product.Quantity}" data-id="${
                    product.id
                }" class="minus-one buttonProducts" >-</button>
               <span id="productQuantity${product.id}"> ${product.quantity} </span>
                <button type="button" data-quantity="${product.Quantity}" data-id="${
                    product.id
                }" class="plus-one buttonProducts" >+</button>
            </td>
            <td data-label="New Price">$${(product.newPrice * product.quantity)}</td>
            <td data-label="Remove">
                <button type="button" data-id="${
                    product.id
                }" class="remove" id="buttonRemove"><i class="fa fa-close"></i></button>
            </td>
        </tr>
    `;
}

function generatePayment(){
    let rez="";
    for (let item of productsAjaxCart) {
        rez += generateLi(item);
    }
    $("#productInfo").html(rez);
}
function generateLi(item){
    return `<li>${item.name}, Price:$${item.newPrice},  Quantity:${item.quantity}, Sum Price:$${(item.newPrice * item.quantity)}</li>`;
}


function showEmptyCart() {
     $("#tablesCart").html(
        '<p>Your cart is currently empty.</p>'
    );
    document.querySelector("#cartpay").style.display="none";
}

function totalPrice() {
    var total = 0;
    for (let productAjaxLS of productsAjaxCart) {
        for (let productLS of productsCart) {
            if (productAjaxLS.id == productLS.id) {
                total +=
                productAjaxLS.newPrice * productAjaxLS.quantity;
            }
        }
    }
    setLS("total", total)
    $("#buttonCardPay").html("Pay $"+total);
    $(".subtotal").html("$"+total);
    $("#total").html(total);

    

    
}

function removeProductFromCart() {
    let id = $(this).data("id");
    productsCart = getLS("products");
    let productsFiltered = productsCart.filter(productCart => productCart.id != id);
    setLS("products", productsFiltered);
    productsCart = getLS("products");
    if (productsCart.length) {
        setProductsAjaxCart();
        generateTable();
    } else {
        removeLS("products");
        showEmptyCart();

    }
    printCartCount();
}

function removeAllProductsFromCart(e) {
    e.preventDefault();
    removeLS("products");
    showEmptyCart();
    printCartCount();
    checkDarkMode();
}

function minusOneProduct() {
    let id = $(this).data("id");
    productsCart = getLS("products");
    let productsFiltered = [];

    productsCart.forEach(productCart => {
        if (productCart.id == id) {
            if (--productCart.quantity > 0) {
                productsFiltered.push(productCart);
            }
        } else {
            productsFiltered.push(productCart);
        }
    });
    setLS("products", productsFiltered);

    productsCart = getLS("products");
    if (productsCart.length) {
        setProductsAjaxCart();
        generateTable();
    } else {
        removeLS("products");
        showEmptyCart();
        removeLS("total");
    }
    printCartCount();
}

function plusOneProduct() {
    let id = $(this).data("id");
    let productQuantity =parseInt($(this).data("quantity"));
    let products = getLS("products");
    for (let product of products) {
        if (product.id == id) {
            console.log("q"+product.quantity);
            console.log("pq"+productQuantity);
            if(product.quantity>=productQuantity){
                product.quantity=productQuantity
            }else{
                product.quantity++;
                console.log();
            }
            
            break;
        }
    }
    setLS("products", products);
    productsCart = getLS("products");
    setProductsAjaxCart();
    generateTable();
    printCartCount();
}
function getLS(name) {
    return JSON.parse(localStorage.getItem(name));
}

function setLS(name, value) {
    return localStorage.setItem(name, JSON.stringify(value));
}

function removeLS(name) {
    return localStorage.removeItem(name);
}

function hasLS(name) {
    return localStorage.getItem(name) != null;
}
function printCartCount() {
    if (hasLS("products")) {
        let count = 0,
        products = getLS("products");
        for (let product of products) {
            count += product.quantity;
        }
        $(".badge_cart").text(count);
    } else {
        $(".badge_cart").text(0);
    }
}

function menu(){
    document.querySelector(".dropbtn").addEventListener("click",function(){
        klikIkonica()
        function klikIkonica() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }});
      

          menu();  
        function menu(){
          document.querySelector("#meniLinkOpen").addEventListener("click",function(){
              document.querySelector("#mySidenav").style.width = "250px";
          });
        
          document.querySelector("#meniLinkClose").addEventListener("click",function(){
              document.querySelector("#mySidenav").style.width = "0";
          });
        }
        
}


function buy(){
    var status=$(this).data('status');
    let total=getLS("total");
    productsCart = getLS("products");
$.ajax({
    url: 'models/products/buyProducts.php',
    method: "POST",
    data: {
        prod:productsCart,
        total:total,
        status:status
    },
    success: function(){
        removeLS("products");
        showEmptyCart();
        printCartCount();
        addToCartNotification();
        removeLS("total");
    },
    error: function(xhr, greska, status){
        console.log(greska);
        console.log(xhr);
        console.log(status);
        console.log("ne radi");
        
        
    }
})
}


function buyCard(){
    var status=$(this).data('status');
    if(document.querySelector("#hiddenA").value=="dd"){
        errorNotification();
    }else{
        let total=getLS("total");
        productsCart = getLS("products");
    $.ajax({
        url: 'models/products/buyProducts.php',
        method: "POST",
        data: {
            prod:productsCart,
            total:total,
            status:status
            
        },
        success: function(){
            removeLS("products");
            showEmptyCart();
            printCartCount();
            addToCartNotification();
            removeLS("total");
        },
        error: function(xhr, greska, status){
            console.log(greska);
            console.log(xhr);
            console.log(status);
            console.log("ne radi");
            
            
        }
    })
    }
}

function closeCardPaymant(){
    var modal = document.getElementById('id01');


    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function noLoginButton(){
    $(document).on('click','#noLoginButton',function(){
        loginErrorNotification();
    })
}
function alertNoLog(){
    $(document).on('click','#buttonByNoLogin',function(){
        loginErrorNotification();
    })
}

function loginErrorNotification(){
    $("#info").html("<div id='notification' class='notificationColorRed'>You must login!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}

function addToCartNotification(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>your purchase was successful</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}

function errorNotification(){
    $("#info").html("<div id='notification' class='notificationColorGreen'>Error!</div>");
    setTimeout(function() {
        $("#notification").hide(500);
    }, 3000);
}

function deleteAll(){
    $(document).on('click','#deleteProducts',function(){
        removeLS('products');
        removeLS('total');
        showEmptyCart();
        total=0;
        $("#total").html(total);
        $(".badge_cart").html("0");
    })
}

function redirectBuyCartPage(){
    var lastword = window.location.href.split("=").pop();
    if(lastword=="buyCartPage"){
        window.location.href='index.php?page=cart';
    }
    
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
    $('.darkEmptyLightBackroundTable').addClass('darkLightBackgroundTable');
    $(".darkEmptyLightBackground").addClass("darkLightBackground");
    $('.darkEmptyBackround').addClass('darkBackground');
}

function removeDark(){
    $('.darkEmptyTextWhite').removeClass('darkTextWhite');
    $('.darkEmptyLightBackroundTable').removeClass('darkLightBackgroundTable');
    $(".darkEmptyLightBackground").removeClass("darkLightBackground");
    $('.darkEmptyBackround').removeClass('darkBackground');
}