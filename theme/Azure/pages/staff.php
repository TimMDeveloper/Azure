<?php
	include_once "theme/Azure/pages/header.php";
?>
<div class="contentLeft">
			<?php
			$getRanks = DB::Query("SELECT * FROM ranks WHERE id >= '3' ORDER BY id DESC");
			while ($ranks = DB::Fetch($getRanks))
			{
				if($ranks['id'] == '8') 
				{
					?>
					<div class="mainBox" style="float;left">
						<div class="boxHeader" style="background-color: <?= $rankColors[2] ?>;"><?= $rank[2] ?></div>
					<?php
					$sqlGetUsersByRankDev = DB::Query("SELECT * FROM players WHERE rank = '2'");
					while ($getUsersDev = DB::Fetch($sqlGetUsersByRankDev))
					{
						?>
						<div class="staffUser">
							<div class="circle staffMember" style="border:2px dotted <?= $rankColors[2] ?>;background: url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?= $getUsersDev['figure'] ?>&amp;head_direction=2&amp;direction=2&amp;gesture=sml) rgba(255, 255, 255, 0.2) -2px -16px no-repeat;"></div>						
							<div class="StaffMemberInfo" style="margin-left:77px;">
								<b><a href="index.php?url=home&username=<?= $getUsersDev['username'] ?>"><?= $getUsersDev['username'] ?></a></b><br><img src="theme/<?php echo $config['skin'];?>/images/<?php echo ($getUsersDev['online'] == '1') ? "online" : "offline" ?>.gif"><br><?= $getUsersDev['motto'] ?></div>
						</div>
						<?php
					}
					echo "</div>";
				}
				?>

				<div class="mainBox" style="float;left">
					<div class="boxHeader" style="background-color: <?= $rankColors[$ranks['id']] ?>;"><?= $ranks['name'] ?></div>
				<?php
				$sqlGetUsersByRank = DB::Query("SELECT * FROM players WHERE rank = '".$ranks['id']."'");
				while ($getUsers = DB::Fetch($sqlGetUsersByRank))
				{
					?>
					<div class="staffUser">
						<div class="circle staffMember" style="border:2px dotted <?= $rankColors[$ranks['id']] ?>;background: url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?= $getUsers['figure'] ?>&amp;head_direction=2&amp;direction=2&amp;gesture=sml) rgba(255, 255, 255, 0.2) 0px -16px no-repeat;"></div>
						<div class="StaffMemberInfo" style="margin-left:77px;">
							<b><a href="index.php?url=home&username=<?= $getUsers['username'] ?>"><?= $getUsers['username'] ?></a></b><br><img src="theme/<?php echo $config['skin'];?>/images/<?php echo ($getUsers['online'] == '1') ? "online" : "offline" ?>.gif"><br><?= $getUsers['motto'] ?></div>
					</div>
					<?php
				}
				?>
				</div>
				<?php
			}
			?>
			<?php
			?>
	</div>
<?php
	include_once'footer.php';
?>