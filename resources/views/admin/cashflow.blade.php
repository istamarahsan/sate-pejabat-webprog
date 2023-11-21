@extends('layouts.dashboard')

@section('child-content')
<div class="p-10 flex justify-center mx-auto">
    <div x-data="cashflow" class="w-full flex flex-col items-center gap-10">
        <div class="flex flex-col gap-5 items-center">
            <div role="tablist" class="tabs tabs-boxed">
                <a role="tab" :class="`tab ${by === 'category' ? 'tab-active' : ''}`" @click="by = 'category'">By Category</a>
                <a role="tab" :class="`tab ${by === 'day' ? 'tab-active' : ''}`" @click="by = 'day'">By Day</a>
            </div>
            <div class="">
                <label class="label cursor-pointer gap-5">
                    <span class="label-text text-lg">Specific Timeframe</span> 
                    <template x-if="!timeframe">
                        <input type="checkbox" class="rounded-md p-2" @change="timeframe = true" />
                    </template>
                    <template x-if="timeframe">
                        <input type="checkbox" class="rounded-md p-2" @change="timeframe = false" checked />
                    </template>
                </label>
            </div>
            <div class="flex items-center" id="cashflow-daterange-picker">
                <template x-if="timeframe">
                    <input x-model="from" id="cashflow-daterange-picker-from" name="from" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date start">
                </template>
                <template x-if="!timeframe">
                    <input disabled id="cashflow-daterange-picker-from" name="from" type="date" class="bg-gray-500 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date start">
                </template>
                
                <span class="mx-4 text-gray-500">to</span>

                <template x-if="timeframe">
                    <input :min="from" x-model="until" id="cashflow-daterange-picker-to" name="until" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date end">
                </template>
                <template x-if="!timeframe">
                    <input disabled :min="from" id="cashflow-daterange-picker-to" name="until" type="date" class="bg-gray-500 border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Select date end">
                </template>
            </div>
            <div class="w-full h-[64px] flex justify-center items-stretch">
                <template x-if="!(loading || salesChartLoading || revenueChartLoading) && ((from !== null && until !== null) || !timeframe)">
                    <button @click="search()" class="btn btn-primary w-full">Search</button>
                </template>
                <template x-if="!(loading || salesChartLoading || revenueChartLoading) && ((from === null || until === null) && timeframe)">
                    <button disabled class="btn btn-primary w-full">Search</button>
                </template>
                <template x-if="loading || salesChartLoading || revenueChartLoading">
                    <span class="loading loading-dots loading-lg"></span>
                </template>
            </div>
        </div>
        <div class="max-w-3xl w-full grid grid-cols-1 place-content-stretch place-items-stretch">
            <div class="p-5">
                <canvas class="w-full h-full" id="cashflow-chart-sales"></canvas>
            </div>
            <div class="p-5">
                <canvas class="w-full h-full" id="cashflow-chart-revenue"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", (_) => {
            const axios = window.axios
            Alpine.data('cashflow', () => ({
                loading: false,
                salesChartLoading: false,
                revenueChartLoading: false,
                by: 'category',
                timeframe: false,
                from: null,
                until: null,
                cashflowData: null,
                activeChartSales: null,
                activeChartRevenue: null,
                init() {
                    this.by = 'category'
                    this.from = new Date().toISOString().slice(0, 10)
                    this.$watch('from', () => {
                        this.until = this.until ?? this.from
                        this.until = this.until > this.from ? this.until : this.from
                    })
                    this.$watch('cashflowData', () => {
                        if (this.cashflowData === null) {
                            return
                        }
                        if (this.activeChartSales !== null) {
                            this.activeChartSales.destroy()
                        }
                        if (this.activeChartRevenue !== null) {
                            this.activeChartRevenue.destroy()
                        }
                        const { labels, datasets } = this.cashflowData.type === 'category' ? this.extractByCategoryData(this.cashflowData.data) : this.extractByDayData(this.cashflowData.data)

                        this.salesChartLoading = true
                        this.revenueChartLoading = true
                        this.activeChartSales = new window.Chart(document.getElementById('cashflow-chart-sales'), {
                            type: 'bar',
                            title: 'Sales',
                            data: {
                                labels,
                                datasets: [datasets.sales]
                            },
                            options: {
                                animation: {
                                    onComplete: () => this.salesChartLoading = false
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            font: {
                                                size: 16
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: this.by === 'category' ? 'Category' : 'Date',
                                            font: {
                                                size: 16
                                            }                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Number of Sales',
                                            font: {
                                                size: 16
                                            }
                                        }
                                    }
                                }
                            }
                        })
                        this.activeChartRevenue = new window.Chart(document.getElementById('cashflow-chart-revenue'), {
                            type: 'bar',
                            title: 'Revenue',
                            data: {
                                labels,
                                datasets: [datasets.revenue]
                            },
                            options: {
                                animation: {
                                    onComplete: () => this.revenueChartLoading = false
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            font: {
                                                size: 16
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: this.by === 'category' ? 'Category' : 'Date',
                                            font: {
                                                size: 16
                                            }                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Total Sale (IDR)',
                                            font: {
                                                size: 16
                                            }
                                        }
                                    }
                                }
                            }
                        })
                    })
                },
                search() {
                    this.loading = true
                    const baseParams = {
                        type: this.by
                    }
                    const params = new URLSearchParams(this.timeframe ? {
                        ...baseParams,
                        from: this.from,
                        until: this.until
                    } : baseParams)
                    axios.get(`/admin/api/cashflow?${params}`)
                        .then((response) => {
                            this.cashflowData = {
                                type: this.by,
                                data: response.data
                            }
                            this.loading = false
                        })
                },
                extractByCategoryData(data) {
                    const values = Object.values(data);
                    return {
                        labels: values.map((e) => e.category).map((e) => e.charAt(0).toUpperCase() + e.slice(1)),
                        datasets: {
                            sales: {
                                label: 'Sales',
                                data: values.map((e) => e.sales),
                                borderWidth: 1
                            },
                            revenue: {
                                label: 'Revenue',
                                data: values.map((e) => e.revenue),
                                borderWidth: 1
                            }
                        }
                    }
                },
                extractByDayData(data) {
                    const entries = Object.entries(data)
                    return {
                        labels: entries.map(([key, _]) => key),
                        datasets: {
                            sales: {
                                label: 'Sales',
                                data: entries.map(([_, val]) => Object.values(val).reduce((acc, { sales }) => acc + sales, 0))
                            },
                            revenue: {
                                label: 'Revenue',
                                data: entries.map(([_, val]) => Object.values(val).reduce((acc, { revenue }) => acc + revenue, 0))
                            }
                        }
                    }
                }
            }))
        })

    </script>
</div>
@endsection
