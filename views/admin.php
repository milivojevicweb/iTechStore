<?php
include "models/admin/functions.php";
accessAllowAdmin();
?>


<div  id="hiddenNavContainer"  class="darkEmptyLightBackground">
    <div id="adminModeratorHiddenNav" class="adminModeratorButtonColor darkEmptyBackround">Navigations</div>
</div>
<div class="relative darkEmptyLightBackground" id="adminPanel">

    <div id="sidebar" class="darkEmptyBackround">
        <ul class="toggle-tabs ">
            <li>
                <div  onclick="selectTab(event, 'contactAdmin')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite">
                    <span><i class="fa fa-envelope"></i>Inbox</span>
                    <span class="badge">
                        <?= contactNumber();?>
                    </span>
                </div>
            </li>
            <li>
                <div  onclick="selectTab(event, 'pageStatisticAdmin')"  class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-bar-chart"></i>Page statistic</div>
            </li>
            <li>
                <div  onclick="selectTab(event, 'logFileAdmin')" class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-file-text"></i>Log</a>
            </li>
            <li>
                <div id="adminUserButton" class="adminButtonTab darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-user"></i>User</div>
                <div onclick="selectTab(event, 'userAdmin')" class=" tablinks userButton darkEmptyTextWhite"><i class="darkEmptyTextWhite fa fa-minus"></i>All Users </div>
                <div onclick="selectTab(event, 'addUserAdmin')" class=" tablinks userButton darkEmptyTextWhite"><i class="darkEmptyTextWhite fa fa-minus"></i>Add User </div> 
            </li>
            <li>
                <div onclick="selectTab(event, 'authorAdmin')" class="adminButtonTab tablinks darkEmptyLightBackground darkEmptyTextWhite"><i class="fa fa-vcard"></i>Author</div>                                
            </li>
        </ul>
    </div>
    <div id="proizvodiDesno" class="tabbed-content-wrap">

        <div class="ordersSection tabcontent defaultOpen" id="contactAdmin">
            <button id="contactStatusButton" class="darkEmptyBackround ordersButton adminModeratorButtonColor">Sorted by status</button>
            <div id="contactStatusSection" class="filterButtonModAdmin">
                <button type="button" data-idstatus="1" class="darkEmptyBackround darkEmptyTextWhite ordersB contactStatus">Send <i class="fa fa-check success"></i></button>
                <button type="button" data-idstatus="0" class="darkEmptyBackround darkEmptyTextWhite ordersB contactStatus">Wait <i class="fa fa-close error"></i></button>
                <button type="button" data-idstatus="" class="darkEmptyBackround darkEmptyTextWhite ordersB contactStatus">Clear</button>
                <input type="hidden" id="contactStatusInput" value=""/>
            </div>
            <table class="tableAdminModerator kontakt darkEmptyBackroundTable darkEmptyTextWhite">
                <thead>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Text</th>
                    <th class="textBreakNormal" scope="col">Status</th>
                    <th scope="col">Send Message</th>

                    <th class="textBreakNormal" scope="col">Delete</th>
                </thead>
                <tbody id="teloTablele">
                <?php
                    $rezultat = getContakt();
                    foreach($rezultat as $rez):
                ?>
                    
                    <tr>
                        <td data-label="Name"><?= $rez->name?></td>
                        <td data-label="Email"><?= $rez->email ?></td>
                        <td class="textBreakNormal" data-label="Phone"><?= $rez->phone ?></td>
                        <td data-label="Text"><?= $rez->text ?></td>
                        <td data-label="Status"><?php if($rez->status==1):?><i class="fa fa-check success"></i> <?php else:?> <i class="fa fa-close error"></i> <?php endif;?></td>
                        <td data-label="Send Message"><button class="sendMessageAdmin plava adminModeratorButton" data-idcontact="<?=$rez->idContact?>" onclick="document.getElementById('sendMessageBox').style.display='block'"><i class="fa fa-send"></i></button></td>
                        <td data-label="Delete"><button type="button" class="f brisanjeKontakt adminModeratorButton" data-id="<?=$rez->idContact?>"><i class="fa fa-close"></i></button></td>
                    </tr>

                    
                    <?php endforeach; ?>
                </tbody>
            </table>

            <input type="hidden" id="pagFilterContact" value="1" />
            <div id="paginationContact" class="pagination paginationAdminMod">
            </div>
        </div>

        <div id="sendMessageBox" class="modal ">
            <div class="modalAdminModerator container5 darkEmptyLightBackground darkEmptyTextWhite">
                <div class="row">
                    <span onclick="document.getElementById('sendMessageBox').style.display='none'" class="close" title="Close Modal"><i class="darkEmptyTextWhite fa fa-close"></i></span> 
                </div>
                <div class="row">
                    <h2>Send Message</h2>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Message</label>
                    </div>
                    <div class="col-75">
                        <textarea class="darkEmptyBackround darkEmptyTextWhite" id="sendMessageTextarea"></textarea>
                        <input type="hidden" id="sendMessageId" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">

                    </div>
                    <div class="col-75">
                        <span id="sendMessageStatus"></span>
                        <button id="sendMessageAdminButton" class="darkEmptyBackround adminModeratorButtonColor">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <table  id="pageStatisticAdmin" class="tableAdminModerator adminModeratorMargin  korisnik tabcontent  darkEmptyBackroundTable darkEmptyTextWhite">
            <thead>
                <tr>
                    <th scope="col">Page name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $niz=array("home","iphone","ipad","iwatch","imac","news","vest","contact","registration","autor","user","login","admin","moderator");
                    foreach ($niz as $key => $value):?>   
                <tr>
                    <td data-label="Page name"><?=$value?></td>
                    <td data-label=""><?php echo statistikaFajl($value);?></td>
                </tr>
                <?php endforeach;?>
            </tbody>                                                                                       
        </table>

        <table  id="logFileAdmin" class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator adminModeratorMargin  korisnik log tabcontent">
            <thead>
                <tr>
                    <th scope="col">Url adresa</th>
                    <th scope="col">Ip adresa</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Strana</th>
                </tr>                          
            </thead>
            <tbody>      
                            
                <?php
                
                $open=fopen(LOG_FAJL, "r");
                $file=file(LOG_FAJL);
                foreach ($file as $key => $value):
                $explode=explode(SEPARTOR,$value);
                if(isset($explode[2])):
                if($explode[2]==date("Y/m/d")):

                ?>
                    <tr>
                        <td data-label="Url adresa"><?= $explode[0];?></td>
                        <td data-label="Ip adresa"><?= $explode[1];?></td>
                        <td data-label="Datum"><?= $explode[2];?></td>
                        <td data-label="Strana"><?= $explode[3];?></td>
                    </tr>     
                    
                <?php endif; endif; endforeach; 
                fclose($open)?>
                        

            </tbody>
        </table>

        <div id="userAdmin"  class="tabcontent adminModeratorMargin " > 
            <table class="darkEmptyBackroundTable darkEmptyTextWhite tableAdminModerator korisnik">
                <thead>
                    <tr>
                        <th scope="col">Id User</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="ispisKorisnici">
                <?php
                    $korisnici = korisniciUloge();
                    $br = 1;
                    
                    foreach($korisnici as $korisnik) :
                ?>
                <tr>
                    <td data-label="Id User"><?= $korisnik->idUser?></td>
                    <td data-label="Frist Name"><?= $korisnik->firstName ?></td>
                    <td data-label="Last Name"><?= $korisnik->lastName ?></td>
                    <td data-label="Email"><?= $korisnik->email ?></td>
                    <td data-label="Role"><?= $korisnik->name ?></td>
                    <td data-label="Edit"><a class="plava" href="index.php?page=userEdit&idUser=<?=$korisnik->idUser?>"><i class="fa fa-cog"></i></a></td>
                    <td data-label="Delete"><button type="button" class="f brisanjeKorisnika"   data-iduser="<?=$korisnik->idUser?>">X</button></td>
                </tr>
                
                    <?php endforeach; ?>
                    </tbody>
            </table>

            <input type="hidden" id="pagFilterUser" value="1" />
            <div id="paginationUser" class="pagination paginationAdminMod"></div>
        </div>

        <div id="addUserAdmin"  class="darkEmptyBackround container5 dodaj tabcontent"> 
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="fname">First Name</label>
            </div>
            <div class="col-75">
                <input type="hidden" name="idSkriveno" />
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground" id="nameAddUserAdmin" name="ime" placeholder="First Name.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="lname">Last Name</label>
            </div>
            <div class="col-75">
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground"  id="lastNameAddUserAdmin" name="prezime" placeholder="Last Name.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="lname">Email</label>
            </div>
            <div class="col-75">
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground"  id="emailAddUserAdmin" name="email" placeholder="Email.." />
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="lname">Address</label>
            </div>
            <div class="col-75">
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground"  id="addressAddUserAdmin"  placeholder="Address.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="lname">City</label>
            </div>
            <div class="col-75">
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground"  id="cityAddUserAdmin"  placeholder="City.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite"  for="lname">Zip</label>
            </div>
            <div class="col-75">
                <input type="text" class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground"  id="zipAddUserAdmin"  placeholder="Zip.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite"  for="lname">Password</label>
            </div>
            <div class="col-75">
                <input type="password"  class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground" id="passwordAddUserAdmin" name="sifra" placeholder="Password.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite"  for="lname">Repeat Password</label>
            </div>
            <div class="col-75">
                <input type="password"  class="validateAddUser darkEmptyTextWhite darkEmptyLightBackground" id="repeatPasswordAddUserAdmin" name="sifra" placeholder="Repeat Password.."/>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="country">Country</label>
            </div>
            <div class="col-75">
                <select class="selectFieldValidationAddUser darkEmptyTextWhite darkEmptyLightBackground" id="contryAddUserAdmin" >
                <option value="0">Choose..</option>
                <?php
                    $country = country();

                    foreach($country as $item):?>

                    <option value="<?= $item->idCountry ?>"><?= $item->countryName  ?></option>

                    <?php endforeach;?>
                </select>
            </div>
            </div>
            <div class="row">
            <div class="col-25">
                <label class="darkEmptyTextWhite" for="country">Role</label>
            </div>
            <div class="col-75">
                <select  class="selectFieldValidationAddUser darkEmptyTextWhite darkEmptyLightBackground" id="roleAddUserAdmin" name="uloga">
                <option value="0">Choose..</option>
                <?php
                    $role = role();

                    foreach($role as $item):?>

                    <option value="<?= $item->idRole ?>"><?= $item->name ?></option>
                
                <?php    endforeach;?>
                </select>
            </div>
            </div>
            <div class="row">
                <span id="addUserAdminStatus"></span>
            </div>
            <span id="gr"></span>
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <button type="button" disabled class="adminModeratorButtonColor buttonDisable" id="addUserAdminButton">Add User</button>
                </div>
            </div></br>
            <div class="row">
                    <p>Name: first letter uppercase</p>
            </div></br>
            <div class="row">
            <p>Last Name: first letter uppercase</p>
            </div></br>
            <div class="row">
                    <p>Password: min 8 characters, min at least 1 number,min at least 1 lowercase character,min at least 1 uppercase character.</p>
            </div>
        </div>

        <div id="authorAdmin" class="darkEmptyBackround container5 dodaj tabcontent">

            <?php $author=getAuthor(); ?>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="editAuthorName">Name</label>
                </div>
                <div class="col-75">
                <input type="text" id="editAuthorName" class=" darkEmptyTextWhite darkEmptyLightBackground" name="autorIme" value="<?=$author->nameLastName?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <label class="darkEmptyTextWhite" for="editAuthorText">Description</label>
                </div>
                <div class="col-75">
                <textarea id="editAuthorText" class=" darkEmptyTextWhite darkEmptyLightBackground"><?=$author->text?></textarea>
                </div>
            </div>
            <div class="row">
                <span id="editAuthorStatus"></span>
            </div>
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <button type="button" class="adminModeratorButtonColor" data-idauthor=<?=$author->idAuthor?> id="editAuthorButton">Edit</button>
                </div>  
                
            </div>
        </div>

        <div class="cistac"></div>
    </div>
<div class="cistac"></div>
</div>

                
    <script type="text/javascript" src="assets/js/admin.js"></script> 
    <script type="text/javascript" src="assets/js/cekiran.js"></script>  
    <script type="text/javascript" src="assets/js/main.js"></script>






                        


