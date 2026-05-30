
<script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- SweetAlert (ONLY ONCE) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Webcam -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<!-- ===================== -->
<!-- LEAFLET (FIXED SAFE LOAD) -->
<!-- ===================== -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>

<!-- ===================== -->
<!-- OPTIONAL -->
<!-- ===================== -->
<script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- ===================== -->
<!-- CHART SAFE -->
<!-- ===================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    let el = document.getElementById("chartdiv");
    if (!el) return;

    try {
        am4core.useTheme(am4themes_animated);

        let chart = am4core.create("chartdiv", am4charts.PieChart3D);

        chart.data = [
            { country: "Hadir", litres: 501.9 },
            { country: "Sakit", litres: 301.9 },
            { country: "Izin", litres: 201.1 },
            { country: "Terlambat", litres: 165.8 }
        ];

        let series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";

    } catch (e) {
        console.log("Chart error:", e);
    }

});
</script>

<!-- ===================== -->
<!-- BASE APP -->
<!-- ===================== -->
<script src="{{ asset('assets/js/base.js') }}"></script>

<!-- ===================== -->
<!-- PAGE SCRIPT -->
<!-- ===================== -->
@stack('myscript')