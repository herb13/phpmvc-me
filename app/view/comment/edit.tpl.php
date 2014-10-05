<div class='edit-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($this->request->getBaseUrl() . "/" . $pageUrl)?>">
        <fieldset class='comment-form'>
        <legend>Redigera kommentar</legend>
        <p><label>Kommentar:<br/><textarea><?=$content?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>E-post:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doUpdate' value='Spara kommentar' onClick="this.form.action = '<?=$this->url->create($pageUrl . '/update/' . $id)?>'"/>
            <input type='reset' value='Reset'/>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>