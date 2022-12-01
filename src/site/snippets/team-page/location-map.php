
<?php if (isset($viewedTeam['latitude'])&&isset($viewedTeam['longitude'])) : ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<style>
    #mapid {
        height: 400px;
        border: 1px solid black;
    }

    .flex-grid {
        justify-content: flex-start;
    }
</style>
<h3><?=t("Location")?></h3>
<div id="mapid"></div>
<script>
    var mymap = L
        .map('mapid')
        .setView([
            50.0755381, 14.43780049999998
        ], 13)
        .setZoom(4);
    L
        .tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiamFtZXNkcmV2ZXIiLCJhIjoiY2txMmhzbnJ4MGJ2aDJva2FoN3QxdmR0dCJ9.ZNR6w7R_dVfQeX2Dj2v4KA'
        })
        .addTo(mymap);

    var marker = L
        .marker([<?=$viewedTeam['latitude'] ?>, <?=$viewedTeam['longitude'] ?>])
        .addTo(mymap);
    marker.bindPopup('<?=$viewedTeam['name']?>');
</script>
<?php endif ?>