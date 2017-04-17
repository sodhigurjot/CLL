<?php
include('library.php');
if(empty($_SESSION['sid']) || $_SESSION['sid']==''){
    header("Location: index.php");
    exit();   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dictionary</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dictionary.css">        
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <style>
            .card-box {
                background: #fff;
                border-radius: 2px;
                box-shadow: 0 0 4px 0 rgba(0,0,0,.10);
                clear: both;
                float: none;
                margin-bottom: 1.25em;
                min-height: 5em;
                overflow: hidden;
                padding: 1.9375em 1.3125em;
                position: relative;
                width:50%;
                margin-left: 25%;
            }
            .text-muted {
                color: #636c72 !important;
            }
        </style>
    </head>
    <body>
        <div style="text-align:right; margin-right:20%;"><a href="studentmain.php"><i class="fa fa-home" aria-hidden="true">Home</i></a></div>
        <h1 style="text-align: center;">Dictionary</h1>        
        <form method="get" action="">
            <input type="text" name="search" />
            <div class="after"></div>
            <input type="submit" />
        </form>
        <h4>&nbsp;</h4>
        <p>Click search, Enter to submit</p>
        <br>
        <?php
           if(isset($_REQUEST["search"]) && $_REQUEST["search"]!=''){ 
        ?>
        <div class="card-box">       
            <h2 style="margin:0;"><?php echo $_REQUEST["search"]; ?></h2>
            <h5 style="display: inline-block; margin:0;">
                <div id="pronunciation" style="">
                </div>
            </h5>
            <audio id="audio" src="" ></audio>
            <i class="fa fa-volume-up" aria-hidden="true" onclick="play()" title="Listen"></i>        
            <div id="meaning"></div>
            <div class="text-muted" style="display:inline-block;">
                <i>                    
                    <div id="sentence">
                    </div>                    
                </i>
            </div>
            <h3 style="margin-bottom:0;">Synonyms:</h3>
            <div id="synonyms"></div>
        </div>
        <?php } ?>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/dictionary.js"></script>
        <?php
            $dic_text = "";
            if(isset($_REQUEST["search"]) && $_REQUEST["search"]!=''){
                $dic_text = $_REQUEST["search"];
            }
        ?>
        <script>
        var url1 = "http://api.wordnik.com:80/v4/word.json/";
        var word = "<?php echo $_REQUEST["search"]; ?>";
        var url2 = "/definitions?limit=5&includeRelated=true&sourceDictionaries=all&useCanonical=true&includeTags=false&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5";
        
        var ur1 = "http://api.wordnik.com:80/v4/word.json/";
        var pro = "<?php echo $_REQUEST["search"]; ?>";
        var ur2 = "/pronunciations?useCanonical=false&typeFormat=ahd&limit=1&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5";
        
        var ur3 = "http://api.wordnik.com:80/v4/word.json/";
        var syn = "<?php echo $_REQUEST["search"]; ?>";
        var ur4 = "/relatedWords?useCanonical=false&relationshipTypes=synonym&limitPerRelationshipType=10&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5";
        
        var ur5 = "http://api.wordnik.com:80/v4/word.json/";
        var audio = "<?php echo $_REQUEST["search"]; ?>";
        var ur6 = "/audio?useCanonical=false&limit=1&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5";
        
        var ur7 = "http://api.wordnik.com:80/v4/word.json/";
        var sen = "<?php echo $_REQUEST["search"]; ?>";
        var ur8 = "/topExample?useCanonical=false&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5";
        
        
        function Get(yourUrl){
            var Httpreq = new XMLHttpRequest(); 
            Httpreq.open("GET",yourUrl,false);
            Httpreq.send(null);
            return Httpreq.responseText;          
        }

        var json_obj = JSON.parse(Get(url1+word+url2));
        var pron = JSON.parse(Get(ur1+pro+ur2));
        var syno = JSON.parse(Get(ur3+syn+ur4));
        var aud = JSON.parse(Get(ur5+audio+ur6));
        var payload = json_obj[0].text;
        var payload1 = pron[0].raw;
        var payload2 = syno[0].words;
        var payload2Join = payload2.join(", ");
        var payload3 = aud[0].fileUrl;
        
        var sentence = JSON.parse(Get(ur7+sen+ur8));
        var payload4 = sentence.text;
        document.getElementById("meaning").textContent=payload;
        document.getElementById("pronunciation").textContent=payload1;
        document.getElementById("synonyms").textContent=payload2Join;
        document.getElementById("audio").src=payload3;
        document.getElementById("sentence").textContent="'"+payload4+"'";
        //alert(payload2Join);
        //alert(json_obj[0].text);
        //alert(pron[0].raw);      
        function play(){
            var audio = document.getElementById("audio");
            audio.play();
        }
        </script>
    </body>
</html>