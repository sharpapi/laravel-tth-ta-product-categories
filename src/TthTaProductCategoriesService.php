<?php

declare(strict_types=1);

namespace SharpAPI\TthTaProductCategories;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * @api
 */
class TthTaProductCategoriesService extends SharpApiClient
{
    /**
     * Initializes a new instance of the class.
     *
     * @throws InvalidArgumentException if the API key is empty.
     */
    public function __construct()
    {
        parent::__construct(config('sharpapi-tth-ta-product-categories.api_key'));
        $this->setApiBaseUrl(
            config(
                'sharpapi-tth-ta-product-categories.base_url',
                'https://sharpapi.com/api/v1'
            )
        );
        $this->setApiJobStatusPollingInterval(
            (int) config(
                'sharpapi-tth-ta-product-categories.api_job_status_polling_interval',
                5)
        );
        $this->setApiJobStatusPollingWait(
            (int) config(
                'sharpapi-tth-ta-product-categories.api_job_status_polling_wait',
                180)
        );
        $this->setUserAgent('SharpAPILaravelTthTaProductCategories/1.0.0');
    }

    /**
     * Generates a list of suitable categories for the Tours & Activities product
     * with relevance weights as float value (1.0-10.0) where 10 equals 100%, the highest relevance score.
     * Provide the product name and its parameters to get the best category matches possible.
     * Comes in handy with populating product catalogue data and bulk product processing.
     *
     * @param string $productName The name of the product to categorize
     * @param string|null $city The city related to the product (optional)
     * @param string|null $country The country related to the product (optional)
     * @param string|null $language The language for the response (optional)
     * @param int|null $maxQuantity Maximum number of categories to return (optional)
     * @param string|null $voiceTone The tone of voice for the response (optional)
     * @param string|null $context Additional context for better categorization (optional)
     * @return string The categorization result or an error message
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function toursAndActivitiesProductCategories(
        string $productName,
        ?string $city = null,
        ?string $country = null,
        ?string $language = null,
        ?int $maxQuantity = null,
        ?string $voiceTone = null,
        ?string $context = null
    ): string {
        $response = $this->makeRequest(
            'POST',
            '/tth/ta_product_categories',
            [
                'content' => $productName,
                'city' => $city,
                'country' => $country,
                'language' => $language,
                'max_quantity' => $maxQuantity,
                'voice_tone' => $voiceTone,
                'context' => $context,
            ]
        );

        return $this->parseStatusUrl($response);
    }
}