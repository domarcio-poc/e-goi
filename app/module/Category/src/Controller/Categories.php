<?php

declare(strict_types=1);

namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class Categories extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
