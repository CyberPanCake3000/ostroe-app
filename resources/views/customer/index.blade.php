@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Все покупатели
                </button>
            </li>
        </ul>

        <button type="button" class="btn btn-outline-primary d-flex flex-row justify-content-center align-items-center"
                data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="bi bi-plus-lg me-0 me-md-2"></i>
            <span class="d-none d-md-block">Добавить покупателя</span>
        </button>
    </div>


    @if(count($customers) == 0)
        <div class="bg-dark bg-opacity-10 rounded-4 d-flex justify-content-center py-5">
            Тут пока нет покупателей!
        </div>
    @else
        <div class="bg-white rounded-4 p-3">
            <div class="container-fluid">

                <div class="overflow-scroll">
                    <div class="border-bottom p-2 d-flex">
                        <div class="fw-bold col-md-1 col-1 me-2">№</div>
                        <div class="fw-bold col-md-3 col-5">ФИО</div>
                        <div class="fw-bold col-md-3 col-4">Дата рождения</div>
                    </div>
                    @foreach($customers as $customer)

                        <div class="d-flex border-bottom p-2" data-bs-toggle="modal"
                             data-bs-target="#orderModal{{ $customer->id }}">
                            <div class="col-md-1 col-1 me-2">{{ $customer->id }}</div>
                            <div class="col-md-3 col-5">{{ $customer->getCustomerInfo->name }}</div>
                            <div class="col-md-3 col-4">{{ $customer->getCustomerInfo->birth_date }}</div>
                        </div>

                        <div class="modal fade" id="orderModal{{ $customer->id }}" tabindex="-1"
                             aria-labelledby="orderModal{{ $customer->id }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-muted" id="orderModal{{ $customer->id }}Label">
                                            Покупатель
                                            № {{ $customer->id }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-text fw-bold">
                                            {{ $customer->getCustomerInfo->name }}
                                        </h2>

                                        <div class="mb-3">
                                            {{ $customer->getCustomerInfo->birth_date }}
                                        </div>

                                        <div class="mb-3">
                                            {{ $customer->phone }}
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
                                                        {{ $customer->getCustomerInfo->OD_Sph }}
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="text-muted">
                                                        Cyl
                                                    </div>
                                                    <div>
                                                        {{ $customer->getCustomerInfo->OD_Cyl }}
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="text-muted">
                                                        ax
                                                    </div>
                                                    <div>
                                                        {{ $customer->getCustomerInfo->OD_ax }}
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
                                                        {{ $customer->getCustomerInfo->OS_Sph }}
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="text-muted">
                                                        Cyl
                                                    </div>
                                                    <div>
                                                        {{ $customer->getCustomerInfo->OS_Cyl }}
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="text-muted">
                                                        ax
                                                    </div>
                                                    <div>
                                                        {{ $customer->getCustomerInfo->OS_ax }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-start mb-3">
                                            <div class="col-4">
                                                <div class="text-muted">Dpp</div>
                                                {{ $customer->getCustomerInfo->Dpp }}
                                            </div>
                                        </div>

                                        @if(count($customer->getOrders) == 0)
                                            <div
                                                class="bg-body d-flex justify-content-center align-items-center mb-2 p-4">
                                                <div class="text-muted text-center">
                                                    <i class="bi bi-bag-x"></i><br>
                                                    <span>Заказы не найдены</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="">
                                                <h5>Заказы покупателя</h5>
                                                <div class="px-2">
                                                    <div class="row border-bottom">
                                                        <div class="fw-bold col-1">№</div>
                                                        <div class="fw-bold col-5">Дата</div>
                                                        <div class="fw-bold col-5">Номер телефона</div>
                                                        <div class="col-1"></div>
                                                    </div>
                                                    @foreach($customer->getOrders as $order)
                                                        <div class="row border-bottom py-2">
                                                            <a href="{{ route('orders.show', $order->id) }}"
                                                               class="col-1">{{ $order->id }}</a>
                                                            <div class="col-5">{{ $order->getDate() }}</div>
                                                            <div
                                                                class="col-5">{{ $order->getCustomer->getPhoneNumber->phone_number }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endif
                                        <div class="d-flex justify-content-end">
                                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-error me-2" type="submit">Удалить
                                                </button>
                                                <a class="btn btn-primary text-white"
                                                   href="{{ route('customer.edit', $customer->id) }}">Изменить</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-2">
                    {{ $customers->links() }}
                </div>

            </div>
        </div>
    @endif

    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addCustomerForm" action="{{ route('customer.store') }}" class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCustomerModalLabel">Добавить покупателя</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2 align-items-start mb-3">
                        <div class="col-6">
                            <label for="name" class="form-label">Имя покупателя</label>
                            <input list="customers" name="name" id="name" type="text" class="name form-control"
                                   placeholder="Имя покупателя" required>
                            <datalist id="customers" class="customers">

                            </datalist>
                        </div>
                        <div class="col-6">
                            <label for="birth_date" class="form-label">Дата рождения</label>
                            <input name="birth_date" id="birth_date" type="date"
                                   class="birth_date form-control">
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="phone" class="form-label">Номер телефона покупателя</label>
                            <input list="phone_list" id="phone" name="phone"
                                   class="phone form-control" type="tel" required/>
                            <datalist id="phone_list" class="phone_list">

                            </datalist>
                        </div>
                    </div>
                    <div class="d-flex align-items-end mb-3">
                        <h4 class="m-0 col-1">
                            OD
                        </h4>

                        <div class="row gx-3 container-fluid">
                            <div class="col-4">
                                <label for="OD_Sph" class="form-label">Sph</label>
                                <input type="number" value="0" step="any" name="OD_Sph" id="OD_Sph"
                                       class="OD_Sph form-control">
                            </div>

                            <div class="col-4">
                                <label for="OD_Cyl" class="form-label">Cyl</label>
                                <input type="number" value="0" step="any" name="OD_Cyl" id="OD_Cyl"
                                       class="OD_Cyl form-control">
                            </div>

                            <div class="col-4">
                                <label for="OD_ax" class="form-label">ax</label>
                                <input type="number" value="0" step="any" name="OD_ax" id="OD_ax"
                                       class="OD_ax form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-end mb-3">
                        <h4 class="m-0 col-1">
                            OS
                        </h4>

                        <div class="row gx-3 container-fluid">
                            <div class="col-4">
                                <label for="OS_Sph" class="form-label">Sph</label>
                                <input type="number" value="0" step="any" name="OS_Sph" id="OS_Sph"
                                       class="OS_Sph form-control">
                            </div>

                            <div class="col-4">
                                <label for="OS_Cyl" class="form-label">Cyl</label>
                                <input type="number" value="0" step="any" name="OS_Cyl" id="OS_Cyl"
                                       class="OS_Cyl form-control">
                            </div>

                            <div class="col-4">
                                <label for="OS_ax" class="form-label">ax</label>
                                <input type="number" value="0" step="any" name="OS_ax" id="OS_ax"
                                       class="OS_ax form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 align-items-end mb-3">
                        <div class="col-6">
                            <label for="Dpp" class="form-label">Dpp</label>
                            <input name="Dpp" id="Dpp" type="number" value="0" step="any"
                                   class="Dpp form-control">
                        </div>
                    </div>

                    <div>
                        <label for="comment" class="form-label">Комментарий по заказу</label>
                        <textarea type="text" class="comment form-control mb-3" name="comment"
                                  id="comment"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
