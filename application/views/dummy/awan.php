<?php
  $url = base_url('index.php/TugasAkhir/lihatData');
  $jsondata = file_get_contents($url);
  $dataJsonDecode = json_decode($jsondata);
  $dataSemua = [];
  foreach ($dataJsonDecode->data as $key => $dataInt) {
    array_push($dataSemua, [
      'ph' =>  $dataInt->ph, 
      'lat' => $dataInt->lat, 
      'lng' => $dataInt->long
    ]);
  }
?>
    <script>
    
        setTimeout(function(){initMap(),location.reload()}, 120000);
        var map, heatmap;
        var gradient;
        // memindahkan data json php ke javascript
        var arrayLat = [];
        var arrayLong = [];
        var arrayPH = [];
        <?php foreach ($dataSemua as $key => $value) { ?>
          arrayLat.push("<?php echo $value['lat']; ?>");   
          arrayLong.push("<?php echo $value['lng']; ?>");   
          arrayPH.push("<?php echo $value['ph']; ?>");   
        <?php } ?>

        function initMap() {        
        var poly, geodesicPoly, heatmap;
        var markerinterpolasi = [];
        var latMarker = []; var lngMarker = [];
        var marker = [];
        var latLng = [];
        var interpolateA;
        var latMark = []; var lngMark = [];
        var A = [];

        var jmlLat;
        var jmlLng;
        var laT;
        var lnG;
        var d;
        
        

            var obMaps = {
                inMarker: marker,
                inMarkerInterpolate: markerinterpolasi,
                inLatLng: latLng
            };
          
            map = new google.maps.Map(document.getElementById('map'), {
            zoom: 20,
            center: {lat: -6.972837, lng: 107.631684}
            });

            map.setMapTypeId('satellite');

            gradient = [
            'rgba(255, 255, 255, 0)',
            'rgba(175, 255, 122, 1)',
            'rgba(152, 246, 100, 1)',
            'rgba(126, 237, 78, 1)',
            'rgba(96, 227, 52, 1)',
            'rgba(56, 218, 16, 1)',
            'rgba(56, 225, 15, 1)',
            'rgba(56, 232, 13, 1)',
            'rgba(56, 239, 11, 1)',
            'rgba(56, 246, 8, 1)',
            'rgba(48, 247, 22, 1)',
            'rgba(39, 249, 31, 1)',
            'rgba(26, 250, 39, 1)',
            'rgba(3, 251, 45, 1)',
            'rgba(16, 252, 59, 1)',
            'rgba(25, 253, 70, 1)',
            'rgba(33, 254, 81, 1)',
            'rgba(40, 255, 90, 1)',
            'rgba(33, 255, 121, 1)',
            'rgba(41, 255, 146, 1)',
            'rgba(59, 255, 169, 1)',
            'rgba(81, 255, 188, 1)',
            'rgba(94, 251, 198, 1)',
            'rgba(109, 246, 206, 1)',
            'rgba(125, 241, 212, 1)',
            'rgba(141, 235, 216, 1)',
            'rgba(127, 237, 223, 1)',
            'rgba(110, 238, 231, 1)',
            'rgba(91, 239, 240, 1)',
            'rgba(66, 240, 250, 1)',
            'rgba(75, 239, 252, 1)',
            'rgba(84, 237, 253, 1)',
            'rgba(93, 236, 254, 1)',
            'rgba(101, 234, 255, 1)',
            'rgba(89, 246, 235, 1)',
            'rgba(122, 254, 202, 1)',
            'rgba(174, 255, 163, 1)',
            'rgba(233, 255, 127, 1)',
            'rgba(233, 255, 122, 1)',
            'rgba(234, 255, 117, 1)',
            'rgba(234, 255, 112, 1)',
            'rgba(235, 255, 107, 1)',
            'rgba(239, 254, 92, 1)',
            'rgba(244, 253, 75, 1)',
            'rgba(249, 252, 55, 1)',
            'rgba(255, 251, 25, 1)',
            'rgba(253, 248, 37, 1)',
            'rgba(250, 245, 46, 1)',
            'rgba(248, 242, 54, 1)',
            'rgba(245, 239, 60, 1)',
            'rgba(250, 220, 50, 1)',
            'rgba(253, 201, 44, 1)',
            'rgba(254, 182, 44, 1)',
            'rgba(252, 164, 47, 1)',
            'rgba(253, 150, 41, 1)',
            'rgba(253, 136, 37, 1)',
            'rgba(253, 121, 36, 1)',
            'rgba(252, 105, 37, 1)',
            'rgba(252, 96, 30, 1)',
            'rgba(252, 85, 24, 1)',
            'rgba(252, 74, 18, 1)',
            'rgba(252, 60, 12, 1)',
            'rgba(251, 51, 8, 1)',
            'rgba(251, 41, 5, 1)',
            'rgba(250, 27, 2, 1)',
            'rgba(249, 0, 0 ,1)',
            'rgba(237, 4, 4, 1)',
            'rgba(224, 7, 8, 1)',
            'rgba(212, 10, 11, 1)',
            'rgba(200, 13, 13, 1)',
            'rgba(189, 11, 11, 1)',
            'rgba(178, 9, 9, 1)',
            'rgba(167, 8, 8, 1)',
            'rgba(156, 6, 6, 1)',
            'rgba(132, 1, 10, 1)',
            'rgba(109, 0, 10, 1)',
            'rgba(86, 0, 7, 1)',
            'rgba(64, 1, 1, 1)',
            'rgba(51, 5, 7, 1)',
            'rgba(38, 5, 9, 1)',
            'rgba(25, 3, 7, 1)',
            'rgba(0, 0, 0, 1)'
            ]

            heatmap = new google.maps.visualization.HeatmapLayer({
            data: obMaps.inLatLng,
            map: map
            });

            heatmap.set('gradient', gradient);
            heatmap.set('radius', 50);

            var iconInterpolasi = {
            url: "<?php echo base_url('download.png')?>",
            scaledSize: new google.maps.Size(1,1),
            origin: new google.maps.Point(0,0),
            anchor: new google.maps.Point(0,0)
            }

            for (i = 0; i < arrayLat.length; i++) {
            marker[i+1] = new google.maps.Marker({
                map: map,
                position: {
                lat: parseFloat(arrayLat[i]), 
                lng: parseFloat(arrayLong[i])
                }
            });
            }

            var 
            popUp = "",
            iterator = [1,2,3,4,5],
            infowindows = []

            arrayPH.forEach(function(data, index) {
                popUp = 
                    '<div id="content"><div id="siteNotice"></div>'+
                    '<h1 id="firstHeading" class="firstHeading">Titik '+ (index+1) +'</h1>'+
                    '<div id="bodyContent">'+
                    '<p>Lat: '+ arrayLat[index]+'</p>'+
                    '<p>Lng: '+ arrayLong[index]+'</p>'+
                    '<p>Data TDS: '+ arrayPH[index]+'</p>'+
                    '</div>'+
                    '</div>';
                infowindows[index+1] = new google.maps.InfoWindow({
                    content: popUp
                });
                marker[index+1].addListener('click', function() {
                    infowindows[index+1].open(map, marker[index+1]);
                });
            })

            var arrayPH1 = parseFloat(arrayPH);
            var arrayLat1 = arrayLat;
            var arrayLng1 = arrayLong;
            var arrayPH2 = [];
            var arrayLat2 = [];
            var arrayLng2 = [];

            var arrayLatTemp1 = [];
            var arrayLatTemp2 = arrayLong;
            var arrayLongTemp1 = [];
            var arrayLongTemp2 = arrayLat;
            var arrayPHTemp1 = [];
            var arrayPHTemp2 = arrayPH;
            var indexArrayCount = 0;

            for(var j = 0; j < 4; j++) {
                for (var i = 0; i < arrayLatTemp2.length-1; i++) {
                    jmlLat = ((parseFloat(arrayLatTemp2[i]) + parseFloat(arrayLatTemp2[i+1])) / 2);
                    jmlLng = ((parseFloat(arrayLongTemp2[i]) + parseFloat(arrayLongTemp2[i+1])) / 2);
                    laT = Math.pow((jmlLat - parseFloat(arrayLatTemp2[i])),2);
                    lnG = Math.pow((jmlLng - parseFloat(arrayLongTemp2[i])),2);
                    d = Math.sqrt(laT+lnG);
                    
                    if (i == 0){ 
                        // push titik A
                        arrayLatTemp1[indexArrayCount] = parseFloat(arrayLatTemp2[i]);
                        arrayLongTemp1[indexArrayCount] = parseFloat(arrayLongTemp2[i]);
                        arrayPHTemp1[indexArrayCount] = parseFloat(arrayPHTemp2[i]);
                        indexArrayCount = indexArrayCount + 1;
                        
                        // push titik tengah                        
                        arrayLatTemp1[indexArrayCount] = jmlLat;
                        arrayLongTemp1[indexArrayCount] = jmlLng;
                        arrayPHTemp1[indexArrayCount] = ((arrayPHTemp2[i] / d) + (arrayPHTemp2[i+1] / d)) / ((1 / d) + (1 / d));
                        indexArrayCount = indexArrayCount + 1;

                        // push titik B
                        arrayLatTemp1[indexArrayCount] = parseFloat(arrayLatTemp2[i+1]);
                        arrayLongTemp1[indexArrayCount] = parseFloat(arrayLongTemp2[i+1]);
                        arrayPHTemp1[indexArrayCount] = parseFloat(arrayPHTemp2[i+1]);
                        indexArrayCount = indexArrayCount + 1;
                    }
                    else{
                        // push titik tengah                        
                        arrayLatTemp1[indexArrayCount] = jmlLat;
                        arrayLongTemp1[indexArrayCount] = jmlLng;
                        arrayPHTemp1[indexArrayCount] = ((arrayPHTemp2[i] / d) + (arrayPHTemp2[i+1] / d)) / ((1 / d) + (1 / d));
                        indexArrayCount = indexArrayCount + 1;
                        
                        // push titik B
                        arrayLatTemp1[indexArrayCount] = parseFloat(arrayLatTemp2[i+1]);
                        arrayLongTemp1[indexArrayCount] = parseFloat(arrayLongTemp2[i+1]);
                        arrayPHTemp1[indexArrayCount] = parseFloat(arrayPHTemp2[i+1]);
                        indexArrayCount = indexArrayCount + 1;
                    }
                
                }
                arrayLatTemp2 = arrayLatTemp1;
                arrayLongTemp2 = arrayLongTemp1;
                arrayPHTemp2 = arrayPHTemp1;
                
                arrayLatTemp1 = [];
                arrayLongTemp1 = [];
                arrayPHTemp1 = [];
                indexArrayCount = 0;
            }

            for (var k = 0; k < arrayPHTemp2.length; k++) {
                markerinterpolasi[k] = new google.maps.Marker({
                    map: map,
                    draggable: false,
                    position: {
                        lat: parseFloat(arrayLatTemp2[k]), 
                        lng: parseFloat(arrayLongTemp2[k])
                    },
                    icon : iconInterpolasi 
                });

                latMarker[i] = markerinterpolasi[k].getPosition().lat();
                lngMarker[i] = markerinterpolasi[k].getPosition().lng();

                if(arrayPHTemp2[k] == 7.00)
                {
                    //baik = hijau
                    console.log(arrayPHTemp2[k] + ", baik");
                    latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.1});
                } 
                else if(arrayPHTemp2[k] > 7.00 && arrayPHTemp2[k] <= 13.00)
                {
                    //sedang = biru
                    console.log(arrayPHTemp2[k] + ", sedang");
                    latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.2});
                }
                else if(arrayPHTemp2[k] > 13)
                {
                    //sedang = biru
                    console.log(arrayPHTemp2[k] + ", sangat sangat buruk");
                    latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.2});
                }
                else if(arrayPHTemp2[k] >= 4.00 && arrayPHTemp2[k] <= 6.00)
                {
                    //tidak sehat = kuning
                    console.log(arrayPHTemp2[k] + ", tidak sehat");
                    latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.3});
                }
                else if(arrayPHTemp2[k] < 4.00)
                {
                    //sangat tidak sehat = merah
                    console.log(arrayPHTemp2[k] + ", sangat tidak sehat");
                    latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.4});
                }
                // else if(interpolateTDS >= 1201.00)
                // {
                //     //berbahaya = hitam
                //     console.log(interpolateTDS + ", berbahaya");
                //     latLng.push({location: new google.maps.LatLng(latMarker[i], lngMarker[i]), weight: 0.9});
                // }
            }

            var bounds = new google.maps.LatLngBounds();
            
            for(var l = 0; l <= arrayPHTemp2.length; l++){
                var loc = new google.maps.LatLng(marker[l].getPosition().lat(), marker[l].getPosition().lng());
            }

            bounds.extend(loc);
            map.panToBounds(bounds);
            //map.fitBounds(bounds);

            poly = new google.maps.Polyline({
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 3,
                map: map,
            });

            geodesicPoly = new google.maps.Polyline({
                strokeColor: '#CC0099',
                strokeOpacity: 1.0,
                strokeWeight: 3,
                geodesic: true,
                map: map
            });
      
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8i6rKTleK3wfdzpeGWATBBZUdmC5cZgg&libraries=geometry,visualization&callback=initMap" async defer></script>
</body>

</html>