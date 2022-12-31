<html><head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head><body>
<?php
require_once'db.php';

if(isset( $_GET['edit'])){
$getProduct = $database->prepare("SELECT * FROM report WHERE id = :id");
$getProduct->bindParam("id",$_GET['edit']);
$getProduct->execute();
foreach($getProduct AS $result){
    $getFile = "data:" . $result['fileType'] . ";base64,".base64_encode($result['file']);

echo '
<div class="container">
  <div class="row">
    <div class="col">
	<img src="http://www.olivearabia.com/wp-content/uploads/2017/10/OliveArabia.png" class="img-thumbnail rounded"high="300px" width="300px"alt="...">
    </div>
    <div class="col">
	<p align="center">Health, Safety & Environmental Division
       Observation Management system
        Operations Observation Report</p>
    </div>
    <div class="col">
	<img src="https://pbs.twimg.com/media/FEtChtAXMAIN7mo?format=jpg&name=900x900" class="img-thumbnail  rounded"high="300px" width="300px"alt="...">
    </div>
  </div>
  <div class="container">
  <table class="table table-bordered">
  <tbody>
    <tr>
      <td>Date of inspection</td>
      <td>' .$result["date"] . '</td>
	  <td>Inspected by</td>
      <td>HSE</td>
    </tr>
    <tr>
      <td>Time of inspection</td>
	  <td>' .$result["time"] . '</td>
      <td>Action by</td>
      <td>' .$result["action"] . '</td>
    </tr>
    <tr>
      <td colspan="2">Subject:' .$result["sub"] . '</td>
      <td>Location</td>
	  <td>' .$result["location"] . '</td>
      <tr>
      <td colspan="2">Photo</td>
	  <td colspan="2">Observation </td>
      
    </tr>
    
    <tr>
      <td colspan="2"><img src="' .$getFile . '" width="300px" /></td>
	  <td colspan="2">' .$result["observation"] . '</td>
      
    </tr>
    <tr>
      <td colspan="2"><img src="' .$getFile . '" width="300px" /></td>
	  <td colspan="2">' .$result["observation"] . '</td>
      
    </tr>
  </tbody>
</table>

</div>
<h4 onclick="window.print();"> Print </h4>

';
}


}
?>

        

<script>
function Export2Doc(element, filename = '') {
            //  _html_ will be replace with custom html
            var meta= "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>";
            //  _styles_ will be replaced with custome css
            var head= "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n";
  
            var html = document.getElementById(element).innerHTML ;
            
            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });
            
            var  css = (
                   '<style>' +
                   'img {width:300px;}table {border-collapse: collapse; border-spacing: 0;}td{padding: 6px;}' +
                   '</style>'
                  );
//  Image Area %%%%
            var options = { maxWidth: 624};
            var images = Array();
            var img = $("#"+element).find("img");
            for (var i = 0; i < img.length; i++) {
                // Calculate dimensions of output image
                var w = Math.min(img[i].width, options.maxWidth);
                var h = img[i].height * (w / img[i].width);
                // Create canvas for converting image to data URL
                var canvas = document.createElement("CANVAS");
                canvas.width = w;
                canvas.height = h;
                // Draw image to canvas
                var context = canvas.getContext('2d');
                context.drawImage(img[i], 0, 0, w, h);
                // Get data URL encoding of image
                var uri = canvas.toDataURL("image/png");
                $(img[i]).attr("src", img[i].src);
                img[i].width = w;
                img[i].height = h;
                // Save encoded image to array
                images[i] = {
                    type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
                    encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
                    location: $(img[i]).attr("src"),
                    data: uri.substring(uri.indexOf(",") + 1)
                };
            }

            // Prepare bottom of mhtml file with image data
            var imgMetaData = "\n";
            for (var i = 0; i < images.length; i++) {
                imgMetaData += "--NEXT.ITEM-BOUNDARY\n";
                imgMetaData += "Content-Location: " + images[i].location + "\n";
                imgMetaData += "Content-Type: " + images[i].type + "\n";
                imgMetaData += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
                imgMetaData += images[i].data + "\n\n";
                
            }
            imgMetaData += "--NEXT.ITEM-BOUNDARY--";
// end Image Area %%

             var output = meta.replace("_html_", head.replace("_styles_", css) +  html) + imgMetaData;

            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(output);


            filename = filename ? filename + '.doc' : 'document.doc';


            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {

                downloadLink.href = url;
                downloadLink.download = filename;
                downloadLink.click();
            }

            document.body.removeChild(downloadLink);
        }
        </script></body></html>