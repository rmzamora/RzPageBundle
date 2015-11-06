<?php

namespace Rz\PageBundle\Admin;

use Sonata\PageBundle\Admin\SharedBlockAdmin as Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\PageBundle\Entity\BaseBlock;

/**
 * Admin class for shared Block model.
 *
 * @author Romain Mouillard <romain.mouillard@gmail.com>
 */
class SharedBlockAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('type')
            ->add('enabled', null, array('editable' => true))
            ->add('updatedAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var BaseBlock $block */
        $block = $this->getSubject();

        // New block
        if ($block->getId() === null) {
            $block->setType($this->request->get('type'));
        }

        $formMapper
            ->with('form.field_group_general')
                ->add('name', null, array('required' => true))
                ->add('enabled')
            ->end();

        $formMapper->with('form.field_group_options');

        /** @var BaseBlockService $service */
        $service = $this->blockManager->get($block);

        if ($block->getId() > 0) {
            $service->buildEditForm($formMapper, $block);
        } else {
            $service->buildCreateForm($formMapper, $block);
        }

        $formMapper->end();
    }

    /**
     * {@inheritDoc).
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        // Filter on blocks without page and parents
        $query->andWhere($query->expr()->isNull($query->getRootAlias().'.page'));
        $query->andWhere($query->expr()->isNull($query->getRootAlias().'.parent'));

        return $query;
    }
}
