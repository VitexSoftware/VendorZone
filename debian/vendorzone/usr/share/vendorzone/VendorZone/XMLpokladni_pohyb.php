<?php
/**
 * Description of SysXMLpokladni-pohyb.
 *
 * @author vitex
 */
namespace VendorZone;

class XMLpokladni_pohyb extends XML
{
    public function __construct($data = null, $tagProperties = null, $content = null)
    {
        parent::__construct('pokladni-pohyb', $tagProperties, $content);
        $this->populate($data);
    }
}
