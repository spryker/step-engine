<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Yves\StepEngine\Process\Fixtures;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;

class StepMockWithBreadcrumbs extends StepMock implements StepWithBreadcrumbInterface
{
    public function getBreadcrumbItemTitle(): string
    {
        return $this->getStepRoute();
    }

    public function isBreadcrumbItemEnabled(AbstractTransfer $dataTransfer): bool
    {
        return $this->postCondition($dataTransfer);
    }

    public function isBreadcrumbItemHidden(AbstractTransfer $dataTransfer): bool
    {
        return !$this->requireInput($dataTransfer);
    }
}
