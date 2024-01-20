
<?php
	include "models/cart/functions.php";
	accessAllowCartPage();
?>

<div id="cartContainer">
	<div class="omotac">
		<div id="tablesCart" class="darkEmptyLightBackground darkEmptyTextWhite">
			<table class="darkEmptyLightBackroundTable darkEmptyTextWhite" >
				<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Price</th>
					<th scope="col">Quantity</th>
					<th scope="col">New Price</th>
					<th scope="col">Remove</th>
				</tr>
				</thead>
				<tbody id="cartTable">

				</tbody>
			</table>
		</div>
		<div id="cartpay" class="darkEmptyLightBackground darkEmptyTextWhite">
				<ul>
					<li>Total: $<span id="total"></span></li>
					<li><button id="deleteProducts">Delete</button></li>
					<?php include "models/functions.php";if(usersCart()){?>
					<li><input name="buyProducts" data-status=2 value="Buy" class="buttonBuy" id="buttonBuy"type="button"></li>
					<?php }else{?>
						<li><input id="noLoginButton" class="buttonBuy" value="Buy" type="button"></li>
					<?php }?>
					<?php if(isset($_SESSION['korisnik'])){ ?>
					<li><a id="buttonBuy" class="buttonBuy" href="index.php?page=buyCartPage">Pay with Card <i class="fa fa-cc-stripe"></i></a></li>
					<?php }else{ ?>
						<li><button id="buttonByNoLogin" class="buttonBuy">Pay with Card <i class="fa fa-cc-stripe"></i></button></li>
					<?php } ?>
				</ul>
			</form>
		</div>
		<div id="id01" class="modal">


		</div>
	</div>
</div>
<script type="text/javascript" src="assets/js/cart.js"></script>
<script type="text/javascript" src="assets/js/cekiran.js"></script>

  


