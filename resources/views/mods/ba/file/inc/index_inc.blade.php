<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
        font-size: 12px;
        line-height: 1.5;
    }

    .a4 {
        width: 210mm;
        margin: 0cm auto; /* Tengah halaman dengan margin atas dan bawah */
        padding: 0cm;  /* Padding dalam dokumen */
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* border: 1px solid #ccc; */
        /* box-sizing: border-box; */
    }

    .margin {
        padding: 2.5cm;
        margin-bottom: 20px;
        position: relative;
    }

    .justify{
        text-align: justify;
    }

    @media print {

        body {
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .margin {
            padding: 0;
        }

        @page {
            size: A4;
            margin: 2.5cm;
        }

        .a4 {
            box-shadow: none;
            border: none;
            margin: 0;
            padding: 0;
            width: auto;
            height: auto;
        }

        table {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

    }



    /* =============== */
    .table-no-padding td {
        padding: 0;
    }

    ol li {
        line-height: 2;
    }

    thead
    td{
        vertical-align: middle;
    }

    table,
    td {
        border-collapse: collapse;
    }

    .table-border,
    .table-border td {
        border: 1px #000000 solid;
    }

    .table-border-bold,
    .table-border-bold td {
        border: 1px #000000 solid;
    }

    /* vertical */
    .verticalTableHeader {
        /* white-space: nowrap;
        transform-origin: 50% 50%;
        transform: rotate(-90deg); */
        writing-mode: vertical-lr; /* Untuk dukungan browser modern */
        white-space: nowrap; /* Untuk memastikan teks tidak patah menjadi beberapa baris */
        transform: rotate(180deg);
        position: relative;
        /* right: 10px; */
    }

    .verticalTableHeader:before {
        /* content: '';
        padding-top: 100%;
        display: inline-block;
        vertical-align: middle; */
    }
</style>
