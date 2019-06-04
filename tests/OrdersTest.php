<?php

class OrdersTest extends TestCase
{

    /**
     * Placing an Order Test.
     * Pass valid parameters and must return success
     *
     * @return void
     */
    public function testPlaceOrder()
    {
        // ARRANGE
        $data = [
            "origin" => [
                "28.489836",
                "77.0924223"
            ],
            "destination" => [
                "28.4997511",
                "77.0806805"
            ]
        ];
        
        // ACT
        $response = $this->json('POST', '/orders', $data)->response->getContent();
        $json = json_decode($response);
        
        // ASSERT
        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            'id',
            'distance',
            'status'
        ]);
        
        $this->assertEquals('UNASSIGN', $json->status);
        $this->assertEquals(5112, $json->distance);
    }

    /**
     * Test Take Order Request for first time
     * Pass valid parameters and must return success
     *
     * @return void
     */
    public function testTakeOrder()
    {
        // ARRANGE
        $orderData = [
            "origin" => [
                "28.489836",
                "77.0924223"
            ],
            "destination" => [
                "28.4997511",
                "77.0806805"
            ]
        ];
        
        // ACT
        $responseOrder = $this->json('POST', '/orders', $orderData)->response->getContent();
        $jsonResponse = json_decode($responseOrder);
        $this->assertResponseStatus(200);
        
        // Updating Status
        $data = [
            "status" => "taken"
        ];
        
        $response = $this->json('PUT', '/orders/' . $jsonResponse->id, $data)->response->getContent();
        $json = json_decode($response);
        
        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            'status'
        ]);
        
        $this->assertEquals('SUCCESS', $json->status);
        
        // Resubmitting Update Status to verify required behaviour
        $responseResubmit = $this->json('PUT', '/orders/' . $jsonResponse->id, $data)->response->getContent();
        
        // ASSERT
        $this->assertResponseStatus(409);
        $this->seeJsonStructure([
            'error'
        ]);
    }

    /**
     * Test List Orders Request
     *
     * @return void
     */
    public function testListOrders()
    {
        // ARRANGE & ACT
        $response = $this->json('GET', '/orders?page=1&limit=10', [])->response->getContent();
        $json = json_decode($response);
        
        // ASSERT
        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            [
                'id',
                'distance',
                'status'
            ]
        ]);
    }

    /**
     * Test List Orders Request With No Params For Page and Limit.
     * Should return 500 Internal Server Error
     *
     * @return void
     */
    public function testListOrdersNoParams()
    {
        // ARRANGE & ACT
        $response = $this->json('GET', '/orders', [])->response->getContent();
        $json = json_decode($response);
        
        // ASSSERT
        $this->assertResponseStatus(500);
    }
}
