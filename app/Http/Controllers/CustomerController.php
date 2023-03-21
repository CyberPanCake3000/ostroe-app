<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('updated_at', 'desc')->paginate(10);
        return view('customer/index', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        return redirect()->route('customer.index')->with(['message' => "Покупатель №$customer->id успешно создан"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customer/show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer/edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $updatedCustomer = $customer->update($request->all());

        if(!$updatedCustomer)
        {
            return redirect()->route('customer.index')->with(['error' => "Информация о покупателе №$customer->id не обновлена"]);
        }

        return redirect()->route('customer.index')->with(['message' => "Информация о покупателе №$customer->id успешно обновлена!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if(count($customer->getOrders) != 0){
            return redirect()->route('customer.index')
                ->with(['error' => "Неаозможно удалить информацию о покупателе №$customer->id!. У покупателя есть заказы."]);
        }

        $customer->delete();

        return redirect()->route('customer.index')->with(['message' => "Информация о покупателе №$customer->id успешно удалена!"]);
    }
}
