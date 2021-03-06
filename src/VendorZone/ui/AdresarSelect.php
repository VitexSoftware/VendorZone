<?php

/**
 * vendorzone - Stránka Webu.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2017 VitexSoftware v.s.cz
 */
namespace VendorZone\ui;

class AdresarSelect extends \Ease\Html\InputTextTag
{
    public function finalize()
    {
        $this->setTagID('AdresarSelect');
        \Ease\Shared::webPage()->includeJavaScript('js/handlebars.js');
        \Ease\Shared::webPage()->includeJavaScript('js/typeahead.bundle.js');

        \Ease\Shared::webPage()->addJavaScript('


var addresses = new Bloodhound({
    limit: 1000,
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace(\'value\'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: \'searcher.php?class=SysAdresar&q=%QUERY\',
      wildcard: \'%QUERY\'
    }
});

addresses.initialize();

$(\'input[name="'.$this->getTagName().'"]\').typeahead(null, {
    displayKey: \'name\',
    limit: 1000,
    minLength: 3,
    highlight: true,
    select: function( event,suggest ) { alert( suggest ) },
    source: addresses.ttAdapter(),
     templates: {
        suggestion: Handlebars.compile(\'<p><small>{{type}} #<span class="idkey">{{id}}</span></small><br><strong>{{name}}</strong> – {{what}}</p>\')
    }
});

$(".twitter-typeahead").css("display","block");
', null, true);
    }
}
