@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-danger text-white">
        <h4 class="mb-0">Sistem Log Aktivitas (Audit Log)</h4>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            Halaman ini hanya dapat diakses oleh Administrator untuk memantau aktivitas sistem.
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Waktu (WIB)</th>
                        <th>User</th>
                        <th>Aktivitas (Action)</th>
                        <th>IP Address</th>
                        <th>Detail Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>
                                {{ $log->user ? $log->user->name : 'Unknown/Guest' }}
                            </td>
                            <td>
                                @if($log->action == 'LOGIN')
                                    <span class="badge bg-success">{{ $log->action }}</span>
                                @elseif($log->action == 'LOGOUT')
                                    <span class="badge bg-secondary">{{ $log->action }}</span>
                                @elseif(str_contains($log->action, 'DELETE'))
                                    <span class="badge bg-danger">{{ $log->action }}</span>
                                @else
                                    <span class="badge bg-primary">{{ $log->action }}</span>
                                @endif
                            </td>
                            <td><code>{{ $log->ip_address }}</code></td>
                            <td>{{ $log->details }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada aktivitas tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection