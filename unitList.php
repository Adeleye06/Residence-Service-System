<?php
require "authentication.php";
quitIfNotAdmin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit List</title>
    <link rel="stylesheet" href="assets/css/style_unit_list.css"> 

    <script>
    function showUnit(unit) {

        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("results").innerHTML=this.responseText;
            }
        }
        
        xmlhttp.open("GET","getUnitDetail.php?unit="+unit,true);
        xmlhttp.send();
    }
    </script>
</head>
<body>
    <header class="site-header">
        <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="ribbon">
        <p>Home &gt; Admin Dashboard &gt; Unit List </p>
    </div>

    <div class="content-section">
        <h1>Unit list</h1>
        <p>Hover over a letter to show Unit Detail</p>
        <br/>
        <br/>

        <div class="units-container">
            <table>
                <tr>
                    <td class="letter" id="letter_A">A</td>
                </tr>
<!-- Cullen Four Bedroom Unit -->
<tr><td><div onmouseover='showUnit("A101")'>A101</div></td></tr>
<tr><td><div onmouseover='showUnit("A102")'>A102</div></td></tr>
<tr><td><div onmouseover='showUnit("A103")'>A103</div></td></tr>
<tr><td><div onmouseover='showUnit("A104")'>A104</div></td></tr>
<tr><td><div onmouseover='showUnit("A105")'>A105</div></td></tr>
<tr><td><div onmouseover='showUnit("A106")'>A106</div></td></tr>

<tr>
    <td class="letter" id="letter_B">B</td>
</tr>
<tr><td><div onmouseover='showUnit("B107")'>B107</div></td></tr>
<tr><td><div onmouseover='showUnit("B108")'>B108</div></td></tr>
<tr><td><div onmouseover='showUnit("B109")'>B109</div></td></tr>
<tr><td><div onmouseover='showUnit("B110")'>B110</div></td></tr>
<tr>
    <td class="letter" id="letter_C">C</td>
</tr>
<tr><td><div onmouseover='showUnit("C111")'>C111</div></td></tr>
<tr><td><div onmouseover='showUnit("C112")'>C112</div></td></tr>
<tr><td><div onmouseover='showUnit("C113")'>C113</div></td></tr>
<tr><td><div onmouseover='showUnit("C114")'>C114</div></td></tr>

<tr>
    <td class="letter" id="letter_D">D</td>
</tr>
<tr><td><div onmouseover='showUnit("D115")'>D115</div></td></tr>
<tr><td><div onmouseover='showUnit("D116")'>D116</div></td></tr>
<tr><td><div onmouseover='showUnit("D117")'>D117</div></td></tr>
<tr><td><div onmouseover='showUnit("D118")'>D118</div></td></tr>

<tr>
    <td class="letter" id="letter_E">E</td>
</tr>
<tr><td><div onmouseover='showUnit("E119")'>E119</div></td></tr>
<tr><td><div onmouseover='showUnit("E120")'>E120</div></td></tr>
<tr><td><div onmouseover='showUnit("E121")'>E121</div></td></tr>
<tr><td><div onmouseover='showUnit("E122")'>E122</div></td></tr>
<tr>
    <td class="letter" id="letter_G">G</td>
</tr>
<tr><td><div onmouseover='showUnit("G127")'>G127</div></td></tr>
<tr>
    <td class="letter" id="letter_I">I</td>
</tr>
<tr><td><div onmouseover='showUnit("I131")'>I131</div></td></tr>
<tr><td><div onmouseover='showUnit("I132")'>I132</div></td></tr>
<tr><td><div onmouseover='showUnit("I133")'>I133</div></td></tr>
<tr><td><div onmouseover='showUnit("I134")'>I134</div></td></tr>
<!-- <p>Cullen Two Bedroom Unit</p> -->
<tr>
    <td class="letter" id="letter_F">F</td>
