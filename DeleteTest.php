<?php

require __DIR__ . '/Delete.php';

use Algolia\AlgoliaSearch\Api\SearchClient;
use Algolia\AlgoliaSearch\Model\Search\BatchResponse;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    #[Test]
    public function canDeleteObjects(): void
    {
        $client = \Mockery::mock(SearchClient::class);
        $client->expects('create')
            ->with('YOUR_APP_ID', 'YOUR_API_KEY');
        $client->expects('deleteObjects')
            ->with('indexName', [1,2,3])
            ->andReturn([new BatchResponse(['taskID' => 12345678, 'objectIDs' => ['1', '2', '3']])]);
        $client->expects('waitForTask')
            ->with('indexName', 12345678);
        $delete = new Delete($client);
        $delete->deleteObjects();
        self::assertTrue(true);
    }
}
