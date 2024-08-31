import { Grid, html } from "gridjs";
import Swal from "sweetalert2";
window.gridjs = Grid;

class GridDatatable {
    constructor() {
        this.grid = null;
        this.originalData = [];
    }

    init() {
        this.basicTableInit();
    }

    async fetchData() {
        const response = await fetch('/vehicles/data');
        const data = await response.json();
        console.log(response);  // Tambahkan ini untuk melihat data di console
        this.originalData = data;
        return this.mapData(data);
    }
    

    mapData(data) {
        return data.map(vehicle => {
            const [month, year] = vehicle.bulan_dec ? vehicle.bulan_dec.split(' ') : [null, null];
            const bulanMapping = {
                "Januari": "Januari",
                "Februari": "Februari",
                "Maret": "Maret",
                "April": "April",
                "Mei": "Mei",
                "Juni": "Juni",
                "Juli": "Juli",
                "Agustus": "Agustus",
                "September": "September",
                "Oktober": "Oktober",
                "November": "November",
                "Desember": "Desember"
            };
            const monthNumber = bulanMapping[month] || "00"; // default to "00" if month is undefined
            const formattedMonthYear = month && year ? `${monthNumber} / ${year}` : '';

            return [
                vehicle.id,
                html(`<a href="/vehicles/${vehicle.id}/edit" class="text-blue-600 hover:text-blue-800">${vehicle.nopol}</a>`),
                vehicle.no_rangka,
                vehicle.customer,
                vehicle.model,
                vehicle.warna,
                vehicle.tgl_dec,
                vehicle.masa_pakai,
                html(`
                    <button onclick="deleteVehicle(${vehicle.id})" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
                `),
            ];
        });
    }

    async basicTableInit() {
        const data = await this.fetchData();
        this.grid = new Grid({
            columns: [
                { name: 'ID', hidden: true },
                { name: 'Nopol', width: '80px' },
                { name: 'No Rangka', width: '150px' },
                { name: 'Customer', width: '150px' },
                { name: 'Model', width: '100px' },
                { name: 'Warna', width: '100px' },
                {
                    name: 'Bulan DEC',
                    width: '100px',
                    sort: {
                        compare: (a, b) => {
                            const bulanMapping = {
                                "Januari": 1,
                                "Februari": 2,
                                "Maret": 3,
                                "April": 4,
                                "Mei": 5,
                                "Juni": 6,
                                "Juli": 7,
                                "Agustus": 8,
                                "September": 9,
                                "Oktober": 10,
                                "November": 11,
                                "Desember": 12
                            };
                            const [monthA, yearA] = a.split(' ');
                            const [monthB, yearB] = b.split(' ');
                            if (yearA !== yearB) {
                                return parseInt(yearA) - parseInt(yearB);
                            }
                            return bulanMapping[monthA] - bulanMapping[monthB];
                        }
                    }
                },
                { name: 'Masa Pakai', width: '100px' },
                { name: 'Actions', sort: false, width: '80px' },
            ],
            pagination: { limit: 10 },
            sort: true,
            search: true,
            data: data,
            resizable: true,
            className: {
                search: 'custom-search-input',
                pagination: 'custom-pagination'
            },
            style: {
                table: {
                    'width': '100%',
                    'font-size': '14px',
                },
                th: {
                    'background-color': '#f4f4f4',
                },
                td: {
                    'padding': '8px',
                    'border': '1px solid #ddd',
                }
            }
        }).render(document.getElementById("table-gridjs"));

        this.setupFilters();
    }

    setupFilters() {
        const tahunFilter = document.getElementById('tahunFilter');
        const bulanFilter = document.getElementById('bulanFilter');
        const masaPakaiFilter = document.getElementById('masaPakaiFilter');
        const warnaFilter = document.getElementById('warnaFilter');
        const customerFilter = document.getElementById('customerFilter');

        [tahunFilter, bulanFilter, masaPakaiFilter, warnaFilter, customerFilter].forEach(filter => {
            filter.addEventListener('change', () => this.applyFilters());
        });
    }

    applyFilters() {
        const tahunValue = document.getElementById('tahunFilter').value;
        const bulanValue = document.getElementById('bulanFilter').value;
        const masaPakaiValue = document.getElementById('masaPakaiFilter').value;
        const warnaValue = document.getElementById('warnaFilter').value;
        const customerValue = document.getElementById('customerFilter').value;

        const filteredData = this.originalData.filter(vehicle => {
            const [month, year] = vehicle.bulan_dec ? vehicle.bulan_dec.split(' ') : [null, null];
            const bulanMapping = {
                "Januari": "01",
                "Februari": "02",
                "Maret": "03",
                "April": "04",
                "Mei": "05",
                "Juni": "06",
                "Juli": "07",
                "Agustus": "08",
                "September": "09",
                "Oktober": "10",
                "November": "11",
                "Desember": "12"
            };
            const monthNumber = bulanMapping[month] || "00";
            const matchYear = !tahunValue || year === tahunValue;
            const matchMonth = !bulanValue || monthNumber === bulanValue;

            const masaPakai = parseInt(vehicle.masa_pakai, 10);
            const matchMasaPakai = !masaPakaiValue || (
                (masaPakaiValue === '1-3' && masaPakai >= 1 && masaPakai <= 3) ||
                (masaPakaiValue === '4-6' && masaPakai >= 4 && masaPakai <= 6) ||
                (masaPakaiValue === '7-9' && masaPakai >= 7 && masaPakai <= 9) ||
                (masaPakaiValue === '>10' && masaPakai > 10)
            );

            return matchYear && matchMonth && matchMasaPakai &&
                   (!warnaValue || vehicle.warna === warnaValue) &&
                   (!customerValue || vehicle.customer === customerValue);
        });

        // Update table with filtered data
        const tableBody = document.querySelector('.gridjs-table tbody');
        if (tableBody) {
            tableBody.classList.add('opacity-0');

            setTimeout(() => {
                this.grid.updateConfig({
                    data: this.mapData(filteredData)
                }).forceRender();

                tableBody.classList.remove('opacity-0');
            }, 300); // Duration of transition
        }
    }
}


async function deleteVehicle(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(`/vehicles/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (response.ok) {
                const result = await response.json();
                Swal.fire({
                    title: 'Deleted!',
                    text: result.success,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    location.reload();
                });
            } else {
                const error = await response.json();
                Swal.fire({
                    title: 'Failed!',
                    text: 'Failed to delete vehicle: ' + (error.message || 'Unknown error'),
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
            }
        }
    });
}

window.deleteVehicle = deleteVehicle;

document.addEventListener('DOMContentLoaded', function () {
    new GridDatatable().init();
});


async function fetchData() {
    const response = await fetch('/vehicles/data');
    const data = await response.json();
    
    // Log data untuk melihat isi dari respons JSON
    console.log(data);  // Ini akan menampilkan isi data di console browser
}

fetchData();
