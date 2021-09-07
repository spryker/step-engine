<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\StepEngine\Dependency\Form;

interface SubFormInterface
{
    /**
     * @var string
     */
    public const OPTIONS_FIELD_NAME = 'select_options';

    /**
     * @return string
     */
    public function getPropertyPath();

    /**
     * @return string
     */
    public function getName();
}
