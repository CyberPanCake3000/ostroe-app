<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $customer = Customer::firstOrCreate([
            'name' => $request->get('name'),
            'birth_date' => $request->get('birth_date'),
            'OD_Sph' => $request->get('OD_Sph'),
            'OD_Cyl' => $request->get('OD_Cyl'),
            'OD_ax' => $request->get('OD_ax'),
            'OS_Sph' => $request->get('OS_Sph'),
            'OS_Cyl' => $request->get('OS_Cyl'),
            'OS_ax' => $request->get('OS_ax'),
            'Dpp' => $request->get('Dpp'),
            'phone' => $request->get('phone'),
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
        $customer = $order->getCustomer;
        $updatedCustomer = $customer->update([
            'name' => $request->get('name'),
            'birth_date' => $request->get('birth_date'),
            'OD_Sph' => $request->get('OD_Sph'),
            'OD_Cyl' => $request->get('OD_Cyl'),
            'OD_ax' => $request->get('OD_ax'),
            'OS_Sph' => $request->get('OS_Sph'),
            'OS_Cyl' => $request->get('OS_Cyl'),
            'OS_ax' => $request->get('OS_ax'),
            'Dpp' => $request->get('Dpp'),
            'phone' => $request->get('phone'),
            'comment' => $request->get('customer_comment'),
        ]);

        if(!$updatedCustomer)
        {
            return redirect()->route('order.index')->with(['error' => "Информация о покупателе №$customer->id не обновлена"]);
        }

        $orderUpdate = $order->update([
            'comment' => $request->get('comment'),
            'glasses_model' => $request->get('glasses_model'),
        ]);

        if(!$orderUpdate){
            return redirect()->route('order.index')->with(['error' => "Информация о заказе №$order->id не обновлена!"]);
        }

        return redirect()->route('order.index')->with(['message' => "Информация о заказе №$order->id успешно обновлена!"]);
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
