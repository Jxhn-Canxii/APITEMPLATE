<template>
  <div id="map-container"></div>
</template>

<script setup>
import { onMounted } from 'vue';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { convertWebMercatorToLatLng } from "@/Utility/Formatter.js";

const landmarkIcon = L.icon({
  iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png', // Ensure this URL is accessible
  iconSize: [25, 41], 
  iconAnchor: [12, 41], 
  popupAnchor: [1, -34], 
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
  shadowSize: [41, 41]
});

const brgySanAgustin = {
  "type": "FeatureCollection",
  "generator": "overpass-turbo",
  "copyright": "The data included in this document is from www.openstreetmap.org. The data is made available under ODbL.",
  "timestamp": "2025-03-25T11:04:45Z",
  "features": [
    {
      "type": "Feature",
      "properties": {
        "@id": "relation/1751066",
        "admin_level": "10",
        "boundary": "administrative",
        "name": "San Agustin",
        "postal_code": "1117",
        "ref": "137404095",
        "type": "boundary"
      },
      "geometry": {
        "type": "Polygon",
        "coordinates": [
          [
            [
              121.0397334,
              14.7268438
            ],
            [
              121.039594,
              14.7269708
            ],
            [
              121.0392642,
              14.7269442
            ],
            [
              121.0392783,
              14.7271199
            ],
            [
              121.0392635,
              14.7274917
            ],
            [
              121.0392253,
              14.7276168
            ],
            [
              121.039177,
              14.7277309
            ],
            [
              121.0389531,
              14.7284975
            ],
            [
              121.0387346,
              14.7284522
            ],
            [
              121.0385628,
              14.7284417
            ],
            [
              121.0387385,
              14.7290053
            ],
            [
              121.0388126,
              14.7291038
            ],
            [
              121.0389827,
              14.7291367
            ],
            [
              121.0390071,
              14.7293253
            ],
            [
              121.038925,
              14.7298116
            ],
            [
              121.0388874,
              14.7298568
            ],
            [
              121.0384023,
              14.7303893
            ],
            [
              121.0382884,
              14.730555
            ],
            [
              121.0372535,
              14.7310267
            ],
            [
              121.0383709,
              14.7315364
            ],
            [
              121.0391779,
              14.7324043
            ],
            [
              121.0389137,
              14.7328398
            ],
            [
              121.0388367,
              14.7335077
            ],
            [
              121.0380761,
              14.7338206
            ],
            [
              121.037854,
              14.7340211
            ],
            [
              121.0376321,
              14.7340467
            ],
            [
              121.0376692,
              14.7342024
            ],
            [
              121.0377287,
              14.73424
            ],
            [
              121.0379938,
              14.7345354
            ],
            [
              121.0383244,
              14.7345512
            ],
            [
              121.0381155,
              14.7347706
            ],
            [
              121.0385801,
              14.7348807
            ],
            [
              121.038535,
              14.7358244
            ],
            [
              121.0394341,
              14.7358148
            ],
            [
              121.0394351,
              14.737755
            ],
            [
              121.0394248,
              14.739706
            ],
            [
              121.039221,
              14.7397119
            ],
            [
              121.038909,
              14.739963
            ],
            [
              121.0385103,
              14.740294
            ],
            [
              121.0362582,
              14.7380574
            ],
            [
              121.0308457,
              14.732682
            ],
            [
              121.0309747,
              14.7323659
            ],
            [
              121.0307054,
              14.7318569
            ],
            [
              121.0305727,
              14.731678
            ],
            [
              121.0315264,
              14.731661
            ],
            [
              121.0321517,
              14.7314315
            ],
            [
              121.0320408,
              14.731012
            ],
            [
              121.0314789,
              14.7307667
            ],
            [
              121.0316926,
              14.7306084
            ],
            [
              121.0320171,
              14.7303947
            ],
            [
              121.0321358,
              14.7301731
            ],
            [
              121.0319854,
              14.7298011
            ],
            [
              121.0319221,
              14.7294766
            ],
            [
              121.031843,
              14.7287485
            ],
            [
              121.0315027,
              14.7284002
            ],
            [
              121.0307429,
              14.7275929
            ],
            [
              121.0308932,
              14.7273476
            ],
            [
              121.030917,
              14.726564
            ],
            [
              121.0305371,
              14.7259071
            ],
            [
              121.0305529,
              14.7257488
            ],
            [
              121.0311666,
              14.7257024
            ],
            [
              121.0313704,
              14.7260136
            ],
            [
              121.03278,
              14.7251615
            ],
            [
              121.0328827,
              14.7251584
            ],
            [
              121.0334697,
              14.7251677
            ],
            [
              121.0335915,
              14.7251149
            ],
            [
              121.0336986,
              14.7250318
            ],
            [
              121.0337791,
              14.7247737
            ],
            [
              121.0337986,
              14.7242198
            ],
            [
              121.0337475,
              14.7240648
            ],
            [
              121.0337262,
              14.7238841
            ],
            [
              121.0337991,
              14.7237829
            ],
            [
              121.0339548,
              14.7238923
            ],
            [
              121.0340238,
              14.7239494
            ],
            [
              121.0343209,
              14.7241666
            ],
            [
              121.0345247,
              14.7245091
            ],
            [
              121.0348466,
              14.7244987
            ],
            [
              121.0350397,
              14.7244468
            ],
            [
              121.0351899,
              14.7243223
            ],
            [
              121.0352766,
              14.7241053
            ],
            [
              121.0353129,
              14.7240297
            ],
            [
              121.0358589,
              14.7240308
            ],
            [
              121.0357821,
              14.7252793
            ],
            [
              121.0358157,
              14.7253211
            ],
            [
              121.0360202,
              14.7256467
            ],
            [
              121.0361597,
              14.7258101
            ],
            [
              121.0363294,
              14.7260979
            ],
            [
              121.0373104,
              14.7261798
            ],
            [
              121.0374644,
              14.7259099
            ],
            [
              121.0375542,
              14.7257789
            ],
            [
              121.0378052,
              14.725845
            ],
            [
              121.0380048,
              14.7258975
            ],
            [
              121.0382155,
              14.7262017
            ],
            [
              121.0386285,
              14.7262665
            ],
            [
              121.0389222,
              14.7263639
            ],
            [
              121.0390348,
              14.7262977
            ],
            [
              121.0394521,
              14.7265209
            ],
            [
              121.0397334,
              14.7268438
            ]
          ]
        ]
      },
      "id": "relation/1751066"
    },
    {
      "type": "Feature",
      "properties": {
        "@id": "node/251004902",
        "@relations": [
          {
            "role": "label",
            "rel": 1751066,
            "reltags": {
              "admin_level": "10",
              "boundary": "administrative",
              "name": "San Agustin",
              "postal_code": "1117",
              "ref": "137404095",
              "type": "boundary"
            }
          }
        ]
      },
      "geometry": {
        "type": "Point",
        "coordinates": [
          121.0386039,
          14.7295595
        ]
      },
      "id": "node/251004902"
    }
  ]
};

