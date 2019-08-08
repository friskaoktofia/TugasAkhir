<script>
      setTimeout(function(){initMap(),location.reload()}, 120000);
      var map, heatmap;
      var gradient;

      function initMap() {
        var poly, geodesicPoly, heatmap;
        var markerinterpolasi = [];
        var latMarker = []; var lngMarker = [];
        var marker = [];
        var latLng = [];
        var tempPeta;
        var tempSuhu = [];
        var interpolatePeta;
        var interpolateSuhu;
        var latMark = []; var lngMark = [];
        var suhu = [];
        
        $.get('<?php echo site_url("TugasAkhir/dataJson")?>', function(data){
          var tempData = JSON.parse(data);
          var myData = JSON.parse(tempData['detail']);
          console.log(myData)
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
          heatmap.set('radius', 100);


          marker[1] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[0].lat), lng: parseFloat(myData[0].lng)},
            title: 'Stasiun 1'
          });

          marker[2] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[1].lat), lng: parseFloat(myData[1].lng)},
            title: 'Stasiun 2'
          });

          marker[3] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[2].lat), lng: parseFloat(myData[2].lng)},
            title: 'Stasiun 3'
          });

          marker[4] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[3].lat), lng: parseFloat(myData[3].lng)},
            title: 'Stasiun 4'
          });

          marker[5] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[4].lat), lng: parseFloat(myData[4].lng)},
            title: 'Stasiun 5'
          });
          
          var 
            popUp = "",
            iterator = [1,2,3,4,5],
            infowindows = []

          iterator.forEach(function(data, index) {
            popUp = 
              '<div id="content"><div id="siteNotice"></div>'+
              '<h1 id="firstHeading" class="firstHeading">Info Stasiun '+ data +'</h1>'+
              '<div id="bodyContent">'+
              '<p>Lat: '+ marker[data].getPosition().lat()+'</p>'+
              '<p>Lng: '+ marker[data].getPosition().lng()+'</p>'+
              '<p>Data Suhu: '+parseFloat(myData[data-1].suhu)+'</p>'+
              '<p>Last Update: '+tempData['waktu']+'.</p>'+
              '</div>'+
              '</div>';
            infowindows[data] = new google.maps.InfoWindow({
              content: popUp
            });
            marker[data].addListener('click', function() {
              infowindows[data].open(map, marker[data]);
            });
          })

          for (var i = 1; i <= 5; i++) {
            suhu[i] = parseFloat(myData[i-1].suhu);
            latMark[i] = marker[i].getPosition().lat();
            lngMark[i] = marker[i].getPosition().lng();
          }

          for (var i = 1; i <= 5; i++) {
            if(suhu[i] >= 1.00 && suhu[i] <= 450.00)
              {
                //baik = hijau
                latLng.push({location: new google.maps.LatLng(marker[i].getPosition().lat(), marker[i].getPosition().lng()), weight: 0.1});
              } 
              else if(suhu[i] >= 451.00 && suhu[i] <= 600.00)
              {
                //sedang = biru
                latLng.push({location: new google.maps.LatLng(marker[i].getPosition().lat(), marker[i].getPosition().lng()), weight: 0.2});
              }
              else if(suhu[i] >= 601.00 && suhu[i] <= 1000.00)
              {
                //tidak sehat = kuning
                latLng.push({location: new google.maps.LatLng(marker[i].getPosition().lat(), marker[i].getPosition().lng()), weight: 0.3});
              }
              else if(suhu[i] >= 1001.00 && suhu[i] <= 2500.00)
              {
                //sangat tidak sehat = merah
                latLng.push({location: new google.maps.LatLng(marker[i].getPosition().lat(), marker[i].getPosition().lng()), weight: 0.4});
              }
              else if(suhu[i] >= 2501.00)
              {
                //berbahaya = hitam
                latLng.push({location: new google.maps.LatLng(marker[i].getPosition().lat(), marker[i].getPosition().lng()), weight: 0.9});
              }
          }

          var addRange = 0.02;
          for (var i = 1; i <= 5; i++) {
            tempPeta = latMark[i];
            for (var j=1; j <= 50 ; j++) { 
              interpolateSuhu = (suhu[i]*(1-addRange))+(suhu[i+1]*addRange);
            
              interpolatePeta = (lngMark[i]*(1-addRange))+(lngMark[i+1]*addRange);
              
              addRange = addRange + 0.02;

              markerinterpolasi[j] = new google.maps.Marker({
                map: map,
                draggable: false,
                position: {lat: parseFloat(tempPeta), lng: parseFloat(interpolatePeta)}
              });

              latMarker[j] = markerinterpolasi[j].getPosition().lat();
              lngMarker[j] = markerinterpolasi[j].getPosition().lng();
              console.log(latMarker[j]+", "+lngMarker[j])
              
              if(interpolateSuhu >= 1.00 && interpolateSuhu <= 450.00)
              {
                //baik = hijau
                console.log(interpolateSuhu + ", baik");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.1});
              } 
              else if(interpolateSuhu >= 451.00 && interpolateSuhu <= 600.00)
              {
                //sedang = biru
                console.log(interpolateSuhu + ", sedang");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.2});
              }
              else if(interpolateSuhu >= 601.00 && interpolateSuhu <= 1000.00)
              {
                //tidak sehat = kuning
                console.log(interpolateSuhu + ", tidak sehat");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.3});
              }
              else if(interpolateSuhu >= 1001.00 && interpolateSuhu <= 2500.00)
              {
                //sangat tidak sehat = merah
                console.log(interpolateSuhu + ", sangat tidak sehat");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.4});
              }
              else if(interpolateSuhu >= 2501.00)
              {
                //berbahaya = hitam
                console.log(interpolateSuhu + ", berbahaya");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.9});
              }
            }
          }

          var bounds = new google.maps.LatLngBounds();
          var loc = new google.maps.LatLng(parseFloat(marker[1].getPosition()), parseFloat(marker[2].getPosition()), parseFloat(marker[3].getPosition()), parseFloat(marker[4].getPosition()), parseFloat(marker[5].getPosition()));
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
        });

      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8i6rKTleK3wfdzpeGWATBBZUdmC5cZgg&libraries=geometry,visualization&callback=initMap" async defer></script>

</body>

</html>