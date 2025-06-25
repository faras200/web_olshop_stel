@extends('layouts.app')

@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>
                <div class="section-header-button">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Users</a></div>
                    <div class="breadcrumb-item">All Users</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>


                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>

                            <div class="clearfix mb-3"></div>
                            @php
                                function formatPhoneToWa($phone)
                                {
                                    // Hapus karakter non-angka
                                    $number = preg_replace('/[^0-9]/', '', $phone);

                                    // Cegah error jika string kosong
                                    if (empty($number)) {
                                        return null; // atau return ''; tergantung kebutuhan
                                    }

                                    // Jika mulai dengan 08
                                    if (strpos($number, '08') === 0) {
                                        return '+62' . substr($number, 1);
                                    }

                                    // Jika tidak mulai dengan 0
                                    if ($number[0] !== '0') {
                                        return '+62' . $number;
                                    }

                                    // Default: jika mulai dengan 0 tapi bukan 08
                                    return '+62' . substr($number, 1);
                                }

                            @endphp

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Roles</th>
                                        <th>Action</th>
                                    </tr>


                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->roles }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    {{-- Tombol WhatsApp --}}
                                                    <a href="https://wa.me/{{ ltrim(formatPhoneToWa($user->phone), '+') }}?text={{ urlencode("Halo {$user->name}!\nKamu belum isi review untuk produk yang kamu pesan nih.\nYuk isi sekarang sebelum 2x24 jam, biar kami bisa terus meningkatkan kualitas layanan!\nBuka aplikasi untuk review\nAtau download aplikasi : https://bit.ly/3T9a7Ug\nTerima kasih banyak atas waktu dan bantuannya") }}"
                                                        target="_blank" class="btn btn-sm btn-success btn-icon mr-2">
                                                        <i class="fab fa-whatsapp"></i> WA
                                                    </a>

                                                    {{-- Tombol Alamat --}}
                                                    <a href="{{ url('alamat/' . $user->id) }}"
                                                        class="btn btn-sm btn-secondary btn-icon mr-2">
                                                        <i class="fas fa-map-marker-alt"></i> Alamat
                                                    </a>

                                                    {{-- Tombol Edit --}}
                                                    <a href='{{ route('user.edit', $user->id) }}'
                                                        class="btn btn-sm btn-info btn-icon mr-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    {{-- Tombol Delete --}}
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        class="ml-2">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                            <i class="fas fa-times"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach



                                </table>
                            </div>
                            <div class="float-right">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
