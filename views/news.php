<div id="news">
    <?php
        include "models/news/functions.php";
        $news=news();
        foreach ($news as $item):  
    ?>
    <div class="omotac">
        <a href="index.php?page=oneNews&id=<?=$item->idNews?>">
        <div class="vest darkEmptyLightBackground">
        
            <div class="vestLevo">
                <img src="<?=$item->image?>" alt=""/>
            </div>
            <div class="vestDesno darkEmptyTextWhite">
                <h2 ><?=$item->title?></h2>
                <p id="datum" >News | <?=$item->date?></p>
                <p  ><?=implode(' ', array_slice(explode(' ', $item->text), 0, 30))?>...</p>                            
            </div>
        </div></a>
    </div>

    <?php endforeach;?>
</div>   
<div id="newsPaginationContainer">
    <input type="hidden" id="pagNews" value="1" />
    <div id="newsPagination" class="pagination newsPaginationMargin">
    </div>
</div>
<script type="text/javascript" src="assets/js/cekiran.js"></script>  
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/news.js"></script>