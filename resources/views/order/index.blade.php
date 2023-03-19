@extends('layouts.app')

@section('content')
    <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Все заказы
            </button>
        </li>
    </ul>

    @if(count($orders) == 0)
        <div class="bg-dark bg-opacity-10 rounded-4 d-flex justify-content-center py-5">
            Тут пока нет заказов!
        </div>
    @else
    <div class="bg-white rounded-4 p-3">
        <div class="container-fluid">
            <div class="overflow-scroll">
                <div class="border-bottom p-2 d-flex">
                    <div class="fw-bold col-1 me-2">№</div>
                    <div class="fw-bold col-md-2 col-5">ФИО</div>
                    <div class="fw-bold col-md-3 col-5">Телефон</div>
                    <div class="fw-bold col-md-3 col-5">Время</div>
                    <div class="fw-bold col-md-3 col-5">Комментарий</div>
                </div>
                @foreach($orders as $order)

                    <div class="d-flex border-bottom p-2" data-bs-toggle="modal"
                         data-bs-target="#orderModal{{ $order->id }}">

                        <div class="col-1 me-2">{{ $order->id }}</div>
                        <div class="col-md-2 col-5">{{ $order->getCustomer->getCustomerInfo->name }}</div>
                        <div class="col-md-3 col-5">{{ $order->getCustomer->phone }}</div>
                        <div class="col-md-3 col-5">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                        <div class="col-md-3 col-5">{{ $order->comment }}</div>

                    </div>

                    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                         aria-labelledby="orderModal{{ $order->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-muted"
                                        id="orderModal{{ $order->id }}Label">
                                        Заказ
                                        № {{ $order->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h2 class="text-text fw-bold">
                                            {{ $order->getCustomer->getCustomerInfo->name }}
                                        </h2>

                                        <a href="{{ route('customer.show', $order->getCustomer->id) }}" class="btn btn-outline-primary d-flex flex-row">
                                            <span class="d-none d-md-block">О покупателе</span>
                                            <i class="bi bi-box-arrow-in-up-right ms-md-2"></i>
                                        </a>
                                    </div>

                                    <div class="fw-bold">
                                        {{ $order->getCustomer->phone }}
                                    </div>

                                    <div class="mb-3">
                                        {{ $order->comment }}
                                    </div>

                                    <div class="d-flex align-items-end mb-3">
                                        <h2 class="m-0 col-2">
                                            OD
                                        </h2>

                                        <div class="d-flex justify-content-evenly container-fluid">
                                            <div class="col-4">
                                                <div class="text-muted">
                                                    Sph
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OD_Sph }}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-muted">
                                                    Cyl
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OD_Cyl }}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-muted">
                                                    ax
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OD_ax }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-start align-items-end mb-3">
                                        <h2 class="m-0 col-2">
                                            OS
                                        </h2>

                                        <div class="d-flex justify-content-evenly container-fluid">
                                            <div class="col-4">
                                                <div class="text-muted">
                                                    Sph
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OS_Sph }}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-muted">
                                                    Cyl
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OS_Cyl }}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="text-muted">
                                                    ax
                                                </div>
                                                <div>
                                                    {{ $order->getCustomer->getCustomerInfo->OS_ax }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-start mb-3">
                                        <div class="col-4">
                                            <div class="text-muted">Dpp</div>
                                            {{ $order->getCustomer->getCustomerInfo->Dpp }}
                                        </div>

                                        <div class="col-4">
                                            <div class="text-muted">Модель очков</div>
                                            {{ $order->glasses_model }}
                                        </div>
                                    </div>

                                    <div class="text-muted">
                                        {{ $order->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Удалить</button>
                                        <a class="btn btn-primary text-white"
                                           href="{{ route('order.edit', $order->id) }}">Изменить</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    </div>

    <div class="mt-2">
        {{ $orders->links() }}
    </div>
    @endif
@endsection