</tr>
<tr><td><div onmouseover='showUnit("F141")'>F141</div></td></tr>
<tr><td><div onmouseover='showUnit("F142")'>F142</div></td></tr>
<tr><td><div onmouseover='showUnit("F143")'>F143</div></td></tr>
<tr><td><div onmouseover='showUnit("F144")'>F144</div></td></tr>
<tr><td><div onmouseover='showUnit("F145")'>F145</div></td></tr>
<tr><td><div onmouseover='showUnit("F146")'>F146</div></td></tr>
<tr><td><div onmouseover='showUnit("F147")'>F147</div></td></tr>
<tr><td><div onmouseover='showUnit("F148")'>F148</div></td></tr>
<tr><td><div onmouseover='showUnit("F241")'>F241</div></td></tr>
<tr><td><div onmouseover='showUnit("F242")'>F242</div></td></tr>
<tr><td><div onmouseover='showUnit("F243")'>F243</div></td></tr>
<tr><td><div onmouseover='showUnit("F244")'>F244</div></td></tr>
<tr><td><div onmouseover='showUnit("F245")'>F245</div></td></tr>
<tr><td><div onmouseover='showUnit("F246")'>F246</div></td></tr>
<tr><td><div onmouseover='showUnit("F247")'>F247</div></td></tr>
<tr><td><div onmouseover='showUnit("F248")'>F248</div></td></tr>
<tr>
    <td class="letter" id="letter_J">J</td>
</tr>
<tr><td><div onmouseover='showUnit("J171")'>J171</div></td></tr>
<tr><td><div onmouseover='showUnit("J172")'>J172</div></td></tr>
<tr><td><div onmouseover='showUnit("J173")'>J173</div></td></tr>
<tr><td><div onmouseover='showUnit("J174")'>J174</div></td></tr>
<tr><td><div onmouseover='showUnit("J175")'>J175</div></td></tr>
<tr><td><div onmouseover='showUnit("J176")'>J176</div></td></tr>
<tr><td><div onmouseover='showUnit("J177")'>J177</div></td></tr>
<tr><td><div onmouseover='showUnit("J178")'>J178</div></td></tr>
<tr><td><div onmouseover='showUnit("J271")'>J271</div></td></tr>
<tr><td><div onmouseover='showUnit("J272")'>J272</div></td></tr>
<tr><td><div onmouseover='showUnit("J273")'>J273</div></td></tr>
<tr><td><div onmouseover='showUnit("J274")'>J274</div></td></tr>
<tr><td><div onmouseover='showUnit("J275")'>J275</div></td></tr>
<tr><td><div onmouseover='showUnit("J276")'>J276</div></td></tr>
<tr><td><div onmouseover='showUnit("J277")'>J277</div></td></tr>
<tr><td><div onmouseover='showUnit("J278")'>J278</div></td></tr>
<tr>
    <td class="letter" id="letter_M">M</td>
</tr>
<tr><td><div onmouseover='showUnit("M156")'>M156</div></td></tr>
<tr><td><div onmouseover='showUnit("M251")'>M251</div></td></tr>
<tr><td><div onmouseover='showUnit("M252")'>M252</div></td></tr>
<tr><td><div onmouseover='showUnit("M253")'>M253</div></td></tr>
<tr><td><div onmouseover='showUnit("M254")'>M254</div></td></tr>
<tr><td><div onmouseover='showUnit("M255")'>M255</div></td></tr>
<tr><td><div onmouseover='showUnit("M256")'>M256</div></td></tr>
<!-- <p>30th Ave Residence</p> -->
<tr>
    <td class="letter" id="letter_N">N</td>
</tr>
<tr><td><div onmouseover='showUnit("N1")'>N1</div></td></tr>
<tr><td><div onmouseover='showUnit("N2")'>N2</div></td></tr>
<tr><td><div onmouseover='showUnit("N3")'>N3</div></td></tr>
<tr><td><div onmouseover='showUnit("N4")'>N4</div></td></tr>
<tr><td><div onmouseover='showUnit("N5")'>N5</div></td></tr>
<tr><td><div onmouseover='showUnit("N6")'>N6</div></td></tr>
<tr>
    <td class="letter" id="letter_O">O</td>
</tr>
<tr><td><div onmouseover='showUnit("O1")'>O1</div></td></tr>
<tr><td><div onmouseover='showUnit("O2")'>O2</div></td></tr>
<tr><td><div onmouseover='showUnit("O3")'>O3</div></td></tr>
<tr><td><div onmouseover='showUnit("O4")'>O4</div></td></tr>
<tr>
    <td class="letter" id="letter_P">P</td>
