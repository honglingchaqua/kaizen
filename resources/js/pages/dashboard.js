import ApexCharts from "apexcharts";
import $ from 'jquery';
import 'datatables.net';

// DataTables Setup
$(document).ready(function() {
    $('#vehicles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/vehicles', // URL untuk mendapatkan data
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nopol', name: 'nopol' },
            { data: 'no_rangka', name: 'no_rangka' },
            { data: 'model', name: 'model' },
            { data: 'warna', name: 'warna' },
            { data: 'bulan_dec', name: 'bulan_dec' },
            { data: 'masa_pakai', name: 'masa_pakai' },
            { data: 'tanggal_last_service', name: 'tanggal_last_service' },
            { data: 'km_sekarang', name: 'km_sekarang' },
            { data: 'tanggal_next_service', name: 'tanggal_next_service' },
            { data: 'note', name: 'note' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });
});

// ApexCharts Setup
// CRM Project Statistics Chart
var colors = ["#3073F1", "#0acf97"];
var dataColors = document.querySelector("#crm-project-statistics").dataset.colors;

if (dataColors) {
    colors = dataColors.split(",");
}

var options1 = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '25%',
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 3,
        colors: ['transparent']
    },
    colors: colors,
    series: [{
        name: 'Projects',
        data: [56, 38, 85, 72, 28, 69, 55, 52, 69]
    }, {
        name: 'Working Hours',
        data: [176, 185, 256, 240, 187, 205, 191, 114, 194]
    }],
    xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    },
    legend: {
        offsetY: 7,
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.2
        },
        borderColor: '#9ca3af20',
        padding: {
            bottom: 5,
        }
    }
}

var chart1 = new ApexCharts(
    document.querySelector("#crm-project-statistics"),
    options1
);

chart1.render();

// Monthly Target Chart
var colors = ["#3073F1", "#0acf97"];
var dataColors = document.querySelector("#monthly-target").dataset.colors;

if (dataColors) {
    colors = dataColors.split(",");
}

var options2 = {
    chart: {
        height: 280,
        type: 'donut',
    },
    legend: {
        show: false
    },
    stroke: {
        colors: ['transparent']
    },
    series: [82, 37],
    labels: ["Done Projects", "Pending Projects"],
    colors: colors,
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
}

var chart2 = new ApexCharts(
    document.querySelector("#monthly-target"),
    options2
);

chart2.render();

// Project Overview Chart
var colors = ["#3073F1", "#0acf97", "#fa5c7c", "#ffbc00"];
var dataColors = document.querySelector("#project-overview-chart").dataset.colors;
if (dataColors) {
    colors = dataColors.split(",");
}

var options3 = {
    chart: {
        height: 350,
        type: 'radialBar'
    },
    colors: colors,
    series: [85, 70, 80, 65],
    labels: ['Product Design', 'Web Development', 'Illustration Design', 'UI/UX Design'],
    plotOptions: {
        radialBar: {
            track: {
                margin: 5,
            }
        }
    }
}

var chart3 = new ApexCharts(
    document.querySelector("#project-overview-chart"),
    options3
);

chart3.render();
