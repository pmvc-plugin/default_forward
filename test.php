<?php
PMVC\Load::plug();
PMVC\addPlugInFolders(['../']);
class Default_forwardTest extends PHPUnit_Framework_TestCase
{
    private $_plug = 'default_forward';

    function teardown()
    {
        \PMVC\unPlug($this->_plug);
    }

    function testPlugin()
    {
        ob_start();
        print_r(PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertContains($this->_plug,$output);
    }

    function testAddDefaultForward()
    {
        $url = \PMVC\plug('url',[ 
            'SCRIPT_NAME'=>'/yo/'
        ]);
        $p = PMVC\plug($this->_plug);
        $p->onMapRequest();
        $c = \PMVC\plug('controller');
        $mapping = $c->getMappings();

        $this->assertTrue($mapping->forwardExists('debug'));
        $this->assertTrue($mapping->forwardExists('error'));
    }

}
