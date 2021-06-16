<?php

namespace Libs;

class Controller
{
    protected $template;
    protected $dao;

    public function renderView(string $view, $data=null)
    {
        // require_once '../app/views/test/saludo.phtml';

        require_once '../app/views/' . $view . '.phtml';
    }

    public function loadDirectoryTemplate(string $directory)
    {
        $this->template = new \League\Plates\Engine(MAINPATH . 'app/views/' . $directory);
        $this->template->setFileExtension('phtml');
    }

    public function loadDAO(string $daoName)
    {
        $classDAO = "App\\Daos\\" . $daoName . "DAO";
        $this->dao = new $classDAO();
    }
}
