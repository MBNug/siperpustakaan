{{-- @dd($jsonpengunjung) --}}
@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Admin Dashboard
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Jumlah Pengunjung</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">{{ $pengunjungthisweek->sum('jmlpengunjung') }} Pengunjung Minggu ini</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div>
                        {{-- CHARTTT --}}
                        <canvas id="myChart" width="1230" height="450"></canvas>
                        {{-- <div id="chartContainer" style="height: 300px; width: 100%;">
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <div class="card mt-4 mb-4">
                <div class="card-header border-0">
                    <h3 class="card-title">Pengunjung Terbaik</h3>
                    
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jumlah Kunjungan</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $top = [];
                            $top=$members
                                ->sortByDesc('jmlkunjungan')
                                ->take(3)
                                ;
                            // @dd($top);
                        @endphp
                        @foreach ($top as $t)
                        <tr>
                            <td>
                                {{ $t->nama }}
                            </td>
                            <td>
                                {{ $t->jmlkunjungan }}
                            </td>
                        </tr>
                        @endforeach
                    
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
            

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Data Perpustakaan SMK Daarul Khair Pulosari</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success text-xl">
                            <i class="nav-icon fas fa-person-booth"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                {{ $pengunjungtoday->jmlpengunjung }}
                            </span>
                            
                            
                            <span class="text-muted">Jumlah pengunjung hari ini</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning text-xl">
                            <i class="nav-icon fas fa-book"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                {{ $books->sum('jumlah') }}
                            </span>
                            <span class="text-muted">Jumlah buku</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <p class="text-danger text-xl">
                            <i class="nav-icon fas fa-users"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                {{ count($members) }}
                            </span>
                            <span class="text-muted">Jumlah Anggota</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  @push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
          label: 'Jumlah Pengunjung',
          data: {{ json_encode($thisweekpengunjung) }},
          borderWidth: 1,
          borderJoinStyle: 'round'
        },
        {
          label: 'Jumlah Buku Dipinjam',
          data: {{ json_encode($thisweekpinjam) }},
          borderWidth: 1,
          borderJoinStyle: 'round'
        },
    ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  @endpush
@endsection
