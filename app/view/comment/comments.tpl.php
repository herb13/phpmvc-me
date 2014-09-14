<hr>
<h2>Kommentarer</h2>
<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
	<h4>Comment #<?=$id?></h4>
	<form method=post>
		<p><?=dump($comment)?></p>
		<p class='commentButton'>
			<input type=hidden name="redirect" value="<?=$this->url->create('guestbook')?>">
			<input type=hidden name="id" value="<?=$id?>">
			<input type="submit" name="doEdit" value="Redigera kommentar" onClick="this.form.action = '<?=$this->url->create('comment/edit/' . $id)?>'"/>
			<input type="submit" name="doDelete" value="Ta bort kommentar" onClick="this.form.action = '<?=$this->url->create('comment/delete/' . $id)?>'"/>
		</p>
	</form>
<?php endforeach; ?>
</div>
<?php endif; ?>