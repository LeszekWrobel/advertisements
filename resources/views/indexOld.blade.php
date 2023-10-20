<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    
</head>
<body>
    
    <form action="{{ 'uploadFile' }}" class="dropzone"></form>

    <!-- Script -->
    <script type="text/javascript">
    var CSRF_TOKEN = document.querySelector(meta[name="csrf-token"]).getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 2, // 2 Mb
        acceptedFiles: ".png,.jpeg,.jpg"
    })

    myDropzone.on("sending", function(file,xhr,formData){
        formData.append("_token", CSRF_TOKEN)
    })
    myDropzone.on("success", function(file, response){
        if(response.success == 0) { //error
            alert(response.error);
        }
    })
    </script>
</body>
</html>