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
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function preCondition(AbstractTransfer $abstractTransfer): bool
    {
        return true;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $abstractTransfer): bool
    {
        return true;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return void
     */
    public function execute(Request $request, AbstractTransfer $abstractTransfer): void
    {
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $abstractTransfer): bool
    {
        return true;
    }
}
