<?php
include "models/moderator/function.php";
accessAllowModeratorMain();

?>

<div  id="hiddenNavContainer" class="darkEmptyLightBackground">
    <div id="adminModeratorHiddenNav" class="adminModeratorButtonColor darkEmptyBackround">Navigations</div>
</div>
<div class="relative darkEmptyLightBackground" id="adminPanel">
    <div id="sidebar" class="darkEmptyBackround">
            <ul class="toggle-tabs ">
                <li>
                    <div id="moderatoProductButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-folder-open"></i>Product</div>
                    <div onclick="selectTab(event, 'productModeratorTable')" id="defaultOpen"  class="darkEmptyTextWhite moderatorProductTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>All Products</div>
                    <div onclick="selectTab(event, 'productModeratorAdd')"  class="darkEmptyTextWhite moderatorProductTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add Product</div>
                </li>
                <li>
                    <div id="moderatoNewsButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-newspaper-o"></i> News</div>
                    <div onclick="selectTab(event, 'newsModeratorTable')"  class="darkEmptyTextWhite moderatorNewsTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>All News</div>
                    <div onclick="selectTab(event, 'newsModeratorAdd')"  class="darkEmptyTextWhite moderatorNewsTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add News</div>
                </li>
                <li>
                    <div onclick="selectTab(event, 'ordersModerator')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite">
                        <span><i class="fa fa-cart-arrow-down"></i>Orders</span>
                        <span class="badge orderBadge">
                            <?php
                                echo ordersNumber();
                            ?>
                        </span>
                        </div>
                </li>
                <li>
                    <div id="moderatoCategoryButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-tag"></i>Category</div>
                    <div onclick="selectTab(event, 'categoryModeratorTable')"  class="darkEmptyTextWhite moderatorCategoryTab tablinks userButton" ><i class="darkEmptyTextWhite fa fa-minus"></i>All Categories</div>
                    <div  onclick="selectTab(event, 'categoryModeratorAdd')"  class="darkEmptyTextWhite moderatorCategoryTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add Category</div>
                </li>
                <li>
                    <div id="moderatoNewsletterButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-envelope-open"></i>Newsletter</div>
                    <div  onclick="selectTab(event, 'newsletterModeratorTable')"  class="darkEmptyTextWhite moderatorNewsletterTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>All Newsletters</div>
                    <div  onclick="selectTab(event, 'newsletterModeratorAdd')"  class="darkEmptyTextWhite moderatorNewsletterTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add Newsletter</div>
                </li>
                <li>
                    <div id="moderatoPollButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-server"></i>Poll</div>
                    <div  onclick="selectTab(event, 'pollModeratorAdd')"  class="darkEmptyTextWhite moderatorPollTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>All Polls</div>
                    <div  onclick="selectTab(event, 'pollModeratorStatistic')"  class="darkEmptyTextWhite moderatorPollTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Statistic</div>
                    <div  onclick="selectTab(event, 'pollModeratorTable')"  class="darkEmptyTextWhite moderatorPollTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add Poll</div>
                </li>
                <li>
                    <div id="moderatoContryButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-globe"></i>Contry</div>
                    <div  onclick="selectTab(event, 'contryModeratorTable')"  class="darkEmptyTextWhite moderatorContryTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>All Contries</div>
                    <div  onclick="selectTab(event, 'contryModeratorAdd')"  class="darkEmptyTextWhite moderatorContryTab tablinks userButton"><i class="darkEmptyTextWhite fa fa-minus"></i>Add Contry</div>
                </li>
        </ul>
    </div>
    <div id="proizvodiDesno" class="tabbed-content-wrap">
        <div id="productModeratorTable" class="cdd tabcontent defaultOpen ordersSection">
            <button id="productStatusButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Sorted by status</button>
            <div id="productStatusSection" class="filterButtonModAdmin">
                <button type="button" data-idstatus="1" class="darkEmptyBackround darkEmptyTextWhite productStatus adminModButtonHidden">In stock  <span class='sell'>  <i class='fa fa-circle'></i></span></button>
                <button type="button" data-idstatus="0" class="darkEmptyBackround darkEmptyTextWhite productStatus adminModButtonHidden">Out of stock <span class='wait'><i class='fa fa-circle'></i></span></button>
                <button type="button" data-idstatus="" class="darkEmptyBackround darkEmptyTextWhite productStatus adminModButtonHidden">Clear</button>
                <input type="hidden" id="productStatusInput" value=""/>
            </div>

            <button id="productCategoryButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Products Category</button>
            <div id="productCategorySection" class="filterButtonModAdmin">
                <?php $productCategory=getCategory();
                foreach($productCategory as $item):?>
                    <button type="button" data-idcategory=<?=$item->idCategory?> class="darkEmptyBackround darkEmptyTextWhite productCategory adminModButtonHidden"><?=$item->name?></button>
                <?php endforeach; ?>
                <button type="button" data-idstatus="" class="darkEmptyBackround darkEmptyTextWhite productCategory adminModButtonHidden">Clear</button>
                <input type="hidden" id="productCategoryInput" value=""/>
            </div>

            <button id="productSearchButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Search product</button>
            <div id="productSearchSection">
                <input id="productSearchInput" class="adminModeratorSearch" type="text" name="search" placeholder="Search...">

            </div>

            <table class="darkEmptyBackroundTable responsiveTable darkEmptyTextWhite tableAdminModerator" >
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Description</th>
                        <th scope="col">New price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Edit price</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="prikazProizvoda">
                <?php
                        $product = proizvodi();
                        
                        foreach($product as $item):
                    ?>
                        <tr>
                            <td data-label=""><img src="<?= $item->path ?>" alt="<?= $item->alt ?>" class="slikaModerator"/></td>
                            <td data-label=""><?= $item->name ?></td>
                            <td data-label="Description"><?= $item->description ?></td>
                            <td data-label="New price">&#36;<?= $item->newPrice ?>.00</td>
                            <td data-label="Categories"><?= $item->knaziv ?></td>
                            <td data-label="Availability"> <?php if($item->Quantity>=1):?>In stock  <span class='sell'>  <i class='fa fa-circle'></i></span> <?php else: ?>Out of stock <span class='wait'><i class='fa fa-circle'></i></span><?php endif;?></td>
                            <td data-label="Edit"><a class="plava" href="index.php?page=editProduct&idEditProduct=<?= $item->idProduct ?>"><i class="fa fa-cog"></i></a></td>
                            <td data-label="Edit price"><a class="green plava" href="index.php?page=editPrice&id=<?= $item->idProduct ?>"><i class="fa fa-dollar"></i></a></td>
                            <td data-label="Delete"><button type="button" class="f brisanjeProizvod adminModeratorButton" data-id="<?= $item->idProduct ?>"><i class="fa fa-close"></i></button></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

            <input type="hidden" id="pagFilterModeratorProducts" value="1" />
            <div id="paginationModeratorProducts" class="pagination paginationAdminMod"></div>
        </div>

        <div id="productModeratorAdd" class="darkEmptyBackround darkEmptyTextWhite container5 mod tabcontent">
            <form method="post" action="" enctype="multipart/form-data" id="myform">
                <div class="row">
                <div class="col-25">
                    <label for="fname">Image</label>
                </div>
                <div class="col-75">
                    <input type="hidden" name="idSkriveno" />
                    <button type="button" id="addImageProductModerator" onclick="document.getElementById('profilePhoto').click()" class="adminModeratorImageButton ">Add photo</button>
                        <span id="profilePhotoValue"></span>
                        <input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>
                </div>
                </div>

                <div class="row">
                <div class="col-25">
                    <label for="fname">Image</label>
                </div>
                <div class="col-75">
                    <input type="hidden" name="idSkriveno" />
                    <button type="button" id="addImageMultiProductModerator"onclick="document.getElementById('multiProfilePhoto').click()" class="adminModeratorImageButton">Add photos</button>
                        <span id="multiProfilePhotoValue"></span>
                        <input type="file" name="multiImage[]" id="multiProfilePhoto" style="display:none;" onchange="document.getElementById('multiProfilePhotoValue').innerHTML=this.value;" multiple />
                </div>
                </div>

                <div class="row">
                <div class="col-25">
                    <label for="lname">Alt</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="altInsertProduct" name="alt"/>
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">Name</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="nameInsertProduct" name="naziv" />
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">Description</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="descInsertProduct" name="opis" />
                </div>
                
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">Old price</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="oldPriceInsertProduct" name="stara" />
                </div>
                
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">New price</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="newPriceInsertProduct" name="nova" />
                </div>
                
                </div>

                <div class="row">
                <div class="col-25">
                    <label for="lname">Quantity</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="quantityInsertProduct" name="quantity" />
                </div>
                
                </div>

                <div class="row">
                <div class="col-25">
                    <label for="country">Categories</label>
                </div>
                <div class="col-75">
                    <select id="categoryInsertProduct" class="darkEmptyLightBackground darkEmptyTextWhite" name="kategorije">
                        <option value="0">Choose..</option>
                            <?php
                                $category=category();   
                                foreach($category as $item):
                            ?>
                                <option value="<?=$item->idCategory?>" ><?=$item->name?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="country">Add to home page</label>
                    </div>
                    <div class="col-75">
                        <div class="row">
                            <select id="homeInsertProduct" class="darkEmptyLightBackground darkEmptyTextWhite" name="istaknut">
                            <?php
                                    $homeProduct = homeProduct();
                                    foreach($homeProduct as $item):
                                        if($item->idHomeProduct == $korisnik->idHomeProduct) : ?>
                                    <option selected value="<?= $item->idHomeProduct ?>"><?= $item->name ?></option>
                                <?php 
                                    else: 
                                ?>
                                    <option selected value="<?= $item->idHomeProduct ?>"><?= $item->name ?></option>
                                <?php
                                    endif;
                                    endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <span id="insertProductStatusModerator"></span>
                </div>

                <div class="row">
                    <div class="col-25">
                    </div>
                    <div class="col-75">
                        <button id="insertProductButton" class="buttonDisable adminModeratorButtonColor" disabled type="button" name="dodajProizovd" >Submit</button>
                    </div>

                </div>
            </form>
        </div>

        <div id="newsModeratorAdd" class="darkEmptyBackround darkEmptyTextWhite container5 mod tabcontent">
            <form action="models/moderator/news/addNews.php" method="POST" enctype="multipart/form-data" >
                <div class="row">
                <div class="col-25">
                    <label for="fname">Image</label>
                </div>
                <div class="col-75">
                    <input type="hidden" name="idSkriveno" />
                    <button type="button" id="addNewsImageModerator" onclick="document.getElementById('profilePhoto2').click()" class="adminModeratorImageButton">Add photo</button>
                        <span id="profilePhotoValue2"></span>
                        <input type="file" name="slikaVest" id="profilePhoto2" style="display:none;" onchange="document.getElementById('profilePhotoValue2').innerHTML=this.value;"/>
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">Title</label>
                </div>
                <div class="col-75">
                    <input type="text" class="darkEmptyLightBackground darkEmptyTextWhite" id="newsTitle" name="title"/>
                </div>
                </div>
                <div class="row">
                <div class="col-25">
                    <label for="lname">Text</label>
                </div>
                <div class="col-75">
                <textarea class="form-control darkEmptyLightBackground darkEmptyTextWhite" id="summary-ckeditor" name="tekstUpis"></textarea>
                
                </div>

                </div>
                <span id="newsTextModeratorStatus"></span>
                <div class="row">
                <div class="col-25">
                    
                </div>
                <div class="col-75">
                <input type="submit" id="addNewsModerator" class="adminModeratorButtonColor buttonDisable adminModeratorButtonColor" disabled  name="dodajVest" value="Submit">
                </div>
                
                </div>
            </form>
        </div>

        <div  id="newsModeratorTable" class="tabcontent">
            <table class="darkEmptyBackroundTable  darkEmptyTextWhite  tableAdminModerator adminModeratorMargin ">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="prikazVesti">
                <?php

                        $news = news();                                
                        foreach($news as $item):
                    ?>
                        <tr>
                            <td data-label=""><img src="<?= $item->image ?>" alt="<?= $item->title ?>" class="slikaModerator"/></td>
                            <td data-label="Title"><?= implode(' ', array_slice(explode(' ', $item->title), 0, 3))?>...</td>
                            <td data-label="Date"><?= $item->date ?></td>
                            <td data-label="Edit"><a class="plava" href="index.php?page=editNews&idNews=<?= $item->idNews ?>"><i class="fa fa-cog"></i></a></td>
                            <td data-label="Delete"><button type="button" class="f brisanjeVesti adminModeratorButton" data-idvest="<?= $item->idNews ?>"><i class="fa fa-close"></i></button></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

            <input type="hidden" id="pagFilterModeratorNews" value="1" />
            <div id="paginationModeratorNews" class="pagination paginationAdminMod">
            </div>
        </div>

        <div id="ordersModerator" class="tabcontent ordersSection">
            <button id="statisticButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Statistic</button>
                <div id="statisticHidden">
                    <p>This Year: </p><hr>
                    <div class="buttonOrders">
                            <span class="darkEmptyBackround darkEmptyTextWhite">Sum of sell products: <?= numberSellProducts()->qu;?></span>
                            <span class="darkEmptyBackround darkEmptyTextWhite">Sum total cost of all orders: <?=sumOrdersPrice()->total;?></span>
                    </div>
                    <div class="statisticDetails">
                        <span class="darkEmptyBackround darkEmptyTextWhite">Top 5 Products of the Year</span>
                                <?php $items=topProducts();
                                $i=1;
                                foreach($items as $item):?>
                                <span class="darkEmptyBackround darkEmptyTextWhite"><?=$i?>: <?=$item->name;?> <span class="slellsBadge">Sells:<?=$item->number;?></span></span>
                                <?php $i++; endforeach;?>
                    </div>
                    <p>This Month: </p><hr>
                    <div class="buttonOrders">
                            <span class="darkEmptyBackround darkEmptyTextWhite">Number of sell products this Month: <?= numberSellProductsThisMonth()->qu;?></span>
                            <span class="darkEmptyBackround darkEmptyTextWhite">Sum total cost of orders this month: <?=sumOrdersPriceMonth()->total;?></span>
                    </div>
                    <div class="statisticDetails">
                        <span class="darkEmptyBackround darkEmptyTextWhite">Top 5 Products this Month</span>
                                <?php $items=topProductsMonth();
                                $i=1;
                                foreach($items as $item):?>
                                <span class="darkEmptyBackround darkEmptyTextWhite"><?=$i?>: <?=$item->name;?> <span class="slellsBadge">Sells:<?=$item->number;?></span></span>
                                <?php $i++; endforeach;?>
                    </div>
                </div>

                <button id="paymentMethodButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Payment method</button>
                    <div id="paymentMethodOrderSection" class="filterButtonModAdmin">
                        <?php $payment=getPaymentMethod(); 
                        foreach($payment as $item):
                        ?>
                            <button type="button" data-idpayment=<?=$item->idOrderPaymentMethod?> class="darkEmptyModeratorAdminButton darkEmptyTextWhite paymentButton"><?=$item->name?></button>

                        <?php endforeach; ?>
                        <button type="button" data-idpayment="" class="paymentButton darkEmptyModeratorAdminButton darkEmptyTextWhite">Clear</button>
                        <input type="hidden" id="paymentOrder" value=""/>
                    </div>

                <button id="statusButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Sorted by status</button>
                    <div id="sortOrdersSection" class="filterButtonModAdmin">
                        <?php $status=getStatus(); 
                        foreach($status as $item):
                        
                        
                        if($item->idOrderStatus==1){
                                    echo "<button type='button' data-idstatus=$item->idOrderStatus class='darkEmptyModeratorAdminButton darkEmptyTextWhite ordersB'>$item->name <span class='wait'><i class='fa fa-circle'></i></span></button>";
                                }elseif($item->idOrderStatus==2){
                                    echo "<button type='button' data-idstatus=$item->idOrderStatus class='darkEmptyModeratorAdminButton darkEmptyTextWhite ordersB'>$item->name <span class='sell'>  <i class='fa fa-circle'></i></span></button>";
                                }else{
                                    echo "<button type='button' data-idstatus=$item->idOrderStatus class='darkEmptyModeratorAdminButton darkEmptyTextWhite ordersB'>$item->name <span class='error'><i class='fa fa-circle'></i></span></button>";
                        }
                        ?>
                        

                        <?php endforeach; ?>
                        <button type="button" data-idstatus="" class="darkEmptyModeratorAdminButton darkEmptyTextWhite ordersB">CLEAR</button>
                        <input type="hidden" id="statusOrder" value=""/>
                    </div>
                <button id="searchButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Search id</button>
                    <div id="searchOrdersSection">
                        <p>Search idOrdes</p>
                        <input id="inputOrder" class="adminModeratorSearch" type="text" name="search" placeholder="Search..">
                    </div>
                <button id="dateOrdesButton" class="darkEmptyBackround darkEmptyTextWhite ordersButton adminModeratorButtonColor">Filtred by Date</button>
                    <div id="dateSection">
                        <input class="darkEmptyBackround darkEmptyTextWhite" id="datumOd" type="date"/>
                        <input class="darkEmptyBackround darkEmptyTextWhite" id="datumDo" type="date"/>
                        <button id="searchDate" class="adminModeratorButtonColor">Search Date</button>
                    </div>

        <table  class="darkEmptyBackroundTable responsiveTable darkEmptyTextWhite tableAdminModerator tableOrders">
            <thead>
            <tr>
                <th scope="col">Orders Id</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
                <th scope="col">User name</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Status</th>
                <th scope="col">Info</th>
            </tr>
            </thead>
            <tbody id="orderProducts" >
            <?php

                        $orders = ordersInformation();                                
                        foreach($orders as $item):
                    ?>
                    <tr>
                        <td  data-label="Orders Id"><?= $item->idOrders?></td>
                        <td data-label="Price"><?= $item->total?></td>
                        <td data-label="Date"><?= $item->dateOrders;?></td>
                        <td data-label="User name"><?= $item->name?> <?= $item->lastName?></td>
                        <td data-label="Payment Method"><?= $item->payment?></td>
                        <td data-label="Status"><?php
                            if($item->idOrderStatus==1){
                                echo "Processing in progress <span class='wait'><i class='fa fa-circle'></i></span>";
                            }elseif($item->idOrderStatus==2){
                                echo "Delivered <span class='sell'>  <i class='fa fa-circle'></i></span>";
                            }else{
                                echo "Canceled <span class='error'><i class='fa fa-circle'></i></span>";
                            }
                        ?></td>
                        <td data-label="Info" class="details"><a href="index.php?page=orderDetails&id=<?=$item->idOrders?>">Details</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <input type="hidden" id="pagFilterModeratorOrder" value="1" />
        <div id="paginationModeratorOrder" class="pagination paginationAdminMod">
            

        </div>
        </div>
        <div id="categoryModeratorTable"  class="tabcontent" >
        <table id="category" class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator adminModeratorMargin ">
                <thead>
                <tr>
                    <th scope="col">Category Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                </tr>
                </thead>
                <tbody id="showCategory">
                    <?php $category=getCategory();
                    foreach($category as $item):
                    ?>
                    <tr>
                        <td data-label="Category Id"><?=$item->idCategory?></td>
                        <td data-label="Name"><?=$item->name?></td>
                        <td data-label="Edit"><button class="buttonCategory plava adminModeratorButton"  data-idcategory=<?=$item->idCategory?> onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-cog"></i></button></td>
                        <td data-label="Delete"><button class="deleteCategoryButton f adminModeratorButton " data-idcategory=<?=$item->idCategory?>  type="button"><i class="fa fa-close"></i></button></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
        </table>
        <input type="hidden" id="pagFilterModeratorCategory" value="1" />
        <div id="paginationModeratorCategory" class="pagination paginationAdminMod">
            

        </div>
        </div>
        <div id="id01" class="modal ">
            <div class="modalAdminModerator container5 darkEmptyLightBackground darkEmptyTextWhite darkEmptyTextWhite">
                <div class="row">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal"><i class="darkEmptyTextWhite fa fa-close"></i></span>
                </div>
                <div class="row">
                    <h2>Edit Category</h2>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Name</label>
                    </div>
                    <div class="col-75">
                        <input class="darkEmptyBackround darkEmptyTextWhite" type="text" id="updateCategoryName" placeholder="Add Category..." name="categoryName"/>
                        <input type="hidden" id="categotyEditId" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">

                    </div>
                    <div class="col-75">
                        <span id="categoryEditStatus"></span>
                        <button type="button" id="editCategoryButton" class="darkEmptyBackround adminModeratorButtonColor"  name="editCategory">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="categoryModeratorAdd" class="tabcontent container5 mod darkEmptyBackround darkEmptyTextWhite">

            <div class="row">
                <div class="col-25">
                    <label for="fname">Category name</label>
                </div>
                <div class="col-75">
                    <input class="darkEmptyLightBackground darkEmptyTextWhite" type="text" id="categoryName" placeholder="Add Category..." name="categoryName"/>
                </div>
            </div>
            <div class="row">
                <span id="categoryStatus"></span>
            </div>
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <button  type="button" disabled class="buttonDisable adminModeratorButtonColor" id="addCategoryButton" name="addCategory">Add</button>
                </div>
                
            </div>


        </div>

        <div id="newsletterModeratorAdd" class="tabcontent container5 mod darkEmptyBackround darkEmptyTextWhite">
            
            <div class="row">
                <div class="col-25">
                    <label for="fname">Newsletter title</label>
                </div>
                <div class="col-75">
                    <input class="darkEmptyLightBackground darkEmptyTextWhite" id="newsletterTitle" name="title" type="text"/>  
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Newsletter code</label>
                </div>
                <div class="col-75">
                    <textarea id="newsletterCode" class="darkEmptyLightBackground darkEmptyTextWhite" name="code"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <button id="newsletterButtonModerator" class="adminModeratorButtonColor buttonDisable"  disabled name="button">Send</button>
                </div>
            </div>
            
        </div>

        <div id="newsletterModeratorTable" class="tabcontent newslettermoderator" >
        <div id="newsletterCount" class="darkEmptyBackround darkEmptyTextWhite "><p>number of subscribed users: <?=newsletterCount()->number?></p> <p>New users: <?=newUsersNewsletterCount()->number?></p></div>
        <table class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator ">
            <thead>
                <tr>
                    <th scope="col">Newsletter Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                </tr>   
            </thead>
            <tbody id="newsletterTbody"> 
                <?php include "models/moderator/newsletter/functions.php";
                $allNewsletter=getAllNewsletter();
                foreach($allNewsletter as $item):
                ?>

                <tr>
                    <td data-label="Newsletter Id"><?=$item->idNewsletter?></td>
                    <td data-label="Newsletter Id"><?=$item->title?></td>
                    <td data-label="Date"><?=$item->date?></td>
                    <td data-label="Edit"><a class="plava adminModeratorButton" href="index.php?page=editNewsletter&id=<?=$item->idNewsletter?>"><i class="fa fa-cog"></i></a></td>
                    <td data-label="Delete"><button class="deleteNewsletterButton f adminModeratorButton " data-idnewsletter="<?=$item->idNewsletter?>"><i class="fa fa-close"></i></button></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" id="pagFilterModeratorNewsletter" value="1" />
        <div id="paginationModeratorNewsletter" class="pagination paginationAdminMod">
            

        </div>
        </div>

        <div id="pollModeratorTable" class="tabcontent container5 mod darkEmptyBackround darkEmptyTextWhite">
            <div class="row">
                <div class="col-25">
                    <label for="fname">Question</label>
                </div>
                <div class="col-75">
                    <input class="darkEmptyLightBackground darkEmptyTextWhite" type="text" id="question"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Answers number</label>
                </div>
                <div class="col-75">
                <input class="darkEmptyLightBackground darkEmptyTextWhite" type="number" id="numberAnswers"/>
                <div id="inputPoll">
                </div>          
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <span id="pollStatus"></span>
                    <button class="adminModeratorButtonColor buttonDisable" disabled id="insertPollButton">Insert</button>
                </div>
            </div>
        </div>

        <div id="pollModeratorStatistic" class="tabcontent darkEmptyTextWhite">
            <?= pollResult(); ?>
        </div>

        <div id="pollModeratorAdd" class="tabcontent moderatorPoll">
        <table class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator adminModeratorMargin ">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Question</th>
                <th scope="col">Active</th>
                <th scope="col">Statistic</th>
                <th scope="col">Edit</th>
                <th scope="col">Delite</th>
            </tr>
            </thead>
            <tbody id="pollTableBody">
            <?php
            
                $allPoll=viewAllPoll();
                foreach($allPoll as $item):
            ?>
                    <tr>
                        <td data-label="Id"><?=$item->idPoll?></td>
                        <td data-label="Question"><?=$item->question?></td>
                        <td data-label="Active"><?php pollUpdateStatus($item->status,$item->idPoll)?></td>
                        <td data-label="Statistic"><button onclick="document.getElementById('polStatisticModal').style.display='block'" class="plava pollStatistic adminModeratorButton" data-id=<?=$item->idPoll?>><i class="fa fa-bar-chart"></i></button></td>
                        <td data-label="Edit"><a class="plava" href="index.php?page=editPoll&id=<?=$item->idPoll?>"><i class="fa fa-cog"></i></a></td>
                        <td data-label="Delite"><button class="deletePoll f  adminModeratorButton" data-idpoll="<?=$item->idPoll?>"><i class="fa fa-close"></i></button></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>    
        <input type="hidden" id="pagFilterModeratorPoll" value="1" />
        <div id="paginationModeratorPoll" class="pagination paginationAdminMod">
            

        </div>
        </div>

        <div id="polStatisticModal" class="modal  ">
            <div id="pollStatisticContainer" class="darkEmptyLightBackground darkEmptyTextWhite">
            <span onclick="document.getElementById('polStatisticModal').style.display='none'" class="close" title="Close Modal"><i class="darkEmptyTextWhite fa fa-close"></i></span>
                    <div id="pollTable"></div>
            </div>
        </div>

        <div id="contryModeratorTable" class="tabcontent">
            <table id="category" class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator adminModeratorMargin ">
                    <thead>
                    <tr>
                        <th scope="col">Country Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>                              
                        <th scope="col">Delete</th>

                    </tr>
                    </thead>
                    <tbody id="showContry">
                        <?php $country=getCountry();
                        foreach($country as $item):
                        ?>
                        <tr>
                            <td data-label="Contry Id"><?=$item->idCountry?></td>
                            <td data-label="Name"><?=$item->name?></td>
                            <td data-label="Edit"><button class="buttonContry plava adminModeratorButton"  data-idcountry=<?=$item->idCountry?> onclick="document.getElementById('contryModal').style.display='block'"><i class="fa fa-cog"></i></button></td>
                            <td data-label="Delete"><button class="deleteContryButton f adminModeratorButton " data-idcountry=<?=$item->idCountry?>  type="button"><i class="fa fa-close"></i></button></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
            </table>
            <input type="hidden" id="pagFilterModeratorContry" value="1" />
            <div id="paginationModeratorContry" class="pagination paginationAdminMod">
                
            </div>
        </div>

        <div id="contryModal" class="modal ">
            <div class="modalAdminModerator container5 darkEmptyLightBackground darkEmptyTextWhite darkEmptyTextWhite">
                <div class="row">
                    <span onclick="document.getElementById('contryModal').style.display='none'" class="close" title="Close Modal"><i class="darkEmptyTextWhite fa fa-close"></i></span>
                </div>
                <div class="row">
                    <h2>Edit Country</h2>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Name</label>
                    </div>
                    <div class="col-75">
                        <input class="darkEmptyBackround darkEmptyTextWhite" type="text" id="updateContryName" placeholder="Edit Contry..." name="contryName"/>
                        <input type="hidden" id="contryEditId" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">

                    </div>
                    <div class="col-75">
                        <span id="contryEditStatus"></span>
                        <button type="button" id="editContryButton" class="darkEmptyBackround adminModeratorButtonColor" name="editContry">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="contryModeratorAdd" class="tabcontent container5 mod darkEmptyBackround darkEmptyTextWhite">
            <div class="row">
                <div class="col-25">
                    <label for="fname">Name</label>
                </div>
                <div class="col-75">
                    <input class="darkEmptyLightBackground darkEmptyTextWhite" type="text" id="contryNameInsert"/>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <span id="insertContryStatus"></span>
                    <button class="adminModeratorButtonColor buttonDisable" disabled id="insertContryButton">Insert</button>
                </div>
            </div>
        </div>


        <div class="cistac"></div>
    </div>
        <div class="cistac"></div>
    </div>                  

    <script type="text/javascript" src="assets/js/moderator.js"></script>
    <script type="text/javascript" src="assets/js/cekiran.js"></script>  
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: 'models/moderator/news/ckeditorImage.php',
        filebrowserUploadMethod: 'form'
    });

    var e = CKEDITOR.instances['summary-ckeditor']
    e.on('change', function( e ){
        newsValidationModerator();
    });

</script>




                
            

                

        