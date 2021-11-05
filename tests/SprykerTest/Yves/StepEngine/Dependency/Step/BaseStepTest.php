<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Yves\StepEngine\Dependency\Step;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepInterface;
use SprykerTest\Yves\StepEngine\Dependency\Step\Fixtures\BaseStep;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Yves
 * @group StepEngine
 * @group Dependency
 * @group Step
 * @group BaseStepTest
 * Add your own group annotations below this line
 */
class BaseStepTest extends Unit
{
    /**
     * @var string
     */
    public const STEP_ROUTE = 'stepRoute';

    /**
     * @var string
     */
    public const ESCAPE_ROUTE = 'escapeRoute';

    /**
     * @return void
     */
    public function testInstantiation(): void
    {
        $baseStep = $this->getBaseStepInstance();

        $this->assertInstanceOf(StepInterface::class, $baseStep);
    }

    /**
     * @return void
     */
    public function testGetStepRoute(): void
    {
        $baseStep = $this->getBaseStepInstance();
        $this->assertSame(static::STEP_ROUTE, $baseStep->getStepRoute());
    }

    /**
     * @return void
     */
    public function testGetEscapeRoute(): void
    {
        $baseStep = $this->getBaseStepInstance();
        $this->assertSame(static::ESCAPE_ROUTE, $baseStep->getEscapeRoute());
    }

    /**
     * @return void
     */
    public function testGetTemplateVariables(): void
    {
        $baseStep = $this->getBaseStepInstance();
        $this->assertSame([], $baseStep->getTemplateVariables($this->getDataTransferMock()));
    }

    /**
     * @return \SprykerTest\Yves\StepEngine\Dependency\Step\Fixtures\BaseStep
     */
    private function getBaseStepInstance(): BaseStep
    {
        return new BaseStep(static::STEP_ROUTE, static::ESCAPE_ROUTE);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    private function getDataTransferMock(): AbstractTransfer
    {
        return $this->getMockBuilder(AbstractTransfer::class)->getMock();
    }
}
