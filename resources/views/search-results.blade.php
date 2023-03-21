@extends('layouts.app')

@section('content')
    <div class="px-4 mb-3">
        <h2>Результаты поиска по запросу "{{ $query }}"</h2>
    </div>

    @if(count($customers) != 0 )
        <div class="bg-white rounded-4 p-4">
            <h2>Покупатели</h2>
            <div class="overflow-scroll">
                <div class="border-bottom p-2 d-flex">
                    <div class="col-md-1 col-1 fw-bold">№</div>
                    <div class="col-md-2 col-5 fw-bold">ФИО</div>
                    <div class="col-md-3 col-5 fw-bold">Дата рождения</div>
                    <div class="col-md-3 col-5 fw-bold">Телефон</div>
                    <div class="col-md-3 col-5 fw-bold">Комментарий</div>
                </div>
                @foreach($customers as $customer)
                    <div class="d-flex border-bottom p-2">
                        <div class="col-md-1 col-1">
                            <a href="{{ route('customer.show', $customer->id) }}">
                                {{ $customer->id }}
                            </a>
                        </div>
                        <div class="col-md-2 col-5">{{ $customer->name }}</div>
                        <div class="col-md-3 col-5">{{ $customer->birth_date }}</div>
                        <div class="col-md-3 col-5">{{ $customer->phone }}</div>
                        <div class="col-md-3 col-5">{{ $customer->comment }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($orders) != 0)
        <div class="bg-white rounded-4 p-4 mt-2">
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
                        <div class="col-md-4 col-5">{{ $order->getCustomer->name }}</div>
                        <div
                            class="col-md-4 col-5">{{ $order->getCustomer->phone }}</div>
                        <div class="col-md-3 col-5">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
