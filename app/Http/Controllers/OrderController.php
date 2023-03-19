<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\CustomerRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('order.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customerInfo = CustomerInfo::firstOrCreate([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'OD_Sph' => $request->OD_Sph,
            'OD_Cyl' => $request->OD_Cyl,
            'OD_ax' => $request->OD_ax,
            'OS_Sph' => $request->OS_Sph,
            'OS_Cyl' => $request->OS_Cyl,
            'OS_ax' => $request->OS_ax,
            'Dpp' => $request->Dpp,
        ]);

        $customer = Customer::firstOrCreate([
            'phone' => $request->get('phone'),
            'customer_info_id' => $customerInfo->id,
            'comment' => $request->get('customer_comment'),
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'comment' => $request->get('comment'),
            'glasses_model' => $request->get('glasses_model'),
        ]);

        if(!$order || !$customer) {
            return redirect()->route('order.index')->with('error', 'Невозможно создать заказ!');
        }

        return redirect()->route('order.index')->with('message', "Заказ №$order->id успешно создан!");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order/edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Order $order)
    {
        $customerInfo = $order->getCustomer->getCustomerInfo;
        $updatedCustomerInfo = $customerInfo->update($request->all());

        $customer = $order->getCustomer;
        $updatedCustomer = $customer->update([
            'phone' => $request->get('phone'),
            'comment' => $request->get('customer_comment'),
        ]);

        if(!$updatedCustomer || !$updatedCustomerInfo)
        {
            return redirect()->route('order.index')->with(['error' => "Информация о покупателе №$customer->id не обновлена"]);
        }

        $orderUpdate = $order->update([
            'comment' => $request->get('comment'),
            'glasses_model' => $request->get('glasses_model'),
        ]);

        if($orderUpdate){
            return redirect()->route('order.index')->with(['error' => "Информация о заказе №$order->id не обновлена!"]);
        }

        return redirect()->route('order.index')->with(['message' => "Информация о о заказе №$order->id успешно обновлена!"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with(['message' => "Информация о заказе №$order->id успешно удалена!"]);
    }
}
