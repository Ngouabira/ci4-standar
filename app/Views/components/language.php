<div>
    <form class="btn" method="POST" action="/translate">
        <?=csrf_field()?>
        <input type="hidden" name="lang" value="fr">
        <button type="submit" class="btn btn-sm"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i><?=lang('language.french')?></button>
    </form>
</div>
<div>
    <form class="btn" method="POST" action="/translate">
        <?=csrf_field()?>
        <input type="hidden" name="lang" value="en">
        <button type="submit" class="btn btn-sm"><i class="flag-icon flag-icon-us" title="en" id="en"></i><?=lang('language.english')?></button>
    </form>
</div>
<div>
    <form class="btn" method="POST" action="/translate">
        <?=csrf_field()?>
        <input type="hidden" name="lang" value="it">
        <button type="submit" class="btn btn-sm"><i class="flag-icon flag-icon-it" title="it" id="it"></i><?=lang('language.italian')?></button>
    </form>
</div>