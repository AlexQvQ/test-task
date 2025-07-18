@extends('layouts.layout')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row g-3">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 fw-semibold">Категории</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-unstyled mb-0">
                            @forelse ($groups as $group)
                                @allChildGroup($group)
                            @empty
                                <li class="px-3 py-2 text-muted">Нет категорий</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <h5 class="mb-2 mb-md-0 fw-semibold">Товары</h5>
                            <div class="d-flex align-items-center">
                                <span class="me-2 text-nowrap">Сортировать:</span>
                                <div class="btn-group btn-group-sm flex-wrap">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                                        class="btn btn-outline-secondary">По цене ↑</a>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                                        class="btn btn-outline-secondary">По цене ↓</a>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}"
                                        class="btn btn-outline-secondary">По названию ↑</a>
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}"
                                        class="btn btn-outline-secondary">По названию ↓</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @forelse ($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h6 class="card-title mb-2">{{ $product->name }}</h6>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div class="price-container">
                                                    @if ($product->price)
                                                        <span class="fw-bold text-primary fs-5">
                                                            {{ number_format($product->price->price, 0, ',', ' ') }} ₽
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Цена не указана</span>
                                                    @endif
                                                </div>
                                                <a href="{{ Route('product', ['id' => $product->id]) }}"
                                                    class="btn btn-sm btn-outline-success">
                                                    Посмотреть
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <i class="bi bi-box-seam fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">Товары не найдены</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 p-3">
    {{ $products->links('pagination::bootstrap-4') }}

    <div class="d-flex flex-column flex-md-row align-items-center gap-2">
        <span class="text-nowrap">На странице:</span>
        <div class="btn-group btn-group-sm">
            <a href="{{ request()->fullUrlWithQuery(['per_page' => 6]) }}"
               class="btn btn-outline-secondary {{ request('per_page', 12) == 6 ? 'active' : '' }}">6</a>
            <a href="{{ request()->fullUrlWithQuery(['per_page' => 12]) }}"
               class="btn btn-outline-secondary {{ request('per_page', 12) == 12 ? 'active' : '' }}">12</a>
            <a href="{{ request()->fullUrlWithQuery(['per_page' => 18]) }}"
               class="btn btn-outline-secondary {{ request('per_page', 12) == 18 ? 'active' : '' }}">18</a>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.toggle-icon').forEach(icon => {
                    icon.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const targetId = this.getAttribute('data-bs-target');
                        const target = document.querySelector(targetId);
                        const bsCollapse = new bootstrap.Collapse(target, {
                            toggle: true
                        });
                        this.classList.toggle('bi-plus');
                        this.classList.toggle('bi-dash');
                    });
                });
            });
        </script>
    @endpush
@endsection
