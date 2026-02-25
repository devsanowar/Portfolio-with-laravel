@extends('admin.layouts.app')
@section('title', 'All Package Pricings')

@push('styles')
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('admin_content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">All Package Pricings</h5>
                            <a href="{{ route('admin.package_pricings.create') }}"
                               class="btn btn-outline-primary px-5 rounded-0">
                                Add Package
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="packagePricingsTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Service</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($packagePricings as $key => $package)
                                        <tr id="row-{{ $package->id }}">
                                            <td>{{ $key + 1 }}</td>

                                            {{-- Service --}}
                                            <td>
                                                {{ $package->service->service_name ?? '—' }}
                                            </td>

                                            {{-- Name --}}
                                            <td>{{ $package->name }}</td>

                                            {{-- Price --}}
                                            <td class="text-end">
                                                {{-- Simple money format --}}
                                                {{ number_format($package->price, 2) }}
                                            </td>

                                            {{-- Sort Order --}}
                                            <td class="text-center">{{ $package->sort_order }}</td>

                                            {{-- Status --}}
                                            <td class="text-center">
                                                @if ($package->status === 'active' || $package->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            {{-- Action --}}
                                            <td class="text-center">
                                                {{-- Edit --}}
                                                <a href="{{ route('admin.package_pricings.edit', $package->id) }}"
                                                   class="action-icon border border-primary text-primary me-2">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.package_pricings.destroy', $package->id) }}"
                                                      method="POST"
                                                      class="deletePackagePricingForm d-inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        class="action-icon border border-danger text-danger deleteBtn"
                                                        data-id="{{ $package->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- card-body -->

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {

            $('#packagePricingsTable').DataTable({
                order: [
                    [4, 'asc'] // sort_order column by default
                ]
            });

            $(document).on('click', '.deleteBtn', function() {
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this package!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endpush
