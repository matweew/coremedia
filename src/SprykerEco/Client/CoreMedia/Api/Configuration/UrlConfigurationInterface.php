<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\CoreMedia\Api\Configuration;

interface UrlConfigurationInterface
{
    public function getCoreMediaHost(): string;

    public function getBasePath(): string;

    public function getStore(string $storeName): string;

    public function getLocale(string $store, string $localeName): string;
}
