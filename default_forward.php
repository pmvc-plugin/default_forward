<?php
namespace PMVC\PlugIn\default_forward;
\PMVC\initPlugin(['controller'=>null]);

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\default_forward';

class default_forward extends \PMVC\PlugIn
{
    public function onMapRequest()
    {
        $c = \PMVC\plug('controller');
        $b = new \PMVC\MappingBuilder();
        $b->addForward('dump', [
            _TYPE=>'view'
        ]);
        $b->addForward('debug', [
            _TYPE=>'view'
        ]);
        $b->addForward('error', [
           _TYPE=>'redirect',
           _PATH=>'/error'
        ]);
        $c->addMapping($b);
    }

    public function init()
    {
        \PMVC\callPlugin(
            'dispatcher',
            'attach',
            array(
                $this,
                \PMVC\Event\MAP_REQUEST
            )
        );
    }
}
