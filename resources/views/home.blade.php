@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7 col-12">
            @if(count($orders) == 0)
                <div class="bg-dark bg-opacity-10 rounded-4 me-md-2 me-0 d-flex justify-content-center py-5">
                    Тут пока нет заказов!
                </div>
            @else
                <div class="p-4 bg-white rounded-4 me-md-2 me-0">
                    <h2>Заказы</h2>

                    <div class="overflow-scroll">
                        <div class="border-bottom p-2 d-flex">
                            <div class="col-md-1 col-1 fw-bold">№</div>
                            <div class="col-md-4 col-5 fw-bold">ФИО</div>
                            <div class="col-md-4 col-5 fw-bold">Телефон</div>
                            <div class="col-md-3 col-5 fw-bold">Время</div>
                        </div>

                        @foreach($orders as $order)
                            <div class="d-flex border-bottom p-2">
                                <div class="col-md-1 col-1">
                                    <a href="{{ route('order.show', $order->id) }}">
                                        {{ $order->id }}
                                    </a>
                                </div>
                                <div class="col-md-4 col-5">{{ $order->getCustomer->getCustomerInfo->name }}</div>
                                <div
                                    class="col-md-4 col-5">{{ $order->getCustomer->phone }}</div>
                                <div class="col-md-3 col-5">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                            </div>
                        @endforeach

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('order.index') }}" class="btn btn-primary text-white">Все заказы</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-5 col-12 mt-3 mt-md-0">
            @if(count($customers) == 0)
                <div class="bg-dark bg-opacity-10 rounded-4 me-md-2 me-0 d-flex justify-content-center py-5">
                    Тут пока нет покупателей!
                </div>
            @else
                <div class="bg-white rounded-4 p-4">
                    <h2>Покупатели</h2>
                    <div class="overflow-scroll">
                        <div class="border-bottom p-2 d-flex">
                            <div class="col-md-1 col-1 fw-bold">№</div>
                            <div class="col-md-4 col-5 fw-bold">ФИО</div>
                            <div class="col-md-4 col-5 fw-bold">Дата рождения</div>
                            <div class="col-md-3 col-5 fw-bold">Телефон</div>
                        </div>
                        @foreach($customers as $customer)
                            <div class="d-flex border-bottom p-2">
                                <div class="col-md-1 col-1">
                                    <a href="{{ route('customer.show', $customer->id) }}">
                                        {{ $customer->id }}
                                    </a>
                                </div>
                                <div class="col-md-4 col-5">{{ $customer->getCustomerInfo->name }}</div>
                                <div class="col-md-4 col-5">{{ $customer->getCustomerInfo->birth_date }}</div>
                                <div class="col-md-3 col-5">{{ $customer->phone }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('customer.index') }}" class="btn btn-primary text-white">Все покупатели</a>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
