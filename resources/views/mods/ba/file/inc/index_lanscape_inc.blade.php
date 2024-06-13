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
        width: 297mm;
        margin: 0cm auto; /* Tengah halaman dengan margin atas dan bawah */
        padding: 0cm;  /* Padding dalam dokumen */
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        overflow: auto;
        /* border: 1px solid #ccc; */
        /* box-sizing: border-box; */
    }

    .margin {
        padding: 1cm;
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
            /* width: 100%;
            transform-origin: top left; */
        }

        .margin {
            padding: 0;
        }

        @page {
            size: A4 landscape;
            margin: 1cm;
        }

        .a4 {
            box-shadow: none;
            border: none;
            margin: 0;
            padding: 0;
            width: auto;
            height: auto;
            overflow: auto;
        }

        table {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            /* table-layout: fixed; */
        }


        /* th, td {
            word-wrap: break-word;
        } */

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

</style>