</tr>
<tr><td><div onmouseover='showUnit("P1")'>P1</div></td></tr>
<tr><td><div onmouseover='showUnit("P2")'>P2</div></td></tr>
<tr><td><div onmouseover='showUnit("P3")'>P3</div></td></tr>
<tr><td><div onmouseover='showUnit("P4")'>P4</div></td></tr>
<tr>
    <td class="letter" id="letter_Q">Q</td>
</tr>
<tr><td><div onmouseover='showUnit("Q1")'>Q1</div></td></tr>
<tr><td><div onmouseover='showUnit("Q2")'>Q2</div></td></tr>
<tr><td><div onmouseover='showUnit("Q3")'>Q3</div></td></tr>
<tr><td><div onmouseover='showUnit("Q4")'>Q4</div></td></tr>
<tr>
    <td class="letter" id="letter_R">R</td>
</tr>
<tr><td><div onmouseover='showUnit("R1")'>R1</div></td></tr>
<tr><td><div onmouseover='showUnit("R2")'>R2</div></td></tr>
<tr><td><div onmouseover='showUnit("R3")'>R3</div></td></tr>
<tr><td><div onmouseover='showUnit("R4")'>R4</div></td></tr>
<tr>
    <td class="letter" id="letter_S">S</td>
</tr>
<tr><td><div onmouseover='showUnit("S1")'>S1</div></td></tr>
<tr><td><div onmouseover='showUnit("S2")'>S2</div></td></tr>
<tr><td><div onmouseover='showUnit("S3")'>S3</div></td></tr>
<tr><td><div onmouseover='showUnit("S4")'>S4</div></td></tr>
<tr>
    <td class="letter" id="letter_T">T</td>
</tr>
<tr><td><div onmouseover='showUnit("T1")'>T1</div></td></tr>
<tr><td><div onmouseover='showUnit("T2")'>T2</div></td></tr>
<tr><td><div onmouseover='showUnit("T3")'>T3</div></td></tr>
<tr><td><div onmouseover='showUnit("T4")'>T4</div></td></tr>
<tr>
    <td class="letter" id="letter_U">U</td>
</tr>
<tr><td><div onmouseover='showUnit("U1")'>U1</div></td></tr>
<tr><td><div onmouseover='showUnit("U2")'>U2</div></td></tr>
<tr><td><div onmouseover='showUnit("U3")'>U3</div></td></tr>
<tr><td><div onmouseover='showUnit("U4")'>U4</div></td></tr>
<tr>
    <td class="letter" id="letter_V">V</td>
</tr>
<tr><td><div onmouseover='showUnit("V1")'>V1</div></td></tr>
<tr><td><div onmouseover='showUnit("V2")'>V2</div></td></tr>
<tr><td><div onmouseover='showUnit("V3")'>V3</div></td></tr>
<tr><td><div onmouseover='showUnit("V4")'>V4</div></td></tr>
<tr>
    <td class="letter" id="letter_W">W</td>
</tr>
<tr><td><div onmouseover='showUnit("W1")'>W1</div></td></tr>
<tr><td><div onmouseover='showUnit("W2")'>W2</div></td></tr>
<tr><td><div onmouseover='showUnit("W3")'>W3</div></td></tr>
<tr><td><div onmouseover='showUnit("W4")'>W4</div></td></tr>
<tr><td><div onmouseover='showUnit("W5")'>W5</div></td></tr>
<tr><td><div onmouseover='showUnit("W6")'>W6</div></td></tr>
<tr>
    <td class="letter" id="letter_X">X</td>
</tr>
<tr><td><div onmouseover='showUnit("X1")'>X1</div></td></tr>
<tr><td><div onmouseover='showUnit("X2")'>X2</div></td></tr>
<tr><td><div onmouseover='showUnit("X3")'>X3</div></td></tr>
<tr><td><div onmouseover='showUnit("X4")'>X4</div></td></tr>
<tr>
    <td class="letter" id="letter_Y">Y</td>
