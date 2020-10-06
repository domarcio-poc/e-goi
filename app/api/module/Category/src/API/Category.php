<?php

declare(strict_types=1);

namespace Category\API;

use Category\Repository\CategoryInterface;
use Exception;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Filter\{StaticFilter, StringTrim, StripTags};
use Zend\InputFilter\{InputFilter, Input};
use Zend\Validator\NotEmpty;

final class Category extends AbstractRestfulController
{
    protected CategoryInterface $repository;

    public function __construct(CategoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === 0) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel();
        }

        try {
            $category = $this->repository->get($id);
        } catch (Exception $e) {
            $this->getResponse()->setStatusCode($e->getCode());
            return new JsonModel(['message' => $e->getMessage()]);
        }

        return new JsonModel($category->getArrayCopy());
    }

    public function getList()
    {
        $limit      = 5;
        $offset     = (int) $this->params()->fromQuery('offset') ?? 1;

        $filterName = new Input('filter_name');
        $filterName->getFilterChain()
            ->attach(new StripTags())
            ->attach(new StringTrim());

        $inputFilter = new InputFilter();
        $inputFilter->add($filterName);
        $inputFilter->setData(['filter_name' => $this->params()->fromQuery('filterName')]);

        $all        = $this->repository->all($offset, $limit, $inputFilter->getValue('filter_name'));
        $items      = $all->getCurrentItems()->getArrayCopy();
        $categories = [];

        if (! empty($items)) {
            array_walk(
                $items,
                function ($value) use (&$categories) {
                    $categories[] = $value;
                }
            );
        }

        return new JsonModel([
            'categories' => $categories,
            'total'      => $all->count(),
            'offset'     => $offset,
            'limit'      => $limit,
        ]);
    }

    public function create($data)
    {
        $name = new Input('name');
        $name->getFilterChain()
            ->attach(new StripTags())
            ->attach(new StringTrim());
        $name->getValidatorChain()
            ->attach(new NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);
        $inputFilter->setData($data);

        if (! $inputFilter->isValid()) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel(['message' => 'Invalid name']);
        }

        $category = null;

        try {
            $category = $this->repository->create($name->getValue());
        } catch (Exception $e) {
            $this->getResponse()->setStatusCode($e->getCode());
            return new JsonModel(['message' => $e->getMessage()]);
        }

        return new JsonModel($category->getArrayCopy());
    }

    public function patch($id, $data)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $name = new Input('name');
        $name->getFilterChain()
            ->attach(new StripTags())
            ->attach(new StringTrim());
        $name->getValidatorChain()
            ->attach(new NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);
        $inputFilter->setData($data);

        if (! $inputFilter->isValid() || $id === 0) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel(['message' => 'Name or ID invalid']);
        }

        try {
            $this->repository->update($id, $name->getValue());
        } catch (Exception $e) {
            $this->getResponse()->setStatusCode($e->getCode());
            return new JsonModel(['message' => $e->getMessage()]);
        }

        $this->getResponse()->setStatusCode(204);
        return new JsonModel();
    }

    public function delete($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        try {
            $this->repository->delete($id);
        } catch (Exception $e) {
            $this->getResponse()->setStatusCode($e->getCode());
            return new JsonModel(['message' => $e->getMessage()]);
        }

        $this->response->setStatusCode(204);
        return new JsonModel();
    }
}
