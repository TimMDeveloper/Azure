<?php 
	include_once 'header.php'; 
	if(isset($_GET['delete'])) { 
		$delete = DB::Escape($_GET[ 'delete']); 
		$query =  DB::Query( "DELETE FROM comments_news WHERE id='$delete'"); 
	} 
?>
<div class="contentLeft" style="width: 28%;">
    <div class="mainBox">
        <div class="boxHeader darkBlue">Archief</div>
        <?php 
        $queryNewsArchief = DB::Query("SELECT * FROM cms_news ORDER BY id DESC"); 
        while($rowNewsArchief = DB::Fetch($queryNewsArchief)) 
        { 
        	?>
	        <div class="newsArchief">
	            <a style="color:black;" href="/?url=news&id=<?= $rowNewsArchief['id'] ?>">» <?php echo $rowNewsArchief['title'] ?></a>
	            <br>
	        </div>
        	<?php 
        } 
        ?>
    </div>
    <div class="mainBox">
        <div class="boxHeader darkBlue">Auteurs</div>
        <div style="margin-left: 5px;margin-right: 5px;">
            <div id="comments">
                <?php 
                if(isset($_GET['id']) && DB::NumRowsQuery("SELECT * FROM cms_news WHERE id = '".filter($_GET['id'])."'") == 1)
                { 
                	$getNews = DB::Fetch(DB::Query("SELECT * FROM cms_news WHERE id = '".filter($_GET['id'])."'")); 
                } 
                else
                { 
                	$getNews = DB::Fetch(DB::Query("SELECT * FROM cms_news ORDER BY id DESC")); 
                }
                $getNewsAuthors = DB::Query("SELECT * FROM cms_news_authors WHERE news_id = '".filter($getNews['id'])."'");
                while($getAuthors = DB::Fetch($getNewsAuthors))
                {
                 	?>
	                <div class="newsComment" style="min-height:54px;margin-left:-1px;margin-top:-1px">
	                    <div class="commentUser hastip" title="" style="float: right; background:url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?php echo User::data($getAuthors['username'], 'username', 'figure'); ?>&amp;direction=4&amp;head_direction=4&amp;action=std=6&amp;size=m);height:70px;width:64px;margin-top:-16px;"></div>
	                    <div class="newsCommentHeadline" style="margin-left:5px;">
	                        <div style="margin-left:0px;margin-top:7px;margin-bottom:5px;font-size:11px;">
	                            <b><?= $getAuthors['username']; ?></b>
	                            <br>Motto:
	                            <?php echo User::data($getAuthors['username'], 'username', 'motto'); ?>
	                            <br>Rank:
	                            <?php echo $rank[User::data($getAuthors['username'], 'username', 'rank')]; ?>
	                        </div>
	                    </div>
	                </div>
                	<?php 
                } 
                ?>
            </div>
        </div>
    </div>
    <div class="mainBox">
        <div class="boxHeader darkBlue">Reageer</div>
        <div id="succesBoxNews"></div>
        <div id="errorBoxNews"></div>
        <form action="#" method="POST">
        	<input type="hidden" id="newsId" value="<?= $getNews['id'] ?>">
            <textarea style="width:99%;" id="comment" onkeyup="checkLength(this.value, 'comment', 4)" rows="6" name="comment" placeholder="Schrijf hier je reactie"></textarea>
            <div style="width:304px;" type="submit" id="submitComment" name="submitComment">Verzend reactie</div>
        </form>
    </div>
</div>
<div class="contentRight" style="width: 71%;">
    <div class="mainBox">
        <div class="boxHeader darkBlue">
            <?= $getNews['title'] ?>
        </div>
        <div style="margin-left: 5px;margin-right: 5px;">
            <?=htmlspecialchars_decode($getNews['longstory']) ?>
        </div>
    </div>
    <div class="mainBox">
        <div class="boxHeader darkBlue">Reacties</div>
        <div style="margin-left: 5px;margin-right: 5px;">
            <div id="comments">
                <?php
                $queryGetNewsReactions = DB::Query("SELECT * FROM comments_news WHERE news_id = '".$getNews['id']."' && status = '1' ORDER by id DESC"); 
                if (DB::NumRows($queryGetNewsReactions) == 0)
                {
                	error("Er zijn geen reacties gevonden.");
                }
                else
                {
	                while ($newsReaction = DB::Fetch($queryGetNewsReactions))
	               	{
	               			if (in_array(User::userData("rank"), $allowedDeleteNewsReactions))
	               			{
	               			?>
			                <form method="POST" style="margin-right:0px;float:left;">
		                		<input id="deleteReaction" name="deleteReaction" value="<?= $newsReaction['id'] ?>" type="hidden">
			                    <div id="deleteReactionSubmit" name="deleteReactionSubmit" class="newsRemove"><i class="fa fa-trash"></i></div>
			                </form>
			                <?php
			            	}
			            	else
			            	{
			            		?>
			            		<form method="POST" style="margin-right:0px;float:left;">
				                    <div id="reportReaction" name="report" value="<?= $newsReaction['id'] ?>" type="submit" class="newsRemove"><i class="fa fa-flag"></i></div>
				                </form>
			            		<?php
			            	}
			            	?>
	                		<div class="newsComment" id="newsComment<?= $newsReaction['id'] ?>" style="min-height:54px;margin-left:-1px;margin-top:-1px">
			                    <div class="commentUser hastip" title="" style="float: right; background:url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?= User::data($newsReaction['user_id'], 'id', 'figure'); ?>&amp;direction=4&amp;head_direction=4&amp;action=std=6&amp;size=m);height:70px;width:64px;margin-top:-16px;"></div>
			                    <div class="newsCommentHeadline" style="margin-left:5px;">
			                        <div style="margin-left:20px;margin-top:7px;margin-bottom:5px;font-size:11px;">
			                            <b><?= User::data($newsReaction['user_id'], "id", "username") ?></b> reageerde op
			                            <?= getFullyDate($newsReaction['time']) ?>
	                                    <br>
	                                    <?= Core::checkWordFilter($newsReaction['news_comment']); ?>
			                        </div>
			                    </div>
	                		</div>
	                <?php 
	                } 
	            }
                ?>
            </div>
            <div id="commentBoxjQuery"></div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>