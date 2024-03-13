<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="file.css">
</head>
<body>
    <h1>File Upload</h1>
    <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
        <label for="images" class="drop-container" id="dropcontainer">
            <span class="drop-title">Drop files here</span>
            or
            <input type="file" id="upload" name="upload" accept="" required>
            <input type="submit" style="justify-content: center;">
          </label>
          
    </form>
    <!-- <div>
        <img src="fileupload.php" alt="" width="100px" height="100px">
    </div> -->

    <script>
        const dropContainer = document.getElementById("dropcontainer")
        const fileInput = document.getElementById("upload")

        dropContainer.addEventListener("dragover", (e) => {
        // prevent default to allow drop
        e.preventDefault()
    }, false)

        dropContainer.addEventListener("dragenter", () => {
        dropContainer.classList.add("drag-active")
    })

        dropContainer.addEventListener("dragleave", () => {
        dropContainer.classList.remove("drag-active")
     })

  dropContainer.addEventListener("drop", (e) => {
    e.preventDefault()
    dropContainer.classList.remove("drag-active")
    fileInput.files = e.dataTransfer.files
  })
    </script>
</body>
</html>