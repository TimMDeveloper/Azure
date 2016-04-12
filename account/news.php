<?php
include_once "../includes/class.inc.php";
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