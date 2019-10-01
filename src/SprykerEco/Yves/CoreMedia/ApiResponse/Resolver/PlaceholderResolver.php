<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\CoreMedia\ApiResponse\Resolver;

use Generated\Shared\Transfer\CoreMediaApiResponseTransfer;
use SprykerEco\Yves\CoreMedia\ApiResponse\Parser\PlaceholderParserInterface;
use SprykerEco\Yves\CoreMedia\ApiResponse\PostProcessor\PlaceholderPostProcessorInterface;
use SprykerEco\Yves\CoreMedia\ApiResponse\Replacer\PlaceholderReplacerInterface;

class PlaceholderResolver implements ApiResponseResolverInterface
{
    /**
     * @var \SprykerEco\Yves\CoreMedia\ApiResponse\Parser\PlaceholderParserInterface
     */
    protected $placeholderParser;

    /**
     * @var \SprykerEco\Yves\CoreMedia\ApiResponse\PostProcessor\PlaceholderPostProcessorInterface
     */
    protected $placeholderPostProcessor;

    /**
     * @var \SprykerEco\Yves\CoreMedia\ApiResponse\Replacer\PlaceholderReplacerInterface
     */
    protected $placeholderReplacer;

    /**
     * @param \SprykerEco\Yves\CoreMedia\ApiResponse\Parser\PlaceholderParserInterface $placeholderParser
     * @param \SprykerEco\Yves\CoreMedia\ApiResponse\PostProcessor\PlaceholderPostProcessorInterface $placeholderPostProcessor
     * @param \SprykerEco\Yves\CoreMedia\ApiResponse\Replacer\PlaceholderReplacerInterface $placeholderReplacer
     */
    public function __construct(
        PlaceholderParserInterface $placeholderParser,
        PlaceholderPostProcessorInterface $placeholderPostProcessor,
        PlaceholderReplacerInterface $placeholderReplacer
    ) {
        $this->placeholderParser = $placeholderParser;
        $this->placeholderPostProcessor = $placeholderPostProcessor;
        $this->placeholderReplacer = $placeholderReplacer;
    }

    /**
     * @param \Generated\Shared\Transfer\CoreMediaApiResponseTransfer $coreMediaApiResponseTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\CoreMediaApiResponseTransfer
     */
    public function resolve(
        CoreMediaApiResponseTransfer $coreMediaApiResponseTransfer,
        string $locale
    ): CoreMediaApiResponseTransfer {
        $coreMediaPlaceholderTransfers = $this->placeholderParser->parse($coreMediaApiResponseTransfer->getData());

        if (!$coreMediaPlaceholderTransfers) {
            return $coreMediaApiResponseTransfer;
        }

        foreach ($coreMediaPlaceholderTransfers as $coreMediaPlaceholderTransfer) {
            $coreMediaPlaceholderTransfer = $this->placeholderPostProcessor->addReplacement(
                $coreMediaPlaceholderTransfer,
                $locale
            );
            $coreMediaApiResponseTransfer->setData(
                $this->placeholderReplacer->replace(
                    $coreMediaApiResponseTransfer->getData(),
                    $coreMediaPlaceholderTransfer
                )
            );
        }

        return $coreMediaApiResponseTransfer;
    }
}