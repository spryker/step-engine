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

    public function preCondition(AbstractTransfer $dataTransfer): bool
    {
        return $this->preCondition;
    }

    public function requireInput(AbstractTransfer $dataTransfer): bool
    {
        return $this->requireInput;
    }

    public function execute(Request $request, AbstractTransfer $dataTransfer): AbstractTransfer
    {
        return $dataTransfer;
    }

    public function postCondition(AbstractTransfer $dataTransfer): bool
    {
        return $this->postCondition;
    }

    public function getStepRoute(): string
    {
        return $this->stepRoute;
    }

    public function getEscapeRoute(): ?string
    {
        return $this->escapeRoute;
    }

    public function getTemplateVariables(AbstractTransfer $dataTransfer): array
    {
        return [];
    }
}
