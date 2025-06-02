<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\StepEngine\Form;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Symfony\Component\HttpFoundation\Request;

interface FormCollectionHandlerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return array<\Symfony\Component\Form\FormInterface>
     */
    public function getForms(AbstractTransfer $abstractTransfer);

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return bool
     */
    public function hasSubmittedForm(Request $request, AbstractTransfer $abstractTransfer);

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return \Symfony\Component\Form\FormInterface|null
     */
    public function handleRequest(Request $request, AbstractTransfer $abstractTransfer);

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $abstractTransfer
     *
     * @return void
     */
    public function provideDefaultFormData(AbstractTransfer $abstractTransfer);
}
