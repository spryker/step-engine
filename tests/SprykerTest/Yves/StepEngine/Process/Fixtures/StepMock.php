<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Yves\StepEngine\Process\Fixtures;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepInterface;
use Symfony\Component\HttpFoundation\Request;

class StepMock implements StepInterface
{
    /**
     * @var bool
     */
    protected $postCondition;

    /**
     * @var bool
     */
    protected $preCondition;

    /**
     * @var bool
     */
    protected $requireInput;

    /**
     * @var string
     */
    protected $stepRoute;

    /**
     * @var string|null
     */
    protected $escapeRoute;

    /**
     * @param bool $preCondition
     * @param bool $postCondition
     * @param bool $requireInput
     * @param string $stepRoute
     * @param string|null $escapeRoute
     */
    public function __construct(
        bool $preCondition = true,
        bool $postCondition = true,
        bool $requireInput = true,
        string $stepRoute = '',
        ?string $escapeRoute = null
    ) {
        $this->preCondition = $preCondition;
        $this->postCondition = $postCondition;
        $this->requireInput = $requireInput;
        $this->stepRoute = $stepRoute;
        $this->escapeRoute = $escapeRoute;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function preCondition(AbstractTransfer $abstractTransfer): bool
    {
        return $this->preCondition;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $abstractTransfer): bool
    {
        return $this->requireInput;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function execute(Request $request, AbstractTransfer $abstractTransfer): AbstractTransfer
    {
        return $abstractTransfer;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $abstractTransfer): bool
    {
        return $this->postCondition;
    }

    /**
     * @return string
     */
    public function getStepRoute(): string
    {
        return $this->stepRoute;
    }

    /**
     * @return string|null
     */
    public function getEscapeRoute(): ?string
    {
        return $this->escapeRoute;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return array
     */
    public function getTemplateVariables(AbstractTransfer $abstractTransfer): array
    {
        return [];
    }
}
