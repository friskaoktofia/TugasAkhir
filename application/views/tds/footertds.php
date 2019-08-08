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
        var tempTDS = [];
        var interpolatePeta;
        var interpolateTDS;
        var latMark = []; var lngMark = [];
        var tds = [];
        var vTDS = []; var uTDS = []; var hTDS = []; var bTDS = [];
        var vPeta = []; var uPeta = []; var hPeta = []; var bPeta = [];
        var zTDS = []; var zPeta = [];
        var pers1TDS, pers2TDS, pers3TDS, pers4TDS;
        var pers1Peta, pers2Peta, pers3Peta, pers4Peta;
        var aTDS, invTDS;
        var aPeta, invPeta;
        zPeta[0] = 0; zPeta[4] = 0;
        zTDS[0] = 0; zTDS[4] = 0;
        
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

          // var iconSensor = {
          //   url: "<?php echo base_url('iconfix.png')?>",
          //   scaledSize: new google.maps.Size(18,25),
          //   origin: new google.maps.Point(0,0),
          //   anchor: new google.maps.Point(0,0)
          // }

          // var iconInterpolasi = {
          //   url: "<?php echo base_url('ungu.png')?>",
          //   scaledSize: new google.maps.Size(1,1),
          //   origin: new google.maps.Point(0,0),
          //   anchor: new google.maps.Point(0,0)
          // }

          marker[1] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[0].lat), lng: parseFloat(myData[0].lng)},
            // icon: iconSensor,
            title: 'Stasiun 1'
          });

          marker[2] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[1].lat), lng: parseFloat(myData[1].lng)},
            // icon: iconSensor,
            title: 'Stasiun 2'
          });

          marker[3] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[2].lat), lng: parseFloat(myData[2].lng)},
            // icon: iconSensor,
            title: 'Stasiun 3'
          });

          marker[4] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[3].lat), lng: parseFloat(myData[3].lng)},
            // icon: iconSensor,
            title: 'Stasiun 4'
          });

          marker[5] = new google.maps.Marker({
            map: map,
            draggable: false,
            position: {lat: parseFloat(myData[4].lat), lng: parseFloat(myData[4].lng)},
            // icon: iconSensor,
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
              '<p>Data TDS: '+parseFloat(myData[data-1].tds)+'</p>'+
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

          for (var i = 0; i <= 4; i++) {
            tds[i] = parseFloat(myData[i].tds);
            latMark[i] = marker[i+1].getPosition().lat();
            lngMark[i] = marker[i+1].getPosition().lng();
            console.log(tds);
          }

          for (var i = 0; i <= 4; i++) {
            if(tds[i] <= 300.00)
              {
                //baik = hijau
                latLng.push({location: new google.maps.LatLng(marker[i+1].getPosition().lat(), marker[i+1].getPosition().lng()), weight: 0.1});
              } 
              else if(tds[i] >= 301.00 && tds[i] <= 600.00)
              {
                //sedang = biru
                latLng.push({location: new google.maps.LatLng(marker[i+1].getPosition().lat(), marker[i+1].getPosition().lng()), weight: 0.2});
              }
              else if(tds[i] >= 601.00 && tds[i] <= 900.00)
              {
                //tidak sehat = kuning
                latLng.push({location: new google.maps.LatLng(marker[i+1].getPosition().lat(), marker[i+1].getPosition().lng()), weight: 0.3});
              }
              else if(tds[i] >= 901.00 && tds[i] <= 1200.00)
              {
                //sangat tidak sehat = merah
                latLng.push({location: new google.maps.LatLng(marker[i+1].getPosition().lat(), marker[i+1].getPosition().lng()), weight: 0.4});
              }
          }

          
          for (var i = 0; i <= 4; i++) {
            hTDS[i] = (i+1) - i;
            bTDS[i] = (1/hTDS[i])*(tds[i+1] - tds[i]);

            hPeta[i] = lngMark[i+1] - lngMark[i];
            bPeta[i] = (1/hPeta[i])*(latMark[i+1] - latMark[i]);

            if (i >= 1) {
              vTDS[i] = 2*(hTDS[i-1] + hTDS[i]);
              uTDS[i] = 6*(bTDS[i] - bTDS[i-1]);

              vPeta[i] = 2*(hPeta[i-1] + hPeta[i]);
              uPeta[i] = 6*(bPeta[i] - bPeta[i-1]);

            }
          }

          aTDS = ((vTDS[1]*vTDS[2]*vTDS[3])-(vTDS[1]*hTDS[2]*hTDS[2])-(hTDS[2]*hTDS[1]*vTDS[3])).toFixed(2);
          invTDS = (1/aTDS).toFixed(2);

          aPeta = (vPeta[1]*vPeta[2]*vPeta[3])-(vPeta[1]*hPeta[2]*hPeta[2])-(hPeta[2]*hPeta[1]*vPeta[3]);
          invPeta = 1/aPeta;

          aPeta = (vPeta[1]*vPeta[2]*vPeta[3])-(vPeta[1]*hPeta[2]*hPeta[2])-(hPeta[2]*hPeta[1]*vPeta[3]);
          invPeta = 1/aPeta;

          zTDS[1] = (( invTDS*vTDS[1]*uTDS[1])+ (invTDS*hTDS[1]*uTDS[2])).toFixed(2);
          zTDS[2] = (( invTDS*hTDS[1]*uTDS[1])+ (invTDS*vTDS[2]*uTDS[2])+ (invTDS*hTDS[2]*uTDS[3])).toFixed(2);
          zTDS[3] = (( invTDS*hTDS[2]*uTDS[2])+ (invTDS*vTDS[3]*uTDS[3])).toFixed(2);

          zPeta[1] = ((invPeta*vPeta[1]*uPeta[1])+(invPeta*hPeta[1]*uPeta[2])).toFixed(2);
          zPeta[2] = ((invPeta*hPeta[1]*uPeta[1])+(invPeta*vPeta[2]*uPeta[2])+(invPeta*hPeta[2]*uPeta[3])).toFixed(2);
          zPeta[3] = ((invPeta*hPeta[2]*uPeta[2])+(invPeta*vPeta[3]*uPeta[3])).toFixed(2);

          var dividentPeta = parseFloat(0.000225 / 51);
          
          tempPeta = marker[1].getPosition().lng();

          for (var i = 0; i <= 3; i++) {
            tempTDS = i;

            for (var j=1; j <= 51 ; j++) { 
              tempTDS = tempTDS + 0.02;
              pers1TDS = (zTDS[i+1]/(6*hTDS[i]))*((tempTDS-i)*(tempTDS-i)*(tempTDS-i));
              pers2TDS = (zTDS[i]/(2*hTDS[i]))*((i-tempTDS)*(i-tempTDS)*(i-tempTDS));
              pers3TDS = ((tds[i+1]/hTDS[i])-((zTDS[i+1]/6)*hTDS[i]))*(tempTDS-i);
              pers4TDS = ((tds[i]/hTDS[i])-((hTDS[i]/6)*zTDS[i]))*((i+1)-tempTDS);
              interpolateTDS = (pers1TDS + pers2TDS + pers3TDS + pers4TDS).toFixed(2);
            
              tempPeta = tempPeta + dividentPeta;
              pers3Peta = (latMark[i+1]/hPeta[i])*(tempPeta-lngMark[i]);
              pers4Peta = (latMark[i]/hPeta[i])*(lngMark[i+1]-tempPeta);
              interpolatePeta = (pers3Peta + pers4Peta);

              markerinterpolasi[j] = new google.maps.Marker({
                map: map,
                draggable: false,
                position: {lat: parseFloat(tempPeta), lng: parseFloat(interpolatePeta)}  
              });

              latMarker[j] = markerinterpolasi[j].getPosition().lat();
              lngMarker[j] = markerinterpolasi[j].getPosition().lng();
              console.log(latMarker[j]+", "+lngMarker[j])
              
              if(interpolateTDS >= 1.00 && interpolateTDS <= 300.00)
              {
                //baik = hijau
                console.log(interpolateTDS + ", baik");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.1});
              } 
              else if(interpolateTDS >= 301.00 && interpolateTDS <= 600.00)
              {
                //sedang = biru
                console.log(interpolateTDS + ", sedang");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.2});
              }
              else if(interpolateTDS >= 601.00 && interpolateTDS <= 900.00)
              {
                //tidak sehat = kuning
                console.log(interpolateTDS + ", tidak sehat");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.3});
              }
              else if(interpolateTDS >= 901.00 && interpolateTDS <= 1200.00)
              {
                //sangat tidak sehat = merah
                console.log(interpolateTDS + ", sangat tidak sehat");
                latLng.push({location: new google.maps.LatLng(latMarker[j], lngMarker[j]), weight: 0.4});
              }
              else if(interpolateTDS >= 1201.00)
              {
                //berbahaya = hitam
                console.log(interpolateTDS + ", berbahaya");
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