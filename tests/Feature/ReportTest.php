<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{

    public function reportProvider()
    {
        return [
            ['TEST_AutoTagsReport', 'Zermelo'],
            ['TEST_CharTest', 'Zermelo'],
            ['TEST_graph_npi', 'ZermeloGraph'],
            ['TEST_GraphTest', 'ZermeloGraph'],
            ['TEST_LeadingZero', 'Zermelo'],
            ['TEST_ndh_endpoint', 'Zermelo'],
            ['TEST_NorthwindCustomerReport', 'Zermelo'],
            ['TEST_NorthwindCustomerSocketReport', 'Zermelo'],
            ['TEST_NorthwindOrderIndexReport', 'Zermelo'],
            ['TEST_NorthwindOrderReport', 'Zermelo'],
            ['TEST_NorthwindOrderSlowReport', 'Zermelo'],
            ['TEST_NorthwindOrderYearReport', 'Zermelo'],
            ['TEST_NorthwindProductReport', 'Zermelo'],
            ['TEST_TagsReport', 'Zermelo'],
        ];
    }

    /**
     * @dataProvider reportProvider
     */
    public function testReportWebPageLoads($reportName, $prefix)
    {
        $response = $this->get("/$prefix/$reportName");
        $response->assertStatus(200);
    }

    /**
     * @dataProvider reportProvider
     */
    public function testReportJsonEndpoint($reportName, $prefix)
    {
        $response = $this->get("/zapi/$prefix/$reportName");
        $response->assertStatus(200);
        if ($prefix === 'ZermeloGraph') {
            $response->assertJsonStructure([
                'nodes',
                'links',
                'groups',
                'types',
                'link_types',
            ]);
        } else {
            $response->assertJsonStructure(['data']);
        }
    }
}
