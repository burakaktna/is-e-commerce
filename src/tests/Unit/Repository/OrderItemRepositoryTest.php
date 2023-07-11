<?php

namespace Tests\Unit\Repository;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repository\OrderItemRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderItemRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private OrderItemRepository $orderItemRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderItemRepository = new OrderItemRepository(new OrderItem());
    }

    public function test_can_create_order_item()
    {
        $data = [
            'quantity' => 2,
            'unit_price' => 50,
            'total' => 100,
            'order_id' => Order::factory()->create()->id,
            'product_id' => Product::factory()->create()->id,
        ];

        $orderItem = $this->orderItemRepository->create($data);

        $this->assertInstanceOf(OrderItem::class, $orderItem);
        $this->assertEquals($data['quantity'], $orderItem->quantity);
        $this->assertEquals($data['unit_price'], $orderItem->unit_price);
        $this->assertEquals($data['total'], $orderItem->total);
        $this->assertEquals($data['order_id'], $orderItem->order_id);
        $this->assertEquals($data['product_id'], $orderItem->product_id);
    }

    public function test_can_update_order_item()
    {
        $orderItem = OrderItem::factory()->create();

        $data = [
            'quantity' => 3,
            'unit_price' => 60,
            'total' => 180,
            'order_id' => Order::factory()->create()->id,
            'product_id' => Product::factory()->create()->id,
        ];

        $updatedOrderItem = (bool)$this->orderItemRepository->update($orderItem->id, $data);

        $this->assertTrue($updatedOrderItem);
        $this->assertEquals($data['quantity'], $orderItem->fresh()->quantity);
        $this->assertEquals($data['unit_price'], $orderItem->fresh()->unit_price);
        $this->assertEquals($data['total'], $orderItem->fresh()->total);
        $this->assertEquals($data['order_id'], $orderItem->fresh()->order_id);
        $this->assertEquals($data['product_id'], $orderItem->fresh()->product_id);
    }

    public function test_can_delete_order_item()
    {
        $orderItem = OrderItem::factory()->create();

        $deletedOrderItem = $this->orderItemRepository->delete($orderItem->id);

        $this->assertTrue($deletedOrderItem);
        $this->assertNull(OrderItem::find($orderItem->id));
    }

    public function test_can_show_order_item()
    {
        $orderItem = OrderItem::factory()->create();

        $foundOrderItem = $this->orderItemRepository->find($orderItem->id);

        $this->assertInstanceOf(OrderItem::class, $foundOrderItem);
        $this->assertEquals($foundOrderItem->quantity, $orderItem->quantity);
        $this->assertEquals($foundOrderItem->unit_price, $orderItem->unit_price);
        $this->assertEquals($foundOrderItem->total, $orderItem->total);
        $this->assertEquals($foundOrderItem->order_id, $orderItem->order_id);
        $this->assertEquals($foundOrderItem->product_id, $orderItem->product_id);
    }

    public function test_can_get_all_order_items()
    {
        OrderItem::factory()->count(5)->create();

        $allOrderItems = $this->orderItemRepository->all();

        $this->assertCount(5, $allOrderItems);
    }
}
