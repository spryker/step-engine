<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\StepEngine\Dependency\Step;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Symfony\Component\HttpFoundation\Request;

interface StepInterface
{
    /**
     * Requirements for this step, return true when satisfied.
     *
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function preCondition(AbstractTransfer $abstractTransfer);

    /**
     * Require input, should we render view with form or just skip step after calling execute.
     *
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function requireInput(AbstractTransfer $abstractTransfer);

    /**
     * Execute step logic, happens after form submit if provided, gets AbstractTransfer filled by form data.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function execute(Request $request, AbstractTransfer $abstractTransfer);

    /**
     * Conditions that should be met for this step to be marked as completed. returns true when satisfied.
     *
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function postCondition(AbstractTransfer $abstractTransfer);

    /**
     * Current step route.
     *
     * @return string
     */
    public function getStepRoute();

    /**
     * Escape route when preConditions are not satisfied user will be redirected to provided route.
     *
     * @return string|null
     */
    public function getEscapeRoute();

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return array
     */
    public function getTemplateVariables(AbstractTransfer $abstractTransfer);
}
