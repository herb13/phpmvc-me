<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
	<div class='comment'>
	<?=$comment['avatar']?>	
	<h4 class='comment-heading'>Kommentar #<?=$id?><span class='timestamp'> | Skapad: <?=date("Y-m-d H:i:s",$comment['timestamp'])?></span><span class='contributor'> | Av: <?=$comment['name']?></span></h4>
	<form method=post>	
		<span class='content'><p><?=$comment['content']?></p></span>
		<span class='contactinfo'>Mail: <?=$comment['mail']?> | Webbsida: <?=$comment['web']?></span>
		<p class='commentButton'>
			<input type=hidden name="redirect" value="<?=$this->url->create( $this->request->getCurrentUrl() )?>">
			<input type=hidden name="id" value="<?=$id?>">
			<input class='edit' type="submit" name="doEdit" value="Redigera kommentar" onClick="this.form.action = '<?=$this->url->create($pageUrl . '/edit/' . $id)?>'"/>
			<input class='delete' type="submit" name="doDelete" value="Ta bort kommentar" onClick="this.form.action = '<?=$this->url->create($pageUrl . '/delete/' . $id)?>'"/>
		</p>
	</form>
	</div>
<?php endforeach; ?>
</div>
<?php endif; ?>