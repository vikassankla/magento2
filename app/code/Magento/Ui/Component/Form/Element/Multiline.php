<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Ui\Component\Form\Element;

/**
 * Class Multiline
 */
class Multiline extends AbstractFormElement
{
    const NAME = 'multiline';

    /**
     * Get component name
     *
     * @return string
     */
    public function getComponentName()
    {
        return static::NAME;
    }

    /**
     * @return mixed|string
     */
    public function getType()
    {
        return $this->getData('input_type') ? $this->getData('input_type') : 'text';
    }

    /**
     * @return void
     */
    public function prepare()
    {
        parent::prepare();
    }
}
