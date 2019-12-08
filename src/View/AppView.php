<?php

namespace App\View;

use Cake\View\View;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Event\EventManager;
use \Smarty;

class AppView extends View
{
    public function initialize()
    { }
    protected $_smarty = null;
    public function __construct(Request $request = null, Response $response = null, EventManager $eventManager = null, array $viewOptions = [])
    {
        $this->_smarty = new Smarty();
        $this->_smarty->compile_dir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/Smarty/templates_c';
        $this->_smarty->cache_dir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/Smarty/cache';
        $this->_smarty->config_dir = $_SERVER["DOCUMENT_ROOT"] . '/tmp/Smarty/configs';
        $this->_smarty->error_reporting = 'E_ALL & ~E_NOTICE';
        $this->_smarty->debugging = true;
        $this->_smarty->caching = 0;
        $this->_smarty->clearCompiledTemplate();
        parent::__construct($request, $response, $eventManager, $viewOptions);
    }
    protected function _evaluate($viewFile, $dataForView)
    {
        foreach ($dataForView as $key => $val) {
            $this->_smarty->assign($key, $val);
        }
        $this->_smarty->assignByRef('this', $this);
        if (@$dataForView["error"] !== null) {
            return parent::_evaluate($viewFile, $dataForView);
        }
        return $this->_smarty->fetch($viewFile);
    }
}