let map = null;

const loadSanAgustinBorderMap = async () => {
  // Initialize the map without a fixed center
  map = L.map('map-container');

  // Add tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Add GeoJSON layer
  const geoJsonLayer = L.geoJSON(brgySanAgustin, {
    style: {
      color: "#ff0000",
      weight: 2,
      opacity: 0.8,
      fillOpacity: 0.2
    },
    onEachFeature: function (feature, layer) {
      if (feature.properties) {
        let popupContent = `<strong>${feature.properties.name ?? "Unknown Area"}</strong><br>
                            <b>Admin Level:</b> ${feature.properties.admin_level ?? "N/A"}<br>
                            <b>Boundary:</b> ${feature.properties.boundary ?? "N/A"}<br>
                            <b>Postal Code:</b> ${feature.properties.postal_code ?? "N/A"}`;
        layer.bindPopup(popupContent);
      }
    }
  }).addTo(map);

  map.fitBounds(geoJsonLayer.getBounds());
}

const loadLandMarks = async () => {
    // Fetch landmarks from API
    try {
      const response = await axios.get(route('landmarks.list.all'));
      const landmarks = response.data.landmarks;
      // console.log("Fetched landmarks:", landmarks);
  
      landmarks.forEach(landmark => {
        if (landmark.latitude && landmark.longitude) {
          const mercatorPoints = convertWebMercatorToLatLng(landmark.latitude, landmark.longitude);
  
          // console.log(mercatorPoints);
          L.marker(mercatorPoints, { icon: landmarkIcon }) // Use custom icon
          //L.marker(mercatorPoints) // Use defualt icon
            .addTo(map)
            .bindPopup(`<strong>${landmark.name}</strong><br>${landmark.building_type ?? 'Not available'}<br><br>${landmark.description ?? 'No description'}`);
        }
      });
  
    } catch (error) {
      console.error("Error fetching landmarks:", error);
    }

}
onMounted(() => {
  loadSanAgustinBorderMap();
  loadLandMarks();

  window.addEventListener('resize', () => {
    setTimeout(() => {
      map.invalidateSize();
    }, 400);
  });
});
</script>

<style scoped>
#map-container {
  height: 1000px;
  width: 100%;
  margin: 20px 0;
  border-radius: 8px;
  z-index: 0;
}

/* Fix Leaflet icon paths */
:deep(.leaflet-default-icon-path) {
  background-image: url(https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png);
}
</style>