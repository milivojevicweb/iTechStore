<?php
include "models/user/functions.php";
accessAllowUser();
if(isset($_SESSION['korisnik'])){
    $id=$_SESSION['korisnik'];
    $user=userInfo($id->idUser);
}
?>
<div id="hiddenNavContainer" class="darkEmptyLightBackground" >
    <div id="adminModeratorHiddenNav" class="adminModeratorButtonColor darkEmptyBackround">Navigations</div>
</div>
<div class="relative darkEmptyLightBackground" id="adminPanel">

        <div id="sidebar" class="darkEmptyBackround">
                    <ul class="toggle-tabs ">
                        <li>
                            <div onclick="selectTab(event, 'orderUser')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite" >Orders </div>
                            
                        </li>
                        <li>
                            <div onclick="selectTab(event, 'changePasswordUser')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite">Edit Info</div>
                        </li>
                        <li>
                            <div onclick="selectTab(event, 'editInfoUser')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite" >Change Password</div>
                        </li>
                    </ul>
        </div>

    <div id="proizvodiDesno" class="tabbed-content-wrap">

    <div id="orderUser" class="tabcontent defaultOpen">
    <table class="darkEmptyTextWhite darkEmptyBackroundTable tabelaKontakt tableAdminModerator">
                    <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">User name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Info</th>
                    </tr>
                    </thead>
                    <tbody id="orderProducts" >
                    <?php

                                $orders = ordersUser($user->idUser);       
                                foreach($orders as $item):

                            ?>
                            <tr>
                                <td data-label="Orders Id"><?= $item->idOrders?></td>
                                <td data-label="Price"><?= $item->total?></td>
                                <td data-label="Date"><?= $item->dateOrders;?></td>
                                <td data-label="User name"><?= $item->name?> <?= $item->lastName?></td>
                                <td data-label="Status"><?php
                                    if($item->idOrderStatus==1){
                                        echo "Wait <span class='wait'><i class='fa fa-circle'></i></span>";
                                    }elseif($item->idOrderStatus==2){
                                        echo "Sell <span class='sell'>  <i class='fa fa-circle'></i></span>";
                                    }else{
                                        echo "Error <span class='error'><i class='fa fa-circle'></i></span>";
                                    }
                                ?></td>
                                <td data-label="Info" class="details"><button class="plava orderUserButton" data-idorder=<?=$item->idOrders?> onclick="document.getElementById('userOrderModal').style.display='block'">Details</button></td>
                            </tr>
                        <?php endforeach;?>
                </tbody>
        </table>

        <input type="hidden" id="idUser" value="<?php if(isset($id)){echo$id->idUser;} ?>"/>
        <input type="hidden" id="pagUser" value="1" />
        <div id="userOrderPagination" class="pagination paginationAdminMod">
        
        </div>

        <div id="userOrderModal" class="modal ">
                <div class="modalAdminModerator darkEmptyBackround container5">
                    <div class="row">
                        <span onclick="document.getElementById('userOrderModal').style.display='none'" class="close " title="Close Modal"><i class="fa fa-close darkEmptyTextWhite"></i></span>
                    </div>
                    <div class="row" >
                        <ul class="darkEmptyTextWhite" id="userOrderD">
                        </ul>

                    </div>
                </div>

        </div>
    </div>

    <div id="changePasswordUser" class="tabcontent">
        <div class="container5 darkEmptyBackround">
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="fname">First Name</label>
                </div>
                <div class="col-75">
                <input type="text" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" id="fname" name="name" value="<?= $user->name; ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="lname">Last Name</label>
                </div>
                <div class="col-75">
                <input type="text" id="lname" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" name="lastname" value="<?= $user->lastName ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="city">Email</label>
                </div>
                <div class="col-75">
                <input type="text" id="emailUpdateUser" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" placeholder="Email.."  name="email" value="<?= $user->email ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="address">Address</label>
                </div>
                <div class="col-75">
                <input type="text" id="addressUpdateUser" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" name="address" value="<?= $user->address ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="city">City</label>
                </div>
                <div class="col-75">
                <input type="text" id="cityUpdateUser" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" placeholder="Enter City"  name="city" value="<?= $user->city ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="city">Zip code</label>
                </div>
                <div class="col-75">
                <input type="text" id="zipCodeUpdateUser" class="darkEmptyLightBackground  darkEmptyTextWhite userValidation" placeholder="11420"  value="<?= $user->zip ?>" name="zip">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="countryReg">Country</label>
                </div>
                <div class="col-75">
                    <select id="countryUpdateUser" class="darkEmptyLightBackground  darkEmptyTextWhite " name="country">
                        <?php $contry=contry();
                            foreach($contry as $items):
                            if($items->idCountry == $user->idCountry) : ?>

                                <option selected value="<?= $items->idCountry ?>"><?= $items->name ?></option>
                            <?php 
                                else: 
                            ?>
                                <option value="<?= $items->idCountry ?>"><?= $items->name ?></option>
                            <?php
                                endif;

                            endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <div id="userStatus"></div>
                    <button type="button"  id="updeteUserInfoButton" class="adminModeratorButtonColor" name="submitInfo" value="Submit">Submit</button>
                </div>
            </div>
            
        </div>
    </div>

    <div id="editInfoUser" class="tabcontent">
        <div class="container5 darkEmptyBackround">
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite " for="fname">Password</label>
                </div>
                <div class="col-75">
                <input type="password" id="userPassword" class="darkEmptyLightBackground  darkEmptyTextWhite " name="password" >
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="fname">Repeat Password</label>
                </div>
                <div class="col-75">
                <input type="password" id="userRepeatPassword" class="darkEmptyLightBackground  darkEmptyTextWhite " name="rePassword"/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <div id="userPasswordStatus"></div>
                    <button type="button" disabled id="updatePasswordUserButton" class="adminModeratorButtonColor buttonDisable" name="submitPassword">Submit</button>
                </div>
            </div>
        </div>
    </div>



    <div class="cistac"></div>
    </div>
    <div class="cistac"></div>
</div>

                

    <script type="text/javascript" src="assets/js/cekiran.js"></script>  
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/user.js"></script>
                                    





                        


