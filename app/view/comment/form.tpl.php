<form method=post>
    <input type=hidden name="redirect" value="<?=$this->url->create( $this->request->getCurrentUrl() )?>">
    <fieldset class='comment-form'>
        <legend>Skriv en kommentar</legend>
        <p><textarea placeholder='Skriv en kommentar...'><?=$content?></textarea></p>
        <input type='text' name='name' value='<?=$name?>' placeholder='Skriv ditt namn...'/>
        <input type='text' name='web' value='<?=$web?>' placeholder='Skriv in länk till hemsida...'/>
        <input type='text' name='mail' value='<?=$mail?>' placeholder='Skriv in din mailadress...'/>
        <p class=buttons>
            <input type='submit' name='doCreate' value='Spara kommentar' onClick="this.form.action = '<?=$this->url->create($pageUrl . '/add')?>'"/>
            <input type='reset' value='Reset'/>
            <input type='submit' name='doRemoveAll' value='Radera alla kommentarer' onClick="this.form.action = '<?=$this->url->create($pageUrl . '/remove-all')?>'"/>
        </p>
        <output><?=$output?></output>
    </fieldset>
</form>

