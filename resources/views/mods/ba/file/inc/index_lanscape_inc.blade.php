<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Calibri', sans-serif;
        font-size: 10px;
        /* background-color: #e6e6e6; */
        line-height: 1.5;
    }

    .a4 {
        width: 297mm;
        /* Mengganti lebar menjadi 297mm untuk mode landscape */
    }

    .margin {
        padding: 1.7cm;
        background-color: white;
    }

    @media print {
        hr {
            display: none;
        }

        .margin {
            padding: 0;
        }

        @page {
            size: A4 landscape;
            /* Mengatur halaman ke mode landscape */
            /* margin: 1.7cm; */
        }

        body {
            font-family: 'Calibri', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
    }



    /* =============== */
    .table-no-padding td {
        padding: 0;
    }

    ol li {
        line-height: 2;
    }

    table,
    td {
        margin: 0;
    }

    .table-border,
    .table-border td {
        border: 1px #000000 solid;
    }

    .table-border-bold,
    .table-border-bold td {
        border: 2px #000000 solid;
    }

    /* vertical */
    .verticalTableHeader {
        white-space: nowrap;
        transform-origin: 50% 50%;
        transform: rotate(-90deg);
    }

    .verticalTableHeader:before {
        content: '';
        padding-top: 100%;
        display: inline-block;
        vertical-align: middle;
    }

    .table-padding td{
        padding: 3px;
    }

</style>
