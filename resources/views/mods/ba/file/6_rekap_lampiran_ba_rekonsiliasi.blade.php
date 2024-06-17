@include('mods.ba.file.6a_rekap_lampiran_ba_rekonsiliasi')
@include('mods.ba.file.6b_rekap_lampiran_ba_rekonsiliasi')
@include('mods.ba.file.6c_rekap_lampiran_ba_rekonsiliasi')
@include('mods.ba.file.6d_rekap_lampiran_ba_rekonsiliasi')

<script>

    document.addEventListener("DOMContentLoaded", function() {
        const maxWidth = 1047; // Lebar maksimum yang diizinkan dalam piksel
        const tableIds = ["myTable1", "myTable2", "myTable3"];

        tableIds.forEach(id => {
            const table = document.getElementById(id);
            const tableWidth = table.offsetWidth;

            if (tableWidth > maxWidth) {
                const scale = maxWidth / tableWidth;
                table.style.transformOrigin = "top left";
                table.style.transform = `scale(${scale})`;
            }

            console.log(`Table ${id} width: ${tableWidth}px`);
        });


    });
</script>
