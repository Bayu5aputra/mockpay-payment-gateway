<x-app-layout>
    <div class="min-h-screen bg-[#eae6df] py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="rounded-[36px] bg-[#f8f4ef] border border-white/70 shadow-[0_40px_90px_rgba(15,23,42,0.14)] p-8 space-y-8">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('client.developers.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-slate-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Developer Tools
                    </a>
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">API Logs</p>
                        <h1 class="text-4xl font-semibold text-slate-900 mt-2">API Request Logs</h1>
                        <p class="text-sm text-slate-600 mt-2">Audit your API usage and errors.</p>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white p-6 shadow-sm border border-white/70">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                            <select name="status" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="success" @selected(request('status')==='success')>Success</option>
                                <option value="error" @selected(request('status')==='error')>Error</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Method</label>
                            <select name="method" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                                <option value="">All</option>
                                <option value="GET" @selected(request('method')==='GET')>GET</option>
                                <option value="POST" @selected(request('method')==='POST')>POST</option>
                                <option value="PUT" @selected(request('method')==='PUT')>PUT</option>
                                <option value="DELETE" @selected(request('method')==='DELETE')>DELETE</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">End Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-2xl border border-slate-200 bg-white/90 px-4 py-2 text-sm text-slate-700">
                        </div>
                        <div class="md:col-span-4">
                            <button class="rounded-2xl bg-slate-900 px-5 py-2 text-sm font-semibold text-white">Apply Filters</button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Total Requests</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['total']) }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Success Rate</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['success_rate'], 2) }}%</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-white p-5 border border-white/70 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Errors (24h)</p>
                                <p class="text-3xl font-semibold text-slate-900 mt-3">{{ number_format($stats['errors_24h']) }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[28px] bg-white shadow-sm border border-white/70 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50/70 border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Timestamp</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Method</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Path</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-[0.2em]">Duration</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($logs as $log)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                            {{ $log->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $log->method }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-700">
                                            <span class="truncate block max-w-xs">{{ $log->path }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ $log->status_code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">{{ number_format((float) $log->duration_ms, 2) }} ms</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-6 text-center text-slate-500">No API logs yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
