<?php

use Algolia\AlgoliaSearch\Api\SearchClient;

class Delete
{
    public function __construct(
        private readonly SearchClient $searchClient,
    ) {
        $this->searchClient::create('YOUR_APP_ID', 'YOUR_API_KEY');
    }

    public function deleteObjects(): void
    {
        $indexName = 'indexName';
        $responses = $this->searchClient->deleteObjects($indexName, [1,2,3]);
        if (!empty($responses)) {
            foreach ($responses as $response) {
                $this->searchClient->waitForTask(
                    indexName: $indexName,
                    taskId: $response->getTaskID(),
                );
            }
        }
    }
}
