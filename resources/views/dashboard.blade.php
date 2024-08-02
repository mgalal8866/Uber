@extends('layout.main')

@section('content')
<div class="col-lg-12 mb-4 col-md-12">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <h5 class="card-title mb-0">Statistics</h5>
        <small class="text-muted">Updated 1 month ago</small>
      </div>
      <div class="card-body pt-2">
        <div class="row gy-3">
         
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-info me-3 p-2">
                <i class="ti ti-user ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">8.549k</h5>
                <small>Total Users</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-info me-3 p-2">
                <i class="ti ti-users ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">8.549k</h5>
                <small>Total Drivers</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-primary me-3 p-2">
                <i class="ti ti-car ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">230k</h5>
                <small>Total Trips</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-primary me-3 p-2">
                <i class="ti ti-car ti-sm"></i>
              </div>
              <div class="card-info">
                <h5 class="mb-0">230k</h5>
                <small>Live Trips</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="row">
  <div class="col-12 col-xl-4 mb-4 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Top Drivers Trips</h5>
        </div>
 
      </div>
      <div class="table-responsive">
        <table class="table table-borderless border-top">
          <thead class="border-bottom">
            <tr>
              <th>Driver</th>
              <th class="text-end">Total Trip</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="pt-2">
                <div class="d-flex justify-content-start align-items-center mt-lg-4">
                  <div class="avatar me-3 avatar-sm">
                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0">Maven Analytics</h6>
                    {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                  </div>
                </div>
              </td>
              <td class="text-end pt-2">
                <div class="user-progress mt-lg-4">
                  <p class="mb-0 fw-medium">33</p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-4 mb-4 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Top Users Trips</h5>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless border-top">
          <thead class="border-bottom">
            <tr>
              <th>User</th>
              <th class="text-end">Total Trip</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td class="pt-2">
                  <div class="d-flex justify-content-start align-items-center mt-lg-4">
                    <div class="avatar me-3 avatar-sm">
                      <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-0">Mai Mohamed</h6>
                      {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                    </div>
                  </div>
                </td>
                <td class="text-end pt-2">
                  <div class="user-progress mt-lg-4">
                    <p class="mb-0 fw-medium">33</p>
                  </div>
                </td>
              </tr>
 
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12 col-xl-4 mb-4 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Top 10 Rating Driver</h5>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless border-top">
          <thead class="border-bottom">
            <tr>
              <th>Driver</th>
              <th class="text-end">Rating</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td class="pt-2">
                  <div class="d-flex justify-content-start align-items-center mt-lg-4">
                    <div class="avatar me-3 avatar-sm">
                      <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-0">Mai Mohamed</h6>
                      {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                    </div>
                  </div>
                </td>
                <td class="text-end pt-2">
                  <div class="user-progress mt-lg-4">
                    <p class="mb-0 fw-medium">5</p>
                  </div>
                </td>
              </tr>
 
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-12 col-12 mb-4">
    <div class="card">
      <div class="card-header header-elements">
        <h5 class="card-title mb-0">Latest Statistics</h5>
        <div class="card-action-element ms-auto py-0">
          <div class="dropdown">
            <button
              type="button"
              class="btn dropdown-toggle px-0"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="ti ti-calendar"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
              </li>
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                  >Yesterday</a
                >
              </li>
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                  >Last 7 Days</a
                >
              </li>
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                  >Last 30 Days</a
                >
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                  >Current Month</a
                >
              </li>
              <li>
                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"
                  >Last Month</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="barChart" class="chartjs" data-height="400"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
 
     <script src="{{asset('assets/vendor/libs/chartjs/chartjs.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('assets/js/charts-chartjs.js')}}"></script>
 
@endpush