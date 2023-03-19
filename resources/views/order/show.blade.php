@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-4 p-4 col-12 col-md-6">


        <div class="d-flex justify-content-between align-items-start">
            <h2>Заказ №{{ $order->id }}</h2>

            <a href="{{ route('customer.show', $order->getCustomer->id) }}" class="btn btn-outline-primary d-flex flex-row">
                <span class="d-none d-md-block">О покупателе</span>
                <i class="bi bi-box-arrow-in-up-right ms-md-2"></i>
            </a>
        </div>

        <div>
            <h2 class="text-text fw-bold">
                {{ $order->getCustomer->getCustomerInfo->name }}
            </h2>

            <div class="fw-bold">
                {{ $order->getCustomer->phone }}
            </div>

            <div class="mb-3">
                {{ $order->comment }}
            </div>

            <div class="d-flex align-items-end mb-3">
                <h2 class="m-0">
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
                <h2 class="m-0">
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

            <div class="text-muted mb-3">
                {{ $order->created_at->format('d.m.Y H:i') }}
            </div>

            <form class="d-flex justify-content-end" action="{{ route('order.destroy', $order->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger me-2" type="submit">Удалить</button>
                <a class="btn btn-primary text-white" href="{{ route('order.edit', $order->id) }}">Изменить</a>
            </form>
        </div>
    </div>
@endsection
