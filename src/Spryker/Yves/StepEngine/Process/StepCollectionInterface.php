<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\StepEngine\Process;

use IteratorAggregate;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends \IteratorAggregate<int, \Spryker\Yves\StepEngine\Dependency\Step\StepInterface>
 */
interface StepCollectionInterface extends IteratorAggregate
{
    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $step
     *
     * @return $this
     */
    public function addStep(StepInterface $step);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $step
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function canAccessStep(StepInterface $step, Request $request, AbstractTransfer $quoteTransfer);

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Step\StepInterface
     */
    public function getCurrentStep(Request $request, AbstractTransfer $quoteTransfer);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Step\StepInterface
     */
    public function getNextStep(StepInterface $currentStep);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     * @param \Generated\Shared\Transfer\QuoteTransfer|null $dataTransfer
     *
     * @return \Spryker\Yves\StepEngine\Dependency\Step\StepInterface
     */
    public function getPreviousStep(StepInterface $currentStep, ?AbstractTransfer $dataTransfer = null);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     *
     * @return string
     */
    public function getCurrentUrl(StepInterface $currentStep);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return string
     */
    public function getNextUrl(StepInterface $currentStep, AbstractTransfer $quoteTransfer);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     * @param \Generated\Shared\Transfer\QuoteTransfer|null $quoteTransfer
     *
     * @return string
     */
    public function getPreviousUrl(StepInterface $currentStep, ?AbstractTransfer $quoteTransfer = null);

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Step\StepInterface $currentStep
     *
     * @return string
     */
    public function getEscapeUrl(StepInterface $currentStep);
}