</tr>
<tr><td><div onmouseover='showUnit("Y1")'>Y1</div></td></tr>
<tr><td><div onmouseover='showUnit("Y2")'>Y2</div></td></tr>
<tr><td><div onmouseover='showUnit("Y3")'>Y3</div></td></tr>
<tr><td><div onmouseover='showUnit("Y4")'>Y4</div></td></tr>
<!-- <p>Kodiak House</p> -->
<tr>
    <td class="letter" id="letter_K">K</td>
</tr>

<tr><td><div onmouseover='showUnit("KH1010")'>KH1010</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1012")'>KH1012</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1013")'>KH1013</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1014")'>KH1014</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1015")'>KH1015</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1016")'>KH1016</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1017")'>KH1017</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1018")'>KH1018</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1020")'>KH1020</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1021")'>KH1021</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1022")'>KH1022</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1023")'>KH1023</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1024")'>KH1024</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1025")'>KH1025</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1026")'>KH1026</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1029")'>KH1029</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1030")'>KH1030</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1031")'>KH1031</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1032")'>KH1032</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1033")'>KH1033</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1034")'>KH1034</div></td></tr>
<tr><td><div onmouseover='showUnit("KH1035")'>KH1035</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2010")'>KH2010</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2011")'>KH2011</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2012")'>KH2012</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2013")'>KH2013</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2014")'>KH2014</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2015")'>KH2015</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2016")'>KH2016</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2017")'>KH2017</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2018")'>KH2018</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2020")'>KH2020</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2021")'>KH2021</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2022")'>KH2022</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2023")'>KH2023</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2024")'>KH2024</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2025")'>KH2025</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2026")'>KH2026</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2029")'>KH2029</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2030")'>KH2030</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2031")'>KH2031</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2032")'>KH2032</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2033")'>KH2033</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2034")'>KH2034</div></td></tr>
<tr><td><div onmouseover='showUnit("KH2035")'>KH2035</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3010")'>KH3010</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3011")'>KH3011</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3012")'>KH3012</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3013")'>KH3013</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3014")'>KH3014</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3015")'>KH3015</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3016")'>KH3016</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3017")'>KH3017</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3018")'>KH3018</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3020")'>KH3020</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3021")'>KH3021</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3022")'>KH3022</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3023")'>KH3023</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3024")'>KH3024</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3025")'>KH3025</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3026")'>KH3026</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3029")'>KH3029</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3030")'>KH3030</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3031")'>KH3031</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3032")'>KH3032</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3033")'>KH3033</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3034")'>KH3034</div></td></tr>
<tr><td><div onmouseover='showUnit("KH3035")'>KH3035</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4010")'>KH4010</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4011")'>KH4011</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4012")'>KH4012</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4013")'>KH4013</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4014")'>KH4014</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4015")'>KH4015</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4016")'>KH4016</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4017")'>KH4017</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4018")'>KH4018</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4020")'>KH4020</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4021")'>KH4021</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4022")'>KH4022</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4023")'>KH4023</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4024")'>KH4024</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4025")'>KH4025</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4026")'>KH4026</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4029")'>KH4029</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4030")'>KH4030</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4031")'>KH4031</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4032")'>KH4032</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4033")'>KH4033</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4034")'>KH4034</div></td></tr>
<tr><td><div onmouseover='showUnit("KH4035")'>KH4035</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5010")'>KH5010</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5011")'>KH5011</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5012")'>KH5012</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5013")'>KH5013</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5014")'>KH5014</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5015")'>KH5015</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5016")'>KH5016</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5017")'>KH5017</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5018")'>KH5018</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5020")'>KH5020</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5021")'>KH5021</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5022")'>KH5022</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5023")'>KH5023</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5024")'>KH5024</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5025")'>KH5025</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5026")'>KH5026</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5029")'>KH5029</div></td></tr>
<tr><td><div onmouseover='showUnit("KH5030")'>KH5030</div></td></tr>
</table>

</div><div style='float:right; align:left; width:95%;' id='results' >here is the list</div>
<footer class="site-footer">
            <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
            <p>3000 College Dr S, Lethbridge, Alberta, Canada, T1K 1L6</p>
            <p>1-800-572-0103</p>
            <nav>
                <a href="contact.php">Contacts and Maps</a>
            </nav>
        </footer>

</body>
</html>