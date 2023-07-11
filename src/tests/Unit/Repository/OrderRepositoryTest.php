<?php

namespace Tests\Unit\Repository;

use App\Models\Customer;
use App\Models\Order;
use App\Repository\OrderRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private OrderRepository $orderRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = new OrderRepository(new Order());
    }

    public function test_can_create_order()
    {
        $data = [
            'total' => 100,
            'customer_id' => Customer::factory()->create()->id,
        ];

        $order = $this->orderRepository->create($data);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($data['total'], $order->total);
        $this->assertEquals($data['customer_id'], $order->customer_id);
    }

    public function test_can_update_order()
    {
        $order = Order::factory()->create();

        $data = [
            'total' => 200,
            'customer_id' => Customer::factory()->create()->id,
        ];

        $updatedOrder = (bool)$this->orderRepository->update($order->id, $data);

        $this->assertTrue($updatedOrder);
        $this->assertEquals($data['total'], $order->fresh()->total);
        $this->assertEquals($data['customer_id'], $order->fresh()->customer_id);
    }

    public function test_can_delete_order()
    {
        $order = Order::factory()->create();

        $deletedOrder = $this->orderRepository->delete($order->id);

        $this->assertTrue($deletedOrder);
        $this->assertNull(Order::find($order->id));
    }

    public function test_can_show_order()
    {
        $order = Order::factory()->create();

        $foundOrder = $this->orderRepository->find($order->id);

        $this->assertInstanceOf(Order::class, $foundOrder);
        $this->assertEquals($foundOrder->total, $order->total);
        $this->assertEquals($foundOrder->customer_id, $order->customer_id);
    }

    public function test_can_get_all_orders()
    {
        Order::factory()->count(5)->create();

        $allOrders = $this->orderRepository->all();

        $this->assertCount(5, $allOrders);
    }
}
