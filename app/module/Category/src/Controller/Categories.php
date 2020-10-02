<?php

declare(strict_types=1);

namespace Category\Controller;

use Category\Repository\CategoryInterface;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class Categories extends AbstractActionController
{
    protected CategoryInterface $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
}
