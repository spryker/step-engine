<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\StepEngine\Form;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use Spryker\Yves\StepEngine\Exception\InvalidFormHandleRequest;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormCollectionHandler implements FormCollectionHandlerInterface
{
    /**
     * @var array<\Symfony\Component\Form\FormTypeInterface|string>
     */
    protected $formTypes;

    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface|null
     */
    protected $dataProvider;

    /**
     * @var array<\Symfony\Component\Form\FormInterface>
     */
    protected $forms = [];

    /**
     * @param array<\Symfony\Component\Form\FormTypeInterface|string> $formTypes
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface|null $dataProvider
     */
    public function __construct(
        array $formTypes,
        FormFactoryInterface $formFactory,
        ?StepEngineFormDataProviderInterface $dataProvider = null
    ) {
        $this->formTypes = $formTypes;
        $this->formFactory = $formFactory;
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return array<\Symfony\Component\Form\FormInterface>
     */
    public function getForms(AbstractTransfer $abstractTransfer)
    {
        if (!$this->forms) {
            $this->forms = $this->createForms($abstractTransfer);
        }

        return $this->forms;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function hasSubmittedForm(Request $request, AbstractTransfer $abstractTransfer)
    {
        foreach ($this->getForms($abstractTransfer) as $form) {
            if ($request->request->has($form->getName())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @throws \Spryker\Yves\StepEngine\Exception\InvalidFormHandleRequest
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function handleRequest(Request $request, AbstractTransfer $abstractTransfer)
    {
        foreach ($this->getForms($abstractTransfer) as $form) {
            if ($request->request->has($form->getName())) {
                $form->setData($abstractTransfer);

                return $form->handleRequest($request);
            }
        }

        throw new InvalidFormHandleRequest('Form to handle not found in Request.');
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return void
     */
    public function provideDefaultFormData(AbstractTransfer $abstractTransfer)
    {
        $abstractTransfer = $this->getFormData($abstractTransfer);

        foreach ($this->getForms($abstractTransfer) as $form) {
            $form->setData($abstractTransfer);
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function getFormData(AbstractTransfer $abstractTransfer)
    {
        if ($this->dataProvider !== null) {
            return $this->dataProvider->getData($abstractTransfer);
        }

        return $abstractTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return array<\Symfony\Component\Form\FormInterface>
     */
    protected function createForms(AbstractTransfer $abstractTransfer)
    {
        $forms = [];
        foreach ($this->formTypes as $formType) {
            $forms[] = $this->createForm($formType, $abstractTransfer);
        }

        return $forms;
    }

    /**
     * @param \Symfony\Component\Form\FormTypeInterface|string $formType
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function createForm($formType, AbstractTransfer $abstractTransfer)
    {
        $formOptions = [
            'data_class' => get_class($abstractTransfer),
        ];

        if ($this->dataProvider) {
            $formOptions = array_merge($formOptions, $this->dataProvider->getOptions($abstractTransfer));
        }

        if ($formType instanceof FormInterface) {
            return $formType;
        }

        return $this->formFactory->create(is_object($formType) ? get_class($formType) : $formType, null, $formOptions);
    }
}
