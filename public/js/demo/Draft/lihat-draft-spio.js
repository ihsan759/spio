$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        searchBuilder: true,
        searchBuilder: {
            columns: [1,2,4,8],
            conditions: {
                date: {
                    '!between': {
                        "conditionName": "Diluar antara tanggal"
                    },
                    'between': {
                        "conditionName": "Antara tanggal"
                    },
                    '=': {
                        "conditionName": "Sama dengan tanggal"
                    },
                    '!=': {
                        "conditionName": "Selain tanggal"
                    },
                    'null': null,
                    '!null': null,
                    '>': {
                        "conditionName": "Setelah tanggal"
                    },
                    '<': {
                        "conditionName": "Sebelum tanggal"
                    },
                },
                num:{
                    '>':null,
                    '>=':null,
                    '<=':null,
                    '<':null,
                    '=': {
                        "conditionName": "Sesuai dengan"
                    },
                    '!=': {
                        "conditionName": "Tidak sesuai dengan"
                    },
                    '!between':null,
                    'between':null,
                    '!null':null,
                    'null':null
                },
                string:{
                    '=': {
                        "conditionName": "Sesuai dengan"
                    },
                    '!=': {
                        "conditionName": "Selain dengan"
                    },
                    'starts':null,
                    '!starts':null,
                    'ends':null,
                    '!ends':null,
                    'contains':null,
                    '!contains':null,
                    'null': {
                        "conditionName": "Data kosong"
                    },
                    '!null': {
                        "conditionName": "Selain data kosong"
                    },
                }
            }
        },
        "oLanguage": {
            "sSearch": "Pencarian:",
            "sZeroRecords": "Tidak ada data",
            "sInfoEmpty": "Tidak ada data",
            "sLengthMenu": "Tampilan _MENU_ data",
            "sInfo": "Tampilan _START_ sampai _END_ dari _TOTAL_ data"
          },
          language: {
            oPaginate: {
               sNext: 'Selanjutnya',
               sPrevious: 'Sebelumnya',
               sFirst: 'Pertama',
               sLast: 'Terakhir'
            },
            searchBuilder: {
                add: 'Tambah',
                condition: 'Kondisi',
                clearAll: 'Hapus Semua',
                delete: 'Hapus',
                deleteTitle: 'Hapus Judul',
                data: 'Data',
                left: 'Kiri',
                leftTitle: 'Kiri Judul',
                logicAnd: 'Dan',
                logicOr: 'Atau',
                right: 'Kanan',
                rightTitle: 'Kanan Judul',
                title: {
                    0: 'Kondisi',
                    _: 'Kondisi (%d)'
                },
                value: 'Option',
                valueJoiner: 'et'
            }
          }
    });
    table.searchBuilder.container().prependTo(table.table().container());
});