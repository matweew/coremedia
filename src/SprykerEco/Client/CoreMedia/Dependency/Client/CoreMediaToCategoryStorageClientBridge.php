<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\CoreMedia\Dependency\Client;

class CoreMediaToCategoryStorageClientBridge implements CoreMediaToCategoryStorageClientInterface
{
    /**
     * @var \Spryker\Client\CategoryStorage\CategoryStorageClientInterface
     */
    protected $categoryClient;

    /**
     * @param \Spryker\Client\CategoryStorage\CategoryStorageClientInterface $categoryClient
     */
    public function __construct($categoryClient)
    {
        $this->categoryClient = $categoryClient;
    }

    /**
     * @param int $idCategoryStorageNode
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\CategoryNodeStorageTransfer
     */
    public function getCategoryNodeById($idCategoryStorageNode, $localeName)
    {
        return $this->categoryClient->getCategoryNodeById($idCategoryStorageNode, $localeName);
    }
}
