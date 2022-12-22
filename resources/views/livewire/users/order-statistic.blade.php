<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Statistique de toutes les annes</h5>
                <small class="text-muted">{{ $totalAmount }} Total Sales</small>
            </div>
            <div class="dropdown">
                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-dots-circle"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column align-items-center gap-1">
                    <h2 class="mb-2">{{ $nbOrders }}</h2>
                    <span>Differentes Categories</span>
                </div>
                {{-- <div id="orderStatisticsChart"></div> --}}
            </div>
            <ul class="p-0 m-0">
                @foreach ($orderPerCategories  as $item)                    
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="mdi mdi-store"></i>
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $item->cat_nom }}</h6>
                                <small class="text-muted">Produit differents : {{ $item->nb_produit }}</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">{{ $item->price }} Eur</small>
                            </div>
                        </div>
                    </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</div>
