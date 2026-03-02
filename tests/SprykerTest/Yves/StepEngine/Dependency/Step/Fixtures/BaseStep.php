<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Yves\StepEngine\Dependency\Step\Fixtures;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\AbstractBaseStep;
use Symfony\Component\HttpFoundation\Request;

class BaseStep extends AbstractBaseStep
{
    public function preCondition(AbstractTransfer $dataTransfer): bool
    {
        return true;
    }

    public function requireInput(AbstractTransfer $dataTransfer): bool
    {
        return true;
    }

    public function execute(Request $request, AbstractTransfer $dataTransfer): void
    {
    }

    public function postCondition(AbstractTransfer $dataTransfer): bool
    {
        return true;
    }
}
