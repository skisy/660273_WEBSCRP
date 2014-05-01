<?php 
  header("Content-type: image/svg+xml");
  echo '<?xml version="1.0" encoding="iso-8859-1"?>';
  echo '<?xml-stylesheet href="/660273/assets/css/style.php" type="text/css"?>'; ?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg class="imgLoader" version="1.1" 
     viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"
     xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink">

<g>
    <defs>
        <clipPath id="progressHighlight">
            <path  d="M 50 50 L 35 0 L 65 0 z" />
        </clipPath>

        <ellipse id="loadEllipse" clip-path="url(#progressHighlight)" 
        cx="50" cy="50" rx="40" ry="40" 
        style="fill:none; stroke:#cccccc" stroke-width="10" />
    </defs>


<use xlink:href="#loadEllipse" />
<use xlink:href="#loadEllipse" transform="rotate(40 50 50)" />
<use xlink:href="#loadEllipse" transform="rotate(80 50 50)" />
<use xlink:href="#loadEllipse" transform="rotate(120 50 50)"/>
<use xlink:href="#loadEllipse" transform="rotate(160 50 50)"/>
<use xlink:href="#loadEllipse" transform="rotate(200 50 50)"/>
<use xlink:href="#loadEllipse" transform="rotate(240 50 50)"/>
<use xlink:href="#loadEllipse" transform="rotate(280 50 50)"/>
<use xlink:href="#loadEllipse" transform="rotate(320 50 50)"/>


<ellipse class="highlightChev" clip-path="url(#progressHighlight)" cx="50" cy="50" rx="40" ry="40" fill="none" stroke-width="12" >
    <animateTransform attributeName="transform" attributeType="XML" type="rotate" values="0 50 50; 40 50 50; 80 50 50; 120 50 50; 160 50 50; 200 50 50; 240 50 50; 280 50 50; 320 50 50; 360 50 50" dur="1s" repeatCount="indefinite" additive="replace" calcMode="discrete" fill="freeze"/>
</ellipse>  
  </g>
</svg>