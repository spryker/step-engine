<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Yves\StepEngine\Process;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\DataContainer\DataContainerInterface;
use Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface;
use Spryker\Yves\StepEngine\Process\StepEngine;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Yves
 * @group StepEngine
 * @group Process
 * @group StepEngineTest
 * Add your own group annotations below this line
 */
class StepEngineTest extends AbstractStepEngineTest
{
    /**
     * @var string
     */
    public const FORM_NAME = 'formName';

    /**
     * @return void
     */
    public function testProcessReturnRedirectResponseWithEscapeUrlOfCurrentStepWhenPreConditionNotFulfilled(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMock = $this->getStepMock(false, false, false, '', static::ESCAPE_ROUTE);
        $stepCollection->addStep($stepMock);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());
        $response = $stepEngine->process($this->getRequest());

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame(static::ESCAPE_URL, $response->getTargetUrl());
    }

    /**
     * @return void
     */
    public function testProcessReturnRedirectResponseWithUrlOfCurrentStepWhenStepCanNotAccessed(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMock = $this->getStepMock(true, false, false, static::STEP_ROUTE_A, static::ESCAPE_ROUTE);
        $stepCollection->addStep($stepMock);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());
        $response = $stepEngine->process($this->getRequest());

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame(static::STEP_URL_A, $response->getTargetUrl());
    }

    /**
     * @return void
     */
    public function testProcessReturnRedirectResponseWithUrlOfNextStepWhenStepNeedNoInput(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMockA = $this->getStepMock(true, true, false, static::STEP_ROUTE_A, static::ESCAPE_ROUTE);
        $stepCollection->addStep($stepMockA);

        $stepMockB = $this->getStepMock(true, false, false, static::STEP_ROUTE_B, static::ESCAPE_ROUTE);
        $stepCollection->addStep($stepMockB);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());
        $response = $stepEngine->process($this->getRequest(static::STEP_ROUTE_A));

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame(static::STEP_URL_B, $response->getTargetUrl());
    }

    /**
     * @return void
     */
    public function testProcessReturnViewDataWhenNoFormHandlerGiven(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMockA = $this->getStepMock(true, true, true, static::STEP_ROUTE_A);
        $stepCollection->addStep($stepMockA);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());
        $response = $stepEngine->process($this->getRequest(static::STEP_ROUTE_A));

        $this->assertIsArray($response);
        $this->assertArrayHasKey('previousStepUrl', $response);
    }

    /**
     * @return void
     */
    public function testProcessReturnViewDataWhenFormCollectionHasNoSubmittedForm(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMockA = $this->getStepMock(true, true, true, static::STEP_ROUTE_A);
        $stepCollection->addStep($stepMockA);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());
        $formCollectionHandlerMock = $this->getFormCollectionHandlerMock();
        $formCollectionHandlerMock->method('hasSubmittedForm')->willReturn(false);

        $formMock = $this->getFormMock();
        $formMock->method('getName')->willReturn(static::FORM_NAME);
        $formMock->method('createView')->willReturn($this->getFormView());

        $formCollectionHandlerMock->method('getForms')->willReturn([$formMock]);

        $response = $stepEngine->process($this->getRequest(static::STEP_ROUTE_A), $formCollectionHandlerMock);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('previousStepUrl', $response);
        $this->assertArrayHasKey(static::FORM_NAME, $response);
    }

    /**
     * @return void
     */
    public function testProcessReturnRedirectResponseWithUrlToNextStepWhenFormValid(): void
    {
        $stepCollection = $this->getStepCollection();
        $stepMockA = $this->getStepMock(true, true, true, static::STEP_ROUTE_A);
        $stepCollection->addStep($stepMockA);

        $stepMockB = $this->getStepMock(true, true, true, static::STEP_ROUTE_B);
        $stepCollection->addStep($stepMockB);

        $stepEngine = new StepEngine($stepCollection, $this->getDataContainerMock());

        $formCollectionHandlerMock = $this->getFormCollectionHandlerMock();
        $formCollectionHandlerMock->method('hasSubmittedForm')->willReturn(true);

        $dataTransferMock = $this->getDataTransferMock();
        $dataTransferMock->method('modifiedToArray')->willReturn([]);

        $formMock = $this->getFormMock();
        $formMock->method('isValid')->willReturn(true);
        $formMock->method('isSubmitted')->willReturn(true);
        $formMock->method('getData')->willReturn($dataTransferMock);

        $formCollectionHandlerMock->expects($this->once())->method('handleRequest')->willReturn($formMock);

        $response = $stepEngine->process($this->getRequest(static::STEP_ROUTE_A), $formCollectionHandlerMock);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertSame(static::STEP_URL_B, $response->getTargetUrl());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Form\FormInterface
     */
    protected function getFormMock(): FormInterface
    {
        return $this->getMockBuilder(FormInterface::class)->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Form\FormView
     */
    protected function getFormView(): FormView
    {
        return $this->getMockBuilder(FormView::class)->getMock();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\StepEngine\Form\FormCollectionHandlerInterface
     */
    protected function getFormCollectionHandlerMock(): FormCollectionHandlerInterface
    {
        return $this->getMockBuilder(FormCollectionHandlerInterface::class)->getMock();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer|null $dataTransfer
     *
     * @return \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\StepEngine\Dependency\DataContainer\DataContainerInterface
     */
    private function getDataContainerMock(?AbstractTransfer $dataTransfer = null): DataContainerInterface
    {
        $dataContainerMock = $this->getMockBuilder(DataContainerInterface::class)->getMock();

        if ($dataTransfer) {
            $dataContainerMock->method('get')->willReturn($dataTransfer);
        } else {
            $dataContainerMock->method('get')->willReturn($this->getDataTransferMock());
        }

        return $dataContainerMock;
    }
}
