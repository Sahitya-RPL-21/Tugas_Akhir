@extends('newwelcome')

@section('content')
<div class="p-8 bg-grey-100 min-h-screen flex flex-col items-center">
    <h1 class="text-4xl font-bold mb-8 text-green-900">Data Inventaris Barang</h1>
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-6xl w-full">

        <div id="bar-chart" class="w-full"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const chartConfig = {
        series: [{
            name: "Sales",
            data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
        }],
        chart: {
            type: "bar",
            height: 400,
            toolbar: {
                show: false,
            },
        },
        title: {
            text: "Statistik Data ",
            align: "center",
            style: {
                fontSize: "18px",
                fontWeight: "bold",
                color: "#333",
                fontFamily: "helvetica, sans-serif",
            },
        },
        dataLabels: {
            enabled: false,
        },
        colors: ["#4CAF50"],
        plotOptions: {
            bar: {
                columnWidth: "50%",
                borderRadius: 8,
            },
        },
        xaxis: {
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            labels: {
                style: {
                    colors: "#616161",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
            },
            categories: [
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#616161",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
            },
        },
        grid: {
            show: true,
            borderColor: "#e0e0e0",
            strokeDashArray: 4,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            padding: {
                top: 10,
                right: 20,
                left: 20,
            },
        },
        fill: {
            opacity: 0.9,
        },
        tooltip: {
            theme: "light",
            style: {
                fontSize: "12px",
                fontFamily: "inherit",
            },
        },
    };

    const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);

    chart.render();
</script>
@endsection