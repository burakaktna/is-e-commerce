<?php

namespace Tests\Unit\Repository;

use App\Models\Customer;
use App\Repository\CustomerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private CustomerRepository $customerRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->customerRepository = new CustomerRepository(new Customer());
    }

    public function test_can_create_customer()
    {
        $data = [
            'name' => 'Test Customer',
            'since' => '2023-07-11',
            'revenue' => 1000,
        ];

        $customer = $this->customerRepository->create($data);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($data['name'], $customer->name);
        $this->assertEquals($data['since'], $customer->since);
        $this->assertEquals($data['revenue'], $customer->revenue);
    }

    public function test_can_update_customer()
    {
        $customer = Customer::factory()->create();

        $data = [
            'name' => 'Updated Customer',
            'since' => '2023-07-12',
            'revenue' => 2000,
        ];

        $updatedCustomer = (bool)$this->customerRepository->update($customer->id, $data);

        $this->assertTrue($updatedCustomer);
        $this->assertEquals($data['name'], $customer->fresh()->name);
        $this->assertEquals($data['since'], $customer->fresh()->since);
        $this->assertEquals($data['revenue'], $customer->fresh()->revenue);
    }

    public function test_can_delete_customer()
    {
        $customer = Customer::factory()->create();

        $deletedCustomer = $this->customerRepository->delete($customer->id);

        $this->assertTrue($deletedCustomer);
        $this->assertNull(Customer::find($customer->id));
    }

    public function test_can_show_customer()
    {
        $customer = Customer::factory()->create();

        $foundCustomer = $this->customerRepository->find($customer->id);

        $this->assertInstanceOf(Customer::class, $foundCustomer);
        $this->assertEquals($foundCustomer->name, $customer->name);
        $this->assertEquals($foundCustomer->since, $customer->since);
        $this->assertEquals($foundCustomer->revenue, $customer->revenue);
    }

    public function test_can_get_all_customers()
    {
        Customer::factory()->count(5)->create();

        $allCustomers = $this->customerRepository->all();

        $this->assertCount(5, $allCustomers);
    }
}
