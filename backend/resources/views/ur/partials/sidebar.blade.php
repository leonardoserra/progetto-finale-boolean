<div class="d-flex flex-column flex-shrink-0 p-3 h-100 ms_sidebar" style="height">
    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        <div>
            <li class="mb-1 border-bottom border-warning border-2">
                <a href="{{ route('ur.dashboard') }}"
                    class="nav-link  text-black @if (Route::currentRouteName() == 'ur.dashboard') text-white color-logo @endif">
                    <i class="fa-solid fa-house"></i>
                    <span>Ristorante</span>
                </a>
            </li>
        </div>

        <li class="mb-1 border-bottom border-warning border-2">
            <a href="" class="nav-link  text-black ps-1">
                <span>Menù</span>
            </a>
            <div class="collapse show" id="dashboard-collapse-menu">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('ur.dishes.index') }}"
                            class="nav-link  text-black ms-4 @if (Route::currentRouteName() == 'ur.dishes.index') color-logo @endif">
                            <i class="fa-solid fa-utensils pe-1"></i>
                            <span>Elenco Prodotti</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ur.dishes.create') }}"
                            class="nav-link  text-black ms-4 @if (Route::currentRouteName() == 'ur.dishes.create') color-logo @endif">
                            <i class="fa-solid fa-plus pe-1"></i>
                            <span>Aggiungi al menù</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1 border-bottom border-warning border-2">
            <i class="fa-light fa-list-tree"></i>
            <a href="" class="nav-link  text-black ps-1">
                <span>Ordini</span>
            </a>
            <div class="collapse show" id="dashboard-collapse-orders">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('ur.orders') }}"
                            class="nav-link  text-black ms-4 @if (Route::currentRouteName() == 'ur.orders') color-logo @endif">
                            <i class="fa-solid fa-list-ol"></i>
                            <span>Elenco Ordini</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ur.ordersStatistic') }}"
                            class="nav-link  text-black ms-4 @if (Route::currentRouteName() == 'ur.ordersStatistic') color-logo @endif">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Statistiche Ordini</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
